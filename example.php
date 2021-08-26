<?php

/*
 * This is an example script for php-beryl.
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


/* Create variable hello and set it to 'world' */

echo $client->set("hello", "world") 	. "\n";
echo $client->set("test", "entry") 	. "\n";

/* Returns third character (l) in key 'hello' */

echo $client->char("hello", 3)     . "\n";

/* Set var to 100 */

echo $client->set("var", "100") 	. "\n";

/* Increment var by 1 */

echo $client->incr("var") 		. "\n";

/* Increment var by 50 */

echo $client->incrby("var", "50") 	. "\n";

/* Copy var into var2 */

echo $client->copy("var", "var2")       . "\n";

/* Set an expire in 'var'. Keep in mind that 'var2' will not be affected by this. */

echo $client->expire("var", "300")       . "\n";

/* Seconds remaining before 'var' expires */

echo $client->ttl("var")                . "\n";

/* Search for all key items. */

$results = $client->search("*");

if ($results)
{
     foreach ($results as $key => $value)
     {
           printf("%-20s | %-10s\n", $key, $value);
     }
}

/* Create list 'b' and push 1, 2 and 3 */

echo $client->lpush("b", 1) 		. "\n";
echo $client->lpush("b", 2) 		. "\n";
echo $client->lpush("b", 3) 		. "\n";

/* Print all items in list b */

foreach ($client->lget("b") as $key)
{
     printf("%s\n", $key);
}

/* Resize list b to 1 element (This will remove all elements from list.). */

echo $client->lresize("b", 1)		   . "\n";

/* Create a map x, with hash item and value test */

echo $client->hset("x", "item", "test")    . "\n";
echo $client->hset("x2", "item2", "test2") . "\n";

/* Get x's length */

echo $client->hstrlen("x", "item") 	   . "\n";

