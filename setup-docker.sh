#!/bin/bash

echo "🚀 Setting up The Anti-Social Network with Docker..."

# Build and start containers
echo "📦 Building Docker containers..."
docker-compose up -d --build

# Wait for MySQL to be ready
echo "⏳ Waiting for MySQL to be ready..."
sleep 10

# Create database if it doesn't exist
echo "🗄️  Creating database..."
docker-compose exec -T php php bin/console doctrine:database:create --if-not-exists

# Run migrations or create schema
echo "📊 Setting up database schema..."
docker-compose exec -T php php bin/console doctrine:schema:create || \
docker-compose exec -T php php bin/console doctrine:schema:update --force

# Clear cache
echo "🧹 Clearing cache..."
docker-compose exec -T php php bin/console cache:clear

# Set permissions
echo "🔐 Setting permissions..."
docker-compose exec -T php chown -R www-data:www-data /var/www/html/var
docker-compose exec -T php chmod -R 755 /var/www/html/var

echo ""
echo "✅ Setup complete!"
echo ""
echo "🌐 Application is available at:"
echo "   - Web App: http://localhost:8000"
echo "   - Adminer: http://localhost:8080"
echo ""
echo "📝 Database credentials:"
echo "   - Server: db"
echo "   - User: antisocial_user"
echo "   - Password: antisocial_pass"
echo "   - Database: antisocial_db"
echo ""
echo "🧪 Run tests with: docker-compose exec php php vendor/bin/phpunit tests/"
echo ""
