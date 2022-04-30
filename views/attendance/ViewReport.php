<?php
require_once './views/header.php';
$app->setTitle("Add Attendance ".date("d-m-Y"));
?>
<div class="card shadow-lg m-3 p-2">
    <div class="card-header card-title ">
        <h3 class="text-left text-gradient text-dark m-1 p-1">Attendance Report- <?= date('Y') ?></h3>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="row">
                <div class="col-lg-3">
                    <label>Date : </label>
                    <input type="date" name="att_date" class="form-control" value="<?php echo date("Y-m-d") ?>" required />
                </div>
                <div class="col-lg-3">
                    <label>Class : </label>
                    <?=func::classlist("class");?>
                </div>
                <div class="col-lg-3">
                <label for="">Academic Year : </label>
                    <?= func::academicYear("academic_year")?>
                </div>
                <div class="col-lg-3">
                    <label for="">User : </label>
                    <?= func::adminList("user");?>
                </div>
            </div>
            <center>
                <button type="submit" name="get_list" class="btn bg-gradient-primary btn-md rounded-2 m-4">Get Report</button>
            </center>
        </form>
    </div>
</div>

<?php
if (isset($_POST['get_list'])) {
    $date = $_POST['att_date'];
    $class = $_POST['class'];
    $user = $_POST['user'];
    $academic_year = (empty($_POST['academic_year'])) ? '2022-2023' : $_POST['academic_year'];
    $db = new database();
    $conn = $db->conn;
    $sql = "SELECT * FROM student_attendance where ay='$academic_year'";
    if ($user != '') {
        $sql .= " and login_id='$user'";
    }
    if ($class != '') {
        $sql .= " and student_class='$class'";
    }
    if ($date != '') {
        $sql .= " and attendance_date='$date'";
    }
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) < 0) {
        echo '<div class="alert alert-danger">No Record Found</div>';
    } else {
        includes::Datatables("Attendance Report Class $class $date", '0,1,2,3,4,5,6,7,8', '');
        $table = '<div class="card shadow-lg m-3 p-4 " style="overflow:scroll;"><table id="example" class="display" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>Sl No.</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Class </th>
                    <th>SMS Status</th>
                    <th>Attendance</th>
                    <th>Date</th>
                    <th>Month</th>
                    <th>Login</th>
                </tr>
            </thead>
            <tbody>';
        $z = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= '<tr>
                    <td>' . $z++ . '</td>
                    <td>' . $row['reg_no'] . '</td>
                    <td>' . $row['student_name'] . '</td>
                    <td>' . $row['student_class'] . '</td>
                    ';
                    if ($row['response'] == 'N/A') {
                        $table .= "<td>::-::</td>";
                    } else {
                        $data = (array)json_decode($row['response']);
        
                        $table .= '<td>' . $data['status'] . '</td>';
                    }
                    $table .= '
                    <td>' . $row['attendance'] . '</td>
                    <td>' . $row['attendance_date'] . '</td>
                    <td>' . $row['month_'] . '</td>
                    <td>' . $row['login_id'] . '</td>

                    </td>
                </tr>';
        }
        $table .= '</tbody>
        </table></div>';
        echo $table;
    }
}
?>
<?php   
    require_once './views/footer.php';
?>