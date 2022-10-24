
## Figured Sample Inventory

This is a simple inventory app that helps the user understand how much quantity of a 
product is available for use.

## Getting Started
<p>This runs in Laravel v8.75 and PHP(^7.3) and in Laravel <a href="https://laravel.com/docs/8.x/valet#installation">Valet</a></p>

```
# Clone the repository
git clone https://github.com/necrojan/figured-inventory-sample.git

# Create the environment variables for your database
cp .env.example .env

# Run composer install
composer install

# Generate the keys
php artisan key:generate

# Migrate the tables and seed
php artisan migrate:fresh --seed

# Run install and run npm
npm install && npm run watch

# Can be accessed on the browser
http://figured-inventory-sample.test/inventories

```

## Testing
``` 
php artisan test
```
## License

Copyright © 2022 <a href="https://github.com/necrojan">@necrojan</a>  [MIT license](https://opensource.org/licenses/MIT).
