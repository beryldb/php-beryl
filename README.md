PHP-Beryl is **NOT PRODUCTION READY YET**.

<a target="_blank" href="https://twitter.com/beryldb"><img src="https://img.shields.io/twitter/url/https/twitter.com/cloudposse.svg?style=social&label=Follow%20%40beryldb"></a>
<a target="_blank" href="https://github.com/beryldb/php-beryl/actions"><img src="https://github.com/beryldb/php-beryl/workflows/PHP%20Composer/badge.svg?4"></a>
<a target="_blank" href="https://github.com/beryldb/php-beryl/pulse" alt="Activity"> <img src="https://img.shields.io/github/commit-activity/m/beryldb/php-beryl" /></a>
[![License](https://img.shields.io/badge/License-BSD%203--Clause-blue.svg)](https://opensource.org/licenses/BSD-3-Clause)
<br>


This README is a brief introduction to PHP-Beryl. For extended information, you
can visit our documentation site at [docs.beryl.dev](https://docs.beryl.dev/api/php/).

![Logo](https://docs.beryl.dev/img/smaller.png??)

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
                   ]);

?>
```

## Simple query

Most php-beryl function have the same name as any other BerylDB function.
For instance, if you want to execute a basic key set:


```
echo $client->set("hello", "world")->status;
echo $client->get("hello")->value;
```

This script will return:

```
OK
"world"
```

In Beryl, different structues cannot hold the same variable name. In order
to check what kind of data structure is a given key:

```
echo $client->type("a")->code
KEY
```

If you would like to flush (reset) your current database:

```
echo $client->flushdb()->status;
```

Alternatively, you may remove a single key instead of the entire database:

```
echo $client->del("hello")->code;
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

## Protocols

Although calling functions with the ->status object should enough, in some
cases you may be required to check [Beryl's
protocol](https://github.com/beryldb/beryldb/blob/unstable/include/protocols.h) in order to get an exact 
response from the server:

```
echo $client->get("hello")->code; // 164 (BRLD_QUERY_OK)
echo $client->get("hello")->status; // OK
echo $client->get("hello")->value; // World
```

Same response, different way to check your query's response.

## Development

Contributions to php-beryl are appreciated either in the form of pull requests for new features, 
bug fixes, or simple to report a bug.



