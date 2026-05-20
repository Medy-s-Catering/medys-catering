# Medy's Catering — Docker & Render Deployment

## Stack
- **App**: PHP 8.2 + Apache (one container serving both `medysBook/` and `medysStaff/`)
- **DB**: PostgreSQL 16 (was MySQL)
- **Routing**: `/` → `/medysBook/`; staff portal lives at `/medysStaff/`

## Local development (Docker)

```bash
docker compose up --build
```

Then open:
- Public site: http://localhost:8080/medysBook/
- Staff portal: http://localhost:8080/medysStaff/login.php
- Postgres: `localhost:5432` (user `medys`, pass `medys`, db `medys_catering`)

The schema in [db/init.sql](db/init.sql) is auto-applied on first boot of the `db` container.
It seeds an admin user — **username `admin`, password `admin123`** — change this immediately.

To reset the DB:
```bash
docker compose down -v   # drops the pgdata volume
docker compose up --build
```

## Render deployment

1. Push this repo to GitHub.
2. In the Render dashboard: **New → Blueprint** and point it at the repo.
3. Render reads [render.yaml](render.yaml) and provisions:
   - a managed PostgreSQL (`medys-catering-db`)
   - a Docker web service (`medys-catering`) with `DATABASE_URL` wired in
4. The container entrypoint auto-applies [db/init.sql](db/init.sql) on every start (idempotent — `CREATE TABLE IF NOT EXISTS` + `ON CONFLICT DO NOTHING`). No manual step needed.
5. Log into `/medysStaff/login.php` as `admin / admin123` and immediately change the password (or delete that user and recreate one).
6. Set `DB_INIT_SKIP=1` in the service env if you ever want to disable the auto-apply (e.g. after running a manual destructive migration).

## How config resolves
[medysBook/config/db.php](medysBook/config/db.php) and [medysStaff/config/db.php](medysStaff/config/db.php) connect in this order:

1. If `DATABASE_URL` is set (Render), parse it and append `sslmode=require`.
2. Otherwise use `DB_HOST` / `DB_PORT` / `DB_NAME` / `DB_USER` / `DB_PASS` (docker-compose).

Set `APP_DEBUG=1` to include PDO error detail in failure responses — leave it off in production.

## What changed from the original
- `config/db.php` switched from hardcoded MySQL/localhost to env-driven Postgres PDO.
- MySQL `AUTO_INCREMENT` / `ENUM` / `TIMESTAMP DEFAULT CURRENT_TIMESTAMP` replaced with Postgres equivalents (`SERIAL`, `CHECK` constraints, `TIMESTAMPTZ DEFAULT NOW()`).
- API code (`api/*.php`) is otherwise unchanged — all queries were already portable.
- Fixed: [medysStaff/api/accounts.php](medysStaff/api/accounts.php) called `password(...)` instead of `password_hash(...)` — staff account create/update would have 500'd.
- `.gitignore` no longer excludes `config/db.php` (it now contains no secrets).
