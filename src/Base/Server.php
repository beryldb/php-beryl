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

namespace Beryl\Base;

interface Server
{
   /*
    * Connects to a socket.
    *
    * @throws ConnectionException
    */

    public function connect();

   /*
    * Disconnects the socket.
    *
    * This command shutdowns connection.
    */
     
    public function disconnect();
    
    /*
     * Sends a command to the server.
     *
     * @parameters:
     *
     *          · Command: $command.
     *
     * @return 
     *
     *          · Response: Return from server.
     */

    public function send(Command $command);

    /*
     * Reads the output buffer
     *
     * @return Response.
     */

    public function read();
}
?>