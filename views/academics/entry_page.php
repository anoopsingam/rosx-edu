<?php
require '././config.php';
$db = new database();
$conn = $db->conn;
$app = new app();
$student = func::getStudentDetails($db->conn->real_escape_string(decrypt($student_id)));
$sub = func::getSubjects($student->present_class);
$test = $db->conn->real_escape_string($test_name);
$ay = $db->conn->real_escape_string($ay);

if (!empty($student_id) && !empty($test) && !empty($ay)) {
    if (!empty($sub)) {
        //logic part 
        $max1 = 0;
        $max2 = 0;
        $max3 = 0;
        $max4 = 0;
        $max5 = 0;
        $max6 = 0;
        $max7 = 0;
        $max_total = 0;
        if ($test == "FA-1" ||  $test == "FA-2" || $test == "FA-3" || $test == "FA-4") {
            $max1 = $sub['subject1_m_max'];
            $max2 = $sub['subject2_m_max'];
            $max3 = $sub['subject3_m_max'];
            $max4 = $sub['subject4_m_max'];
            $max5 = $sub['subject5_m_max'];
            $max6 = $sub['subject6_m_max'];
            $max7 = $sub['subject7_m_max'];
            $max_total = $sub['subject1_m_max'] + $sub['subject2_m_max'] + $sub['subject3_m_max'] + $sub['subject4_m_max'] + $sub['subject5_m_max'] + $sub['subject6_m_max']+ $sub['subject7_m_max'];
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

        $MAX = json_encode([
            'max1' => $max1,
            'max2' => $max2,
            'max3' => $max3,
            'max4' => $max4,
            'max5' => $max5,
            'max6' => $max6,
            'max7' => $max7,
        ]);
        //start a cron job  


?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <?= $app->setTitle('Marks Entry ' . $student->student_name . ' | ' . $test . ' | ' . $ay); ?>
            <?= includes::css(); ?>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap');

                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    font-family: 'Sora', sans-serif;
                }
            </style>
        </head>

        <body class="bg-gradient-success">
            <form action="/Academics/SubmitMarks/new" method="post" onsubmit=" return confirm('Are you sure you want to submit the marks of <?= $student->student_name . ' of ' . $test ?> ?');">
                <?= set_csrf(); ?>
                <input type="hidden" name="max_data" value='<?= $MAX ?>'>
            <input type="hidden" name="class" value='<?= $student->present_class ?>'> 
                <div class="container-fluid ">
                    <div class="card m-2 border border-info border-2 shadow-lg z-index-2">
                        <div class="card-header">
                            <h4 class="card-title">Marks Entry <?= $student->student_name . ' | ' . $test . ' | ' . $ay; ?></h4>
                        </div>
                        <div class="card-body">
                            <h5>Student Details : </h5>
                            <div class="row mt-5 mb-3 ">
                                <div class="col-sm">
                                    <b>Student Name : </b> <br> <?= $student->student_name; ?>
                                </div>
                                <div class="col-sm">
                                    <b>Student Id : </b> <input type="text" class="form-control" name="student_id" value="<?= $student->studentid; ?>" readonly>
                                </div>
                                <div class="col-sm">
                                    <b>Class : </b> <br> <?= $student->present_class; ?> <?= $student->present_section; ?>
                                </div>
                                <div class="col-sm">
                                    <b>Academic Year : </b> <input type="text" value="<?= $ay; ?>" name="ay" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <b>Father Name : </b> <br> <?= $student->father_name; ?>
                                </div>
                                <div class="col-sm">
                                    <b>Mother Name : </b> <br> <?= $student->mother_name; ?>
                                </div>
                                <div class="col-sm">
                                    <b> Address : </b> <br> <?= $student->permanentaddress; ?>
                                </div>
                                <div class="col-sm">
                                    <b>Month : </b> <input type="text" class="form-control" id="month" name="month" value="<?= date('F'); ?>" readonly>
                                </div>
                                <div class="col-sm">
                                    <b>Test : </b> <input type="text" class="form-control" id="test" name="test" value="<?= $test; ?>" readonly>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="bg-gradient-dark textgradient text-light">
                                        <th>Subject</th>
                                        <th>Max Marks</th>
                                        <th>Obtained Marks</th>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <?= $sub['acd_sub1']; ?>
                                            </td>
                                            <td>
                                                <?= $max1; ?>
                                            </td>
                                            <td>
                                                <input placeholder="Enter <?= $sub['acd_sub1']; ?> Marks " type="number" onkeyup="AddMarks()" name="subject1_marks" id="subject1_marks" class="form-control" min="0" max="<?= $max1; ?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?= $sub['acd_sub2']; ?>
                                            </td>
                                            <td>
                                                <?= $max2; ?>
                                            </td>
                                            <td>
                                                <input placeholder="Enter <?= $sub['acd_sub2']; ?> Marks " type="number" onkeyup="AddMarks()" name="subject2_marks" id="subject2_marks" class="form-control" min="0" max="<?= $max2; ?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?= $sub['acd_sub3']; ?>
                                            </td>
                                            <td>
                                                <?= $max3; ?>
                                            </td>
                                            <td>
                                                <input placeholder="Enter <?= $sub['acd_sub3']; ?> Marks " type="number" onkeyup="AddMarks()" name="subject3_marks" id="subject3_marks" class="form-control" min="0" max="<?= $max3; ?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?= $sub['acd_sub4']; ?>
                                            </td>
                                            <td>
                                                <?= $max4; ?>
                                            </td>
                                            <td>
                                                <input placeholder="Enter <?= $sub['acd_sub4']; ?> Marks " type="number" onkeyup="AddMarks()" name="subject4_marks" id="subject4_marks" class="form-control" min="0" max="<?= $max4; ?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?= $sub['acd_sub5']; ?>
                                            </td>
                                            <td>
                                                <?= $max5; ?>
                                            </td>
                                            <td>
                                                <input placeholder="Enter <?= $sub['acd_sub5']; ?> Marks " type="number" onkeyup="AddMarks()" name="subject5_marks" id="subject5_marks" class="form-control" min="0" max="<?= $max5; ?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?= $sub['acd_sub6']; ?>
                                            </td>
                                            <td>
                                                <?= $max6; ?>
                                            </td>
                                            <td>
                                                <input placeholder="Enter <?= $sub['acd_sub6']; ?> Marks " type="number" onkeyup="AddMarks()" name="subject6_marks" id="subject6_marks" class="form-control" min="0" max="<?= $max6; ?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?= $sub['acd_sub7']; ?>
                                            </td>
                                            <td>
                                                <?= $max7; ?>
                                            </td>
                                            <td>
                                                <input placeholder="Enter <?= $sub['acd_sub7']; ?> Marks " type="number" onkeyup="AddMarks()" name="subject7_marks" id="subject7_marks" class="form-control" min="0" max="<?= $max7; ?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Total Marks : <input type="text" class="form-control" id="total_marks" name="total_marks" readonly>
                                            </td>
                                            <td>
                                                <b>Max Marks : </b> <input type="text" class="form-control" id="max_marks" name="max_marks" value="<?= $max_total; ?>" readonly>
                                            </td>
                                            <td>
                                                <label for=""> Result : </label>
                                                <select name="result" id="result" class="form-control">
                                                    <option value="">Select Result</option>
                                                    <option value="Pass">Pass</option>
                                                    <option value="Fail">Fail</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" colspan="3">
                                                <button type="submit" class="btn bg-gradient-info" name="sub_marks">Submit</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <script>
                                    function AddMarks() {
                                        //if NaN then set to 0
                                        var subject1_marks = parseInt(document.getElementById('subject1_marks').value);
                                        if (isNaN(subject1_marks) == true) {
                                            subject1_marks = 0;
                                        }
                                        var subject2_marks = parseInt(document.getElementById('subject2_marks').value);
                                        if (isNaN(subject2_marks) == true) {
                                            subject2_marks = 0;
                                        }
                                        var subject3_marks = parseInt(document.getElementById('subject3_marks').value);
                                        if (isNaN(subject3_marks) == true) {
                                            subject3_marks = 0;
                                        }
                                        var subject4_marks = parseInt(document.getElementById('subject4_marks').value);
                                        if (isNaN(subject4_marks) == true) {
                                            subject4_marks = 0;
                                        }
                                        var subject5_marks = parseInt(document.getElementById('subject5_marks').value);
                                        if (isNaN(subject5_marks) == true) {
                                            subject5_marks = 0;
                                        }
                                        var subject6_marks = parseInt(document.getElementById('subject6_marks').value);
                                        if (isNaN(subject6_marks) == true) {
                                            subject6_marks = 0;
                                        }
                                        <?php 
                                        if ($test == "FA-1" ||  $test == "FA-2" || $test == "FA-3" || $test == "FA-4") {
                                            ?>
                                            var subject7_marks =0;
                                        <?php }else{ ?>
                                            var subject7_marks = parseInt(document.getElementById('subject7_marks').value);
                                        <?php }?>
                                        if (isNaN(subject7_marks) == true) {
                                            subject7_marks = 0;
                                        }
                                        var total_marks = subject1_marks + subject2_marks + subject3_marks + subject4_marks + subject5_marks + subject6_marks + subject7_marks;
                                        document.getElementById('total_marks').value = total_marks;
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </body>

        </html>
<?php
    } else {
        echo "<h1>No subjects found in this class {$student->present_class}</h1>";
    }
} else {
    //authentication failed
    echo "<h1>Authentication failed</h1>";
}
?>