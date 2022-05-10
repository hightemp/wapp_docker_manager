<?php 

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

include_once("./init.php");

if ($argv[1] == "nuke") {
    R::nuke();
    die();
}

if ($argv[1] == "create_scheme") {

    die();
}

if ($argv[1] == "test_containers_list") {
    try {
        $aData = Request::fnGetContainersList();
        var_export($aData);
    } catch (\Exception $oE) {
        echo $oE->getMessage();
    }
    die();
}
