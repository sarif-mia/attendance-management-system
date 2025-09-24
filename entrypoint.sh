#!/bin/sh
set -e

# Create .env from .env.example if missing
if [ ! -f .env ]; then
	cp .env.example .env
fi

# If APP_KEY is missing or empty, generate one
if ! grep -q '^APP_KEY=' .env || grep -q '^APP_KEY=$' .env; then
	php artisan key:generate
fi

echo "[entrypoint] starting: $(date)"

exec "$@"
