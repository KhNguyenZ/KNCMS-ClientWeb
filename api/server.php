<?php

class KN_API
{
    public function isServerSuport($string_ip)
    {
        if(check_rows($string_ip, "kncms_server", "server_ip")) return 1;
        else return 0;
    }
    public function CheckAPIKey($api_key)
    {
        if(check_rows($api_key, 'kncms_server', 'apikey')) return 1;
        else return 0;
    }
    public function CheckAPILevel($api_key)
    {
        if(check_rows($api_key, 'kncms_server', 'apikey'))
        {
            $query_kncms = KNCMS::query("SELECT * FROM `kncms_server` WHERE `api_key` = '".$api_key."'")->fetch_array();
            if($query_kncms['api_level'] == 'member') return 1;
            else if($query_kncms['api_level'] == 'vip') return 2;
            else if($query_kncms['api_level'] == 'admin') return 3;
        }
    }
}

$KN_API = new KN_API;