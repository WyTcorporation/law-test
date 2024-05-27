# Log Analytics API

## Опис

Цей проект реалізує API для аналізу логів, яке дозволяє отримувати кількість записів логів, 
що відповідають певним критеріям.

## Вимоги

- Docker
- Docker Compose

## Налаштування

1. Клонуйте репозиторій:
    ```bash
    git clone <repository-url>
    cd log-analytics-api
    ```

2. Запустіть Docker:
    ```bash
    docker-compose up --build
    ```

3. Доступ до API буде за адресою:
    ```
    http://localhost:8000
    ```

## Використання API

- `GET /count`: Повертає кількість логів, що відповідають критеріям.
    - Параметри:
        - `serviceNames` (optional): Масив імен сервісів
        - `startDate` (optional): Початкова дата у форматі ISO 8601
        - `endDate` (optional): Кінцева дата у форматі ISO 8601
        - `statusCode` (optional): Код статусу запиту

## Тестування

Запустіть тести за допомогою PHPUnit:

```bash

docker-compose exec app php bin/phpunit

