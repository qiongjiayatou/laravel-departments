## Departments (Sections) with users attached to them. 

Project had been built using Laravel and VueJS.

## Installation

0. Copy .env.example and rename to .env

1. Install all dependencies
```
    composer install
    npm install
    npm run dev
```

2. Generate a fresh key for application
```
    php artisan key:generate
```

3. Add database credentials to .env file
    If needed add Schema::defaultStringLength(191); to AppServiceProvider

4. Migrate databases
```
    php artisan migrate --seed
```

5. Run application
```
    php artisan serve
```