<body class="">
    <div class="wrapper">
        <div class="sidebar" data="blue">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="javascript:void(0)" class="simple-text logo-mini">
                        <?=$site['shortname']?>
                    </a>
                    <a href="javascript:void(0)" class="simple-text logo-normal">
                    <?=$site['name']?>
                    </a>
                </div>
                <ul class="nav">
                    <li class="active ">
                        <a href="./dashboard.html">
                            <i class="tim-icons icon-chart-pie-36"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="collapse" href="#KNCMSNav" role="button" aria-controls="KNCMSNav" aria-selected="true">
                            <i class="tim-icons icon-chart-pie-36"></i>
                            Vehicles
                        </a>
                        <div class="collapse" id="KNCMSNav">
                            <ul class="nav">
                                <li class=""><a href="#/auth/pricing"><span class="sidebar-mini-icon">P</span><span class="sidebar-normal">Pricing</span></a></li>
                                <li class=""><a href="#/rtl/rtl-support"><span class="sidebar-mini-icon">RS</span><span class="sidebar-normal">RTL Support</span></a></li>
                                <li class=""><a href="#/admin/timeline"><span class="sidebar-mini-icon">T</span><span class="sidebar-normal">Timeline</span></a></li>
                                <li class=""><a href="#/auth/login"><span class="sidebar-mini-icon">L</span><span class="sidebar-normal">Login</span></a></li>
                                <li class=""><a href="#/auth/register"><span class="sidebar-mini-icon">R</span><span class="sidebar-normal">Register</span></a></li>
                                <li class=""><a href="#/auth/lock-screen"><span class="sidebar-mini-icon">LS</span><span class="sidebar-normal">Lock Screen</span></a></li>
                                <li class=""><a href="#/admin/user-profile"><span class="sidebar-mini-icon">UP</span><span class="sidebar-normal">User Profile</span></a></li>
                            </ul>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle d-inline">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="javascript:void(0)">Trang chủ</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="search-bar input-group">
                                <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                                    <span class="d-lg-none d-md-block">Search</span>
                                </button>
                            </li>
                            <?php if (!isLogin()) { ?>
                                <li class="dropdown nav-item">
                                    <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                        <div class="notification d-none d-lg-block d-xl-block"></div>
                                        <i class="tim-icons icon-sound-wave"></i>
                                        <p class="d-lg-none">
                                            Notifications
                                        </p>
                                    </a>
                                    <!-- Lich Su (Limit 10) -->
                                    <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                                        <li class="nav-link"><a href="#" class="nav-item dropdown-item">Bạn chưa đăng nhập vào hệ thống</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown nav-item">
                                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                        <div class="photo">
                                            <img src="<?= hUrl('lib/avatars/299.png') ?>" alt="Profile Photo">
                                        </div>
                                        <b class="caret d-none d-lg-block d-xl-block"></b>
                                    </a>
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li class="nav-link"><a href="<?= hUrl('DangNhap') ?>" class="nav-item dropdown-item">Đăng nhập</a></li>
                                        <li class="dropdown-divider"></li>
                                        <li class="nav-link"><a href="<?= hUrl('DangKy') ?>" class="nav-item dropdown-item">Đăng ký</a></li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="dropdown nav-item">
                                    <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                        <div class="notification d-none d-lg-block d-xl-block"></div>
                                        <i class="tim-icons icon-sound-wave"></i>
                                        <p class="d-lg-none">
                                            Notifications
                                        </p>
                                    </a>
                                    <!-- Lich Su (Limit 10) -->
                                    <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                                        <?php
                                        $uid = $UserInfo['id'];
                                        foreach ($KNCMS->get_list("SELECT * FROM `kncms_logs` WHERE `UID` = '$uid' LIMIT 10") as $logs) { ?>
                                            <li class="nav-link"><a href="#" class="nav-item dropdown-item"><?= $logs['Log'] ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li class="dropdown nav-item">
                                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                        <div class="photo">
                                            <img src="<?= getUserAvt($UserInfo['Username']) ?>" alt="Profile Photo">
                                        </div>
                                        <b class="caret d-none d-lg-block d-xl-block"></b>
                                    </a>
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li class="nav-link"><a href="<?= hUrl('AccountDetail/' . $UserInfo['Username']) ?>" class="nav-item dropdown-item">Trang cá nhân</a></li>
                                        <li class="dropdown-divider"></li>
                                        <li class="nav-link"><a href="<?= hUrl('DangXuat') ?>" class="nav-item dropdown-item">Đăng Xuất</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <li class="separator d-lg-none"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Navbar -->
            <div class="content">
                <div class="row">