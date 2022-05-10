<?php

class DockerVolumes extends Base
{
    public static $aRoutes = [
        'list_docker_volumes' => ['fnGetList'],
        'update_and_list_docker_volumes' => ['fnWipeAndGetList'],
        'update_list_volumes' => ['fnWipe'],
    ];

    public static function fnUpdate()
    {
        $aList = Request::fnGetVolumesList();

        foreach ($aList as $aItem) {
            foreach ($aItem as $aRow) {
                $oContainer = R::dispense(T_DOCKER_VOLUMES);
                $oContainer->json = json_encode($aRow);
                R::store($oContainer);
            }
        }
    }

    public static function fnWipe()
    {
        R::wipe(T_DOCKER_VOLUMES);
    }

    public static function fnWipeAndGetList()
    {
        R::wipe(T_DOCKER_VOLUMES);
        static::fnGetList();
    }

    public static function fnGetList()
    {
        $aList = R::findAll(T_DOCKER_VOLUMES);

        if (!$aList) {

            static::fnUpdate();
            $aList = R::findAll(T_DOCKER_VOLUMES);
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