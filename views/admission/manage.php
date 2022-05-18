<?php
require_once './views/header.php';
$app->setTitle('Manage Admission Data');
?>
<div class="card m-2">
    <div class="card-header">
        <span class="btn btn-primary btn-lg">Admission Approval</span>
    </div>
    <div class="card-body">

    <div class="card">
        <form action="" method="post" class="text-center">
            <div class="row m-4">
                <div class="col-sm">
                    <label for="">From Date : </label>
                    <input type="date" name="from_date" class="form-control" >
                </div>
                <div class="col-sm">
                    <label for="">To Date : </label>
                    <input type="date" name="to_date" class="form-control" >
                </div>
                <div class="col-sm">
                    <label for="">Class : </label>
                    <?= func::classlist('class_name'); ?>
                </div>
                <div class="col-sm">
                    <label for="">Status : </label>
                            <select name="status" class="form-control m-1" id="">
                                <option value="">Select Status</option>
                                <option value="WAITING">WAITING</option>
                                <option value="APPROVED">APPROVED</option>
                                <option value="REJECTED">REJECTED</option>
                                <option value="TC ISSUED">TC_ISSUED</option>
                                <option value="ALUMNI">ALUMNI</option>
                            </select>
                </div>
                <div class="col-sm">
                    <label for="">Academic Year : </label>
                    <?= func::academicYear('academic_year'); ?>
                </div>
                <div class="col-sm">
                    <label for="">User : </label>
                    <?= func::adminList('user_id'); ?>
                </div>
            </div>
            <button class="btn btn-danger" name="filter_result">Find</button>
        </form>
    </div>


    <?php

        if (isset($_POST['filter_result'])) {
            $sql = "SELECT * FROM `student_enrollment` WHERE 1";

            if (!empty($_POST['from_date'])) {
                $sql .= " AND `enroll_time`>='".$_POST['from_date']." 00:00:00'";
            }
            if (!empty($_POST['to_date'])) {
                $sql .= " AND `enroll_time`<='".$_POST['to_date']." 23:59:59'";
            }
            if (!empty($_POST['class_name'])) {
                $sql .= " AND `present_class`='".$_POST['class_name']."'";
            }
            if (!empty($_POST['academic_year'])) {
                $sql .= " AND `academic_year`='".$_POST['academic_year']."'";
            }
              if (!empty($_POST['status'])) {
                $sql .= " AND `status`='".$_POST['status']."'";
            }
            if (!empty($_POST['user_id'])) {
                $sql .= " AND `login_id`='".$_POST['user_id']."'";
            }
             $sql .= " ORDER BY student_name ASC";
        } else {
            $sql = 'SELECT * FROM `student_enrollment`';
        }
        $result = mysqli_query($db->conn, $sql);
    ?>


        <?= includes::Datatables('  Admission Data ', '0,1,2,3,4,5,6,7,8,9,10,11,12', 'landscape'); ?>
    <div style="overflow:scroll;">
                <table id="example" class="display" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>Application No.</th>
                    <th>Enrollment ID</th>
                    <th>Admission No</th>
                    <th>Student Id</th>
                    <th>Student Name</th>
                    <th>D.O.B</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Father Mobile No</th>
                    <th>SATS NO</th>
                    <th>Class - Section</th>
                    <th>Academic Year</th> 
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
            <?php
            while ($data = $result->fetch_object()) {
                echo'<tr>';
                echo'<td>'.$data->app_no.'</td>';
                echo'<td>'.$data->enrollment_no.'</td>';
                 echo'<td>'.$data->admission_no.'</td>';
                echo'<td>'.$data->studentid.'</td>';
                echo'<td>'.$data->student_name.'</td>';
                echo'<td>'.$data->dob.'</td>';
                echo'<td>'.$data->father_name.'</td>';
                echo'<td>'.$data->mother_name.'</td>';
                echo'<td>'.$data->father_number.'</td>';
                echo'<td>'.$data->sts_no.'</td>';
                echo'<td>'.$data->present_class.' - '.$data->present_section.'</td>';
                echo'<td>'.$data->academic_year.'</td>';
                echo'<td>'.$data->status.'</td>';
                echo '<td>'; ?>
          <a onclick="window.open('<?= func::href('/Admission/View/'.encrypt($data->enrollment_no)); ?>','popup','width=1000,height=1000');" class="badge bg-success badge-pill"><i class="fa fa-eye" aria-hidden="true"></i></a>
          <a onclick="window.open('<?= func::href('/Admission/Edit/'.encrypt($data->enrollment_no)); ?>','popup','width=1000,height=1000');" class="badge bg-warning badge-pill"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
          <a onclick="window.open('<?= func::href('/FullAdmissionController/delete/'.encrypt($data->enrollment_no)); ?>','popup','width=1000,height=1000');" class="badge bg-danger badge-pill"><i class="fa fa-trash" aria-hidden="true"></i></a>
            <?php
            echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
<?php
    require_once './views/footer.php';
?>