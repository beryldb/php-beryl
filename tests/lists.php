<?php
/*
 * In this test:
 *
 * We create the list 'hello' and add the 'world' item to it. 
 * The, we count items in list. We only have 1 so far.
 * We sort the list. This is not so useful when you only have one item.
 * Finally, we check position 0 with lpos.
 *
 * => php tests/lists.php
 */
 
require __DIR__.'/../vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);

/* Push an item hello */

echo $client->lpush("hello", "world")     . "\n"; /* OK */

/* Check if hello list exists */

echo $client->exists("hello")             . "\n"; /* 1 */
echo $client->lcount("hello", "world")    . "\n"; /* 1 */
echo $client->lsort("hello")   		  . "\n"; /* OK */
echo $client->lpos("hello", 0) 		  . "\n"; /* => world */


try
{
    $results = $client->lget("hello");

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

$results = $client->lkeys("*");

if ($results)
{
     foreach ($results as $key)
     {
         printf("%s\n", $key);
     }
}

/* Delete item world from list hello. */

echo $client->ldel("hello", "world")            . "\n"; /* => OK */

/* Removes all 'world' items in list hello */

echo $client->lpopall("hello", "world")         . "\n"; /* OK */
