<?php
require_once 'header.php';
$app->setTitle("Home");
$app->setTitle("Dashboard");
includes::insertJS('plugins/chartjs.min.js');
?>
<div class="row mt-4">
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-danger shadow-dark text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">man_3</i>
        </div>
        <div class="text-center pt-1">
          <h5 class="text-sm mb-0 text-capitalize">Total Boys</h5>
          <h3 class="mb-0 text-gradient text-dark"><?= func::getStudentCountGender('BOY'); ?></h3>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <!-- <p class="mb-0"><span class="text-primary text-sm font-weight-bolder">Restaurant</span></p> -->
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">woman</i>
        </div>
        <div class="text-center pt-1">
          <h5 class="text-sm mb-0 text-capitalize">Total Girls</h5>
          <h3 class="mb-0 text-gradient text-dark"><?= func::getStudentCountGender('GIRL'); ?></h3>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <!-- <p class="mb-0"><span class="text-primary text-sm font-weight-bolder">Restaurant</span></p> -->
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">person</i>
        </div>
        <div class="text-center pt-1">
          <h5 class="text-sm mb-0 text-capitalize">Total Students</h5>
          <h3 class="mb-0 text-gradient text-dark"><?= func::getTotalStudents(); ?></h3>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <!-- <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">Restaurant</span></p> -->
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">edit_note</i>
        </div>
        <div class="text-center pt-1">
          <h5 class="text-sm mb-0 text-capitalize">Total Absent</h5>
          <h3 class="mb-0 text-gradient text-dark"><?= func::getTotalAbsentToday(); ?></h3>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder"> </span></p> -->
      </div>
    </div>
  </div>
</div>
<div class="row mt-5">
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-danger shadow-dark text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">currency_rupee</i>
        </div>
        <div class="text-end pt-1">
          <h5 class="text-sm mb-0 text-capitalize">Fee Collected Today</h5>
          <h3 class="mb-0 text-center text-gradient text-dark">₹<?= (empty(func::getTodaysFeeCollection('tuition'))) ? '0' : func::getTodaysFeeCollection('tuition'); ?></h3>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-primary text-sm font-weight-bolder">Tuition</span></p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">directions_bus</i>
        </div>
        <div class="text-end pt-1">
          <h5 class="text-sm mb-0 text-capitalize">Fee Collected Today</h5>
          <h3 class="mb-0 text-center text-gradient text-dark">₹<?= (empty(func::getTodaysFeeCollection('transport'))) ? '0' : func::getTodaysFeeCollection('transport'); ?></h3>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">Transport</span></p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">library_books</i>
        </div>
        <div class="text-end pt-1">
          <h5 class="text-sm mb-0 text-capitalize">Fee Collected Today</h5>
          <h3 class="mb-0 text-center text-gradient text-dark">₹<?= (empty(func::getTodaysFeeCollection('ubs'))) ? '0' : func::getTodaysFeeCollection('ubs'); ?></h3>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">UBS</span></p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">summarize</i>
        </div>
        <div class="text-end pt-1">
          <h5 class="text-sm mb-0 text-capitalize">Total Fee Collected </h5>
          <h3 class="mb-0 text-gradient text-center text-dark">₹<?= func::getTodaysFeeCollection('tuition') + func::getTodaysFeeCollection('ubs') + func::getTodaysFeeCollection('transport'); ?></h3>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"> Total </span></p>
      </div>
    </div>
  </div>
</div>
<div class="row mt-5">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h3 class="h5 text-gradient text-primary mb-0">Search Student</h3>
        <h6>(Student Id/Name/ Father/Mother Mobile No) </h6>
      </div>
      <div class="card-body">
        <form action="" method="post">
          <div class="row">
            <div class="col-sm">
              <input type="text" name="string" class="form-control" placeholder="Enter Details..." id="">
            </div>
            <div class="col-sm">
              <button type="submit" name="fetch_data" class="btn btn-primary">Search</button>
            </div>
          </div>
        </form>
        <div style="overflow:scroll;height: 500px;">
          <?php
          if (isset($_POST['fetch_data'])) {
            func::searchStudent($_POST['string']);
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h3 class="h5 text-gradient text-danger mb-0">Students Data</h3>
        <h6>(Class Wise) </h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-responsive text-center">
            <thead class="bg-gradient-dark text-info">
              <th>Class </th>
              <th>Boys</th>
              <th>Girls</th>
              <th>Total</th>
              <th>Present</th>
              <th>Absent</th>
            </thead>
            <tbody>
              <?php
              $arraClass = ['LKG', 'UKG', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];
              foreach ($arraClass as $classes) {
                echo '<tr>';
                echo '<td><h5>' . $classes . '</h5></td>';
                echo '<td>' . func::getTotalStudentsByGenderClass($classes, 'BOY') . '</td>';
                echo '<td>' . func::getTotalStudentsByGenderClass($classes, 'GIRL') . '</td>';
                echo '<td>' . func::getStudentCount($classes, '2023') . '</td>'; ?>
                <td><?= (!empty(func::TodaysAttendance($classes, "PRESENT"))) ? func::TodaysAttendance($classes, "PRESENT") : "0"; ?></td>
                <td><?= (!empty(func::TodaysAttendance($classes, "ABSENT"))) ? func::TodaysAttendance($classes, "ABSENT") : "0"; ?></td>
              <?= '</tr>';
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once 'footer.php';
?>
<script src="<?= url::myurl() ?>/assets/js/index.js"></script>