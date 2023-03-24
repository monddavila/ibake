### Git flow

1. Fork repository thorugh github
2. `git clone` to create local files
3. Edit code
4. Push to github
5. Create a pull request through github
6. Use `git pull` for updating local repo. Repeat starting from step 3

### iBake Laravel Setup

1. Clone the repo
2. Run `composer install` in cli
3. Run `npm install` in cli
4. Create .env file
5. Post contents from .env.example to .env
6. Run `php artisan key:generate` in cli
7. Run `php artisan serve`
8. Check on browser if running properly

### Setup Errors

-   If `SQLSTATE[HY000] [1049] Unknown database 'laravel'` is the output after setup, run `php artisan config:cache` then `php artisan migrate`

### Setup Errors

-   If `SQLSTATE[HY000] [1049] Unknown database 'laravel'` is the output after setup, run `php artisan config:cache` then `php artisan migrate`

### Debugbar (Optional)

-   [Laravel Debugbar Link](https://github.com/barryvdh/laravel-debugbar)
-   [Laravel Debugbar Tutorial](https://youtu.be/2mqsVzgsV_c?t=1975)

#### Debugbar Setup

1. Run `composer require barryvdh/laravel-debugbar --dev` in cli
2. Add `Barryvdh\Debugbar\ServiceProvider::class` under `'providers'` in `./config/app.php`
