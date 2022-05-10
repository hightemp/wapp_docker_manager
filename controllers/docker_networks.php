<?php

class DockerNetworks extends Base
{
    public static $aRoutes = [
        'list_docker_networks' => ['fnGetList'],
        'update_and_list_docker_networks' => ['fnWipeAndGetList'],
        'update_list_networks' => ['fnWipe'],
    ];

    public static function fnUpdate()
    {
        $aList = Request::fnGetNetworksList();

        foreach ($aList as $aItem) {
            $oContainer = R::dispense(T_DOCKER_NETWORKS);
            $oContainer->json = json_encode($aItem);
            
            /*
            foreach ($aItem as $sK => $mI) {
                // $oContainer->import($aItem);
                echo $sK;
                $sK = preg_replace('/[^a-zA-Z]+/', "", $sK);
                $sK = strtolower($sK);
                if (!$sK) continue;
                var_export($mI);
                if ()
                $oContainer['docker'.$sK] = $mI;
            }
            */
            R::store($oContainer);
        }
    }

    public static function fnWipe()
    {
        R::wipe(T_DOCKER_NETWORKS);
    }

    public static function fnWipeAndGetList()
    {
        R::wipe(T_DOCKER_NETWORKS);
        static::fnGetList();
    }

    public static function fnGetList()
    {
        $aList = R::findAll(T_DOCKER_NETWORKS);

        if (!$aList) {

            static::fnUpdate();
            $aList = R::findAll(T_DOCKER_NETWORKS);
        }

        $aResult = [];
        foreach ($aList as $oItem) {
            $aData = json_decode($oItem->json, true);
            // var_Export($aData);
            $aResult[] = $aData;
        }

        return $aResult;
    }
}