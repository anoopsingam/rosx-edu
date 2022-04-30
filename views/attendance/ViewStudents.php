<?php
require_once './views/header.php';
$app->setTitle("Add Attendance ".date("d-m-Y"));
if (empty($_POST['class'])) {
    js::alert("Please fill all the fields");
    js::redirect('/Attendance/Add');
} else {
    // setTitle('Add Attendance  ' . $_POST['class'] . ' ' . $_POST['academic_year']);
    $conn = $db->conn;
    $class = $_POST['class'];
    $academic_year = $_POST['academic_year'];
    $sql = "SELECT * FROM student_enrollment WHERE present_class='$class' AND status='APPROVED'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $count = "SELECT COUNT(studentid) as count FROM student_enrollment WHERE present_class='$class' AND status='APPROVED'";
        $ask = mysqli_query($conn, $count);
        $r = mysqli_fetch_array($ask);
?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Mark Attendance of Class <?= $class?> - <?= $_POST['att_date']; ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="/Attendance/View/Confirm" method="post">
                                <?= set_csrf() ?>
                               
                                    <table id="example" class="table table-striped table-bordered table-responsive-lg table-sm" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sl.No</th>
                                                <th>Student Name</th>
                                                <th>Reg No</th>
                                                <th>Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($info = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td>
                                                        <input type="text" class="form-control" readonly name="name[]" value="<?php echo $info['student_name']; ?>" title="<?php echo $info['father_number'] ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" readonly name="reg_no[]" value="<?php echo $info['studentid']; ?>">
                                                    </td>
                                                    <input type="text" hidden name="mobile_no[]" value="<?php echo $info['father_number']; ?>">
                                                    <td>
                                                        <select required name="attend[]" class="form-control" id="">
                                                            <option value="PRESENT" selected>PRESENT</option>
                                                            <option value="ABSENT">ABSENT</option>
                                                        </select>
                                                    </td>
                                                    <input type="text" name="date[]" hidden value="<?php echo $_POST['att_date']; ?>">
                                                <input type="text" name="loginid[]" hidden value="<?php echo $user['username']; ?>">
                                                <input type="text" name="class[]" hidden value="<?php echo $info['present_class'] ?>">
                                                <input type="text" name="section[]" hidden value="<?php echo $info['present_section'] ?>">
                                                <input type="text" name="ay[]" hidden value="<?php echo $_POST['academic_year'] ?>">
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                    <center>
                                        <input type="hidden" name="trf_ss" value="<?php echo  $_SESSION['attendance_validation'] = uniqid(); ?>">
                                        <input type="hidden" name="month" value="<?php echo date('M'); ?>">
                                        <strong>Total Strength <?php echo "$class  "; ?>:</strong>
                                        <input type="text" name="numbers" readonly class="form-control" style="width: min-content;" value="<?php echo $r['count']; ?>">
                                        <br>
                                        <button type="submit" class="btn btn-info" name="submit">submit</button>
                                    </center>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
        js::alert("No Students found");
        js::redirect('/Attendance/Add');
    }
    ?>
<?php
} 
    require_once './views/footer.php';
?>