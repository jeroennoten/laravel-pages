## Installation

1. Require the package using composer:

    ```
    composer require jeroennoten/laravel-pages
    ```

2. Add the service provider at **the end** of the `providers` array in `config/app.php`:

    ```php
    JeroenNoten\LaravelPages\ServiceProvider::class,
    ```
    
3. Publish the configuration:

    ```
    php artisan vendor:publish --tag=pages-config
    ```    
    
4. Publish the public assets:

    ```
    php artisan vendor:publish --tag=pages-public
    ```
    
5. Publish the public assets of CkEditor:

    ```
    php artisan vendor:publish --tag=ckeditor-assets
    ```

## Updating

Publish the public assets:

    ```
    php artisan vendor:publish --tag=pages-public --force
    ```
