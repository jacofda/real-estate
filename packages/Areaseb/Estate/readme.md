
## Installation

Via Composer

``` bash
$ composer require areaseb/core
```

## Usage

``` bash
$ composer require Areaseb/Core
$ php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
$ php artisan vendor:publish --provider="Areaseb\Estate\CoreServiceProvider" --tag="core.migrations"
$ php artisan vendor:publish --provider="Areaseb\Estate\CoreServiceProvider" --tag="core.trans"
$ php artisan vendor:publish --provider="Areaseb\Estate\CoreServiceProvider" --tag="core.config"
$ php artisan storage:link
$ php artisan queue:table

$ php artisan migrate
$ composer dump-autoload

$ php artisan db:seed --class=CitiesSeeder
$ php artisan db:seed --class=CountriesSeeder
$ php artisan db:seed --class=ExemptionsSeeder
$ php artisan db:seed --class=SettingsSeeder
$ php artisan db:seed --class=StarterSeeder

```
