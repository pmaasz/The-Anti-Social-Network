# The Anti-Social Network

## A falsely functioning social network

This project aims to show badly implemented features. Most of the features should be commonly used and wide spread features in the world of webapplications. To showcase those implementations, a social network context was chosen. Hence the name The Anti-Social Network. Some features will be implemented just to annoy the user, just for fun or due to the given amount of stupidity.

## Quick Start with Docker 🐳

```bash
# Clone the repository
git clone <repository-url>
cd The-Anti-Social-Network

# Run the automated setup script
./setup-docker.sh

# Or manually:
docker-compose up -d --build
docker-compose exec php php bin/console doctrine:schema:create
```

**Access the application:**
- 🌐 Web App: http://localhost:8000
- 🗄️ Adminer (Database): http://localhost:8080
- 🧪 Run Tests: `docker-compose exec php php vendor/bin/phpunit tests/`

See [DOCKER.md](DOCKER.md) for complete Docker documentation.

## Features

A list of features to come:

<ul>
  <li>
     a widely used feature is the login feature. Here the user will get the username of the entered password instead of a wrong password prompt.
  </li>
  <li>
     the user will be asked for microphone and camera access frequently.
  </li>
  <li>
    badly triggered success messages/warnings.
  </li>
  <li>
    secondary action buttons will be higlighted instead of primary actions.
  </li>
  <li>
    bad UI. standard bootstrap.
  </li>
  <li>
    automatically triggers download of Zen Browser.
  </li>
</ul>

## Testing

Run the comprehensive test suite:

```bash
# With Docker
docker-compose exec php php vendor/bin/phpunit tests/

# Without Docker
php vendor/bin/phpunit tests/
```

**Test Coverage:** 23 tests with 26 assertions covering:
- Security Controller (register, login, password reset, profile)
- User Entity (authentication, roles, relationships)
- Entry Entity (posts, media, YouTube links, social features)

