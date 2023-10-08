### Git flow

1. `git clone` to create local files
2. Edit/Update code
3. Git Add ( `git add .`)
4. `git commit -m "commit message here"`
5. Push to github `git push`
6. Create a pull request through github and merge

### iBake Laravel Project Setup

1. Clone the repo
2. Run `composer install` in cli
3. Run `npm install` in cli
4. Create .env file
5. Post contents from project .env
6. Run `php artisan key:generate` in cli
7. Run `php artisan serve`
8. Check on browser if running properly
9. Run `php artisan migrate` to load database
    **Additional packages**
11. Run composer require ixudra/curl
 Once the package is installed, you need to register the service provider in your project's config/app.php file. Add the following line to the providers  and aliases array:
'providers' => [
    ...
    Ixudra\Curl\CurlServiceProvider::class,
    ...
]
'aliases' => [
    ...
    'Curl' => Ixudra\Curl\Facades\Curl::class,
    ...
]
12. For SMS API engageSPARK run `composer require guzzlehttp/guzzle`



### Updating local repository
1. Change branch to master branch `git checkout master`
2. Run `git remote add upstream https://github.com/teammed2022/iBake.git`
3. Run `git fetch upstream`
4. Run `git merge upstream/master master`.
NOTE!
Just stage `git add .` then commit if `Your branch is ahead of 'origin/master` appears.
Commit message can be "Fetched updates". Example: `git commit -m "Fetched updates"`
5. Merge fetched files with master branch with `git rebase upstream/master`
6. Optional: Merge fetched files with your branch `git checkout (YOUR BRANCH)` then `git merge master`




### Setup Errors

-   If `SQLSTATE[HY000] [1049] Unknown database 'laravel'` is the output after setup, run `php artisan config:cache` then `php artisan migrate`

### Debugbar (Optional)

-   [Laravel Debugbar Link](https://github.com/barryvdh/laravel-debugbar)
-   [Laravel Debugbar Tutorial](https://youtu.be/2mqsVzgsV_c?t=1975)

#### Debugbar Setup

1. Run `composer require barryvdh/laravel-debugbar --dev` in cli
2. Add `Barryvdh\Debugbar\ServiceProvider::class` under `'providers'` in `./config/app.php`
