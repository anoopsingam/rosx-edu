<?php
require '././config.php';
$db = new database();
$conn = $db->conn;
if (isset($action) && $action != null) {
    switch ($action) {
        case "new":
            if (is_csrf_valid()) {
                // print_r($_POST);
                $student_id = $_POST['student_id'];
                $login_id = $_POST['login_id'];
                $academicYear = $_POST['ay'];
                $month = $_POST['month'];
                $test = $_POST['test'];
                $class = $_POST['class'];
                $max_sub = json_decode($_POST['max_data']);
                $test_array = ['FA-1', 'FA-2', 'FA-3', 'FA-4'];
                $conversion = 0;
                if ($class == 'LKG' || $class == 'UKG'  || $class == '9' || $class == '10') {
                    $subject1_marks = (empty($_POST['subject1_marks'])) ? '0' : $_POST['subject1_marks'];
                    $subject2_marks = (empty($_POST['subject2_marks'])) ? '0' : $_POST['subject2_marks'];
                    $subject3_marks = (empty($_POST['subject3_marks'])) ? '0' : $_POST['subject3_marks'];
                    $subject4_marks = (empty($_POST['subject4_marks'])) ? '0' : $_POST['subject4_marks'];
                    $subject5_marks = (empty($_POST['subject5_marks'])) ? '0' : $_POST['subject5_marks'];
                    $subject6_marks = (empty($_POST['subject6_marks'])) ? '0' : $_POST['subject6_marks'];
                    $subject7_marks = (empty($_POST['subject7_marks'])) ? '0' : $_POST['subject7_marks'];
                    $max_marks = $_POST['max_marks'];
                } else {
                    if (in_array($test, $test_array)) {
                        $conversion = 15;
                        $subject1_marks = round(($_POST['subject1_marks'] / $max_sub->max1) * $conversion);
                        $subject2_marks = round(($_POST['subject2_marks'] / $max_sub->max2) * $conversion);
                        $subject3_marks = round(($_POST['subject3_marks'] / $max_sub->max3) * $conversion);
                        $subject4_marks = round(($_POST['subject4_marks'] / $max_sub->max4) * $conversion);
                        if (!empty($_POST['subject5_marks'])) {
                            $subject5_marks = round(($_POST['subject5_marks'] / $max_sub->max5) * $conversion);
                        } else {
                            $subject5_marks = '0';
                        }
                        if (!empty($_POST['subject6_marks'])) {
                            $subject6_marks = round(($_POST['subject6_marks'] / $max_sub->max6) * $conversion);
                        } else {
                            $subject6_marks = '0';
                        }
                        if (!empty($_POST['subject7_marks'])) {
                            $subject7_marks = round(($_POST['subject7_marks'] / $max_sub->max7) * $conversion);
                        } else {
                            $subject7_marks = 0;
                        }
                    } else {
                        $conversion = 20;
                        $subject1_marks = round(($_POST['subject1_marks'] / $max_sub->max1) * $conversion);
                        $subject2_marks = round(($_POST['subject2_marks'] / $max_sub->max2) * $conversion);
                        $subject3_marks = round(($_POST['subject3_marks'] / $max_sub->max3) * $conversion);
                        $subject4_marks = round(($_POST['subject4_marks'] / $max_sub->max4) * $conversion);
                        $subject5_marks = round(($_POST['subject5_marks'] / $max_sub->max5) * $conversion);
                        $subject6_marks = round(($_POST['subject6_marks'] / $max_sub->max6) * $conversion);
                        if (!empty($_POST['subject5_marks'])) {
                            $subject5_marks = round(($_POST['subject5_marks'] / $max_sub->max5) * $conversion);
                        } else {
                            $subject5_marks = '0';
                        }
                        if (!empty($_POST['subject6_marks'])) {
                            $subject6_marks = round(($_POST['subject6_marks'] / $max_sub->max6) * $conversion);
                        } else {
                            $subject6_marks = '0';
                        }
                        if (!empty($_POST['subject7_marks'])) {
                            $subject7_marks = round(($_POST['subject7_marks'] / $max_sub->max7) * $conversion);
                        } else {
                            $subject7_marks = 0;
                        }
                    }
                    $max_marks = $conversion * 7;
                }
                // echo $conversion;

                $total_marks = $subject1_marks + $subject2_marks + $subject3_marks + $subject4_marks + $subject5_marks + $subject6_marks + $subject7_marks;
                //calculate percentage
                $percentage = ($total_marks / $max_marks) * 100;
                $percentage = round($percentage, 2);
                $result = $_POST['result'];
                $grade = '';
                if ($percentage >= 90) {
                    $grade = 'A+';
                } else if ($percentage >= 80) {
                    $grade = 'A';
                } else if ($percentage >= 70) {
                    $grade = 'B+';
                } else if ($percentage >= 60) {
                    $grade = 'B';
                } else if ($percentage >= 50) {
                    $grade = 'C+';
                } else if ($percentage >= 35) {
                    $grade = 'C';
                } else if ($percentage < 35) {
                    $grade = 'F';
                }
                if ($result == "FAIL") {
                    $grade = 'F';
                }
                $resData = [
                    'res_test' => $test,
                    'res_ay' => $academicYear,
                    'res_student_id' => $student_id,
                    'res_class' => $class,
                    'res_month' => $month,
                    'res_sub_1_marks' => $subject1_marks,
                    'res_sub_2_marks' => $subject2_marks,
                    'res_sub_3_marks' => $subject3_marks,
                    'res_sub_4_marks' => $subject4_marks,
                    'res_sub_5_marks' => $subject5_marks,
                    'res_sub_6_marks' => $subject6_marks,
                    'res_sub_7_marks' => $subject7_marks,
                    'res_max' => $max_marks,
                    'res_obtained' => $total_marks,
                    'res_percentage' => $percentage,
                    'res_grade' => $grade,
                    'res_result' => $result,
                    'res_login_id' => $login_id
                ];
                // print_r($resData);
                try {
                    if (empty(func::getMarksEntryDetails($student_id, $test, $academicYear)['res_student_id'])) {
                        if ($db->insert('academics_marks', $resData)) {
                            js::alert("Marks entry successful of student: " . $student_id . " for test: " . $test . " in academic year: " . $academicYear);
                            js::WindowClose();
                        } else {
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Inserting Data of Marks $test $student_id $academicYear ", $login_id);
                            throw new Exception("Error Processing Request to Insert marks of student $student_id of test $test");
                        }
                    } else {
                        throw new Exception("Marks entry already exists for student $student_id of test $test");
                    }
                } catch (Exception $e) {
                    js::alert($e->getMessage());
                    js::WindowClose();
                }
            }
            break;
        case "delete":
            if (is_csrf_valid()) {
                $student_id = mysqli_real_escape_string($db->conn, $_POST['student_id']);
                $class = mysqli_real_escape_string($db->conn, $_POST['class']);
                $test = mysqli_real_escape_string($db->conn, $_POST['test']);
                $academicYear = mysqli_real_escape_string($db->conn, $_POST['academicYear']);
                try {
                    if (!empty(func::getMarksEntryDetails($student_id, $test, $academicYear)['res_student_id'])) {
                        if ($db->delete('academics_marks', "res_test='$test' and res_ay='$academicYear' and res_student_id='$student_id' and res_class='$class'")) {
                            js::alert("Marks entry deleted successfully of student: " . $student_id . " for test: " . $test . " in academic year: " . $academicYear);
                            js::WindowClose();
                        } else {
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting Data of Marks $test $student_id $academicYear ", $login_id);
                            throw new Exception("Error Processing Request to delete marks of student $student_id of test $test");
                        }
                    } else {
                        throw new Exception("Marks entry Doesn't exists for student $student_id of test $test in academic year $academicYear");
                    }
                } catch (Exception $e) {
                    js::alert($e->getMessage());
                    js::WindowClose();
                }
            }
            break;
        default:
            js::alert("Invalid Action");
            js::redirect('/Dashboard');
            break;
    }
} else {
    js::alert("Invalid Action");
    js::redirect('/Dashboard');
}
