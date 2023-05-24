# shellcheck disable=SC2164
cd "${0%/*}"
FILE=installed
if test -f "$FILE"; then
    exit
fi
# shellcheck disable=SC2094
which npm > npm
echo installed > installed
php composer.phar install --optimize-autoloader --no-dev
npm install
npm run build
rm -r node_modules/
MIGRATE_FILE=migrate
if test -f "$MIGRATE_FILE"; then
    php artisan key:generate
    php artisan migrate
    rm "$MIGRATE_FILE"
    php artisan storage:link
fi
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
