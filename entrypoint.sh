#!/bin/sh
set -e

# If APP_KEY is missing or empty, generate one
grep -q '^APP_KEY=' .env && grep -q '^APP_KEY=$' .env && php artisan key:generate || true

exec "$@"
