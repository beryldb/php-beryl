<?php
/*
 * php-beryl - PHP Client for BerylDB.
 * http://www.beryldb.com
 *
 * Copyright (C) 2021 - Carlos F. Ferry <cferry@beryldb.com>
 * 
 * This file is part of BerylDB. BerylDB is free software: you can
 * redistribute it and/or modify it under the terms of the BSD License
 * version 3.
 *
 * More information about our licensing can be found at https://docs.beryl.dev
 */

namespace Beryl\Connection;

use Beryl\Commands;
use Beryl\Connection\Server;
use Beryl\Base\Command;

class Client
{
          public $client;
          
         /* 
          * Creates a new Server, while checking for validity of arguments
          * provided.
          * 
          * @parameters:
	  *
	  *         · $args	: These include host, port, etc.
          */              
         
          public function __construct($args)
          {
               $this->client = new Server($this->check_args($args));
          }
          
          public function Connect()
          {
               parent::Connect();
          } 

          public function current()
          {
               $cmd = new Commands\Current($this->client);
               return $cmd->Run();
          }

          public function expires($key)
          {
               $cmd = new Commands\Expires($this->client, $key);
               return $cmd->Run();
          }

          public function getset($key, $value)
          {
               $cmd = new Commands\Getset($this->client, $key, $value);
               return $cmd->Run();
          }

          public function toupper($key)
          {
               $cmd = new Commands\ToUpper($this->client, $key);
               return $cmd->Run();
          }
          
          public function tolower($key)
          {
               $cmd = new Commands\ToLower($this->client, $key);
               return $cmd->Run();
          }
          
          public function getdel($key)
          {
               $cmd = new Commands\Getdel($this->client, $key);
               return $cmd->Run();
          }
          
          public function ttlat($key)
          {
               $cmd = new Commands\TTLAT($this->client, $key);
               return $cmd->Run();
          }

          public function expire($key, $seconds)
          {
               $cmd = new Commands\Expire($this->client, $key, $seconds);
               return $cmd->Run();
          }

          public function commands($key = "")
          {
                $cmd = new Commands\Commands($this->client, $key);
                $cmd->Run();

                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }

                return $cmd->items;
          }

          public function coremodules($key = "")
          {
                $cmd = new Commands\Coremodules($this->client, $key);
                $cmd->Run();

                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }

                return $cmd->items;
          }
          
          public function modules($key = "")
          {
                $cmd = new Commands\Modules($this->client, $key);
                $cmd->Run();

                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }

                return $cmd->items;
          }

          public function setnx($key, $value)
          {
                $cmd = new Commands\Setnx($this->client, $key, $value);
                return $cmd->Run();
          }

          public function exec($key)
          {
                $cmd = new Commands\Exec($this->client, $key);
                return $cmd->Run();
          }

          public function cancel($key)
          {
                $cmd = new Commands\Cancel($this->client, $key);
                return $cmd->Run();
          }

          public function future($seconds, $key, $value)
          {
                $cmd = new Commands\Future($this->client, $seconds, $key, $value);
                return $cmd->Run();
          }

          public function setex($seconds, $key, $value)
          {
                $cmd = new Commands\Setex($this->client, $seconds, $key, $value);
                return $cmd->Run();
          }

          public function me()
          {
                return $this->client->me;
          }

          public function flushall()
          {
                $cmd = new Commands\FlushAll($this->client);
                return $cmd->Run();
          }

          public function dbdelete($key)
          {
                $cmd = new Commands\DBDelete($this->client, $key);
                return $cmd->Run();
          }

          public function exists($key)
          {
                $cmd = new Commands\Exists($this->client, $key);
                return $cmd->Run();
          }

          public function lexists($key, $value)
          {
                $cmd = new Commands\LExists($this->client, $key, $value);
                return $cmd->Run();
          }

          public function ismatch($key, $value)
          {
                $cmd = new Commands\IsMatch($this->client, $key, $value);
                return $cmd->Run();
          }

          public function char($key, $value)
          {
                $cmd = new Commands\Char($this->client, $key, $value);
                return $cmd->Run();
          }

          public function hdel($key, $hash)
          {
                $cmd = new Commands\HDel($this->client, $key, $hash);
                return $cmd->Run();
          }

          public function strlen($key)
          {
                $cmd = new Commands\Strlen($this->client, $key);
                return $cmd->Run();
          }

          public function hcount($key)
          {
                $cmd = new Commands\HCount($this->client, $key);
                return $cmd->Run();
          }

          public function hexists($key, $value)
          {
                $cmd = new Commands\HExists($this->client, $key, $value);
                return $cmd->Run();
          }
          
          public function hget($key, $value)
          {
                $cmd = new Commands\HGet($this->client, $key, $value);
                return $cmd->Run();
          }

          public function hset($key, $hash, $value)
          {
                $cmd = new Commands\HSet($this->client, $key, $hash, $value);
                return $cmd->Run();
          }
          
          public function hsetnx($key, $hash, $value)
          {
                $cmd = new Commands\HSetNX($this->client, $key, $hash, $value);
                return $cmd->Run();
          }

          public function hgetall($key, $offset = "", $limit = "")
          {
                $cmd = new Commands\HGetAll($this->client, $key, $offset, $limit);
                $cmd->Run();
                
                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }
                
                return $cmd->items;
          }

          public function hstrlen($key, $hash)
          {
                $cmd = new Commands\HStrlen($this->client, $key, $hash);
                return $cmd->Run();
          }

          public function persist($key)
          {
                $cmd = new Commands\Persist($this->client, $key);
                return $cmd->Run();
          }


          public function vlow($key)
          {
                $cmd = new Commands\VLow($this->client, $key);
                return $cmd->Run();
          }

          public function rename($key, $value)
          {
                $cmd = new Commands\Rename($this->client, $key, $value);
                return $cmd->Run();
          }

          public function renamenx($key, $value)
          {
                $cmd = new Commands\RenameNX($this->client, $key, $value);
                return $cmd->Run();
          }

          public function clone($key, $value)
          {
                $cmd = new Commands\CloneKey($this->client, $key, $value);
                return $cmd->Run();
          }
          
          public function copy($key, $value)
          {
                $cmd = new Commands\Copy($this->client, $key, $value);
                return $cmd->Run();
          }

          public function move($key, $value)
          {
                $cmd = new Commands\Move($this->client, $key, $value);
                return $cmd->Run();
          }

          public function startup($key, $value)
          {
                $cmd = new Commands\Startup($this->client, $key, $value);
                return $cmd->Run();
          }


          public function transfer($key, $value)
          {
                $cmd = new Commands\Transfer($this->client, $key, $value);
                return $cmd->Run();
          }

          public function vsum($key)
          {
                $cmd = new Commands\VSum($this->client, $key);
                return $cmd->Run();
          }

          public function tte($key)
          {
                $cmd = new Commands\TTE($this->client, $key);
                return $cmd->Run();
          }

          public function ttl($key)
          {
                $cmd = new Commands\TTL($this->client, $key);
                return $cmd->Run();
          }

          public function vexists($key, $value)
          {
                $cmd = new Commands\VExists($this->client, $key, $value);
                return $cmd->Run();
          }

          public function vpushnx($key, $value)
          {
               $cmd = new Commands\VPushNX($this->client, $key, $value);
               return $cmd->Run();
          }

          public function mdel($key, $value)
          {
               $cmd = new Commands\MDel($this->client, $key, $value);
               return $cmd->Run();
          }

          public function lpopall($key, $value)
          {
               $cmd = new Commands\LPopAll($this->client, $key, $value);
               return $cmd->Run();
          }

          public function ldel($key, $value)
          {
               $cmd = new Commands\LDel($this->client, $key, $value);
               return $cmd->Run();
          }

          public function vpush($key, $value)
          {
                $cmd = new Commands\VPush($this->client, $key, $value);
                return $cmd->Run();
          }

          public function mpushnx($key, $hesh, $value)
          {
                $cmd = new Commands\MPushNX($this->client, $key, $hesh, $value);
                return $cmd->Run();
          }

          public function mpush($key, $hesh, $value)
          {
                $cmd = new Commands\MPush($this->client, $key, $hesh, $value);
                return $cmd->Run();
          }

          public function lpush($key, $value)
          {
                $cmd = new Commands\LPush($this->client, $key, $value);
                return $cmd->Run();
          }

          public function lresize($key, $value)
          {
                $cmd = new Commands\LResize($this->client, $key, $value);
                return $cmd->Run();
          }

          public function vresize($key, $value)
          {
                $cmd = new Commands\VResize($this->client, $key, $value);
                return $cmd->Run();
          }

          public function vavg($key)
          {
                $cmd = new Commands\VAvg($this->client, $key);
                return $cmd->Run();
          }

          public function lavg($key)
          {
                $cmd = new Commands\LAvg($this->client, $key);
                return $cmd->Run();
          }
          
          public function lhigh($key)
          {
                $cmd = new Commands\LHigh($this->client, $key);
                return $cmd->Run();
          }
          
          public function llow($key)
          {
                $cmd = new Commands\LLow($this->client, $key);
                return $cmd->Run();
          }

          public function lpushnx($key, $value)
          {
                $cmd = new Commands\LPushNX($this->client, $key, $value);
                return $cmd->Run();
          }
          
          public function using($key)
          {
                $cmd = new Commands\Using($this->client, $key);
                return $cmd->Run();
          }

          public function shutdown()
          {
                $cmd = new Commands\Shutdown($this->client);
                return $cmd->Run();
          }

          public function restart()
          {
                $cmd = new Commands\Restart($this->client);
                return $cmd->Run();
          }

          public function dbcreate($key, $value)
          {
                $cmd = new Commands\DBCreate($this->client, $key, $value);
                return $cmd->Run();
          }

          public function flushdb()
          {
                $cmd = new Commands\FlushDB($this->client);
                return $cmd->Run();
          }

          public function incr($var)
          {
                $cmd = new Commands\Incr($this->client, $var);
                return $cmd->Run();
          }

          public function decr($var)
          {
                $cmd = new Commands\Decr($this->client, $var);
                return $cmd->Run();
          }

          public function decrby($var, $value)
          {
                $cmd = new Commands\Decrby($this->client, $var, $value);
                return $cmd->Run();
          }

          public function avg($var, $value)
          { 
                $cmd = new Commands\Avgby($this->client, $var, $value);
                return $cmd->Run();
          }

          public function incrby($var, $value)
          {	
                $cmd = new Commands\Incrby($this->client, $var, $value);
                return $cmd->Run();
          }

          public function dbsize($dbname = "")
          {
               $cmd = new Commands\DBSize($this->client, $dbname);
               return $cmd->Run();
          }

          public function vget($key, $offset = "", $limit = "")
          {
               $cmd = new Commands\VGet($this->client, $key, $offset, $limit);
               
               if ($cmd->status != Protocol::BRLD_END_LIST)
               {
                      return $cmd->status;
               }
                
                return $cmd->list;
          }

          public function lpopfront($key)
          {
               $cmd = new Commands\LPopFront($this->client, $key);
               return $cmd->Run();
          }

          public function vpos($key, $value)
          {
               $cmd = new Commands\VPos($this->client, $key, $value);
               return $cmd->Run();
          }

          public function vfront($key)
          {
               $cmd = new Commands\VFront($this->client, $key);
               return $cmd->Run();
          }

          public function vback($key)
          {
               $cmd = new Commands\VBack($this->client, $key);
               return $cmd->Run();
          }
                    
          public function vhigh($key)
          {
               $cmd = new Commands\VHigh($this->client, $key);
               return $cmd->Run();
          }

          public function lpos($key, $value)
          {
               $cmd = new Commands\LPos($this->client, $key, $value);
               return $cmd->Run();
          }

          public function lfront($key)
          {
               $cmd = new Commands\LFront($this->client, $key);
               return $cmd->Run();
          }
          
          public function lback($key)
          {
               $cmd = new Commands\LBack($this->client, $key);
               return $cmd->Run();
          }

          public function lfpop($key)
          {
               $cmd = new Commands\LFPop($this->client, $key);
               return $cmd->Run();
          }

          public function vsort($key)
          {
               $cmd = new Commands\VSort($this->client, $key);
               return $cmd->Run();
          }

          public function lsort($key)
          {
               $cmd = new Commands\LSort($this->client, $key);
               return $cmd->Run();
          }

          public function lpopback($key)
          {
               $cmd = new Commands\LPop($this->client, $key);
               return $cmd->Run();
          }

          public function lcount($key)
          {
               $cmd = new Commands\LCount($this->client, $key);
               return $cmd->Run();
          }

          public function lget($key, $offset = "", $limit = "")
          {
                $cmd = new Commands\LGet($this->client, $key, $offset, $limit);
                $cmd->Run();
            
                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }
                
                return $cmd->list;
          }

          public function mkeys($key, $offset = "", $limit = "")
          {
                $cmd = new Commands\MKeys($this->client, $key, $offset, $limit);
                $cmd->Run();
            
                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }
            
                return $cmd->list;
          }

          public function mget($key, $offset = "", $limit = "")
          {
                $cmd = new Commands\MGet($this->client, $key, $offset, $limit);
                $cmd->Run();
                
                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }
                
                return $cmd->list;
          }

          public function change($key)
          {
               $cmd = new Commands\Change($this->client, $key);
               return $cmd->Run();
          }
          
          public function geoadd($key, $value, $hash)
          {
               $cmd = new Commands\GeoAdd($this->client, $key, $value, $hash);
               return $cmd->Run();
          }
          
          public function geodist($key, $value)
          {
               $cmd = new Commands\GeoCalc($this->client, $key, $value);
               return $cmd->Run();
          }
          
          public function set($key, $value)
          {
               $cmd = new Commands\Set($this->client, $key, $value);
               return $cmd->Run();
          }
          
          public function del($key)
          {
               $cmd = new Commands\Del($this->client, $key);
               return $cmd->Run();
          }

          public function get($key)
          {
               $cmd = new Commands\Get($this->client, $key);
               return $cmd->Run();
          }

          public function count($key = "*")
          {
               $cmd = new Commands\Count($this->client, $key);
               return $cmd->Run();
          }

          public function adduser($key, $value)
          {
                $cmd = new Commands\AddUser($this->client, $key, $value);
                return $cmd->Run();
          }

          public function getexp($seconds, $key)
          {
               $cmd = new Commands\Getexp($this->client, $seconds, $key);
               return $cmd->Run();
          }
          
          public function rkey()
          {
               $cmd = new Commands\RKey($this->client);
               return $cmd->Run();
          }

          public function search($key, $offset = "", $limit = "")
          {
                $cmd = new Commands\Search($this->client, $key, $offset, $limit);
                $cmd->Run();
            
                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }
            
                return $cmd->items;
          }

          public function keys($key, $offset = "", $limit = "")
          {
                $cmd = new Commands\Keys($this->client, $key, $offset, $limit);
                $cmd->Run();
            
                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }
                
                return $cmd->list;
          }

          public function lkeys($key, $offset = "", $limit = "")
          {
                $cmd = new Commands\LKeys($this->client, $key, $offset, $limit);
                $cmd->Run();

                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }
            
                return $cmd->list;
          }

          public function vkeys($key, $offset = "", $limit = "")
          {
                $cmd = new Commands\VKeys($this->client, $key, $offset, $limit);
                $cmd->Run();

                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }
            
                return $cmd->list;
          }

          public function hlist($key, $offset = "", $limit = "")
          {
                $cmd = new Commands\HList($this->client, $key, $offset, $limit);
                $cmd->Run();
            
                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }
            
                return $cmd->list;
          }

          public function hvals($key, $offset = "", $limit = "")
          {
                $cmd = new Commands\HVals($this->client, $key, $offset, $limit);
                $cmd->Run();
 
                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }
            
                return $cmd->list;
          }

          public function hkeys($key, $offset = "", $limit = "")
          {
                $cmd = new Commands\HKeys($this->client, $key, $offset, $limit);
                $cmd->Run();
            
                if ($cmd->status != Protocol::BRLD_END_LIST)
                {
                      return $cmd->status;
                }
                
                return $cmd->list;
          }

          public function isalpha($key)
          {
               $cmd = new Commands\IsAlpha($this->client, $key);
               return $cmd->Run();
          }

          public function asbool($key)
          {
               $cmd = new Commands\AsBool($this->client, $key);
               return $cmd->Run();
          }

          public function isbool($key)
          {
               $cmd = new Commands\IsBool($this->client, $key);
               return $cmd->Run();
          }

          public function firstof($key)
          {
               $cmd = new Commands\FirstOf($this->client, $key);
               return $cmd->Run();
          }

          public function pause($key, $value = "")
          {
               $cmd = new Commands\Pause($this->client, $key, $value);
               return $cmd->Run();
          }

          public function resume($key)
          {
               $cmd = new Commands\Resume($this->client, $key);
               return $cmd->Run();
          }

          public function idle($key)
          {
               $cmd = new Commands\Idle($this->client, $key);
               return $cmd->Run();
          }

          public function isnum($key)
          {
               $cmd = new Commands\IsNum($this->client, $key);
               return $cmd->Run();
          }

          public function use($id)
          {
                $cmd = new Commands\UseCommand($this->client, $id);
                return $cmd->Run();
          }

          public function time()
          {
                $cmd = new Commands\Time($this->client);
                return $cmd->Run();
          }

          public function epoch()
          {
               $cmd = new Commands\Epoch($this->client);
               return $cmd->Run();
          }

          public function pwd()
          {
               $cmd = new Commands\PWD($this->client);
               return $cmd->Run();
          }

          public function reset()
          {
               $cmd = new Commands\Reset($this->client);
               return $cmd->Run();
          }

          public function whoami()
          {
               $cmd = new Commands\Whoami($this->client);
               return $cmd->Run();
          }

          public function db()
          {
               $cmd = new Commands\DB($this->client);
               return $cmd->Run();
          }

          public function type($key)
          {
               $cmd = new Commands\Type($this->client, $key);
               return $cmd->Run();
          }

          public function version()
          {
               $cmd = new Commands\Version($this->client);
               return $cmd->Run();
          }
          
          private function check_args($args)
          {
               if (empty($args['host']))
               {
                    $args['host'] = 'localhost';
               }

               if (empty($args['port']))
               {
                    $args['port'] = 6378;
               }

               if (empty($args['timeout']))
               {
                    $args['timeout'] = 30;
               }

               if (empty($args['login']))
               {
                    $args['login'] = 'root';
               }

               if (empty($args['password']))
               {
                    $args['password'] = 'default';
               }

               if (empty($args['debug']))
               {
                    $args['debug'] = false;
               }

               return $args;
          }
          
      
}
