<?php
require('../server/config.php');
require('../api/SampQueryAPI.php');
http_response_code(200);

if(isset($_GET['KNCMS_ACTION']))
{
    if($_GET['KNCMS_ACTION'] == 'ServerOnline')
    {
        if(!isset($_GET['KNCMS_PORT'])) $_GET['KNCMS_PORT'] = 7777;
        $query = new SampQueryAPI($_GET['KNCMS_SERVERIP'], $_GET['KNCMS_PORT']);
        if($query->isOnline()) echo 'Online';
        else echo 'Offline';
    }
    if($_GET['KNCMS_ACTION'] == 'SeverSupport')
    {
        echo isServerSuport($_GET['KNCMS_SERVERIP']);
    }
}