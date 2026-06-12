web: php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
release: php artisan storage:link --force && php artisan migrate --force && php artisan db:seed --force
