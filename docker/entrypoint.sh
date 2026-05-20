#!/bin/sh
# Apache binds to whatever PORT the platform gives us (Render sets PORT=10000),
# falling back to 80 for local docker-compose.
set -e

PORT="${PORT:-80}"

sed -ri "s!^Listen [0-9]+!Listen ${PORT}!g" /etc/apache2/ports.conf
sed -ri "s!<VirtualHost \\*:[0-9]+>!<VirtualHost *:${PORT}>!g" /etc/apache2/sites-available/000-default.conf

exec "$@"
