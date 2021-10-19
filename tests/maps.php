<?php
/*
 * In this test:
 *
 * => php tests/maps.php
 */
 
require __DIR__.'/../vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);


$client->flushall();

/* We create and set a hash 'hello' */

echo $client->hset("hello", "pretty", "world") 	. "\n";    /* OK */

try
{
    $results = $client->hlist("hello");

    if ($results)
    {
          foreach ($results as $key)
          {
                printf("%s\n", $key);
          } 
    } 
    
} 
catch (Exception $error) 
{
          echo $error->getMessage()              .  "\n";
} 

/* Deleting a hash */

try
{
     echo $client->hdel("hello", "pretty");
} 
catch (Exception $error) 
{
    echo $error->getMessage();
    echo $error->getCode();
}