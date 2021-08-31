<a target="_blank" href="https://twitter.com/beryldb"><img src="https://img.shields.io/twitter/url/https/twitter.com/cloudposse.svg?style=social&label=Follow%20%40beryldb"></a>
<a target="_blank" href="https://github.com/beryldb/php-beryl/actions"><img src="https://github.com/beryldb/php-beryl/workflows/PHP%20Composer/badge.svg?4"></a>
<a target="_blank" href="https://github.com/beryldb/php-beryl/pulse" alt="Activity"> <img src="https://img.shields.io/github/commit-activity/m/beryldb/php-beryl" /></a>
[![License](https://img.shields.io/badge/License-BSD%203--Clause-blue.svg)](https://opensource.org/licenses/BSD-3-Clause)
<br>

If you want to learn more about BerylDB and how to install it, feel free to check our
documentation at [docs.beryl.dev](https://docs.beryl.dev/).
Follow us on [Twitter](https://twitter.com/beryldb).

![Logo](https://docs.beryl.dev/img/smaller.png??)

## Loading 

PHP-beryl utilizes the autoloading features of PHP in order to run its
files. If you are using Composer, autoloading should be managed automatically.

## Using

PHP-beryl requries [composer](http://getcomposer.org). You may install
composer on Mac OS:

```
brew install composer
```

* On Debian-based systems:

```
sudo apt update
sudo apt install curl php-cli php-mbstring git unzip
curl -sS https://getcomposer.org/installer -o composer-setup.php
```

* Installing php-beryl's dependencies:

```
composer install
```

## Running

In order to run your php-beryl, you must load autoload.php:

```php 
<?php

require __DIR__.'/vendor/autoload.php';
```

## Connecting to Beryl

When creating a client instance without any parameter, php-beryl uses
host ``127.0.0.1`` and port ``6378``.

```php 
<?php

require __DIR__.'/vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                   'host' => 'localhost',   /* Host to connect to */
                   'port' => 6378,          /* Server's port */
                   'timeout' => 30,         /* Timeout before stop trying to connect */
                   'login' => 'root',       /* Login to utilize */
                   'password' => 'default', /* User's password */
                   'debug' => false         /* Print raw data from remote server */
                   ]);
?>
```

Most php-beryl commands have the same name as base function in BerylDB.
Feel free to check `example.php` and files in the `test/` directory.

* Check Beryl's [full list of commands](https://docs.beryl.dev/using/commands/).


## Simple queries

Most php-beryl functions have the same name as any other BerylDB function.
For instance, if you want to execute a basic key set:

```php 
echo $client->set("hello", "world");
echo $client->get("hello");
```

This script will return:

```
OK
world
```

In case of requesting for a key that is not defined, a 0 (false) will be
returned. For instance:

```php 
echo $client->get("undefined_key") // => 0
```

In BerylDB, different structues cannot hold the same variable name. In order
to check what kind of data structure is a given key:

```php 
echo $client->type("a") // => KEY
```

If you would like to flush (reset) your current database:

```php 
echo $client->flushdb();
```

If you would like to flush all databases instead:

```php 
echo $client->flushall();
```

## Information

You can also run queries in order to obtain information about your server,
for instance:


· Database size:

```php 
echo $client->dbsize()  // => 133 KB
```

· Current time in server:

```php 
echo $client->time() // => Wed Aug 25 2021 16:08:31
```

or simple list all defined keys in server:

$results = $client->keys("*");

```php 
if ($results)
{
     foreach ($results as $key)
     {
         echo $key;
     }
}
```

## Operations

Operations commands typically have the same name as its base command, for
instance:

```php 
echo $client->incrby("a", 20) // => 20; /* Increases 'a' by 20 */
echo $client->decrby("a", 20) // => 0;  /* Decreases 'a' by 20 */
```

In addition to incrby, you may very well use BerylDB to keep track of basic
counters:

```php 
echo $client->incr("a") // => 1;  /* Increases 'a' by 1 */
echo $client->decr("a") // => 0;  /* Decreases 'a' by 1 */
```

## Lists

Managing lists is fairly straightforward. If you would like to push items
into a given list:

In this example, we will be assuming that no other key type is using the
'hello' key.

```php 
echo $client->lpush("hello", "world") // => OK
```

However, in some cases, a conflict may arouse. Let's assume that you have
previously defined 'hello' with another data type:

```
echo $client->set("hello", "world") // => OK
echo $client->lpush("hello", "world") // => 0
```

As you can see above, 'hello' is defined and a 0 (false) will be returned.

Let's assume that list a has the following keys:

a = [1, 2, 3, 4, 5, 6, 7, 8, 9];

```php 
echo $client->lback("a") // => 9
echo $client->lfront("a") // => 1
```

In case that you would like to access a given position:

```php 
echo $client->lpos("a", 3) // => 4
```

or if you need to verify whether given items are actually defined:

```php 
echo $client->lexists("a", "5")   // => 1
echo $client->lfront("a", "100")  // => 0
```

Finally, if what you need is to iterate over all items in a list 'a', you
may very well use a foreach:

```
$results = $client->lget("ab");

if ($results)
{
     foreach ($results as $key)
     {
         echo $key;
     }
}
```

This will print:  

```
123456789
```

Keep in mind that if no results are found, or if an error has taken place,
$results will return a 0 (false).

## Geocalc

You can also use this PHP api in order to calculate the distance between two
geo coordinates (in kilometers):

```php 
echo $client->geoadd("Miami", 25.761681, -80.191788);
echo $client->geoadd("Los_Angeles", 34.052235, -118.243683);
```

```
echo $client->geodist("Los_Angeles", "Miami") => // 4222.46 
```

This would be the equivalent of running in [Beryl-cli](https://github.com/beryldb/beryldb-cli):

```
beryl> GCALC Los_Angeles Miami
4222.46
```


## Debugging

If you wish to connect Beryl in debugging mode, you need to pass this
argument when connecting:

```
'debug' => true
```

When ``debug`` is set to true, everything returning from the remote server
will be printed. This option is set to false by default, and it should be
ethat way, unless you are implementing a new command in Beryl.


## Development

Contributions to php-beryl are appreciated either in the form of pull requests for new features, 
bug fixes, or simple to report a bug. If you wish to join our [Google groups](https://groups.google.com/g/beryldb).

