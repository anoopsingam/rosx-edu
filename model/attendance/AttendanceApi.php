<?php 

require '././config.php';
$db = new database();
$conn = $db->conn;
$app= new app();
$short_name = $app->short_name;
if(isset($_SESSION['confirmation']) && $_SESSION['confirmation']=="YES"){
    $s = "INSERT INTO `student_attendance`(`student_name`, `reg_no`, `student_class`,`attendance_date`,`month_`,`attendance`, `login_id`, `response`,`ay`) VALUES";
for ($i = 0; $i < $_POST['number']; $i++) {
    $class = $_POST['class'][$i];
    $date = $_POST['date'][$i];
 
        if ($_POST['attend'][$i] == 'ABSENT') {
            $date = $_POST['date'][$i];
            $name = $_POST['name'][$i];
            // MDJmNGY3OWVmZDQyMmNlNWUwNmRmYmUyNGRkMWIyZWI=
            $apiKey = urlencode('MDJmNGY3OWVmZDQyMmNlNWUwNmRmYmUyNGRkMWIyZWI=');
            $numbers = $_POST['mobile_no'][$i];
            $sender = urlencode('STARKT');
            $message = rawurlencode("Dear Parent, your ward $name is Absent today $date, Please Contact College/School $short_name. Regards Admin, STARKT");
            // Prepare data for POST request
            $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
            // Send the POST request with cURL
            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $s .= "('" . $_POST['name'][$i] . "','" . $_POST['reg_no'][$i] . "','" . $_POST['class'][$i]  . "','" . $_POST['date'][$i] . "','" . date("M") . "','" . $_POST['attend'][$i] . "','" . $_POST['loginid'][$i] . "','" . $response . "','" . $_POST['ay'][$i]  . "'),";
        } else {
            $s .= "('" . $_POST['name'][$i] . "','" . $_POST['reg_no'][$i] . "','" . $_POST['class'][$i]  . "','" . $_POST['date'][$i] . "','" . date("M") . "','" . $_POST['attend'][$i] . "','" . $_POST['loginid'][$i] . "','N/A','" . $_POST['ay'][$i]  . "'),";
        }
    }
    $s = rtrim($s, ",");
    $insert = mysqli_query($conn, $s);
    if ($insert) {
        //alert Attendance Marked Successfully and Redired to Index
        js::alert("Attendance Marked Successfully for $class of Date: $date");
        js::redirect("/Attendance/Add");
        unset($_SESSION['attendance_validation']);
    } else {
        js::alert("Attendance Not Marked for $class of Date: $date, Contact technical team");
        js::redirect("/Dashboard");
        unset($_SESSION['attendance_validation']);
    }
}else{
    js::alert("Forbidden Access, Null Token Found");
    js::redirect("/");
    unset($_SESSION['attendance_validation']);
    unset($_SESSION['confirmation']);
}