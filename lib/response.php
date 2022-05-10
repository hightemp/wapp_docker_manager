<?php

include_once("./controllers/groups.php");

class Response
{
    public static $aControllers = [
        DockerContainers::class,
        DockerImages::class,
        DockerNetworks::class,
        DockerVolumes::class,
    ];
    
    public static function fnExec()
    {
        foreach (static::$aControllers as $sClass) {
            $mResult = $sClass::fnResponse();
            if ($mResult !== false)  {
                die(json_encode($mResult));
            }
        }

        header("HTTP/1.1 404 Not Found"); 
        die();
    }
}