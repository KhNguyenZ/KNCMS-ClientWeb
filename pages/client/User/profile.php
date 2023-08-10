<?php
require_once('../../../server/config.php');
require_once('../../head.php');
require_once('../../nav.php');

if (isset($_GET['Name'])) {
    $name = $KNCMS->anti_text($_GET['Name']);
    if (!check_rows($name, "accounts", "Username")) $KNCMS->msg_warning("Người chơi không tồn tại", hUrl("Home"), 1000);
    else $userdetail = $KNCMS->getUser($name);
}

?>
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <h4 class="card-title">Thông tin thành viên <b style="color:green;">Online</b></h4>
            <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#Profile" role="tab" aria-controls="Profile" aria-selected="true">Thông tin cá nhân</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-home-tab-nobd" data-toggle="pill" href="#Toys" role="tab" aria-controls="Toys" aria-selected="true">Toys</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-home-tab-nobd" data-toggle="pill" href="#Vehs" role="tab" aria-controls="Vehs" aria-selected="true">Vehicles</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                <div class="tab-pane fade show active" id="Profile" role="tabpanel" aria-labelledby="Profile">
                    <div class="row">
                        <div class="col-md-4">
                            <center>
                                <img src="<?= getUserModel($userdetail['Username']) ?>" style="height:300px" />
                            </center>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group row card-title">
                                <div class="col-md-4">
                                    <span>Tên đăng nhập:</span>
                                </div>
                                <div class="col-md-8">
                                    <b><?= $userdetail['Username'] ?></b>
                                </div>
                            </div>
                            <div class="form-group row card-title">
                                <div class="col-md-4">
                                    <span>Cấp độ:</span>
                                </div>
                                <div class="col-md-8">
                                    <b><?= $userdetail['Level'] ?></b>
                                </div>
                            </div>
                            <div class="form-group row card-title">
                                <div class="col-md-4">
                                    <span>VIP:</span>
                                </div>
                                <div class="col-md-8">
                                    <b><?= GetVip($userdetail['DonateRank']) ?></b>
                                </div>
                            </div>
                            <div class="form-group row card-title">
                                <div class="col-md-4">
                                    <span>Ngày sinh:</span>
                                </div>
                                <div class="col-md-8">
                                    <b><?= $userdetail['BirthDate'] ?></b>
                                </div>
                            </div>
                            <div class="form-group row card-title">
                                <div class="col-md-4">
                                    <span>Ngày sinh:</span>
                                </div>
                                <div class="col-md-8">
                                    <b><?= GetGender($userdetail['Sex']) ?></b>
                                </div>
                            </div>
                            <div class="form-group row card-title">
                                <div class="col-md-4">
                                    <span>Mail:</span>
                                </div>
                                <?php if ($userdetail['ActiveCode'] == 0) { ?>
                                    <div class="col-md-8">
                                        <div class="badge badge-success">Đã Xác Minh GMAIL</div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-8">
                                        <div class="badge badge-danger">Chưa Xác Minh GMAIL</div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="Toys" role="tabpanel" aria-labelledby="Toys">
                    <div class="row">
                        <?php
                        $uid = $userdetail['id'];
                        foreach ($KNCMS->get_list("SELECT * FROM `toys` WHERE `player` = '$uid' ORDER BY id desc") as $row) { ?>
                            <div class="col-md-4">
                                <center>
                                    <img src="https://files.prineside.com/gtasa_samp_model_id/white/<?= $row['modelid'] ?>_w.jpg" style="border-radius: 10px;" width="100px" height="100px">
                                    <hr>
                                    <h5 class="text-center">
                                        <div class="badge badge-warning"><?= $row['modelid'] ?></div>
                                    </h5>
                                    <hr>
                                </center>
                            </div>
                            <br></br>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade show" id="Vehs" role="tabpanel" aria-labelledby="Vehs">
                    <div class="row">
                        <?php
                        $uid = $userdetail['id'];
                        foreach ($KNCMS->get_list("SELECT * FROM `vehicles` WHERE `sqlID` = '$uid' ORDER BY id desc") as $row) { ?>
                            <div class="col-md-4 ">
                                <img src="<?= $base_url ?>/lib/vehicles/Vehicle_<?= $row['pvModelId'] ?>.jpg" style="border-radius: 10px;" width="100%">
                                <h5 class="text-center">
                                    <div class="badge badge-primary card-title"><?= getVehiclesName($row['pvModelId']) ?></div>
                                </h5>
                                <div class="progress mb-4 card-title" bis_skin_checked="1" style="height: 20px;">
                                    <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $row['pvFuel'] ?>%" aria-valuenow="<?= $row['pvFuel'] ?>" aria-valuemin="0" aria-valuemax="100" bis_skin_checked="1"><?= $row['pvFuel'] ?>%</div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('../../foot.php'); ?>