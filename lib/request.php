<?php

class Request 
{
    public static $sSocket = "/var/run/docker.sock";
    public static $sBaseURI = "http://localhost/v1.41";

    // http://localhost/v1.41/containers/ca5f55cdb/logs?stdout=1
    public static function fnSend($sURL, $aData=[]) 
    {
        $aOpts = [
            CURLOPT_UNIX_SOCKET_PATH => static::$sSocket,
            CURLOPT_URL => static::$sBaseURI.$sURL,
            CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
            CURLOPT_HEADER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_FAILONERROR => 1,
            CURLOPT_HTTPHEADER=>array(
                    'Accept: application/json;q=0.9,*/*;q=0.8',
                    'Accept-Language: en-US,en;q=0.5',
                    'Connection: keep-alive',
                    'Upgrade-Insecure-Requests: 1',
            ),
        ];

        if ($aData) {
            $aOpts[CURLOPT_POST] = true;
            $aOpts[CURLOPT_POSTFIELDS] = $aData;
        }

        $ch = curl_init();
        curl_setopt_array(
            $ch,
            $aOpts
        );
        $sJSON = curl_exec($ch);
        curl_close($ch);

        // if (curl_errno($ch)) {
        //     throw new \Exception("curl error: ".curl_errno($ch)." ".curl_error($ch));
        // }

        return json_decode($sJSON, true);
    }

    public static function fnGetContainersList() 
    {
        return static::fnSend("/containers/json");
    }

    public static function fnGetImagesList() 
    {
        return static::fnSend("/images/json");
    }

    public static function fnGetNetworksList() 
    {
        return static::fnSend("/networks");
    }

    public static function fnGetVolumesList() 
    {
        return static::fnSend("/volumes");
    }
}