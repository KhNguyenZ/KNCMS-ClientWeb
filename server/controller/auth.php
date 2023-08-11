<?php 

if(isset($_POST['BtnLogin']))
{
    if(empty($_POST['username']) || empty($_POST['password'])) $KNCMS->msg_warning("Vui lòng nhập đầy đủ thông tin", hUrl('Home'), 0);
    $username = $KNCMS->anti_text($_POST['username']);
    $password = $KNCMS->anti_text($_POST['password']);
    if(check_rows($username, "users", "username"))
    {
        $user = $KNCMS->getUser($username);
        if($password == $user['password'])
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
    $name = $_POST['name'];
    if(strlen($password) < 6) $KNCMS->msg_warning("Mật khẩu không được bé hơn 6 kí tự", hUrl('Home'),0);
    if(check_rows($username, "users", "username")) $KNCMS->msg_warning("Tài khoản này đã tồn tại", "", 0);
    if(check_rows($email, "users", "email")) $KNCMS->msg_warning("Email này đã tồn tại trên hệ thống", "", 0);
    if(strpos($username, " ") > 0) $KNCMS->msg_warning("Tên tài khoản không được có khoảng cách", "", 0); 
    $salt = "KNCMS".rand(0,9999999999999);
    $key = $password;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $time_reg = date('Y-m-d h:i:z');
    $code = "KNCMS-".rand(100000,999999);
    $avt = 'https://robohash.org/'.$username;
    $register_step1 = $KNCMS->insert("users", "SET `username` = '$username',`name` = '$name', `password`='$key',`email` = '$email', 
    `createdtime` = '$time_reg', `ActiveCode` = '$code', `ActiveStatus` = '1',
    `avt` = '$avt', `level` = 'member'");
    echo $register_step1;
    if($register_step1)
    {
        $_SESSION['RegisterStep'] = 1;
        $mail = sendCSM($email, $username, "Xac Nhan Tai Khoan ".$username, MailTemplate($username));
        if($mail) $KNCMS->msg_success("Đăng ký tài khoản thành công", hUrl("DangKy/Step2/".$username), 1000);
    }
}

if(isset($_POST['BtnRegister2']))
{
    $user_active = $KNCMS->getUser($name);
    $usernamez = $user_active['username'];
    $code = $KNCMS->anti_text($_POST['ActiveCode']);
    if($code == $user_active['ActiveCode'])
    {
        $_SESSION['ucp_username'] = $usernamez;
        $KNCMS->update("users", "SET `ActiveCode` = '0', `ActiveStatus` = '0' WHERE `username` = '$usernamez'");
        $KNCMS->msg_success("Xác thực tài khoản thành công", hUrl("Home"), 1000);
    }
    else {
        $KNCMS->msg_warning("Mã này không đúng", "", 1000);
    }
}