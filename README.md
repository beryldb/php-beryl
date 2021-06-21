PHP-Beryl is **NOT PRODUCTION READY YET**.

## Loading 

PHP-beryl utilizes autoloading features of PHP in order to run its
files. If you are using Composer, autoloading should be managed automatically.

## Using

PHP-beryl requries [composer](http://getcomposer.org). You may install
composer on Mac OS:

```
brew install composer
```

On Debian-based systems:

```
sudo apt update
sudo apt install curl php-cli php-mbstring git unzip
curl -sS https://getcomposer.org/installer -o composer-setup.php
```

Installing dependencies:

```
composer install
```

## Running

In order to run your instance, you must load autoload.php:

```
<?php

require __DIR__.'/vendor/autoload.php';
```

## Connecting to Beryl

When creating a client instance without any parameter, php-beryl uses
host ``127.0.0.1`` and port ``6378``.

```
<?php

require __DIR__.'/vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'timeout' => 30, 
                    'login' => 'root', 
                    'password' => 'default',
		    'debug' => false
                   ]);

?>
```

When ``debug`` is set to true, everything returning from the remote server
will be printed. This option is set to false by default, and it should be
that way, unless you are implementing a new command in beryl.

## Simple query

Most php-beryl function have the same name as any other BerylDB function.
For instance, if you want to execute a basic key set:


```
:$ php example.php

echo $client->set("hello", "world")->status. "\n";
echo $client->get("hello")->value . "\n";

OK
"world"
```

If you would like to flush (reset) your current database:

```
echo $client->flushdb();
```

Alternatively, you may remove a single key:

```
echo $client->del("hello")->status. "\n";
```

## Development

Contributions to php-beryl are appreciated either in the form of pull requests for new features, 
bug fixes, or simple to report a bug.



