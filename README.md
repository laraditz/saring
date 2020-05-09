# Saring

[![Latest Stable Version](https://poser.pugx.org/raditzfarhan/saring/v/stable?format=flat-square)](https://packagist.org/packages/raditzfarhan/saring)
[![Total Downloads](https://img.shields.io/packagist/dt/raditzfarhan/saring?style=flat-square)](https://packagist.org/packages/raditzfarhan/saring)
[![License](https://poser.pugx.org/raditzfarhan/saring/license?format=flat-square)](https://packagist.org/packages/raditzfarhan/saring)
[![StyleCI](https://github.styleci.io/repos/7548986/shield?style=square)](https://github.com/raditzfarhan/saring)

A simple eloquent model filter for Laravel and Lumen.

## Installation

Via Composer

``` bash
$ composer require raditzfarhan/saring
```

## Configuration

Add filterable trait to your model as below snippet:
```php
use RaditzFarhan\Saring\Filterable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Filterable;
    ...
}
```

Create filter class under the `App/Filters` folder with `<model_name>Filter` format. For example for `User` model, you will need to create `UserFilter` class. 

Below snippet shows how the `UserFilter` could look like:
```php
namespace App\Filters;

use RaditzFarhan\Saring\Filter;

class UserFilter extends Filter
{
    public function name($value)
    {
        $this->where('name', 'LIKE', $value);
    }

    public function email($value)
    {
        $this->where('email', 'LIKE', "%$value%");
    }
}

```

If you want to have more control on which attributes can be filtered, you can add `filterable` array to you model:
```php

protected $filterable = [
    'name', 'email'
];
```

## Usage

In your controller, call `filter` method and pass the input data to use the filter that you have created.
```php
$users = User::filter($request->all())->get();
```

That's it!

## Credits

- [Raditz Farhan](https://github.com/raditzfarhan)

## License

MIT. Please see the [license file](LICENSE) for more information.