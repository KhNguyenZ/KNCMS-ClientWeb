<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
// $_SESSION['session_request'] = time();
$time = date('Y-m-d h:i:z');
$timez = date('h:i');
session_start();
$base_url = 'http://localhost/';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use function PHPMailer\PHPMailer;

require_once('include/Exception.php');
require_once('include/PHPMailer.php');
require_once('include/SMTP.php');

require_once('include/vendor/autoload.php');
use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Intents;
use Discord\WebSockets\Event;

$dis_bottoken = 'MTAxNDQwNTM1NjQwMDY4OTIxMg.GwkabF.3avlZ2WxynMh-WSjpv9zgerB9I390yLNeGMdbA';
$discord = new Discord([
    'token' => $dis_bottoken,
    'intents' => Intents::getDefaultIntents()
]);

class KNCMS
{
    private $ketnoi;
    function ketnoi()
    {
        if (!$this->ketnoi) {
            $this->ketnoi = mysqli_connect('localhost', 'root', '123456', 'laucher') or die('Vui lòng kết nối đến DATABASE');
            mysqli_query($this->ketnoi, "set names 'utf8'");
        }
    }
    function disketnoi()
    {
        if ($this->ketnoi) {
            mysqli_close($this->ketnoi);
        }
    }
    function getUser($username)
    {
        $this->ketnoi();
        $row = $this->ketnoi->query("SELECT * FROM `users` WHERE `Username` = '$username'")->fetch_array();
        return $row;
    }
    function getSite()
    {
        $this->ketnoi();
        $row = $this->ketnoi->query("SELECT * FROM `settings`")->fetch_array();
        return $row;
    }
    function query($sql)
    {
        $this->ketnoi();
        $row = $this->ketnoi->query($sql);
        return $row;
    }
    function get_row($sql)
    {
        $this->ketnoi();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row) {
            return $row;
        }
        return false;
    }
    function num_rows($sql)
    {
        $this->ketnoi();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $row = mysqli_num_rows($result);
        mysqli_free_result($result);
        if ($row) {
            return $row;
        }
        return false;
    }
    function get_list($sql)
    {
        $this->ketnoi();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $return = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $return[] = $row;
        }
        mysqli_free_result($result);
        return $return;
    }
    function gettime()
    {
        return date('Y/m/d H:i:s', time());
    }
    function anti_text($text)
    {
        $text = html_entity_decode(trim($text), ENT_QUOTES, 'UTF-8');
        //$text=str_replace(" ","-", $text);
        $text = str_replace("--", "", $text);
        $text = str_replace("@", "", $text);
        $text = str_replace("/", "", $text);
        $text = str_replace("\\", "", $text);
        $text = str_replace(":", "", $text);
        $text = str_replace("\"", "", $text);
        $text = str_replace("'", "", $text);
        $text = str_replace("<", "", $text);
        $text = str_replace(">", "", $text);
        $text = str_replace(",", "", $text);
        $text = str_replace("?", "", $text);
        $text = str_replace(";", "", $text);
        $text = str_replace(".", "", $text);
        $text = str_replace("[", "", $text);
        $text = str_replace("]", "", $text);
        $text = str_replace("$", "", $text);
        $text = str_replace("(", "", $text);
        $text = str_replace(")", "", $text);
        $text = str_replace("́", "", $text);
        $text = str_replace("̀", "", $text);
        $text = str_replace("̃", "", $text);
        $text = str_replace("̣", "", $text);
        $text = str_replace("̉", "", $text);
        $text = str_replace("*", "", $text);
        $text = str_replace("!", "", $text);
        //$text=str_replace("$","-",$text);
        //$text=str_replace("&","-and-",$text);
        $text = str_replace("%", "", $text);
        $text = str_replace("#", "", $text);
        $text = str_replace("^", "", $text);
        $text = str_replace("=", "", $text);
        $text = str_replace("+", "", $text);
        $text = str_replace("~", "", $text);
        $text = str_replace("`", "", $text);
        //$text=str_replace("--","-",$text);
        //$text = strtolower($text);
        return $text;
    }


    function to_slug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        // $str = preg_replace('', '+', $str);
        return $str;
    }
    function xoadau($strTitle)
    {
        $strTitle = strtolower($strTitle);
        $strTitle = trim($strTitle);
        $strTitle = str_replace(' ', '-', $strTitle);
        $strTitle = preg_replace("/(ò|ó|ọ|ỏ|õ|ơ|ờ|ớ|ợ|ở|ỡ|ô|ồ|ố|ộ|ổ|ỗ)/", 'o', $strTitle);
        $strTitle = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ô|Ố|Ổ|Ộ|Ồ|Ỗ)/", 'o', $strTitle);
        $strTitle = preg_replace("/(à|á|ạ|ả|ã|ă|ằ|ắ|ặ|ẳ|ẵ|â|ầ|ấ|ậ|ẩ|ẫ)/", 'a', $strTitle);
        $strTitle = preg_replace("/(À|Á|Ạ|Ả|Ã|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ)/", 'a', $strTitle);
        $strTitle = preg_replace("/(ề|ế|ệ|ể|ê|ễ|é|è|ẻ|ẽ|ẹ)/", 'e', $strTitle);
        $strTitle = preg_replace("/(Ể|Ế|Ệ|Ể|Ê|Ễ|É|È|Ẻ|Ẽ|Ẹ)/", 'e', $strTitle);
        $strTitle = preg_replace("/(ừ|ứ|ự|ử|ư|ữ|ù|ú|ụ|ủ|ũ)/", 'u', $strTitle);
        $strTitle = preg_replace("/(Ừ|Ứ|Ự|Ử|Ư|Ữ|Ù|Ú|Ụ|Ủ|Ũ)/", 'u', $strTitle);
        $strTitle = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $strTitle);
        $strTitle = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $strTitle);
        $strTitle = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $strTitle);
        $strTitle = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $strTitle);
        $strTitle = str_replace('đ', 'd', $strTitle);
        $strTitle = str_replace('Đ', 'd', $strTitle);
        $strTitle = preg_replace("/[^-a-zA-Z0-9]/", '', $strTitle);
        return $strTitle;
    }
    function format_cash($price)
    {
        return str_replace(",", ".", number_format($price));
    }
    function exitsql($sql)
    {
        $this->ketnoi();
        $result = mysqli_query($this->ketnoi, $sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    function curl_get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        curl_close($ch);
        return $data;
    }
    function msg_success($text, $url, $time)
    {
        if(ceil($time) == 0)
        {
            return die('<script type="text/javascript">Swal.fire("Thành Công", "' . $text . '","success")</script>');
        }
        else{
            return die('<script type="text/javascript">Swal.fire("Thành Công", "' . $text . '","success");
            setTimeout(function(){ location.href = "' . $url . '" },' . $time . ');</script>');
        }
    }
    function msg_error($text, $url, $time)
    {
        if(ceil($time) == 0)
        {
            return die('<script type="text/javascript">Swal.fire("Thất Bại", "' . $text . '","error")</script>');
        }
        else{
            return die('<script type="text/javascript">Swal.fire("Thất Bại", "' . $text . '","error");
            setTimeout(function(){ location.href = "' . $url . '" },' . $time . ');</script>');
        }
    }
    function msg_warning($text, $url, $time)
    {
        if(ceil($time) == 0)
        {
            return die('<script type="text/javascript">Swal.fire("Thông Báo", "' . $text . '","warning")</script>');
        }
        else{
            return die('<script type="text/javascript">Swal.fire("Thông Báo", "' . $text . '","warning");
            setTimeout(function(){ location.href = "' . $url . '" },' . $time . ');</script>');
        }
    }
    function rows_sql($dataz)
    {
        if ($dataz->num_rows != 0) { // da co du lieu
            $kt = True;
        } else {
            $kt = False; // chua co du lieu
        }
        return $kt;
    }
    function insert($table, $sql){
        $this->ketnoi();
        $sql_insert = "INSERT INTO `$table` $sql";

        $result = mysqli_query($this->ketnoi, $sql_insert);
        if(!$result) die('Insert không thành công do có lỗi mã sql');
        return $result;
    }
    function update($table, $sql)
    {
        $this->ketnoi();
        $sql_insert = "UPDATE `$table` $sql";

        $result = mysqli_query($this->ketnoi, $sql_insert);
        if(!$result) die('Update không thành công do có lỗi mã sql');
        return $result;
    }
}
$admin_url = $base_url . 'AdminPages';
$KNCMS = new KNCMS;
function capbac($data)
{
    if ($data == 2) return 'Junior Admin';
    else if ($data == 3) return 'General Admin';
    else if ($data == 4) return 'Senior Admin';
    else if ($data == 1337) return 'Head Admin';
    else if ($data == 1338) return 'Lead Head Admin';
    else if ($data == 99999) return 'Excutive Admin';
}
function isLogin()
{
    if (isset($_SESSION['ucp_username'])) {
        $kiemtra = True;
    } else {
        $kiemtra = False;
    }
    return $kiemtra;
}
function ResetUserSesson($usernames)
{
    if (isLogin()) {
        $_SESSION['ucp_username'] = $usernames;
        header('location: ' . hUrl('Home'));
    }
}

function Logout($usernames)
{
    if (isLogin()) {
        $_SESSION['ucp_username'] = $usernames;
        header('location: ' . hUrl('Home'));
    }
}
if (isset($_SESSION['ucp_username'])) {
    $username = $KNCMS->anti_text($_SESSION['ucp_username']);
    $UserInfo = $KNCMS->query("SELECT * FROM `users` WHERE `username` = '$username'")->fetch_array();
    $uid = $UserInfo['id'];
    if($UserInfo['level'] == 'admin')
    {
        $_SESSION['SuperAdmin'] = $username;
    }
    else {
        if(isset($_SESSION['SuperAdmin'])) $_SESSION['SuperAdmin'] = array();
    }
}

function getIp()
{
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if ($ip == "::1") {
        $ip = '127.0.0.1';
    }
    return $ip;
}

 
function GetGender($dataz)
{
    if ($dataz == 1) {
        $show = 'Boy';
    } else {
        $show = 'Girl';
    }
    return $show;
}
function sendCSM($mail_nhan, $ten_nhan, $chu_de, $noi_dung)
{
    $mail = new PHPMailer();
    $smtp = new SMTP();
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'tls://smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'knguyen151108@gmail.com';                     //SMTP username
    $mail->Password   = 'ldwehlfimdkwjjhl';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('MaztechWork@gmail.com', "MazTech - Develop Team");
    $mail->addAddress($mail_nhan, $ten_nhan);     //Add a recipient
    $mail->addReplyTo('maztechwork@gmail.com', 'Not Reply');
    $mail->addCC($mail_nhan);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $chu_de;
    $mail->Body    = $noi_dung;
    $mail->CharSet = 'UTF-8';
    $send = $mail->send();
    return $mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;;
}
function LogGlobal($text, $uid)
{
    $KNCMS = new KNCMS;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timezz = date('d-m-Y h:i:z');
    $query = "INSERT INTO `logs` SET 
    `log` = '$text', 
    `uid` = '$uid',
    `time` = '$timezz';
    ";
    $checkzz = $KNCMS->query($query);
    if(!$checkzz) echo 'Lỗi khi ghi lịch sử thao tác<br>'.$query;
}

function check_rows($data, $table, $field)
{
    $KNCMS = new KNCMS;

    $querycheck  = $KNCMS->query("SELECT * FROM `$table` WHERE `$field` = '$data'");
    if ($querycheck !== false && $querycheck->num_rows > 0) return 1;
    else return 0;
}
function GetCardStatus($status)
{
    if ($status == 1) return 'Thẻ thành công đúng mệnh giá';
    if ($status == 2) return 'Thẻ thành công sai mệnh giá';
    if ($status == 3) return 'Thẻ lỗi';
    if ($status == 4) return 'Hệ thống bảo trì';
    if ($status == 99) return 'Thẻ chờ xử lý';
}
function GetServerCard($serverid)
{
    if ($serverid == 1) return "https://thesieure.com/";
    else if ($serverid == 2) return "https://www.doithe1s.vn/";
}
function hUrl($url)
{
    global $base_url;
    $new_url = $strTitle = str_replace("//", "/", $url);
    $new_url = $base_url . $url;
    return $new_url;
}


function MailTemplate($username)
{
    global $KNCMS;
    global $base_url;
    $usermail = $KNCMS->getUser($username);
    $template = '
    <!DOCTYPE html>
    <html>

    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <style type="text/css">
            @media screen {
                @font-face {
                    font-family: "Lato";
                    font-style: normal;
                    font-weight: 400;
                    src: local("Lato Regular"), local("Lato-Regular"), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format("woff");
                }

                @font-face {
                    font-family: "Lato";
                    font-style: normal;
                    font-weight: 700;
                    src: local("Lato Bold"), local("Lato-Bold"), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format("woff");
                }

                @font-face {
                    font-family: "Lato";
                    font-style: italic;
                    font-weight: 400;
                    src: local("Lato Italic"), local("Lato-Italic"), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format("woff");
                }

                @font-face {
                    font-family: "Lato";
                    font-style: italic;
                    font-weight: 700;
                    src: local("Lato Bold Italic"), local("Lato-BoldItalic"), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format("woff");
                }
            }

            /* CLIENT-SPECIFIC STYLES */
            body,
            table,
            td,
            a {
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }

            table,
            td {
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }

            img {
                -ms-interpolation-mode: bicubic;
            }

            /* RESET STYLES */
            img {
                border: 0;
                height: auto;
                line-height: 100%;
                outline: none;
                text-decoration: none;
            }

            table {
                border-collapse: collapse !important;
            }

            body {
                height: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }

            /* iOS BLUE LINKS */
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }

            /* MOBILE STYLES */
            @media screen and (max-width:600px) {
                h1 {
                    font-size: 32px !important;
                    line-height: 32px !important;
                }
            }

            /* ANDROID CENTER FIX */
            div[style*="margin: 16px 0;"] {
                margin: 0 !important;
            }
        </style>
    </head>

    <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
        <!-- HIDDEN PREHEADER TEXT -->
        </div>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <!-- LOGO -->
            <tr>
                <td bgcolor="#FFA73B" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                                <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Xin chao!</h1> <img src=" https://img.icons8.com/clouds/100/000000/handshake.png" width="125" height="120" style="display: block; border: 0px;" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <p style="margin: 0;">Tài khoản của bạn đang chờ xác nhận.</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td align="center" style="border-radius: 5px; width:500px;" bgcolor="#FFA73B"><a href="#" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 5px; border: 1px solid #FFA73B; display: inline-block;"
                                                    >Mã Xác Thực Tài Khoản: '.$usermail['ActiveCode'].'</a></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr> <!-- COPY -->
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <p style="margin: 0;">Link xác thực tài khoản:<a href="'.hUrl("DangKy/Step2/".$usermail['username']).'"> '.hUrl("DangKy/Step2/".$usermail['username']).'</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <p style="margin: 0;">Bạn vui lòng nhập mã này vào form đăng ký (bước 2) nhé</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <p style="margin: 0;">Trang chủ của chúng tôi:<a href="'.$base_url.'"> '.$base_url.'</a></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>

    </html>';
    return $template;
}

$site = $KNCMS->getSite();


function LogDiscord($log)
{
    global $discord;
    if(!$discord->getChannel('1139452363564912670')->sendMessage($log)) echo 'Log discord thất bại';
}