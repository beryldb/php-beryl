<?php
/*
 * In this test:
 *
 * We flush current database, then we flush all databases.
 * Finally, we restart the daemon.
 *
 * => php tests/admin.php
 */
 
require __DIR__.'/../vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default',
                   ]);

echo $client->flushdb()            . "\n"; /* OK */
echo $client->flushall()           . "\n"; /* OK */

/* Print all commands. */

$results = $client->commands();

if ($results)
{
     /* Will print all core modules found. */
     
     foreach ($results as $key => $value)
     {
           printf("%-20s | %-10s\n", $key, $value);
     }
}

$results = $client->coremodules();

if ($results)
{
     /* Will print all core modules found. */
     
     foreach ($results as $key => $value)
     {
           printf("%-20s | %-10s\n", $key, $value);
     }
}

/* Server's pwd */

echo $client->pwd()                . "\n"; /* OK */

/* Restarts server */

//echo $client->restart()            . "\n"; /* OK */

/* Shutdowns server */

//echo $client->shutdown()           . "\n"; /* OK */
