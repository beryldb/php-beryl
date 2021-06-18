<?php
/*
 * Retrieves information about your server.
 *
 * This script can be runned directly from the php-beryl directory:
 *
 * => php tests/info.php
 */
 
require __DIR__.'/../vendor/autoload.php';

use Beryl\Connection;

$client = new Connection\Server([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'timeout' => 30, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);


print_r($client->version());
print_r($client->me());
print_r($client->whoami());
print_r($client->pwd());
print_r($client->dbsize());
print_r($client->using($client->me()));
print_r($client->time());
print_r($client->epoch());
print_r($client->myagent());

?>