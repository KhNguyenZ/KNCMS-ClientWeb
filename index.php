<?php
require_once('server/config.php');
require_once('pages/head.php');
require_once('pages/nav.php');
?>
<div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Tổng thành viên</div>
            <div class="h5 mb-0 font-weight-bold" style="color:blanchedalmond;">3.130</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-success" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Tổng thành viên vi phạm</div>
            <div class="h5 mb-0 font-weight-bold " style="color:blanchedalmond;">692</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-lock fa-2x text-danger" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
              Thành viên online</div>
            <div class="h5 mb-0 font-weight-bold " style="color:blanchedalmond;">Updating...</div>

          </div>
          <div class="col-auto">
            <i class="fas fa-user-check fa-2x text-info" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Tổng house</div>
            <div class="h5 mb-0 font-weight-bold " style="color:blanchedalmond;">5.000</div>

          </div>
          <div class="col-auto">
            <i class="fas fa-home fa-2x text-green-300" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<div class="row" bis_skin_checked="1">
  <div class="col-xl-6 col-md-5" bis_skin_checked="1">
    <div class="card shadow mb-4" bis_skin_checked="1">
      <div class="card-header py-3" bis_skin_checked="1">
        <h6 class="m-0 font-weight-bold text-primary">Fanpage</h6>
      </div>
      <div class="card-body" bis_skin_checked="1">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fgtaroleplayvn&amp;tabs=timeline&amp;width=340&amp;height=500&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-5" bis_skin_checked="1">
    <div class="card shadow mb-4" bis_skin_checked="1">
      <div class="card-header py-3" bis_skin_checked="1">
        <h6 class="m-0 font-weight-bold text-primary">Discord</h6>
      </div>
      <div class="card-body" bis_skin_checked="1">
        <iframe src="https://discordapp.com/widget?id=1064197348948987954&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
      </div>
    </div>
  </div>
</div>

<?php
require_once('pages/foot.php');
?>