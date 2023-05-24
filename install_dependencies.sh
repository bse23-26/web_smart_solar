FILE=installed
if test -f "$FILE"; then
    exit
fi
echo installed > installed
composer install --optimize-autoloader --no-dev
npm install
npm run build
rm -r node_modules/
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
MIGRATE_FILE=migrate
if test -f "$MIGRATE_FILE"; then
    php artisan migrate
    rm "$MIGRATE_FILE"
fi
