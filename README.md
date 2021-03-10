## Departments (Sections) with users attached to them. 

## Installation

1. Generate a fresh key for application
```
    php artisan key:generate
```

2. Add database credentials to .env file


3. Install all dependencies
```
    composer install
    npm install
    npm run dev
```

4. Migrate databases
```
    php artisan migrate --seed
```

5. Run application
```
    php artisan serve
```