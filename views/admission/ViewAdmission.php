<?php
require '././config.php';
$app=new app();
$db=new database();
$data=func::getStudentDetails(decrypt($ern));
// print_r($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">          
              <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 

            <!-- Popper JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <style>
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
                tr{
                    border-width: 10px;
                }
                .table-bordered {
                    border-width: 2px;
                    border-color: black;
                }
                table{
                    overflow: scroll;
                }
                @media print {
                    footer {
                        page-break-after: always;
                    }
                }
                body {
                    font-family: 'Ubuntu', sans-serif;
                }
            </style>
    <?= $app->setTitle("View Admission -".$data->enrollment_no);?>
    
</head>
<body>
    <div class="container-fluid">
        <div class="row text-center mt-5">
            <div class="col-md-2">
                <?= $app->SetLogo('160','160');?>
            </div>
            <div class="col-md-8">
                <h3 class="display-4 font-weigth-bolder"><?= $app->name;?> </h3>
                <h6 class=""><?= $app->address;?> </h6>
                <h6 class=""><?= "Contact No : ".$app->phone.'   Email : '.$app->email;?> </h6>
                <br>
                <h4 class="m-3 text-uppercase">Admission Acknowledgement</h4>
                <!--<h6 class="h6">Contact No:  E-Mail:</h6>-->
            </div>
            <div class="col-md-2">

            </div>
        </div>
        
        <div class="cad m-3">
           
            <div class="crd-body">
            <table class="table table-bordered text-center">
                <tr>
                    <td>
                        <h5 class="mt-5">Application No : <span class="text-danger h4"><?= $data->app_no?></span> </h5>
                    </td>
                    <td>
                        <h5 class="mt-2">Enrollment No : <br>
                            <p class="m-3"> <?= includes::barcode($data->enrollment_no)?></p>
                        </h5>
                    </td>
                </tr>
            </table>
            <h4 style="float: center ;">STUDENT DETAILS</h4>
                <table class="table table-bordered " >
                    <tr>
                        <td class="text-danger">APPLICATION NO. : <br><strong></strong> </td>

                        <td>STUDENT NAME : <br><strong>AALIYA</strong></td>
                        <td> <img class="logo" src="student_pics/" width="130px" height="130px" alt="AALIYA" srcset="">
                        </td>
                        <td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Studentid=S20210813 Enrollment No= Admission Date=2021-09-22 13:54:43 Date of Printing=19-04-2022" alt="AALIYA" srcset=""></td>

                    </tr>
                    <tr>
                        <td>STUDENT ID : <br><strong>S20210813</strong> </td>

                        <td>
                            <label>GENDER : </label>

                            <br><strong></strong>
                        </td>

                        <td>MAIL ID : <br><strong></strong> </td>
                        <td>DATE OF BIRTH: <br><strong></strong></td>
                    </tr>
                </table>
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="text-dark">Student Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3  ">
                            <label for="student_name">Student Name</label>
                            <h5><?= $data->student_name?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="gender">Gender</label>
                            <h5><?= $data->gender?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="dob">DOB</label>
                            <h5><?= $data->dob?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="studentemail">Student E-mail</label>
                            <h5><?= $data->studentemail?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" mb-5">
                <div class="card-header">
                    <h3 class="text-dark">Parents  Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3  ">
                            <label for="father_name">Father Name</label>
                            <h5><?= $data->father_name?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="fatheremail">Father E-mail</label>
                            <h5><?= $data->fatheremail?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="fathereducation">Father Education</label>
                            <h5><?= $data->fathereducation?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="total_family">Total Members in Family</label>
                            <h5><?= $data->total_family?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3  ">
                            <label for="fatheroccupation">Father Occupation</label>
                            <h5><?= $data->fatheroccupation?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="father_number">Father Number</label>
                            <h5><?= $data->father_number?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="father_income">Father Income</label><h5><?= $data->father_income?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3  ">
                            <label for="mother_name">Mother Name</label>                            
                            <h5><?= $data->mother_name?></h5>

                        </div>
                        <div class="col-md-3  ">
                            <label for="mothereducation">Mother Education</label>                            
                            <h5><?= $data->mothereducation?></h5>

                        </div>
                        <div class="col-md-3  ">
                            <label for="motheroccupation">Mother Occupation</label>
                            <h5><?= $data->motheroccupation?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="mother_income">Mother Income</label>
                            <h5><?= $data->mother_income?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3  ">
                            <label for="mother_number">Mother Number</label>
                            <h5><?= $data->mother_number?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="motheremail">Mother E-mail</label>
                            <h5><?= $data->motheremail?></h5>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="card mb-5 page-break">
                <div class="card-header">
                    <h3 class="text-dark">Guardian Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3  ">
                            <label for="guardian_name">Guardian Name</label>
                            <h5><?= $data->guardian_name?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="guardian_mobile">Guardian Mobile</label>
                            <h5><?= $data->guardian_mobile?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="guardianeducation">Guardian Education</label>
                            <h5><?= $data->guardianeducation?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="guardian_income">Guardian Income</label>
                            <h5><?= $data->guardian_income?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4  ">
                            <label for="guardianemail">Guardian E-mail</label>
                            <h5><?= $data->guardianemail?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="guardian_relation">Guardian Relation</label>
                            <h5><?= $data->guardian_relation?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="guardianoccupation">Guardian Occupation</label>
                            <h5><?= $data->guardianoccupation?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="text-dark">Address Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4  ">
                            <label for="permanentaddress">Permanent Address</label>
                            <h5><?= $data->permanentaddress?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="temporaryaddress">Temporary Address</label>
                            <h5><?= $data->temporaryaddress?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="guardianaddress">Guardian Address</label>
                            <h5><?= $data->guardianaddress?></h5>
                       </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="text-dark">Misc Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4  ">
                            <label for="nationality">Nationality</label>
                            <h5><?= $data->nationality?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="religion">Religion</label>
                            <h5><?= $data->religion?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="caste">Caste</label>
                            <h5><?= $data->caste?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4  ">
                            <label for="subcaste">Subcaste</label>
                            <h5><?= $data->subcaste?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="birthplace">Birthplace</label>
                            <h5><?= $data->birthplace?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="taluk">Taluk</label>
                            <h5><?= $data->taluk?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4  ">
                            <label for="district">District</label>
                            <h5><?= $data->district?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="village">Village</label>
                            <h5><?= $data->village?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="mothertongue">Mother Tongue</label>
                            <h5><?= $data->mothertongue?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="text-dark">Previous School Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4  ">
                            <label for="previousclass">Previous Class</label>
                            <h5><?= $data->previousclass?></h5>
                            <label for="admissionclass">Admission Class</label>
                            <h5><?= $data->admissionclass?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="previousschool">Previous School</label>
                            <h5><?= $data->previousschool?></h5>
                            <label for="medium_c">Medium</label>
                            <h5><?= $data->medium_c?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="previousschool_address">Previous School Address</label>
                            <h5><?= $data->previousschool_address?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="text-dark">Bank Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4  ">
                            <label for="studentbank">Student Bank Name</label>
                            <h5><?= $data->studentbank?></h5>
                            </div>
                            <div class="col-md-4  ">
                                <label for="acc_no">Student Bank Account No.</label>
                                <h5><?= $data->acc_no?></h5>
                                </div>
                                <div class="col-md-4  ">
                                <label for="ifsc">IFSC</label>
                                <h5><?= $data->ifsc?></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">                                
                                <label for="bankaddress">Bank Address</label>
                                <h5><?= $data->bankaddress?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5 page-break" style="page-break-after: always;">
                <div class="card-header">
                    <h3 class="text-dark">Required Document Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3  ">
                            <label for="studentaadhar">Student Aadhar</label>
                            <h5><?= $data->studentaadhar?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="fatheraadhar">Father Aadhar</label>
                            <h5><?= $data->fatheraadhar?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="motheraadhar">Mother Aadhar</label>
                            <h5><?= $data->motheraadhar?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="studentcastenumber">Student Caste Certificate No.</label>
                            <h5><?= $data->studentcastenumber?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3  ">
                            <label for="studentincomenumber">Student Income Certificate No.</label>
                            <h5><?= $data->studentincomenumber?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="rationcard">Ration Card</label>
                            <h5><?= $data->rationcard?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="fathercastenumber">Father Caste Certificate No.</label>
                            <h5><?= $data->fathercastenumber?></h5>
                        </div>
                        <div class="col-md-3  ">
                            <label for="fatherincomenumber">Father Income Certificate No.</label>
                            <h5><?= $data->fatherincomenumber?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4  ">
                            <label for="mothercastenumber">Mother Caste Certificate No.</label>
                            <h5><?= $data->mothercastenumber?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="motherincomenumber">Mother Income Certificate No.</label>
                            <h5><?= $data->motherincomenumber?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="birthcertificate">Birth Certificate</label>
                            <h5><?= $data->birthcertificate?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="text-dark">Current Admission Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4  ">
                            <label for="admission_date">Admission Date</label>
                            <h5><?= $data->admission_date?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="present_class">Present Class</label>
                            <h5><?= $data->present_class?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="present_section">Present Section</label>
                            <h5><?= $data->present_section?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4  ">
                            <label for="academic_year">Academic Year</label>
                            <h5><?= $data->academic_year?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="sts_no">STS No.</label>
                            <h5><?= $data->sts_no?></h5>
                        </div>
                        <div class="col-md-4  ">
                            <label for="admission_no">Admission No.</label>
                            <h5><?= $data->admission_no?></h5>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>