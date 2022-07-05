<?php
require '././config.php';
$db = new database();
$app = new app();
if (empty($_POST['student_id'])  && empty($_POST['term_fetch']) && empty($_POST['ay'])) {
    js::alert("Please select a student and a term");
    js::redirect('/Dashboard');
} else {
    $id = $_POST['studentid'];
    $term = $_POST['term_fetch'];
    $ay = $_POST['ay'];
    $t = '';
    if ($term == 'term_1') {
        $t = 'TERM -1';
        $parm = "'FA-1','FA-2','SA-1'";
    } else if ($term == 'term_2') {
        $t = 'TERM -2';
        $parm = "'FA-3','FA-4','SA-2'";
    } else {
        $parm = "'FA-1','FA-2','FA-3','FA-4','SA-1','SA-2'";
    }

    $student = func::getStudentDetails($db->conn->real_escape_string($id));
    /* Fetching the data from the database. */
    $sql_smt = mysqli_query($db->conn, "SELECT * from `academics_marks` WHERE res_test IN($parm) AND res_ay='$ay' AND res_student_id='$id'");
    if (mysqli_num_rows($sql_smt) > 0) {
        $data = array();
        while ($row = mysqli_fetch_assoc($sql_smt)) {
            $data[] = $row;
        }
        $sub = func::getSubjects($student->present_class);
  

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <?= $app->setTitle("$ay | $id") ?>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap');

                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    font-family: 'Sora', sans-serif;
                }

                /* @page {
                    size: landscape;
                } */

                .break {
                    page-break-after: always;
                }

                hr {
                    border: 1px solid #000;
                    width: 100%;
                    margin-bottom: 10px;
                }

                table.customTable {
                    width: 100%;
                    background-color: #FFFFFF;
                    border-collapse: collapse;
                    border-width: 2px;
                    border-color: #000000;
                    border-style: solid;
                    color: #000000;
                }

                table.customTable td,
                table.customTable th {
                    border-width: 2px;
                    border-color: #000000;
                    border-style: solid;
                    padding: 6px;
                }

                table.customTable thead {
                    background-color: #D9D9D9;
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
                        z-index: 2;
                    }
                }
            </style>
        </head>

        <body>

            <div class="border border-3 border-dark ">
                <center class="m-4 p-2">
                    <?= $app->SetLogo('180', '160'); ?>
                    <h3 class="display-5 font-weigth-bolder text-uppercase"><?= $app->name; ?> </h3>
                    <h6 class=""><?= $app->address; ?> </h6>
                    <h6 class=""><?= 'Contact No : ' . $app->phone . '<br>  Email : ' . $app->email; ?> </h6>
                    <h4 class="m-3 text-uppercase"><?= $t; ?> Progress Card</h4>
                </center>
                <div class="card m-3">
                    <div class="card-header">Student Details </div>
                    <div class="card-body">
                        <table class=" customTable   text-center">
                            <tr>
                                <td class="h5">Student Name : </td>
                                <td class="h5"><?= $student->student_name; ?></td>
                            </tr>
                            <tr>
                                <td class="h5">Class : </td>
                                <td class="h5"><?= $student->present_class; ?></td>
                            </tr>
                            <tr>
                                <td class="h5">Section : </td>
                                <td class="h5"><?= $student->present_section; ?></td>
                            </tr>
                            <tr>
                                <td class="h5">Admission No : </td>
                                <td class="h5"><?= $student->admission_no; ?></td>
                            </tr>
                            <tr>
                                <td class="h5">Student ID : </td>
                                <td> <img src="/barcode/50/<?= $student->studentid; ?>/false" alt="" srcset=""><br><b class="h4"><?= $student->studentid; ?></b></td>
                            </tr>
                            <tr>
                                <td class="h5">Enrollment No : </td>
                                <td class="h5"><?= $student->enrollment_no; ?></td>
                            </tr>
                            <tr>
                                <td class="h5"> <b>SATS NO</b> : </td>
                                <td class="h5"><?= $student->sts_no; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card m-3">
                    <div class="card-header">Personal Details </div>
                    <div class="card-body">
                        <table class=" customTable  ">
                            <tr>
                                <td class="h5">Father Name : </td>
                                <td class="h5"><?= $student->father_name; ?></td>
                            </tr>
                            <tr>
                                <td class="h5">Mother Name : </td>
                                <td class="h5"><?= $student->mother_name; ?></td>
                            </tr>
                            <tr>
                                <td class="h5">DOB : </td>
                                <td class="h5"><?= $student->dob; ?></td>
                            </tr>
                            <tr>
                                <td class="h5">Address : </td>
                                <td class="h5"><?= $student->permanentaddress; ?></td>
                            </tr>
                            <tr>
                                <td class="h5">Contact No : </td>
                                <td class="h5"><?= $student->father_number; ?></td>
                            </tr>
                            <tr>
                                <td class="h5">Email : </td>
                                <td class="h5"><?= $student->fatheremail; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="m-5 text-center">
                    This is a Computer Generated Score Card. <b>RoborosX Omni Tech Solutions LLP</b> is not Responsible for Any Mistakes.
                    <br>
                    <p>Software Designed and Developed by <a style="text-decoration: none;" href="https://starktechlabs.in">RoborosX Omni Tech Solutions LLP</a>, Bengaluru <br> Mail : <a style="text-decoration: none;" href="mailto:support@roborosx.com">support@roborosx.com</a></p>
                </div>
            </div>

            <div class="break"></div>
            <div class="border border-3 border-dark p-4">
                <table id="res_table" class="customTable text-center table-sm">
                    <thead>
                        <?php
                        if ($term == 'term_1' || $term == 'term_2') {
                        ?>

                            <tr>
                                <th colspan="6" class="text-center">
                                    <h4 class="m-2"> : Marks Details : </h4>
                                </th>
                            </tr>
                            <tr>
                                <th rowspan="2">
                                    <h5>Subjects</h5>
                                    <br>
                                </th>
                                <th colspan="4">
                                    <h6><?= $t; ?></h6>
                                </th>
                            </tr>
                            <tr>
                                <?php

                                if ($term == 'term_1') {
                                ?>
                                    <th>
                                        <h4>FA-1</h4>
                                    </th>
                                    <th>
                                        <h4>FA-2</h4>
                                    </th>
                                    <th>
                                        <h4>SA-1</h4>
                                    </th>
                                <?php
                                } else {
                                ?>
                                    <th>
                                        <h4>FA-3</h4>
                                    </th>
                                    <th>
                                        <h4>FA-4</h4>
                                    </th>
                                    <th>
                                        <h4>SA-2</h4>
                                    </th>
                                <?php
                                }
                                ?>
                            </tr>
                    </thead>
                    <tbody>
                        <?php
                            for ($i = 1; $i < 8; $i++) {
                        ?>
                            <tr>
                                <td><b class="h5"><?= $sub['acd_sub' . $i] ?></b></td>
                                <?php
                                foreach ($data as $d) {
                                    echo "<td><h6>" . $d['res_sub_' . $i . '_marks'] . "</h6></td>";
                                }
                                ?>
                            </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td colspan="4">
                                <h5>Summary </h5>
                            </td>
                        </tr>
                    <?php
                        } else {
                    ?>

                        <tr>
                            <th colspan="7" class="text-center">
                                <h4 class="m-2"> : Marks Details : </h4>
                            </th>
                        </tr>


                        <tr>
                            <th rowspan="2">
                                <h5>Subjects</h5>
                                <br>
                            </th>
                            <th colspan="3">
                                <h6>TERM-1</h6>
                            </th>
                            <th colspan="3">
                                <h6>TERM-2</h6>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <h4>FA-1</h4>
                            </th>
                            <th>
                                <h4>FA-2</h4>
                            </th>
                            <th>
                                <h4>SA-1</h4>
                            </th>

                            <th>
                                <h4>FA-3</h4>
                            </th>
                            <th>
                                <h4>FA-4</h4>
                            </th>
                            <th>
                                <h4>SA-2</h4>
                            </th>

                        </tr>
                        </thead>
                    <tbody>
                        <?php
                            for ($i = 1; $i < 8; $i++) {
                        ?>
                            <tr>
                                <td><b class="h5"><?= $sub['acd_sub' . $i] ?></b></td>
                                <?php
                                foreach ($data as $d) {
                                    echo "<td><h6>" . $d['res_sub_' . $i . '_marks'] . "</h6></td>";
                                }

                                ?>
                            </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                <h5>Summary </h5>
                            </td>
                        </tr>

                    <?php
                        }


                    ?>
                    <tr>
                        <td><b class="h5">Total</b></td>
                        <?php
                        foreach ($data as $d) {
                            echo "<td>" . $d['res_obtained'] . "</td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><b class="h5">Percentage </b></td>
                        <?php
                        foreach ($data as $d) {
                            echo "<td>" . $d['res_percentage'] . " % </td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><b class="h5">Grade </b></td>
                        <?php
                        foreach ($data as $d) {
                            echo "<td>" . $d['res_grade'] . " </td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td><b class="h5">Result </b></td>
                        <?php
                        foreach ($data as $d) {
                            echo "<td><b>" . $d['res_result'] . "</b> </td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            <b class="h5">Principal Signature </b>
                        </td>
                        <?php
                        foreach ($data as $d) {
                            echo "<td><br><br></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            <b class="h5">Class Teacher Signature </b>
                        </td>
                        <?php
                        foreach ($data as $d) {
                            echo "<td><br><br></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            <b class="h5">Parent Signature </b>
                        </td>
                        <?php
                        foreach ($data as $d) {
                            echo "<td><br><br></td>";
                        }
                        ?>
                    </tr>
                    </tbody>
                </table>
                <br>
                <table class="customTable table-sm text-center ">
                    <thead>
                        <td colspan="13">
                            <h4>Attendance Details</h4>
                        </td>
                    </thead>
                    <tr>
                        <td>#</td>
                        <td>MAY</td>
                        <td>JUN</td>
                        <td>JUL</td>
                        <td>AUG</td>
                        <td>SEPT</td>
                        <td>OCT</td>
                        <td>NOV</td>
                        <td>DEC</td>
                        <td>JAN</td>
                        <td>FEB</td>
                        <td>MAR</td>
                        <td>TOTAL</td>
                    </tr>
                    <tr>
                        <td>
                            <h5>Working Days</h5>
                            <?php
                            for ($i = 1; $i < 13; $i++) {
                                echo "<td>" . $i * $i . "</td>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>Attended</h5>
                            <?php
                            for ($i = 1; $i < 13; $i++) {
                                echo "<td>" . $i * $i . "</td>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

        </body>

        </html>

<?php
    } else {
        echo $db->conn->error;
        echo '<div class="alert alert-danger" role="alert">No data found</div>';
    }
}
