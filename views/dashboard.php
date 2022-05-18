<?php
require_once 'header.php';
$app->setTitle("Home");
$app->setTitle("Dashboard");
?>
<div class="row">
  <div class="col-12">
    <div id="globe" class="position-absolute end-0 top-10 mt-sm-3 mt-7 me-lg-7">
      <canvas width="700" height="600" class="w-lg-100 h-lg-100 w-75 h-75 me-lg-0 me-n10 mt-lg-5"></canvas>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-7 position-relative z-index-2">
    <div class="card card-plain mb-4">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-lg-6">
            <div class="d-flex flex-column h-100">
                <?= $app->SetLogo('180','180')?>
              <h4 class="font-weight-bolder text-gradient text-dark mb-0"><?= $app->name(); ?></h4>
              <small class="text-muted"><?= $app->address(); ?></small>
                <small class="text-muted"><?= $app->phone(); ?>  <?= $app->email(); ?></small>
                
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-5 col-sm-6">
        <div class="card  mb-4">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <h5 class=" mb-0 text-capitalize font-weight-bolder text-gradient text-warning">Total Students</h5>
                  <h3 class="font-weight-bolder mb-0 text-gradient text-info">
                    <!-- <span class="text-success text-sm font-weight-bolder">+55%</span> -->
                    <?= func::getTotalStudents(); ?>
                  </h3>
                </div>
              </div>
              <!-- <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-single-2 text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div> -->
            </div>
          </div>
        </div>
        <div class="card ">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <h5 class=" mb-0 text-capitalize font-weight-bolder text-gradient text-primary"> Total Boys  </h5>
                  <h3 class="font-weight-bolder mb-0 text-gradient text-info">
                  <?= func::getStudentCountGender('BOY'); ?>
                    <!-- <span class="text-success text-sm font-weight-bolder">+55%</span> -->
                  </h3>
                </div>
              </div>
              <!-- <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5 col-sm-6 mt-sm-0 mt-4">
        <div class="card  mb-4">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <h5 class=" mb-0 text-capitalize font-weight-bolder text-gradient text-danger">Total Girls</h5>
                  <h3 class="font-weight-bolder mb-0 text-gradient text-info">
                  <?= func::getStudentCountGender('GIRL'); ?>

                    <!-- <span class="text-success text-sm font-weight-bolder">+55%</span> -->
                  </h3>
                </div>
              </div>
              <!--<div class="col-4 text-end">-->
              <!--  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">-->
              <!--    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>-->
              <!--  </div>-->
              <!--</div>-->
            </div>
          </div>
        </div>
        <div class="card ">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class=" text-sm mb-0 text-capitalize font-weight-bolder text-gradient text-primary">Total Absent [<?= date('d-m-Y') ?>]</p>
                  <h3 class="font-weight-bolder mb-0 text-gradient text-info">
                  <?= func::getTotalAbsentToday(); ?>
                    <!-- <span class="text-success text-sm font-weight-bolder">+55%</span> -->
                  </h3>
                </div>
              </div>
              <!--<div class="col-4 text-end">-->
              <!--  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">-->
              <!--    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>-->
              <!--  </div>-->
              <!--</div>-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12 col-lg-10">
        <div class="card ">
          <div class="card-header pb-0 p-3 bg-gradient-dark text-light">
            <div class="d-flex justify-content-between ">
              <h4 class="mb-2 text-gradient text-info text-center h3">Fee Structure</h4>
            </div>
          </div>
          <div class="table-responsive " style="height:200px;overflow: scroll;">
            <table class="table  align-items-center p">
              <thead>
                <tr class="bg-gradient-dark text-light font-weight-bolder">
                  <td>Sl No.</td>
                  <td>Class</td>
                  <td>Fee ₹</td>
                  <td>Academic Year</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $db = new database();
                $conn = $db->conn;
                $sql = "SELECT * FROM fee_structure order by class asc";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr>
                    <td class="font-weight-bolder"><?php echo $i++; ?></td>
                    <td class="font-weight-bolder"><?php echo $row['class']; ?></td>
                    <td class="font-weight-bolder"><?php echo $row['tution_fee']; ?></td>
                    <td class="font-weight-bolder"><?php echo $row['academic_year']; ?></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- <div class="row">
  <div class="col-12">
    <div class="card m-2 p-3">
      <div class="card-header text-left">
        <h4 class="card-title">Notice : </h4>
      </div>
      <div class="card-body text-danger ">
        <ul>
          <li>Phase-2 ERP has been Updated Phase 3 will be updated by 25/02/2022</li>
        </ul>
      </div>
    </div>
  </div>
</div> -->
  
            <?php 
require_once 'footer.php';
?>
<script src="<?=url::myurl()?>/assets/js/index.js"></script>