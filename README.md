# Prisma — Unified Media Diary

Prisma is a unified entertainment hub: a single, private, and fragmentation-free
place to find, save, and track **movies, Western series, doramas, anime, and
manga** on one virtual shelf.

Any work in the world can be searched in one place — no jumping between niche
sites, no ads, and no features locked behind paywalls.

> **Status:** early-stage application. The base is the official Laravel
> [Livewire starter kit](https://github.com/laravel/livewire-starter-kit) for
> Laravel 13, and the local development environment (Laravel Sail + MySQL) is
> ready.

## Table of contents

- [Stack](#stack)
- [Requirements](#requirements)
- [Installation](#installation)
  - [Option A — Pure PHP (SQLite)](#option-a--pure-php-sqlite)
  - [Option B — Laravel Sail (Docker)](#option-b--laravel-sail-docker)
- [Sail cheat sheet](#sail-cheat-sheet)
- [Testing](#testing)
- [Code quality](#code-quality)
- [Project structure](#project-structure)
- [Architecture](#architecture)
- [Product vision (roadmap)](#product-vision-roadmap)
- [Contributing](#contributing)
- [License](#license)

## Stack

| Layer      | Technology                                                    |
| ---------- | ------------------------------------------------------------- |
| Backend    | PHP 8.3+ (the Sail container runs PHP 8.5) · Laravel 13        |
| UI         | Livewire 4 · Blade (Alpine.js ships with Livewire)             |
| Styling    | Tailwind CSS v4                                                |
| Build      | Vite (via `vite-plus`) · Laravel Vite plugin                   |
| Database   | SQLite by default · MySQL 8.4 via Laravel Sail                 |
| Services   | Redis and Mailpit (dockerized, optional — see `compose.yaml`)  |
| Quality    | Pest · PHPUnit · PHPStan (Larastan) · Laravel Pint             |

## Requirements

**Option A — Pure PHP**

- PHP **8.3+** with the `pdo_sqlite` extension (bundled with most PHP builds).
- [Composer](https://getcomposer.org/) 2.
- Node.js **22+** and npm.

**Option B — Laravel Sail (Docker)**

- **Docker** with Docker Compose.
- **Git**.

With Sail you do **not** need PHP, Composer, Node, or MySQL installed on the
host — the containers provide PHP 8.5, Node, and MySQL 8.4. The first
`composer install` runs from a dedicated Composer Docker image.

**Both options**

- **Git**, to clone the repository.

## Installation

### Option A — Pure PHP (SQLite)

The `.env.example` file is configured for **SQLite**, so no database server is
required to get started.

```bash
# 1) Clone the repository
git clone git@github.com:devc4rlos/prisma.git
cd prisma

# 2) Install PHP dependencies
composer install

# 3) Configure the environment
cp .env.example .env
php artisan key:generate

# Optionally set APP_NAME=Prisma in .env

# 4) Create the SQLite database file and run migrations + seed
touch database/database.sqlite
php artisan migrate --seed

# 5) Install and build the frontend
npm install
npm run build # or: npm run dev

# 6) Serve the application
php artisan serve # http://localhost:8000
```

### Option B — Laravel Sail (Docker)

[Laravel Sail](https://laravel.com/docs/sail) is already present in
`require-dev`. Because `vendor/` is not versioned, the first step installs the
PHP dependencies using a Docker image — so you do **not** need PHP or Composer
on your machine. On the first `up`, the application container (`sail-8.5/app`)
is built, which can take a few minutes.

```bash
# 1) Clone the repository
git clone git@github.com:devc4rlos/prisma.git
cd prisma

# 2) Install PHP dependencies via Docker (no local PHP/Composer required)
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  composer:2 \
  composer install --ignore-platform-reqs

# 3) Configure the environment
cp .env.example .env
# Point the application at the Sail services by editing the DB/REDIS/MAIL
# entries in .env:
#   DB_CONNECTION=mysql
#   DB_HOST=mysql
#   DB_PORT=3306
#   DB_DATABASE=prisma
#   DB_USERNAME=sail
#   DB_PASSWORD=password
#   REDIS_HOST=redis
#   MAIL_MAILER=smtp
#   MAIL_HOST=mailpit
#   MAIL_PORT=1025

# 4) Start the containers (application + MySQL + Redis + Mailpit)
./vendor/bin/sail up -d

# 5) Generate the application key
./vendor/bin/sail artisan key:generate

# 6) Install frontend dependencies
./vendor/bin/sail npm install

# 7) Run migrations and seed
./vendor/bin/sail artisan migrate --seed

# 8) Build the frontend — or run the dev server while developing
./vendor/bin/sail npm run build
# ./vendor/bin/sail npm run dev
```

The application is available at <http://localhost> (port controlled by
`APP_PORT`, default `80`; MySQL is exposed on host port `3306`). When using
Sail, set `APP_URL=http://localhost` in `.env` to match the served port.

## Sail cheat sheet

| Command                                        | Description                          |
| ---------------------------------------------- | ------------------------------------ |
| `./vendor/bin/sail up -d`                      | Start the containers (background)    |
| `./vendor/bin/sail down`                       | Stop the containers                  |
| `./vendor/bin/sail artisan tinker`             | REPL to inspect the application      |
| `./vendor/bin/sail artisan route:list`         | List routes                          |
| `./vendor/bin/sail artisan make:model Post -m` | Generate a model + migration         |
| `./vendor/bin/sail npm run dev`                | Frontend with hot reload             |
| `./vendor/bin/sail pest`                       | Run the test suite directly (Pest)   |

Any command listed below can be run through Sail by prefixing it with
`./vendor/bin/sail`.

## Testing

The `phpunit.xml` uses **in-memory SQLite** (`:memory:`), so the suite runs
without MySQL.

```bash
# Full suite (pure PHP)
php artisan test

# Pint check + PHPStan + tests (CI equivalent)
composer test

# Pest directly
vendor/bin/pest

# A single file or a single test
vendor/bin/pest tests/Feature/ExampleTest.php
vendor/bin/pest --filter=example
```

## Code quality

```bash
composer lint        # format with Laravel Pint
composer lint:check  # check formatting only (CI)
composer types:check # PHPStan static analysis
```

## Project structure

```
app/
├── Http/Controllers/   # HTTP controllers
├── Models/             # Eloquent models
└── Providers/          # service providers
bootstrap/app.php       # application bootstrap, routing and middleware
config/                 # framework configuration
database/
├── factories/          # model factories (tests/seed)
├── migrations/         # database schema
└── seeders/            # database seeders
public/                 # web root and built assets
resources/
├── css/                # Tailwind entrypoint
├── js/                 # frontend entrypoint (Vite)
└── views/              # Blade views
routes/
├── console.php         # console routes
└── web.php             # web routes
src/                    # DDD layers (PSR-4: Domain\, Application\, Infrastructure\)
├── Application/        # application services: use cases and workflows
├── Domain/             # domain model: entities, value objects, aggregates, rules
└── Infrastructure/     # framework, persistence and external adapters
tests/                  # Pest tests (Unit and Feature)
compose.yaml            # Docker orchestration for Laravel Sail
pint.json               # Laravel Pint configuration
phpstan.neon            # PHPStan (Larastan) configuration
```

## Architecture

Prisma is a **server-rendered Laravel application**. HTTP requests are handled
by controllers and Blade views under `app/` and `resources/views/`, and
interactive UI is built with **Livewire** components, which keep state on the
server and avoid a separate single-page-application layer. Styling is handled
by Tailwind CSS and bundled through Vite.

Persistence uses **Eloquent** models backed by SQLite (default) or MySQL (Sail).
Because `phpunit.xml` points to in-memory SQLite, the test suite is fast and
independent from the database server.

### Domain-Driven Design

Business logic lives under `src/`, separated from the framework scaffolding in
`app/`, and is exposed through three PSR-4 namespaces:

| Namespace         | Path                  | Responsibility                                                  |
| ----------------- | --------------------- | --------------------------------------------------------------- |
| `Domain\`         | `src/Domain/`         | Entities, value objects, aggregates and domain rules            |
| `Application\`    | `src/Application/`    | Use cases orchestrating domain and infrastructure               |
| `Infrastructure\` | `src/Infrastructure/` | Framework, persistence and external service adapters            |

The `Domain` layer is framework-agnostic and holds the base building blocks —
`Entity`, `ValueObject`, `AggregateRoot`, `DomainEvent` and `DomainException` —
that concrete domain models extend. Dependencies point inward: `Infrastructure`
may depend on `Application` and `Domain`, but the domain never depends on the
framework.

## Product vision (roadmap)

- **Universal search:** a single field to find any work — cover, synopsis, and
  format (movie, series, manga, etc.) fetched automatically.
- **Central dashboard ("Where you stopped"):** the next manga chapter, the
  following dorama episode, and the movie planned for the weekend, side by side.
- **Unlimited organization:** free-form categories (_Watching/Reading, Want to
  Watch, Paused, Completed_) with personal ratings and reviews.
- **Logbook:** an annual timeline of everything consumed, regardless of format.

## Contributing

Contributions are welcome. To propose a change:

1. Fork the repository and create a branch from `main` using a descriptive name
   (for example `feat/media-search`).
2. Keep changes focused and add tests for new behavior.
3. Run the quality gates locally before pushing:

   ```bash
   composer test
   ```

4. Open a pull request using the
   [pull request template](.github/PULL_REQUEST_TEMPLATE.md), describing the
   scope, testing evidence, and any security or performance considerations.

For feature requests and bug reports, open an issue using the templates in
`.github/ISSUE_TEMPLATE/`.

## License

Distributed under the **GNU Affero General Public License v3.0 or later**
(AGPL-3.0-or-later). See the [LICENSE](LICENSE) file for the full text.
