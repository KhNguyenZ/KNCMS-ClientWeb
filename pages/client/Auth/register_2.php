<?php require_once('../../../server/config.php');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= $base_url ?>/lib/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= $base_url ?>/lib/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= $base_url ?>/lib/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="<?= $base_url ?>/lib/css/style.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login #7</title>
</head>
<?php
if (isset($_GET['Name']))
    $name = $KNCMS->anti_text($_GET['Name']);
?>

<body>
    <?php if (isLogin()) $KNCMS->msg_warning("Bạn đang đăng nhập , không thể thực hiện thao tác này", hUrl('Home'), 1000); ?>
    <?php
    if (check_rows($name, "users", "Username")) {
        $user_check = $KNCMS->getUser($name);
        if ($user_check['ActiveCode'] == '0' && $user_check['ActiveStatus'] != 1) $KNCMS->msg_warning("Tài khoản đã được kích hoạt", hUrl('DangKy'), 0);
    } else $KNCMS->msg_warning("Tài khoản không tồn tại", hUrl('DangKy'), 0); ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= $base_url ?>lib/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign In</h3>
                                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
                            </div>
                            <form action="#" method="post">
                                <div class="form-group last mb-4">
                                    <input type="text" class="form-control" name="ActiveCode" placeholder="Tên đăng nhập" require>
                                </div>
                                <button type="submit" name="BtnRegister2" class="btn btn-block btn-primary">Đăng nhập</button>
                                <?php require('../../../server/controller/auth.php'); ?>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</body>

</html>