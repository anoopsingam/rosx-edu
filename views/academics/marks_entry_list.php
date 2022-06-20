<?php
require_once './views/header.php';
$app->setTitle("Student List - Marks Entry");
// print_r($_POST);
$test = $_POST['test_name'];
$class_list = $_POST['class_list'];
$ay = $_POST['ay'];



$students_list = mysqli_query($db->conn, "SELECT * FROM `student_enrollment` WHERE `present_class`='$class_list' AND `status`='APPROVED' ORDER BY student_name ASC ");
if (mysqli_num_rows($students_list) > 0) {
// echo $db->conn->error;
?>
<script>
//refersh the page every 10 seconds without clearing post data
setInterval(function() {
    window.location.reload();
}, 30000);

</script>
      <div class="card">
            <div class="card-header">
                  <h4 class="card-title"><?= $test.' | '.$class_list.' | '.$ay; ?>| Student List</h4>
            </div>
            <div class="card-body">
                  <?= includes::Datatables('Student List ', '0,1,2,3', 'landscape'); ?>
                  <table id="example" class="display">
                        <thead>
                              <th>Sl No.</th>
                              <th>Student Name</th>
                              <th>Student Id</th>
                              <th>Class & section</th>
                              <th>Action</th>
                        </thead>
                        <tbody>
                        <?php
                  while ($fetch = mysqli_fetch_assoc($students_list)) {
                        ?>
                              <tr>
                                    <td><?= $fetch['id']; ?></td>
                                    <td><?= $fetch['student_name']; ?></td>
                                    <td><?= $fetch['studentid']; ?></td>
                                    <td><?= $fetch['present_class'] . ' ' . $fetch['present_section']; ?></td>
                                    <td>
                                          <?php
                                          if(empty(func::getMarksEntryDetails($fetch['studentid'], $test, $ay)['res_student_id'])){ ?>
                                                <a onclick="window.open('/Academics/MarksEntry/<?= encrypt($fetch['studentid']).'/'.$test.'/'.$ay;?>','popup','width=800,height=1000');"  class="btn btn-primary btn-sm"> Enter Marks</a>
                                          <?php }else{
                                                echo '<span class="text-danger">Entry Done </span>';
                                          } ?>
                                    </td>
                        <?php
                        }
                        ?>
                        </tbody>
                  </table>


                 
            <?php } else {
            echo "<div class='alert alert-danger'>No students found in this class $class_list</div>"; } ?>
            </div>
      </div>
      <?php
      require_once './views/footer.php';
      ?>