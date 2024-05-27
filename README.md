# Log Analytics API

## Description

This project implements an API for log analysis, allowing you to retrieve the number of log entries that match certain criteria.

## Requirements

- Docker
- Docker Compose

## Setup

1. Clone the repository:
    ```bash
    git clone <repository-url>
    cd log-analytics-api
    ```

2. Start Docker:
    ```bash
    docker-compose up --build
    ```

3. Access the API at:
    ```
    http://localhost:8000
    ```

## Using the API

- `GET /count`: Returns the count of logs that match the criteria.
    - Parameters:
        - `serviceNames` (optional): Array of service names
        - `startDate` (optional): Start date in ISO 8601 format
        - `endDate` (optional): End date in ISO 8601 format
        - `statusCode` (optional): Request status code

## Testing

Run tests using PHPUnit:

```bash
docker-compose exec app php bin/phpunit
```
