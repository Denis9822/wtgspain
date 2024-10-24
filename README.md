Copy env.example

```bash
  cp .env.example .env
```

Docker build & up

```bash
  docker compose build
  docker compose up -d
```

Install dependencies

```bash
  docker compose exec php composer install
```

Generate key

```bash
  docker compose exec php php artisan key:generate
```

Run migrations and seeders

```bash
  docker compose exec php php artisan migrate --seed
```

Run server!!

```bash
  php artisan serve
```
