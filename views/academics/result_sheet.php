<?php
require_once './views/header.php';
$app->setTitle("Result Sheet");
?>
<div class="card m-2">
    <div class="card-header">
        <span class="btn bg-gradient-info btn-lg">Result Sheet </span>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Select Test : </label>
                        <?= func::getTestList(); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Select Class : </label>
                        <?= func::classlist("class_list"); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Select Academic Year : </label>
                        <?= func::academicYear(); ?>
                    </div>
                </div>
            </div>
            <button name="fetch_data" type="submit" class="btn btn-primary">Fetch</button>
        </form>
    </div>
</div>
<?php
if (isset($_POST['fetch_data'])) {
    $test_name = $_POST['test_name'];
    $class_id = $_POST['class_list'];
    $academic_year = $_POST['ay'];
    $sql_fetch = mysqli_query($db->conn, "SELECT * FROM `academics_marks` WHERE res_class='$class_id' AND res_test='$test_name' AND res_ay='$academic_year'");
    if (mysqli_num_rows($sql_fetch) > 0) {
        $sub = func::getSubjects($class_id);
        includes::Datatables("Result Sheet $test_name Class-$class_id $academic_year",'0,1,2,3,4,5,6,7,8,9,10,11,12,13','landscape');
?>
        <div class="card m-2">
            <div class="card-header">
                <span class="btn bg-gradient-info btn-lg">Result Sheet </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-bordered  text-center " id="example">
                        <thead class="bg-danger text-light">
                            <th>S.No</th>
                            <th>Student Name</th>
                            <th>Student Id</th>
                            <th>Test</th>
                            <th><?= $sub['acd_sub1']; ?></th>
                            <th><?= $sub['acd_sub2']; ?></th>
                            <th><?= $sub['acd_sub3']; ?></th>
                            <th><?= $sub['acd_sub4']; ?></th>
                            <th><?= $sub['acd_sub5']; ?></th>
                            <th><?= $sub['acd_sub6']; ?></th>
                            <th><?= $sub['acd_sub7']; ?></th>
                            <th>Total</th>
                            <th>Grade</th>
                            <th>Percetage</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($sql_fetch)) {
                                ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= func::getStudentDetails($row['res_student_id'])->student_name; ?></td>
                                    <td><?= $row['res_student_id']; ?></td>
                                    <td><?= $row['res_test']; ?></td>
                                    <td><?= $row['res_sub_1_marks']; ?></td>
                                    <td><?= $row['res_sub_2_marks']; ?></td>
                                    <td><?= $row['res_sub_3_marks']; ?></td>
                                    <td><?= $row['res_sub_4_marks']; ?></td>
                                    <td><?= $row['res_sub_5_marks']; ?></td>
                                    <td><?= $row['res_sub_6_marks']; ?></td>
                                    <td><?= $row['res_sub_7_marks']; ?></td>
                                    <td><?= $row['res_obtained']; ?></td>
                                    <td><?= $row['res_grade']; ?></td>
                                    <td><?= $row['res_percentage']; ?></td>
                                    <td>
                                    <a onclick="window.open('/Academics/ViewResult/<?= encrypt($row['res_student_id']).'/'.$test_name.'/'.$academic_year;?>','popup','width=800,height=1000');"  class="btn btn-primary btn-sm">View</a>
                                    </td>
                                </tr>
                                <?php   
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "<div class='alert alert-danger text-light font-weight-bolder text-center m-4 p-3'>No data found for $test_name in $class_id $academic_year</div>";
    }
} ?>








<?php
require_once './views/footer.php';
?>