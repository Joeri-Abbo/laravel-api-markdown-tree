# Laravel API Markdown Tree

Laravel API Markdown Tree is a package for generating API documentation in a tree view Markdown format based on your
Laravel application's routes.

## Installation

To install the package as a development dependency, follow these steps:

1. Add the package repository to your Laravel project's `composer.json` file:

```json
"repositories": [
{
"type": "vcs",
"url": "https://github.com/JoeriAbbo/laravel-api-markdown-tree.git"
}
],
Make sure to replace the URL with the URL of your Git repository.

2. Require the package in your Laravel project as a development dependency: ```bash
composer require --dev joeriabbo/laravel-api-markdown-tree: dev-master
```

3. If you're using Laravel 5.4 or earlier, register the service provider in your config/app.php file:

```php
'providers' => [
    // ...
    JoeriAbbo\LaravelApiMarkdownTree\LaravelApiMarkdownTreeServiceProvider::class,
],
```

For Laravel 5.5 or later, the service provider will be auto-discovered.

## Usage

To generate API documentation, run the following command in your Laravel project's root directory:

```bash
php artisan apidocs:generate
```

By default, this command will create a `api_docs.md` file in your Laravel project root directory with the tree view of the
API routes in Markdown format. You can specify a custom output file by passing it as an argument, like this:

```bash
php artisan apidocs:generate custom_output.md
```

License
This package is open-source software licensed under the MIT license.