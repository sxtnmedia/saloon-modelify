# Saloon Modelify (Proof of Concept)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sxtnmedia/saloon-modelify.svg?style=flat-square)](https://packagist.org/packages/sxtnmedia/saloon-modelify)
[![Total Downloads](https://img.shields.io/packagist/dt/sxtnmedia/saloon-modelify.svg?style=flat-square)](https://packagist.org/packages/sxtnmedia/saloon-modelify)

Idea of this package is to give the elegant and easy functionality, to use the Sammyjo20/Saloon the way, you naturally use Laravel's models.

It's the Resource (not Request) point of view.
It still allows you, to use the Salloon any way you like and get the best of both worlds.

## Installation

Clone this repository and install composer dependencies

```
composer install
```

Then include example Integration and have some fun.

## Usage

```php
$allUsers = (new User())->get();
$allUsers = User::get();

$firstOfAllUsers = User::get()->first();
// or quicker
$firstOfAllUsers = User::first();

$specificUser = User::find('sxtnmedia');

$allRepos = Repository::get();

$allReposSinceId50 = Repository::where('since', 50)->get();
// All queries are fluent
// Repository::where('since', 50)->where(...)->get();

$firstRepo = $allRepos->first();

$repoForks = $firstRepo->forks()->get();
// or quicker
$repoForks = $firstRepo->forks;

$repository = $repoForks->first()->repository;

$created = Repository::create(["key" => "value"]);

$updated = Repository::find(1)->update(["key" => "value"]);
$updated = Repository::where('id', 1)->update(["key" => "value"]);
```

## TODO

It's an early stage. It still needs so much work, that for now, there is no point in listing what's TODO ;)

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please report the Issue on Github.

## Credits

It's based on the excellent API SDK builder: [Sammyjo20/Saloon](https://github.com/sammyjo20/saloon), made by [Sam Carré](https://github.com/Sammyjo20)

-   [Patryk Kleszyński](https://github.com/sxtnmedia)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
