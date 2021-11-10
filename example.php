<?php

/* 
 * php-beryl - PHP Driver for BerylDB.
 * http://www.beryldb.com
 *
 * This is an example script for php-beryl. You may modify it
 * and freely use it at your convenience. Feel free to join our
 * discord support server If you are interested about
 * BerylDB. 
 */
 
require __DIR__.'/vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                   'host' => 'localhost',   /* Host to connect to */
                   'port' => 6378,          /* Server's port */
                   'timeout' => 30,         /* Timeout before stop trying to connect */
                   'login' => 'root',       /* Login to utilize */
                   'password' => 'default', /* User's password */
                   'debug' => false         /* Print raw data from remote server */
                   ]);

/* Let's remove all data */

$client->flushall();

/* We set a key 'hello' */

try
{
     echo $client->set("hello", "world")   . "\n";
} 
catch (Exception $error) 
{
    echo $error->getMessage()              .  "\n";
}

/* We set a map 'a' with hash 'b' and value 'c'. */

try
{
    echo $client->hset("a", "b", "c")   . "\n";
} 
catch (Exception $error) 
{
    echo $error->getCode()                  . "\n";
}

/* We create list 'd' and push item 'f' */

try
{
    echo $client->lpush("d", "f")     . "\n";
}
catch (Exception $error) 
{
    echo $error->getCode()                  . "\n";
}
   
