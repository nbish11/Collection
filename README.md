# Collection

[![Build Status](https://travis-ci.org/nbish11/Collection.png?branch=master)](https://travis-ci.org/nbish11/Collection)

A dimple data collection framework for PHP 5.

* Simple interface included for use with dependency injection.
* Includes a simple concrete class to use with primitive data.

## Getting started

1. PHP 5.3.3 or greater is required.
2. Install using [Composer](#composer-installation).
3. Require with `composer require nbish11\collection`
4. Add the following line to your main script to include the library: `require 'vendor/autoload.php'`.

## Usage

*Example 1* - Basic usage

```php
<?php
require_once 'vendor/autoload.php';

$address = new stdClass();
$address->country = 'Australia';

$user = new DataCollection(array(
    'name' => 'Nathan',
    'age' => 25,
    'address' => $address
));

echo $user->get('name');     // outputs "Nathan"

if ($user->exists('address')) {
    $address = $user->get('address');
    // do stuff with $address
}

$user->set('age', 18);
echo $user->get('age');      // outputs "18"
```

*Example 2* - Type hinting

```php
<?php
require_once 'vendor/autoload.php';

class Session
{
    private $storage;

    public function __construct(Collection $storage)
    {
        $this->storage = $storage;
    }

    public function storage()
    {
        return $this->storage;
    }
}

$sessionStorage = new DataCollection($_SESSION);
$session = new Session(sessionStorage);

$userLanguage = $session->storage()->get('language', 'en');
```

*Example 3* - Manipulation

```php
<?php
require_once 'vendor/autoload.php';

$data = new DataCollection(array(1, 2, 3, 4, 5));

// cube the value.
$data->map(function (&$n) {
    $n = $n * $n * $n;
});

var_dump($data->all());   // outputs "1, 8, 27, 64, 125"
```

*Example 4* - Advanced usage

```php
<?php
require_once 'vendor/autoload.php';

$user = new DataCollection(array(
    'name' => 'Emma',
    'age' => 22,
    'address' => null
));

// using the class like an array:
var_dump($user['name']);            // outputs "string 'Emma' (length=4)"

// checking with isset() function:
var_dump(isset($user->address));    // outputs "true"

// counting the collection:
var_dump(count($user));             // outputs "3"
```

## API

```php
$collection->
    set($key, $value)               // Adds an item to the collection.
    get($key, $default = null)      // Retrieves an item from the collection.
    exists($key)                    // Checks if an item exists in the collection.
    remove($key)                    // Remove an item from the collection.
    all()                           // Return all items in the collection as a PHP array.
    merge($data)                    // Merges an array in with the collection (replaces items with matching keys).
    replace($data)                  // Replace the collection with an array (or collection).
    clear()                         // Clears the entire collection.
    keys()                          // Returns all the keys in the collection.
    values()                        // Return all items within the collection.
    map($callback)                  // Maps a user defined function to each item within the collection.
    isEmpty()                       // Checks whether or not the collection is empty.
    getIterator()                   // Creates a new iterator.
    count()                         // The number of items in the collection.
```

*In addition, the `Collection` interface implements the following magic methods: [__set()](), [__get()](), [__isset()]() and [__unset]().*

## Unit Testing

This project uses [PHPUnit](https://github.com/sebastianbergmann/phpunit/) as its unit testing framework.

To test the project, simply run `composer install --dev` and then run `vendor/bin/phpunit` from the commandline.

## Contributing

See the [contributing guide](CONTRIBUTING.md) for more info.

## Contributors

See the [contribution list](CONTRIBUTORS.md) for more info.

## License

Copyright (C) 2016  Nathan Bishop

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
