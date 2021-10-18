<?php
/*
 * Example about running vectors.
 *
 * => php tests/vector.php
 */
 
require __DIR__.'/../vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);

/* Push an item hello */

echo $client->vpush("hello", "world")     . "\n"; /* OK */

/* Check if hello vector exists */

echo $client->exists("hello")             . "\n"; /* 1 */
echo $client->vsort("hello")   		  . "\n"; /* OK */
echo $client->vpos("hello", 0) 		  . "\n"; /* => world */


try
{
    $results = $client->vget("hello");

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

/* List all keys */

$results = $client->vkeys("*");

if ($results)
{
     foreach ($results as $key)
     {
         printf("%s\n", $key);
     }
}

/* Delete item world from vector hello. */

echo $client->vdel("hello", "world")            . "\n"; /* => OK */
