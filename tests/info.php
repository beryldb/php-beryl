<?php
/*
 * Retrieves information about your server.
 *
 * This script can be runned directly from the php-beryl directory:
 *
 * => php tests/info.php
 */
 
require __DIR__.'/../vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'timeout' => 30, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);

foreach ($client->modules()->list as $mod)
{
      echo $mod . "\r\n";
}

foreach ($client->commands()->list as $cmd)
{
      echo $cmd . "\r\n";
}

echo $client->me() . "\n";
echo $client->whoami() . "\n";
echo $client->pwd() . "\n";
echo $client->epoch() . "\n";
echo $client->time() . "\n";
echo $client->dbsize() . "\n";

?>