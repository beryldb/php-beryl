## Loading 

PHP-beryl utilizes the autoloading features of PHP in order to run its
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

use Beryl\Link;

$client = new Link([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'timeout' => 30, 
                    'login' => 'root', 
                    'password' => "default"
                   ]);

$client->set('hello', 'world');
$value = $client->get('hello');
echo $value['value'] . "\r\n";

?>
```


## Development

Contributions to php-beryl are appreciated either in the form of pull requests for new features, 
bug fixes, or simple to report a bug.



