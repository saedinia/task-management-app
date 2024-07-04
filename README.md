# Task Management App

## Overview

This is a Task Management App developed with Symfony for the backend and Next.js for the frontend. The application uses Docker to simplify the development environment and ensure compatibility across Windows and Linux.

## Prerequisites

- Docker
- Docker Compose
- For better performance and speed, it is recommended to use Linux or WSL (Windows Subsystem for Linux) on Windows.

## Installation

### Step 1: Clone the repository

```bash
git clone git@github.com:saedinia/task-management-app.git
cd task-management-app
```

### Step 2: Run Docker Compose

```bash
docker-compose up --build -d
```

### Step 3: Verify the services

- Next.js: http://localhost:3000
- Symfony: http://localhost:8000
- Nginx (Reverse Proxy): http://localhost

## Project Structure

```plaintext
.
├── nextjs
│   ├── app
│   ├── public
│   ├── src
│   ├── Dockerfile
│   └── start.sh
├── nginx
│   └── conf.d
│       └── default.conf
├── symfony
│   ├── bin
│   ├── config
│   ├── migrations
│   ├── public
│   ├── src
│   ├── templates
│   ├── tests
│   ├── var
│   ├── vendor
│   ├── Dockerfile
│   └── composer.json
└── docker-compose.yml

```

## Useful Commands

### View container logs

```bash
docker-compose logs -f
```

### Stop containers

```bash
docker-compose down
```

## Install dependencies

If new dependencies are added, install them using the following commands:

### For Symfony

```bash
docker-compose exec symfony-app composer install
```

### For Next.js

```bash
docker-compose exec nextjs-app npm install
```

## API Endpoints

The API endpoints are provided by Symfony and can be accessed under /api. Example:

- Create a new task: POST /api/tasks

  - Request Body:

    ```json
    {
      "title": "New Task",
      "description": "Task description"
    }
    ```

## License

This project is licensed under the MIT License.
