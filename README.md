# Medy's Catering

A two-app PHP/Apache project backed by PostgreSQL.

- **`medysBook/`** — public site where customers browse services and submit bookings/feedback/contact forms.
- **`medysStaff/`** — internal staff portal for managing bookings, accounts, and feedback.

Both apps share one Apache container and one Postgres database. Designed to run identically in local Docker and on Render.

---

## Stack

| Layer | Tech |
|---|---|
| App | PHP 8.2 + Apache (mod_rewrite) |
| DB | PostgreSQL 16 |
| Container | One Docker image serves both `/medysBook` and `/medysStaff` |
| Deploy | Render Blueprint ([render.yaml](render.yaml)) → managed Postgres + Docker web service |

---

## Local development (Docker)

### Prerequisites
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (or Docker Engine + Docker Compose plugin)
- That's it — no PHP, no Postgres, no Composer needed on the host.

### Start the stack

```bash
docker compose up --build
```

First boot pulls the `php:8.2-apache` and `postgres:16-alpine` images (~150 MB total) and runs [db/init.sql](db/init.sql) inside Postgres. Subsequent boots take ~5 seconds.

Add `-d` to run detached:
```bash
docker compose up -d
```

### Access the apps

| Surface | URL |
|---|---|
| Public site | http://localhost:8080/medysBook/ |
| Staff portal | http://localhost:8080/medysStaff/login.php |
| Root redirect | http://localhost:8080/ → public site |

### Default admin login

The schema seeds one user — change it immediately.

| | |
|---|---|
| Username | `admin` |
| Password | `admin123` |

### Hot reload

`medysBook/`, `medysStaff/`, and `index.php` are bind-mounted into the container (see [docker-compose.yml](docker-compose.yml)). Edit a PHP/JS/CSS file on the host → refresh the browser. No rebuild.

Rebuilds are only needed when:
- The `Dockerfile` changes
- The Apache vhost in `docker/` changes
- The entrypoint script changes

```bash
docker compose up --build      # rebuild and restart
```

### Common operations

```bash
docker compose logs -f web     # tail Apache + PHP errors
docker compose logs -f db      # tail Postgres
docker compose restart web     # restart just the app
docker compose down            # stop everything, keep DB data
docker compose down -v         # stop and WIPE the Postgres volume (resets DB)
```

### Access the local database

The Postgres container exposes port 5432 on your host.

**From psql in the host shell:**
```bash
psql "postgresql://medys:medys@localhost:5432/medys_catering"
```

**From psql inside the running db container** (no host psql needed):
```bash
docker compose exec db psql -U medys -d medys_catering
```

**From DBeaver (or any GUI) — local:**

1. **Database** → **New Database Connection** → **PostgreSQL** → **Next**
2. Fill in the **Main** tab:

   | Field | Value |
   |---|---|
   | Host | `localhost` |
   | Port | `5432` |
   | Database | `medys_catering` |
   | Username | `medys` |
   | Password | `medys` |

3. **SSL** tab → leave **Use SSL** unchecked (local connections are unencrypted by default — that's fine).
4. **Test Connection** → if DBeaver prompts to download the PostgreSQL JDBC driver, click Download.
5. **Finish.**

Expand `medys_catering` → **Schemas** → **public** → **Tables** to see `bookings`, `users`, `feedback`, `contact_messages`.

---

## Render deployment

### One-time setup (Blueprint)

1. Push the repo to GitHub.
2. Sign into https://dashboard.render.com (use GitHub OAuth for the easiest connection).
3. **Account Settings → GitHub** → **Configure account** → grant Render access to `Medy-s-Catering/medys-catering`.
4. **New** (top right) → **Blueprint** → pick this repo. Render detects [render.yaml](render.yaml).
5. Name the blueprint (e.g. `medys-catering`) → **Apply**.

Render provisions, in order:
1. `medys-catering-db` — managed PostgreSQL (free tier).
2. `medys-catering` — Docker web service. `DATABASE_URL` is wired in automatically from the database resource.

First deploy takes 5–10 minutes (image build + database provisioning). On boot, [docker/entrypoint.sh](docker/entrypoint.sh) auto-applies [db/init.sql](db/init.sql) — no manual schema step.

### Access the deployed apps

Render gives the web service a URL like `https://medys-catering.onrender.com`.

| Surface | Path |
|---|---|
| Public site | `/medysBook/` |
| Staff portal | `/medysStaff/login.php` |
| Root | `/` redirects to `/medysBook/` |

### View deploys, logs, and metrics

In the Render dashboard, click into the `medys-catering` web service:

- **Logs** — live `tail -f` of Apache + PHP. Filter by container, search by keyword.
- **Events** — deploy history. Click any deploy to see its build log.
- **Settings** — env vars, custom domains, health check, autoscaling (paid).
- **Shell** — interactive shell inside the running container (free tier supported). Useful for `psql`, file inspection, etc.
- **Environment** — manage env vars without redeploying code.

### Trigger a deploy

- Push to `main` → Render auto-deploys.
- Manual: web service → **Manual Deploy** (top right) → **Deploy latest commit** or pick a specific commit.
- Rollback: **Events** → find a previous successful deploy → **Rollback to this version**.

### Access the database on Render

Three options:

**1. From the web service's Shell tab** (no extra setup):

```bash
psql "$DATABASE_URL"
```

The `postgresql-client` package is in the image, and `DATABASE_URL` is injected by render.yaml. This uses Render's internal URL — fast, no SSL handshake.

**2. From your laptop with psql:**

Render dashboard → `medys-catering-db` → **Connect** tab. Copy the **External Database URL** (the one with `.oregon-postgres.render.com` in the host).

```bash
export MEDYS_DB_PROD="postgresql://medys:PASSWORD@dpg-XXXXX-a.oregon-postgres.render.com/medys_catering"

psql "$MEDYS_DB_PROD"                                       # interactive
psql "$MEDYS_DB_PROD" -c "SELECT COUNT(*) FROM bookings;"   # one-off
pg_dump "$MEDYS_DB_PROD" > backup-$(date +%F).sql           # backup
```

**3. From DBeaver — Render external:**

1. **Database** → **New Database Connection** → **PostgreSQL** → **Next**
2. Fill in the **Main** tab using values from the **External Database URL**:

   | Field | Value |
   |---|---|
   | Host | `dpg-XXXXX-a.oregon-postgres.render.com` |
   | Port | `5432` |
   | Database | `medys_catering` |
   | Username | `medys` |
   | Password | *(from the URL)* |

3. **SSL** tab — **required** for Render's external connections:
   - Check **Use SSL**
   - **SSL mode**: `require`
   - Leave certificate/key fields empty (Render uses a public CA).
4. **Test Connection** → ✅
5. **Finish.**

> ⚠️ The external URL embeds the password in plaintext. Don't paste it into chats, screenshots, or commits. If you do, rotate it: `medys-catering-db` → **Settings** → **Reset Password**.

### Invite teammates to the Render workspace

So they can watch deploys, view logs, or run psql — not just use the public site.

1. Render dashboard → top-left workspace dropdown → **Workspace Settings**
2. Left sidebar → **Members** → **Invite Member**
3. Enter email, pick role:
   - **Admin** — everything including billing. Co-owners only.
   - **Developer** — view logs, redeploy, edit env vars, run Shell. **Best for collaborators.**
   - **Viewer** — read-only access to logs, metrics, settings.
4. They get an email; after accepting, this workspace's services appear in their Render dashboard.

No cost change — free tier supports unlimited workspace members.

---

## Architecture notes

### How `config/db.php` resolves the connection

Both apps share the same pattern — [medysBook/config/db.php](medysBook/config/db.php) and [medysStaff/config/db.php](medysStaff/config/db.php):

1. If `DATABASE_URL` is set (Render), parse it and append `sslmode=require`.
2. Otherwise read `DB_HOST` / `DB_PORT` / `DB_NAME` / `DB_USER` / `DB_PASS` from env (docker-compose).

So the same code runs identically in both environments — only the env vars differ.

Set `APP_DEBUG=1` to include PDO error details in JSON responses (dev only — leave off in production).

### Schema is auto-applied on every container start

[docker/entrypoint.sh](docker/entrypoint.sh) waits for Postgres, then runs `psql -f /var/www/html/db/init.sql`. The schema uses:

- `CREATE TABLE IF NOT EXISTS …`
- `CREATE INDEX IF NOT EXISTS …`
- `INSERT … ON CONFLICT (username) DO NOTHING` (for the admin seed)

…which makes it fully idempotent. Safe to re-run on every boot, won't touch existing data.

To disable (e.g. while running a manual destructive migration), set `DB_INIT_SKIP=1` in the service env.

### Sessions are ephemeral

PHP `session_start()` writes session files to `/tmp` inside the container. On Render's free tier, `/tmp` is wiped on every restart/redeploy — so users get logged out when the service spins back up after idle. Fine for now; can be moved to DB-backed sessions later if needed.

---

## Free-tier caveats (Render)

- **Web service** spins down after ~15 min of inactivity. First request after spin-down takes 30–60s while it boots. Upgrade to Starter ($7/mo) to keep it always-on.
- **Postgres free** expires after **90 days**. Render emails reminders around day 60 and day 80. Before expiry: either upgrade to a paid plan, or `pg_dump` the data and reload into a fresh instance.
- **Build minutes**: 500/mo free. Each push rebuilds the Docker image (~3–5 min).
- **Connection limit**: ~97 concurrent Postgres connections. Don't leave idle psql sessions open.
- **Concurrent web instances**: 1 (no autoscaling on free).

---

## Project layout

```
medys-catering/
├── medysBook/              # public-facing site
│   ├── api/                # JSON endpoints (POST bookings, contact, feedback GET/POST)
│   ├── assets/             # CSS, JS (script.js holds the API base path)
│   ├── config/db.php       # env-driven Postgres PDO connection
│   ├── pictures/           # uploaded gallery images
│   └── *.php               # page templates
├── medysStaff/             # staff portal
│   ├── api/                # bookings/accounts/feedback CRUD + auth_login/logout
│   ├── assets/             # CSS, JS (app.js holds the API base path)
│   ├── config/db.php       # same env-driven Postgres PDO
│   └── *.php               # page templates
├── db/init.sql             # Postgres schema + admin seed
├── docker/
│   ├── apache-vhost.conf   # Apache vhost (AllowOverride All for .htaccess)
│   └── entrypoint.sh       # rebinds Apache to $PORT, runs init.sql
├── Dockerfile              # PHP 8.2 + Apache + pdo_pgsql + psql client
├── docker-compose.yml      # web (:8080) + db (:5432) + pgdata volume
├── render.yaml             # Render Blueprint (Postgres + Docker web service)
├── index.php               # root → /medysBook/ redirect
└── README.md               # this file
```
