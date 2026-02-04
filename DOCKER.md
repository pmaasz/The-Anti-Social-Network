# Docker Setup for The Anti-Social Network

## Quick Start

### 1. Build and Start Containers

```bash
docker-compose up -d --build
```

This will start:
- **PHP 8.0-FPM** container (antisocial_php)
- **Nginx** web server (antisocial_nginx) on port 8000
- **MySQL 8.0** database (antisocial_db) on port 13306
- **Adminer** database management tool on port 8080

### 2. Create Database Schema

```bash
# Run migrations
docker-compose exec php php bin/console doctrine:migrations:migrate

# Or create schema directly
docker-compose exec php php bin/console doctrine:schema:create
```

### 3. Access the Application

- **Web Application**: http://localhost:8000
- **Adminer (DB Manager)**: http://localhost:8080
  - System: MySQL
  - Server: db
  - Username: antisocial_user
  - Password: antisocial_pass
  - Database: antisocial_db

## Available Commands

### Container Management

```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# View logs
docker-compose logs -f

# View logs for specific service
docker-compose logs -f php
docker-compose logs -f nginx
```

### Application Commands

```bash
# Clear cache
docker-compose exec php php bin/console cache:clear

# Run tests
docker-compose exec php php vendor/bin/phpunit tests/

# Access PHP container shell
docker-compose exec php bash

# Install new dependencies
docker-compose exec php composer require package/name
```

### Database Commands

```bash
# Create database
docker-compose exec php php bin/console doctrine:database:create

# Run migrations
docker-compose exec php php bin/console doctrine:migrations:migrate

# Update schema
docker-compose exec php php bin/console doctrine:schema:update --force

# Connect to MySQL directly
docker-compose exec db mysql -uantisocial_user -pantisocial_pass antisocial_db
```

## Environment Variables

The following environment variables are configured in `docker-compose.yaml`:

- `DATABASE_URL`: mysql://antisocial_user:antisocial_pass@db:3306/antisocial_db?serverVersion=8.0
- `APP_ENV`: dev
- `APP_SECRET`: f07dbab351c337e3d128466665467edf

## Ports

- **8000**: Nginx web server (Application)
- **8080**: Adminer database management
- **13306**: MySQL database (external access)

## Volumes

- **db_data**: Persistent MySQL data storage
- **./**: Application code (mounted to /var/www/html)

## Troubleshooting

### Permission Issues

```bash
# Fix permissions on var directory
docker-compose exec php chown -R www-data:www-data /var/www/html/var
docker-compose exec php chmod -R 755 /var/www/html/var
```

### Database Connection Issues

```bash
# Check if database is ready
docker-compose exec db mysql -uroot -proot_password -e "SHOW DATABASES;"

# Verify database user
docker-compose exec db mysql -uroot -proot_password -e "SELECT user, host FROM mysql.user;"
```

### Rebuild from Scratch

```bash
# Stop and remove all containers, networks, and volumes
docker-compose down -v

# Rebuild and start
docker-compose up -d --build

# Recreate database schema
docker-compose exec php php bin/console doctrine:schema:create
```

## Development Workflow

1. Make code changes in your local directory
2. Changes are automatically reflected (volumes are mounted)
3. Clear cache if needed: `docker-compose exec php php bin/console cache:clear`
4. Run tests: `docker-compose exec php php vendor/bin/phpunit tests/`

## Production Notes

⚠️ **This setup is for development only!** For production:

- Change all passwords
- Use environment variables from `.env` file
- Enable production mode (`APP_ENV=prod`)
- Use proper SSL certificates
- Configure proper MySQL authentication
- Remove Adminer service
- Use optimized Docker images
