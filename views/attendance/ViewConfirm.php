<?php
require_once './views/header.php';
?>
<center>

<?php

if (isset($_SESSION['attendance_validation']) == isset($_POST['trf_ss'])) {
    $db = new database();
    $conn = $db->conn;
    $date = $_POST['date'][0];
    $class = $_POST['class'][0];
$app->setTitle("Attendance Confirmation  ".$class);
    $sql = mysqli_query($conn, "SELECT * FROM student_attendance where attendance_date='$date'and student_class='$class'");
    if (mysqli_num_rows($sql) > 0) {
    js::alert("Attendance Already Marked for this class");
    js::redirect('/Attendance/Add');
    unset($_SESSION['attendance_validation']);
    } else {
        $_SESSION['confirmation']="YES"
    ?>
     <h2><?php echo "Attendance Confirmation  ".$class?> </h2>
    <form action="/Attendance/View/Confirm/Submit" method="post">
        <center>
            <h3>ABSENT STUDENTS ON <STRONG><?php echo $_POST['date'][0]; ?></STRONG> </h3>
            <table id="example" class="table table-striped table-bordered table-responsive-lg" style="width:100%">
                <thead class="bg-dark text-light">
                    <th>Sl No</th>
                    <th>Student Name</th>
                    <th>Attendance</th>
                    <th>Reg No</th>
                    
                </thead>
                <tbody><?php
                        $z = 1;
                        for ($i = 0; $i < $_POST['numbers']; $i++) {
                            if ($_POST['attend'][$i] == "ABSENT") {
                        ?>
                            <tr class="alert-danger">
                                <td><?php echo $z++; ?></td>
                                <td><input type="text" class="form-control" style="width: fit-content;" readonly name="name[]" value="<?php echo $_POST['name'][$i]; ?>" title="<?php echo $_POST['mobile_no'][$i]; ?>"></td>
                                <td><input type="text" class="form-control" style="width: fit-content;" readonly name="attend[]" value="<?php echo $_POST['attend'][$i]; ?>"></td>
                                <td><input type="text" class="form-control" style="width: fit-content;" readonly name="reg_no[]" value="<?php echo $_POST['reg_no'][$i]; ?>">
                                    <input hidden type="text" class="form-control" readonly name="mobile_no[]" value="<?php echo $_POST['mobile_no'][$i]; ?>">
                                    <input hidden type="text" class="form-control" readonly name="date[]" value="<?php echo $_POST['date'][$i]; ?>">
                                    <input hidden type="text" class="form-control" readonly name="loginid[]" value="<?php echo $_POST['loginid'][$i]; ?>">
                                    <input type="text" name="class[]" hidden value="<?php echo $_POST['class'][$i]; ?>">
                                    <input type="text" name="ay[]" hidden value="<?php echo $_POST['ay'][$i]; ?>">
                                </td>
                            </tr>
                        <?php
                            } else {
                        ?>
                            <tr class="alert-success">
                                <td><?php echo $z++; ?></td>
                                <td><input type="text" class="form-control" style="width: fit-content;" readonly name="name[]" value="<?php echo $_POST['name'][$i]; ?>" title="<?php echo $_POST['mobile_no'][$i]; ?>"></td>
                                <td><input type="text" class="form-control" style="width: fit-content;" readonly name="attend[]" value="<?php echo $_POST['attend'][$i]; ?>"></td>
                                <td><input type="text" class="form-control" style="width: fit-content;" readonly name="reg_no[]" value="<?php echo $_POST['reg_no'][$i]; ?>">
                                    <input hidden type="text" class="form-control" readonly name="mobile_no[]" value="<?php echo $_POST['mobile_no'][$i]; ?>">
                                    <input hidden type="text" class="form-control" readonly name="date[]" value="<?php echo $_POST['date'][$i]; ?>">
                                    <input hidden type="text" class="form-control" readonly name="loginid[]" value="<?php echo $_POST['loginid'][$i]; ?>">
                                    <input type="text" name="class[]" hidden value="<?php echo $_POST['class'][$i]; ?>">
                                    <input type="text" name="ay[]" hidden value="<?php echo $_POST['ay'][$i]; ?>">
                                </td>
                            </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
            <input type="text" hidden class="form-control" readonly name="number" value="<?php echo $_POST['numbers']; ?>">
            <button type="submit" class="btn btn-primary m-3" onclick="return confirm('Are you sure to Acknowledge Todays Attendance ?')">Verified</button>
    </form>
<?php
}

?>

</center>
<?php
} else {
    $app->setTitle("Invalid Access");
    ?>
    <div class="alert alert-danger text-light">
        <h4><strong>Error!</strong></h4> 
        <h3>Invalid CSRF Token ....</h3>
    </div>
    <?php
}
?>
<?php   
    require_once './views/footer.php';
?>