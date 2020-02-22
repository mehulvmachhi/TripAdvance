<?php

    function sqlCompatibleDateFormatter($date)
    {
        return preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1",$date);
    }
    
    function userCompatibleDateFormatter($date)
    {
        return preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3/$2/$1",$date);
    }

?>