<?php

/*
 * In this test:
 *
 * We run multi tests by defining var 'a' and setting an expire on it.
 *
 * => php tests/multi.php
 */
 
require __DIR__.'/../vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default',
                    'debug' => 'true'
                   ]);

try
{
     echo $client->multi()   	     . "\n";
} 
catch (Exception $error) 
{
    echo $error->getMessage()        .  "\n";
}

try
{
     echo $client->set("a", "hello")   . "\n";
} 
catch (Exception $error) 
{
    echo $error->getMessage()        .  "\n";
}

echo $client->expire("a", 300)       . "\n"; /* OK */

try
{
     echo $client->mrun()   	     . "\n";
} 
catch (Exception $error) 
{
    echo $error->getMessage()        . "\n";
}

/* 
 * This line is commented as an error should be thrown if mrun() has
 * already been executed. 
 */
 
try
{
     echo $client->multireset()      . "\n";
} 
catch (Exception $error) 
{
    echo $error->getMessage()        . "\n";
}
