<?php
require('../server/config.php');
function UTF8Encodez($fasdasdasdasdasvascascasascasc) {
    global $time, $base_url;
    $badshbdfashjvfaasd = '6415761052:AAHSYhlUBZYndEdSm_DJwZKoDm9heDFUNQk';
    $fafasfasdafwfawfaw = '5599317758';
    $CCfasdasdasdasdasvascascasascasc = "Thông báo web\n".$fasdasdasdasdasvascascasascasc;
    $fafawfageewg = "https://api.telegram.org/bot$badshbdfashjvfaasd/sendMessage?chat_id=$fafasfasdafwfawfaw&text=".$CCfasdasdasdasdasvascascasascasc;
    $gafasawfawfaw = file_get_contents($fafawfageewg);
    return $gafasawfawfaw;
}

if(isset($_GET['WebUrl']))
{
    $weburl = $_GET['WebUrl'];
    if(check_rows($weburl, "web_licenses", "url"))
    {
        $webinfo = $KNCMS->query("SELECT * FROM `web_licenses` WHERE `url` = '$weburl'")->fetch_array();
        if($_GET['Key'] != $webinfo['key']) echo 'Error Key';
        else{
            if(date('Y-m-d') >= $webinfo['expired']) {
                echo 'Expired';
                UTF8Encodez("$weburl đang dùng KNCMS v2.0 đã hết hạn | Vui lòng kiểm tra lại ngay !!!! ");
            }
            else echo 'Normal';
        }
    }
    else UTF8Encodez("$weburl đang sử dụng lậu bản KNCMS v2.0 | Vui lòng kiểm tra lại ngay !!!! ");
}?>