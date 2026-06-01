set -e

PORT="${PORT:-80}"

sed -ri "s!^Listen [0-9]+!Listen ${PORT}!g" /etc/apache2/ports.conf
sed -ri "s!<VirtualHost \\*:[0-9]+>!<VirtualHost *:${PORT}>!g" /etc/apache2/sites-available/000-default.conf

if [ -z "$DB_INIT_SKIP" ] && [ -f /var/www/html/db/init.sql ]; then
    if [ -n "$DATABASE_URL" ]; then
        CONN="$DATABASE_URL"
    else
        CONN="postgresql://${DB_USER:-medys}:${DB_PASS:-medys}@${DB_HOST:-db}:${DB_PORT:-5432}/${DB_NAME:-medys_catering}"
    fi

    echo "[entrypoint] Waiting for database..."
    for i in $(seq 1 30); do
        if psql "$CONN" -c 'SELECT 1' >/dev/null 2>&1; then
            echo "[entrypoint] Database reachable; applying schema..."
            psql "$CONN" -v ON_ERROR_STOP=1 -f /var/www/html/db/init.sql && echo "[entrypoint] Schema applied."
            break
        fi
        sleep 1
        [ "$i" = "30" ] && echo "[entrypoint] WARNING: DB not reachable after 30s — starting anyway."
    done
fi

exec "$@"
