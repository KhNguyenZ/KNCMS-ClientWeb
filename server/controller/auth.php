<?php 
// require_once('../config.php');

if(isset($_POST['BtnLogin']))
{
    if(empty($_POST['username']) || empty($_POST['password'])) $KNCMS->msg_warning("Vui lòng nhập đầy đủ thông tin", hUrl('Home'), 0);
    $username = $KNCMS->anti_text($_POST['username']);
    $password = $KNCMS->anti_text($_POST['password']);
    if(check_rows($username, "accounts", "Username"))
    {
        $user = $KNCMS->getUser($username);
        if(strtoupper(hash("whirlpool", $password.$user['Salt'])) == strtoupper($user['Key']))
        {
            $_SESSION['ucp_username'] = $username;
            LogGlobal("$username đã đăng nhập thành công vào hệ thống", $user['id']);
            $KNCMS->msg_success("Bạn đã đăng nhập thành công", hUrl('Home'), 1000);
        }
        else {
            $KNCMS->msg_warning("Mật khẩu của bạn không đúng", "", 1000);
        }
    }
    else $KNCMS->msg_warning("Tài khoản này không tồn tại", "", 0);
}

if(isset($_POST['BtnRegister']))
{
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) $KNCMS->msg_warning("Vui lòng nhập đầy đủ thông tin", hUrl('Home'), 0);
    $username = $KNCMS->anti_text($_POST['username']);
    $password = $KNCMS->anti_text($_POST['password']);
    $email = $_POST['email'];
    if(!preg_match("/^[a-zA-Z_]*$/", $username) && !preg_match("/^[a-zA-Z_]*$/", $password)) $KNCMS->msg_warning("Tài khoản hoặc mật khẩu không được chứa kí tự đặc biệt", hUrl('Home'), 0);
    if(strpos($username, "_") == 0) $KNCMS->msg_warning("Tài khoản bắt buộc phải có dấu '_' (VD: Khoi_Nguyenz)", hUrl('Home'),0);

    if(check_rows($username, "accounts", "Username")) $KNCMS->msg_warning("Tài khoản này đã tồn tại", "", 0);
    if(check_rows($email, "accounts", "Email")) $KNCMS->msg_warning("Email này đã tồn tại trên hệ thống", "", 0);
    $salt = "KNCMS".rand(0,9999999999999);
    $key = strtoupper(hash("whirlpool",$password.$salt));
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $time_reg = date('Y-m-d h:i:z');
    $code = "KNCMS-".rand(100000,999999);
    $register_step1 = $KNCMS->insert("accounts", "SET `Username` = '$username', `Key`='$key', `Salt`='$salt',`Email` = '$email', `RegiDate` = '$time_reg', `LastLogin` = '$time_reg', `ActiveCode` = '$code', `ActiveStatus` = '1'");
    if($register_step1)
    {
        $_SESSION['RegisterStep'] = 1;
        $mail = sendCSM($email, $username, "Xac Nhan Tai Khoan ".$username, MailTemplate($username));
        if($mail) $KNCMS->msg_success("Đăng ký tài khoản thành công", hUrl("DangKy"), 1000);
    }
}

if(isset($_POST['BtnRegister2']))
{
    $user_active = $KNCMS->getUser($Name);
    $usernamez = $user_active['Username'];
    $code = $KNCMS->anti_text($_POST['ActiveCode']);
    if($code == $user_active['ActiveCode'])
    {
        $_SESSION['ucp_username'] = $usernamez;
        $KNCMS->update("accounts", "SET `ActiveCode` = '0', `ActiveStatus` = '0' WHERE `Username` = '$usernamez'");
        $KNCMS->msg_success("Xác thực tài khoản thành công", hUrl("Home"), 1000);
    }
    else {
        $KNCMS->msg_warning("Mã này không đúng", "", 1000);
    }
}