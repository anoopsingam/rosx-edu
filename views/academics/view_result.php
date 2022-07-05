<?php
require '././config.php';
$db = new database();
$conn = $db->conn;
$app = new app();
$student = func::getStudentDetails($db->conn->real_escape_string(decrypt($student_id)));
$sub = func::getSubjects($student->present_class);
$test = $db->conn->real_escape_string($test_name);
$ay = $db->conn->real_escape_string($ay);
$data = func::getMarksEntryDetails($student->studentid, $test, $ay);
if (!empty($student_id) && !empty($test_name) && !empty($ay)) {

    $max1 = 0;
    $max2 = 0;
    $max3 = 0;
    $max4 = 0;
    $max5 = 0;
    $max6 = 0;
    $max7 = 0;
    $max_total = 0;

    $max_class = ['LKG', 'UKG'];
    if (in_array($student->present_class, $max_class)) {
        $fa_max_marks_list = [
            "sub1" => "25",
            "sub2" => "25",
            "sub3" => "25",
            "sub4" => "25",
            "sub5" => "25",
            "sub6" => "25",
            "sub7" => "25"
        ];
        $sa_max_marks_list = [
            "sub1" => "50",
            "sub2" => "50",
            "sub3" => "50",
            "sub4" => "50",
            "sub5" => "50",
            "sub6" => "50",
            "sub7" => "50"
        ];
    } else {
        $fa_max_marks_list = [
            "sub1" => "15",
            "sub2" => "15",
            "sub3" => "15",
            "sub4" => "15",
            "sub5" => "15",
            "sub6" => "15",
            "sub7" => "15"
        ];
        $sa_max_marks_list = [
            "sub1" => "20",
            "sub2" => "20",
            "sub3" => "20",
            "sub4" => "20",
            "sub5" => "20",
            "sub6" => "20",
            "sub7" => "20"
        ];
    }


    $arr_2 = ['9', '10'];
    if (in_array($student->present_class, $arr_2)) {
        $fa_max_marks_list = [
            "sub1" => "25",
            "sub2" => "20",
            "sub3" => "20",
            "sub4" => "20",
            "sub5" => "20",
            "sub6" => "20",
            "sub7" => "25"
        ];
        $sa_max_marks_list = [
            "sub1" => "100",
            "sub2" => "80",
            "sub3" => "80",
            "sub4" => "80",
            "sub5" => "80",
            "sub6" => "80",
            "sub7" => "50"
        ];
    }

    if ($test == "FA-1" ||  $test == "FA-2" || $test == "FA-3" || $test == "FA-4") {
        $max1 = $sub['subject1_m_max'] . " (15)";
        $max2 = $sub['subject2_m_max'] . " (15)";
        $max3 = $sub['subject3_m_max'] . " (15)";
        $max4 = $sub['subject4_m_max'] . " (15)";
        $max5 = $sub['subject5_m_max'] . " (15)";
        $max6 = $sub['subject6_m_max'] . " (15)";
        $max7 = $sub['subject7_m_max'] . " (15)";
        $max_total = $sub['subject1_m_max'] + $sub['subject2_m_max'] + $sub['subject3_m_max'] + $sub['subject4_m_max'] + $sub['subject5_m_max'] + $sub['subject6_m_max'] + $sub['subject7_m_max'];
    } else {
        $max1 = $sub['subject1_e_max'];
        $max2 = $sub['subject2_e_max'];
        $max3 = $sub['subject3_e_max'];
        $max4 = $sub['subject4_e_max'];
        $max5 = $sub['subject5_e_max'];
        $max6 = $sub['subject6_e_max'];
        $max7 = $sub['subject7_e_max'];
        $max_total = $sub['subject1_e_max'] + $sub['subject2_e_max'] + $sub['subject3_e_max'] + $sub['subject4_e_max'] + $sub['subject5_e_max'] + $sub['subject6_e_max'] + $sub['subject7_e_max'];
    }
    $arr = ['FA-1', 'FA-2', 'FA-3', 'FA-4'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $app->setTitle("Result | {$student->studentid} | $test | $ay ") ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Sora', sans-serif;
            }



            hr {
                border-top: 2px solid black;
            }

            @media print {
                body:before {
                    content: url('<?= url::myurl() . '/' . $app->logo; ?>');
                    position: fixed;
                    top: 0;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    color: #ff0000;
                    font-size: 100px;
                    font-weight: 500px;
                    display: grid;
                    justify-content: center;
                    align-content: center;
                    opacity: 0.1;
                }
            }
        </style>
    </head>

    <body class="bg-gradient-primary">
        <div class="container">
            <div class="row text-center mt-5">
                <div class="col-md-3">
                    <?= $app->SetLogo('200', '180'); ?>
                </div>
                <div class="col-md-6">
                    <h3 class="display-5 font-weigth-bolder text-uppercase"><?= $app->name; ?> </h3>
                    <small class=""><?= $app->address; ?> </small>
                    <h6 class=""><?= 'Contact No : ' . $app->phone . '<br>  Email : ' . $app->email; ?> </h6>

                    <h4 class="m-3 text-uppercase"><?= $test; ?> Marks Card</h4>
                    <!--<h6 class="h6">Contact No:  E-Mail:</h6>-->
                </div>
                <div class="col-md-3">
                    <img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= json_encode([$data]) ?>' id="QR" height="180" width="180" alt="logo">
                    <p>Powered by RosX Edu Soft </p>
                </div>
            </div>
            <hr class="my-4">
            <table class="table table-bordered text-center ">
                <tr>
                    <td colspan="4" class="text-center">
                        <h6 class="m-2"> : Student Details : </h6>
                    </td>
                </tr>
                <tr class="text-center">
                    <td>
                        <h5>Student Id : </h5>
                        <img src="/barcode/50/<?= $student->studentid; ?>/false" alt="" srcset=""><br>
                       <h5> <?= $student->studentid; ?></h5>

                    </td>
                    <td>
                        <h5>Student Name : </h5> <b><?= $student->student_name; ?></b>
                    </td>

                    <td>
                        <h5>Class : </h5> <b><?= $student->present_class; ?>-<?= $student->present_section; ?></b>
                    </td>
                    <td>
                        <h5>Academic Year : </h5> <b><?= $ay; ?></b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        <h6 class="m-2"> : Test/Exam Details : </h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Test/Exam : </h5> <h4><?= $test; ?></h4>
                    </td>
                    <td>
                        <h5>Month : </h5> <h4><?= $data["res_month"]; ?></h4>
                    </td>
                    <td>
                        <h5>Marks Entered by :</h5> <h5><?= $data["res_login_id"]; ?></h5>
                    </td>
                    <td>
                        <h5>Entered On: </h5> <b><?= $data["res_created_on"]; ?></b>
                    </td>
                </tr>
            </table>

            <table class="table table-bordered text-center border border-dark border-3">
                <thead>
                    <tr>
                        <th colspan="4">
                            <h6 class="m-2"> : Result Details : </h6>
                        </th>
                    </tr>
                    <tr>
                        <th>Sl No </th>
                        <th>Subject Name </th>
                        <th>Max Marks </th>
                        <th>Obatined Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 1; $i < 8; $i++) {
                    ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><b class="h5"><?= $sub['acd_sub' . $i] ?></b></td>
                            <td><b class="h5"><?php
                                                if (in_array($test, $arr)) {
                                                    echo $fa_max_marks_list['sub' . $i];
                                                } else {
                                                    echo $sa_max_marks_list['sub' . $i];
                                                }
                                                ?></b></td>
                            <td><b><?= $data['res_sub_' . $i . '_marks'] ?></b></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>

                        <td>
                            <b>Percentage :</b> <?= $data['res_percentage'] ?>
                        </td>
                        <td>
                            <b>Grade :</b> <?= $data['res_grade'] ?>
                        </td>
                        <td>
                            <b>Total Max Marks :</b> <?= $data['res_max'] ?>
                        </td>
                        <td>
                            <b>Total Marks :</b> <?= $data['res_obtained'] ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <table class="table table-borderless">
                <tr>
                    <td colspan="1" align="left">
                        <br><br><br>
                        <h5 class="mt-5">Class Teacher Signature /- </h5>
                    </td>
                    <td colspan="2" align="center">
                        <br><br><br>
                        <h5 class="mt-5">Parent Signature /- </h5>
                    </td>
                    <td colspan="2" align="right">
                        <br><br><br>
                        <h5 class="mt-5">Principal Signature /- </h5>
                    </td>
                </tr>
            </table>
            <div class="text-center">
                This is a Computer Generated Score Card. These cannot be treated as original mark sheets, <b>RoborosX Omni Tech Solutions LLP</b> is not Responsible for Any Mistakes
                <br>
                <p>
                    Software Designed and Developed by <a style="text-decoration: none;" href="https://starktechlabs.in">RoborosX Omni Tech Solutions LLP</a>, Bengaluru <br> Mail : <a style="text-decoration: none;" href="mailto:support@roborosx.com">support@roborosx.in</a>
                </p>
            </div>
            <span class="d-print-none text-center m-1">
                <center>
                    <button class="btn btn-danger m-1" onclick="window.print()">Print <i class="fa fa-print" aria-hidden="true"></i></button>
                </center>
                <form action="/Academics/SubmitMarks/delete" method="post" onsubmit="return confirm('Are Sure to Delete the Record ???')">
                    <?= set_csrf(); ?>
                    <input type="hidden" name="student_id" value="<?= $data['res_student_id'] ?>">
                    <input type="hidden" name="class" value="<?= $data['res_class'] ?>">
                    <input type="hidden" name="test" value="<?= $data['res_test'] ?>">
                    <input type="hidden" name="academicYear" value="<?= $ay; ?>">
                    <button class="btn btn-danger m-1" type="submit">Delete <i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
            </span>
        </div>
    </body>

    </html>
<?php
} else {
    js::alert('Authentication failed');
    js::WindowClose();
}
