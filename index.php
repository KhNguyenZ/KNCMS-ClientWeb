<?php
  require_once('server/config.php');
  require_once('pages/head.php');
  require_once('pages/nav.php');
?>
<div class="col-md-12">
  <div class="card ">
    <div class="card-header">
      <h4 class="card-title">Thành viên dang <b style="color:green;">Online</b></h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table tablesorter " id="">
          <thead class=" text-primary">
            <tr>
              <th class="text-center">
                ID
              </th>
              <th class="text-center">
                Tên
              </th>
              <th class="text-center">
                Thời gian Online
              </th>
              <th class="text-center">
                Level
              </th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
  require_once('pages/foot.php');
?>