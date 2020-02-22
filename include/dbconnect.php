<?php

define("DB_NAME", "trip");
define("USER", "root");
define("PASSWORD", "");
define("HOST", "localhost");

$connection = mysqli_connect(HOST, USER, PASSWORD);
if(!$connection)
{
    die("Unble to Connect SQL Database Server". mysqli_error($connection));
}
else
{    
//    define("CONNECTION", $connection);
}

$db_select = mysqli_select_db($connection, DB_NAME);
if(!$db_select)
{
    die("Could not select Database". mysqli_error($connection));
}

?>