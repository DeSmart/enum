# PHP Enum 📚

[![Latest version](https://img.shields.io/packagist/v/desmart/php-enum.svg?style=flat)](https://github.com/DeSmart/php-enum)
![Tests](https://github.com/desmart/php-enum/workflows/Run%20Tests/badge.svg)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/DeSmart/php-enum/blob/master/LICENSE)

Package provides a strongly typed enums for PHP.

> `Enumeration` class name is used on purpose, to avoid potential issues. There will be native enums in PHP 8.1 🎉

> There are other great packages implementing enums for PHP. Consider checking them out!

## Installation
To install the package via Composer, simply run the following command:
```
composer require desmart/php-enum
```

## Usage
Example enum definition:
```php
/**
 * @method static Character good()
 * @method static Character evil()
 * @method static Character sometimesGoodSometimesEvil()
 */
class Character extends Enumeration
{
    const GOOD = 'good';
    const EVIL = 'evil';
    const SOMETIMES_GOOD_SOMETIMES_EVIL = 'sometimes_good_or_evil';
}
```

#### Create an enum object
```php
$enum = Character::good(); // or Character::fromName('good')
```
In general, named constructor method name should be a constant name in camelCase.

> Few exceptions to this rule are allowed. See [test file](https://github.com/DeSmart/php-enum/blob/master/tests/EnumerationTest.php).

#### Create an enum object based on available constants' values
```php
$enum = Character::fromValue('sometimes_good_or_evil');
```
This approach is very convenient when enum objects are created from eg. database.

#### Comparing enums
```php
Character::good()->equals(Character::fromName('good')); // true
Character::good()->equals(Character::evil());           // false
Character::good()->equals(OtherEnum::someValue());      // false
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.