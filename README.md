### iBake Laravel Setup

1. Clone the repo
2. Run `composer install` in cli
3. Run `npm install` in cli
4. Create .env file
5. Post contents from .env.example to .env
6. Run `php artisan key:generate` in cli
7. Run `php artisan serve`
8. Check on browser if running properly

### Debugbar

-   [Laravel Debugbar Link](https://github.com/barryvdh/laravel-debugbar)
-   [Laravel Debugbar Tutorial](https://youtu.be/2mqsVzgsV_c?t=1975)

#### Debugbar Setup

1. Run `composer require barryvdh/laravel-debugbar --dev` in cli
2. Add `Barryvdh\Debugbar\ServiceProvider::class` under `'providers'` in `./config/app.php`
