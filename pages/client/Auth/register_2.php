<?php require_once('../../server/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng ký | <?= $knsite['Title'] ?></title>
    <link href="<?= $base_url ?>lib/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= $base_url ?>lib/assets/css/KhNguyen.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/54b11bb8ef.js" crossorigin="anonymous"></script>
</head>
<?php if (isset($_GET['Name'])) {
    $Name = $KNCMS->anti_text($_GET['Name']);
}
?>
<body class="bg-main-kncms-controller" style="background: url('<?= $base_url ?>/lib/bg-login.jpg') no-repeat !important;">
    <div class="container">
        <div class="row justify-content-center">
            <?php
            if (check_rows($Name, "accounts", "Username")) {
                $user_check = $KNCMS->getUser($Name);
                if ($user_check['ActiveCode'] != '0' && $user_check['ActiveStatus'] == 1) { ?>

                    <div class="col-xl-10 col-lg-12 col-md-9">
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Đăng ký (Bước 2)!</h1>
                                            </div>
                                            <form method="POST" action="">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user" name="ActiveCode" placeholder="Mã code xác thực tài khoản">
                                                </div>
                                                <button class="btn btn-primary btn-user btn-block" type="submit" name="BtnRegister2">
                                                    Đăng ký
                                                </button>
                                                <?php
                                                require('../../server/controller/auth.php') ?>
                                            </form>
                                            <hr>
                                            <div class="text-center">
                                                <a class="small" href="<?= hUrl('Auth/ForgotPassword') ?>">Quên mật khẩu</a>
                                            </div>
                                            <div class="text-center">
                                                <a class="small" href="<?= hUrl('Auth/Register') ?>">Đăng ký</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php } else $KNCMS->msg_warning("Tài khoản đã được kích hoạt", hUrl('DangKy'), 0);
            } else $KNCMS->msg_warning("Tài khoản không tồn tại", hUrl('DangKy'), 0);
            ?>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>