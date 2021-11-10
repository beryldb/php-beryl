<p align="center">
  <img src="https://static.beryl.dev/smaller.png">
</p>

# php-beryl, a PHP driver for BerylDB.

<a target="_blank" href="https://github.com/beryldb/php-beryl/actions"><img src="https://github.com/beryldb/php-beryl/workflows/PHP%20Composer/badge.svg?4"></a>
[![Mailing List](https://img.shields.io/badge/email-google%20groups-4285F4 "beryldb@googlegroups.com")](https://groups.google.com/g/beryldb)
[![Twitter](https://img.shields.io/twitter/follow/beryldb?color=%23179CF0&logo=twitter&style=flat-square "@beryldb on Twitter")](https://twitter.com/beryldb)
[![Discord Server](https://badgen.net/badge/icon/discord?icon=discord&label)](https://discord.gg/23f6w9sgAd)
[![License](https://img.shields.io/badge/License-BSD%203--Clause-blue.svg)](https://opensource.org/licenses/BSD-3-Clause)
<br>


If you want to learn more about BerylDB and how to install it, feel free to check our
documentation at [docs.beryl.dev](https://docs.beryl.dev/).<br>
Follow us on [Twitter](https://twitter.com/beryldb).

## QuickStart

The quick start guide will show you how to set up a simple application using
BerylDB's php driver.

It scope is only how to set up the driver and perform the simple operations.
For more advanced coverage, we encourage reading our tutorial.

## Loading 

PHP-beryl utilizes the autoloading features of PHP in order to run its
files. If you are using Composer, autoloading should be managed automatically.

## Using

PHP-beryl requries [composer](http://getcomposer.org). You may install
composer on Mac OS:

```
$ brew install composer
```

* On Debian-based systems:

```
$ sudo apt update
$ sudo apt install curl php-cli php-mbstring git unzip
$ curl -sS https://getcomposer.org/installer -o composer-setup.php
```

* Installing php-beryl's dependencies:

```
$ composer require beryldb/php-beryl:1.0.x-dev
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

* Check Beryl's [full list of commands](https://docs.beryl.dev/commands/).


## Simple queries

Most php-beryl functions have the same name as any other BerylDB function.
For instance, if you want to execute a basic key set

```php 
echo $client->set("hello", "world");
echo $client->get("hello");
```

This script will return:

```
OK
world
```

In case of requesting for a key that is not defined, a Throw exception will be
raised. For instance, we retrieve key **``hello``** 

```php 
try
{
     echo $client->get("hello")             . "\n";
} 
catch (Exception $error) 
{
    echo $error->getCode()                  . "\n";
}
```

In BerylDB, different structues cannot hold the same variable name. In order
to check what kind of data structure is a given key, you may use type

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

```php 
$results = $client->keys("*");

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

```php 
echo $client->set("hello", "world") // => OK
echo $client->lpush("hello", "world") // => 0
```

As you can see above, 'hello' is defined and a 0 (false) will be returned.

Let's assume that list a has the following keys:

```php 
a = [1, 2, 3, 4, 5, 6, 7, 8, 9];

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

```php
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

```php
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

```php
echo $client->gcalc("Los_Angeles", "Miami") => // 4222.46 
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


## Contributing

We are always welcoming new members. If you wish to start contributing code to the 
Beryl project in any form, such as in the form of pull requests via Github, 
a code snippet, or a patch, you will need to agree to release your work under the terms of the
BSD license.

## External Links

* [Documentation](https://docs.beryl.dev)
* [GitHub](https://github.com/beryldb/beryldb)
* [Support/Discord](https://discord.gg/23f6w9sgAd)
* [Twitter](https://twitter.com/beryldb)
