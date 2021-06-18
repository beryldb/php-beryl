<?php
/*
 * Sets two keys (a, and a2) and then runs a get and a copy. Also,
 * this script runs both find and search.
 *
 * This script can be runned directly from the php-beryl directory:
 *
 * => php tests/keys.php
 */
 
require __DIR__.'/../vendor/autoload.php';

$client = new Beryl\Connection\Client([  
                    'host' => 'localhost', 
                    'port' => 6378, 
                    'login' => 'root', 
                    'password' => 'default'
                   ]);


/* Flush database. */

$client->flushdb();

$cities = ["Santiago" => "-33.447487 -70.673676"
           "Miami"    => "25.761681 -80.191788"
           "Los_Angeles" => "34.052235 -118.243683"
          ];
          
foreach ($cities as $city => $coordinates)
{
     $client->geoadd($city, $coordinates);
}
          
?>