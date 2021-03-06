<?php
require '././config.php';
$app = new app();
$db = new database();
$data = func::getStudentDetails(decrypt($ern));
// print_r($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&family=Ubuntu:wght@500&display=swap"
        rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <style>
    * {
        -webkit-print-color-adjust: exact !important;
        /* Chrome, Safari */
        color-adjust: exact !important;
        /*Firefox*/

    }

    .example-print {
        display: none;
    }

    @media print {
        .example-screen {
            display: none;
        }

        .example-print {
            display: block;
        }
    }

    td {
        text-align: center;
        height: min-content;
        border-width: 10px;
    }

    tr {
        border-width: 10px;
    }

    .table-bordered {
        border-width: 2px;
        border-color: black;
    }

    table {
        overflow: scroll;
    }

    .declaration {
        border-color: 5px black;

    }

    @media print {
        footer {
            page-break-after: always;
        }
    }

    body {
        font-family: 'Ubuntu', sans-serif;
        position: relative;
        height: 100%;

    }

    @media print {
        body:before {
            content: url('<?= url::myurl().'/'.$app->logo; ?>');
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
    <?= $app->setTitle('View Admission -'.$data->enrollment_no); ?>
</head>

<body>
    <div class="container">
        <div class="row text-center mt-5">
            <div class="col-md-3">
                <?= $app->SetLogo('200', '180'); ?>
            </div>
            <div class="col-md-6">
                <h3 class="display-5 font-weigth-bolder text-uppercase"><?= $app->name; ?> </h3>
                <h6 class=""><?= $app->address; ?> </h6>
                <h6 class=""><?= 'Contact No : '.$app->phone.'   Email : '.$app->email; ?> </h6>
                <br>
                <h4 class="m-3 text-uppercase">Admission Acknowledgement</h4>
                <!--<h6 class="h6">Contact No:  E-Mail:</h6>-->
            </div>
            <div class="col-md-3">
                <img src="../../web_assets/transperent.png" height="140" width="190" alt="">
                <p>Powered by RosX Edu Soft </p>
            </div>
        </div>
        <table class="table table-bordered text-center">
            <tr>
                <td><br>
                    <h5 class="mt-5">Application No : <span class="text-danger h4"><?= $data->app_no; ?></span>
                    </h5>
                </td>
                <td><br>
                    <?php 
                        if(!empty($data->studentid)){
                            ?>
                    <h5 class="mt-2">Student Id : <br>
                        <p class="m-3"> <?= includes::barcode($data->studentid, 'false', '60'); ?></p><span
                            class="text-success h4"><?= $data->studentid; ?></span>
                    </h5>
                    <?php
                        }else{
                            ?>
                    <h5 class="text-primary text-center">Approval Pending</h5>
                    <?php
                        }
                    ?>
                </td>
                <td>
                    <br>
                    <h5 class="mt-2">Enrollment No : <br>
                        <p class="m-3"> <?= includes::barcode($data->enrollment_no, 'false', '60'); ?></p><span
                            class="text-dark h4"><?= $data->enrollment_no; ?></span>
                    </h5>
                </td>
                <td>
                    <img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?=  json_encode(['Student Name' => $data->student_name, 'Student Di' => $data->studentid, 'Auth Token' => (empty($data->token)) ? md5($data->studentid) : $data->token, 'Enrollment No ' => $data->enrollment_no, 'Application No ' => $data->app_no, 'Enroll Time' => $data->enroll_time]); ?>'
                        id="QR" height="180" width="180" alt="logo">
                </td>
            </tr>
        </table>
        <h4 style="float: center ;">STUDENT DETAILS</h4>
        <table class="table table-bordered ">
            <tr>
                <td><label for="student_name">Student Name :- </label>
                    <h5><?= $data->student_name; ?></h5>
                </td>
                <td> <label for="gender">Gender :- </label>
                    <h5><?= $data->gender; ?></h5>
                </td>
                <td>
                    <label for="dob">DOB :- </label>
                    <h5><?= $data->dob; ?></h5>
                </td>
                <td>
                    <label for="studentemail">Student E-mail :- </label>
                    <h5><?= $data->studentemail; ?></h5>
                </td>
            </tr>
        </table>
        <h4 style="float: center ;">PARENT DETAILS</h4>
        <table class="table table-bordered ">
            <tr>
                <td>
                    <label for="father_name">Father Name :- </label>
                    <h5><?= $data->father_name; ?></h5>
                </td>
                <td>
                    <label for="fatheremail">Father E-mail :- </label>
                    <h5><?= $data->fatheremail; ?></h5>
                </td>
                <td>
                    <label for="fathereducation">Father Education :- </label>
                    <h5><?= $data->fathereducation; ?></h5>
                </td>
                <td>
                    <label for="fatheroccupation">Father Occupation :- </label>
                    <h5><?= $data->fatheroccupation; ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="father_number">Father Number :- </label>
                    <h5><?= $data->father_number; ?></h5>
                </td>
                <td>
                    <label for="father_income">Father Income :- </label>
                    <h5><?= $data->father_income; ?></h5>
                </td>
                <td>
                    <label for="mother_name">Mother Name :- </label>
                    <h5><?= $data->mother_name; ?></h5>
                </td>
                <td>
                    <label for="mothereducation">Mother Education :- </label>
                    <h5><?= $data->mothereducation; ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="motheroccupation">Mother Occupation :- </label>
                    <h5><?= $data->motheroccupation; ?></h5>
                </td>
                <td>
                    <label for="mother_number">Mother Number :- </label>
                    <h5><?= $data->mother_number; ?></h5>
                </td>
                <td>
                    <label for="motheremail">Mother E-mail :- </label>
                    <h5><?= $data->motheremail; ?></h5>
                </td>
                <td>
                    <label for="mother_income">Mother Income :- </label>
                    <h5><?= $data->mother_income; ?></h5>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="total_family">Total Members in Family :- </label>
                    <h5><?= $data->total_family; ?></h5>
                </td>
            </tr>
        </table>
        <h4 style="float: center ;">GUARDIAN DETAILS</h4>
        <table class="table table-bordered ">
            <tr>
                <td>
                    <label for="guardian_name">Guardian Name :- </label>
                    <h5><?= $data->guardian_name; ?></h5>
                </td>
                <td>
                    <label for="guardian_mobile">Guardian Mobile :- </label>
                    <h5><?= $data->guardian_mobile; ?></h5>
                </td>
                <td>
                    <label for="guardianemail">Guardian E-mail :- </label>
                    <h5><?= $data->guardianemail; ?></h5>
                </td>
                <td>
                    <label for="guardian_income">Guardian Income :- </label>
                    <h5><?= $data->guardian_income; ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="guardianeducation">Guardian Education :- </label>
                    <h5><?= $data->guardianeducation; ?></h5>
                </td>
                <td>
                    <label for="guardianoccupation">Guardian Occupation :- </label>
                    <h5><?= $data->guardianoccupation; ?></h5>
                </td>
                <td>
                    <label for="guardianaddress">Guardian Address :- </label>
                    <h5><?= $data->guardianaddress; ?></h5>
                </td>
                <td>
                    <label for="guardian_relation">Guardian Relation :- </label>
                    <h5><?= $data->guardian_relation; ?></h5>
                </td>
            </tr>
        </table>
        <h4 style="float: center ;">ADDRESS DETAILS</h4>
        <table class="table table-bordered ">
            <tr>
                <td colspan="2">
                    <label for="permanentaddress">Permanent Address :- </label>
                    <h5 class="m-5"><?= $data->permanentaddress; ?></h5>
                </td>
                <td colspan="2">
                    <label for="temporaryaddress">Temporary Address :- </label>
                    <h5 class="m-5"><?= $data->temporaryaddress; ?></h5>
                </td>
            </tr>
        </table>
        <br>
        <br> <br> <br> <br> <br> <br> <br>
        <h4 style="float: center ;">OTHER DETAILS</h4>
        <table class="table table-bordered ">
            <tr>
                <td>
                    <label for="nationality">Nationality :- </label>
                    <h5><?= $data->nationality; ?></h5>
                </td>
                <td>
                    <label for="religion">Religion :- </label>
                    <h5><?= $data->religion; ?></h5>
                </td>
                <td>
                    <label for="caste">Caste :- </label>
                    <h5><?= $data->caste; ?></h5>
                </td>
                <td>
                    <label for="subcaste">Sub Caste :- </label>
                    <h5><?= $data->subcaste; ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="birthplace">Birth Place :- </label>
                    <h5><?= $data->birthplace; ?></h5>
                </td>
                <td>
                    <label for="district">District :- </label>
                    <h5><?= $data->district; ?></h5>
                </td>
                <td>
                    <label for="taluk">Taluk :- </label>
                    <h5><?= $data->taluk; ?></h5>
                </td>
                <td>
                    <label for="village">Village :- </label>
                    <h5><?= $data->village; ?></h5>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="mothertongue">Mother Tongue :- </label>
                    <h5><?= $data->mothertongue; ?></h5>
                </td>
            </tr>
        </table>
        <h4 style="float: center ;">PREVIOUS SCHOOL DETAILS</h4>
        <table class="table table-bordered ">
            <tr>
                <td>
                    <label for="previousclass">Previous Class :- </label>
                    <h5><?= $data->previousclass; ?></h5>
                </td>
                <td>
                    <label for="admissionclass">Admission Class :- </label>
                    <h5><?= $data->admissionclass; ?></h5>
                </td>
                <td>
                    <label for="previousschool">Previous School :- </label>
                    <h5><?= $data->previousschool; ?></h5>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="previousschool_address">Previous School Address :- </label>
                    <h5><?= $data->previousschool_address; ?></h5>
                </td>
                <td>
                    <label for="medium_c">Medium :- </label>
                    <h5><?= $data->medium_c; ?></h5>
                </td>
            </tr>
        </table>
        <h4 style="float: center ;">BANK DETAILS</h4>
        <table class="table table-bordered ">
            <tr>
                <td>
                    <label for="studentbank">Student Bank Name :- </label>
                    <h5><?= $data->studentbank; ?></h5>
                </td>
                <td>
                    <label for="acc_no">Student Bank Account No. :- </label>
                    <h5><?= $data->acc_no; ?></h5>
                </td>
                <td>
                    <label for="bankaddress">Bank Address :- </label>
                    <h5><?= $data->bankaddress; ?></h5>
                </td>
                <td>
                    <label for="ifsc">IFSC :- </label>
                    <h5><?= $data->ifsc; ?></h5>
                </td>
            </tr>
        </table>
        <h4 style="float: center ;">REQUIRED DOCUMENT DETAILS</h4>
        <table class="table table-bordered ">
            <tr>
                <td>
                    <label for="studentaadhar">Student Aadhar :- </label>
                    <h5><?= $data->studentaadhar; ?></h5>
                </td>
                <td>
                    <label for="fatheraadhar">Father Aadhar :- </label>
                    <h5><?= $data->fatheraadhar; ?></h5>
                </td>
                <td>
                    <label for="motheraadhar">Mother Aadhar :- </label>
                    <h5><?= $data->motheraadhar; ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="studentcastenumber">Student Caste Certificate No. :- </label>
                    <h5><?= $data->studentcastenumber; ?></h5>
                </td>
                <td>
                    <label for="studentincomenumber">Student Income Certificate No. :- </label>
                    <h5><?= $data->studentincomenumber; ?></h5>
                </td>
                <td>
                    <label for="rationcard">Ration Card :- </label>
                    <h5><?= $data->rationcard; ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="fathercastenumber">Father Caste Certificate No. :- </label>
                    <h5><?= $data->fathercastenumber; ?></h5>
                </td>
                <td>
                    <label for="fatherincomenumber">Father Income Certificate No. :- </label>
                    <h5><?= $data->fatherincomenumber; ?></h5>
                </td>
                <td>
                    <label for="mothercastenumber">Mother Caste Certificate No. :- </label>
                    <h5><?= $data->mothercastenumber; ?></h5>
                </td>
            </tr>
            <tr>
                <td colspan="1">
                    <label for="motherincomenumber">Mother Income Certificate No. :- </label>
                    <h5><?= $data->motherincomenumber; ?></h5>
                </td>
                <td colspan="2"><label for="birthcertificate">Birth Certificate :- </label>
                    <h5><?= $data->birthcertificate; ?></h5>
                </td>

            </tr>
        </table>
        <h4 style="float: center ;">CURRENT ADMISSION DETAILS</h4>
        <table class="table table-bordered ">
            <tr>
                <td>
                    <label for="admission_date">Admission Date :- </label>
                    <h5><?= $data->admission_date; ?></h5>
                </td>
                <td>
                    <label for="present_class">Present Class :- </label>
                    <h5><?= $data->present_class; ?></h5>
                </td>
                <td>
                    <label for="present_section">Present Section :- </label>
                    <h5><?= $data->present_section; ?></h5>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="academic_year">Academic Year :- </label>
                    <h5><?= $data->academic_year; ?></h5>
                </td>
                <td>
                    <label for="sts_no">STS No. :- </label>
                    <h5><?= $data->sts_no; ?></h5>
                </td>
                <td>
                    <label for="admission_no">Admission No. :- </label>
                    <h5><?= $data->admission_no; ?></h5>
                </td>
            </tr>
        </table>
        <footer></footer> <br> <br> <br> <br>
        <center><span class="text-danger text-uppercase text-break">
                <h5 style="color: red;"><strong>NOTE :</strong> ORIGINAL BIRTH CERTIFICATE MUST BE SUBMITTED AT THE TIME
                    OF ADMISSION (APPLICABLE ONLY FOR 1ST STANDARD STUDENTS) </h5>
            </span></center>
        <div class="declaration">
            <hr style="height :  2px;background-color :  black">
            <center>
                <h4>DECLARATION</h4>
                <ul>
                    <li style=" list-style-position: outside;">
                        I DO HEREBY DECLARE THAT THE ABOVE INFORMATION IS CORRECT TO THE BEST OF MY KNOWLEDGE AND BELIEF
                        & I SHALL ABIDE BY THE RULES AND REGULATIONS OF THE INSTITUTION.
                    </li>
                    <li style=" list-style-position: outside;">
                        I UNDERTAKE TO ABIDE BY THE RULES AND REGULATIONS OF THE SCHOOL IN ACADEMICS, SPORTS, CODE OF
                        CONDUCT, DISCIPLINE, EDUCATION IN HUMAN VALUES, EXTRA-CURRICULAR AND OTHER ACTIVITIES AS GIVEN
                        IN THE PROSPECTUS.
                    </li>
                    <li style=" list-style-position: outside;">
                        IN THE EVENT OF ANY ACT OF INDISCIPLINE ON MY PART, THE DECISION OF THE PRINCIPAL/MANAGEMENT
                        SHALL BE FINAL AND BINDING ON ME.
                    </li>
                </ul>
            </center>


            <h4 style="padding-top: 30px;text-align:center;">I ENDORSE THE ABOVE STATEMENTS</h4>
            <p class="text-left"> ADMISSION NO.: <strong><?= $data->admission_no; ?></strong></p>
            <p class="text-left"> ACADEMIC YEAR: <strong><?= $data->academic_year; ?></strong></p>
            <p class="text-left">ENROLLMENT DATE : <strong><?= $data->enroll_time; ?></strong></p>
            <div class="sign main" style="padding-top: 60px; padding-right: 60px; float: right;">
                <h6> ____________________</h6>

                <h6>APPLICANT'S SIGNATURE</h6>
            </div>





            <div class="sign main" style="padding-top: 60px; ">
                <h6> ___________________</h6>

                <h6>PARENTS'S SIGN</h6>
                Application Printed on: <?= date("d-m-Y h:i:s")?>
            </div><br><br><br>
            <h5 class="text-right">SIGN OF THE HEAD OF
                INSTITUTION WITH SEAL</h5>
            <hr style="height :  2px;background-color :  black">
        </div>
        <div class="copyright text-center text-sm text-muted text-lg-start">
            ?? <?= date('Y'); ?> Software Developed <i class="text-danger fa fa-heart"></i> by
            <a href="https://www.roborosx.com" class="font-weight-bold text-primary text-decoration-none"
                target="_blank">RoborosX Omni Tech Solutions LLP </a>
        </div>
    </div>

</body>

</html>