# Laravel Task Management Application

This is a task management application built with Laravel and Docker.

## Requirements

- Docker
- Docker Compose

## Setup

1. Clone the repository
2. Copy `.env.example` to `.env` and configure your environment variables
3. Run the following commands:

```bash
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```

## Development

The application is running at http://localhost:8000

## Features

- User authentication (Laravel Breeze)
- Task management (coming soon)
