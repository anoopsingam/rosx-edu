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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                <!--<h6 class="h6">Contact No:  E-Mail:</h6>-->
            </div>
            <div class="col-md-2">

            </div>
        </div>
        <div class="card m-3">
            <div class="card-header text-center bg-warning text-dark">
                <h4 class="m-3 text-uppercase">Admission Acknowledgement</h4>
            </div>
            <div class="card-body">
            <table class="table table-border text-center">
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
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Student Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="student_name">Student Name</label>
                            <h5><?= $data->student_name?></h5>
                        </div>
                        <div class="col-md-3">
                            <label for="gender">Gender</label>
                            <h5><?= $data->gender?></h5>
                        </div>
                        <div class="col-md-3">
                            <label for="dob">DOB</label>
                            <h5><?= $data->dob?></h5>
                        </div>
                        <div class="col-md-3">
                            <label for="studentemail">Student E-mail</label>
                            <h5><?= $data->studentemail?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Father Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="father_name">Father Name</label>
                            <h5><?= $data->father_name?></h5>
                        </div>
                        <div class="col-md-3">
                            <label for="fatheremail">Father E-mail</label>
                            <h5><?= $data->fatheremail?></h5>
                        </div>
                        <div class="col-md-3">
                            <label for="fathereducation">Father Education</label>
                            <h5><?= $data->fathereducation?></h5>
                        </div>
                        <div class="col-md-3">
                            <label for="total_family">Total Members in Family</label>
                            <h5><?= $data->total_family?></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="fatheroccupation">Father Occupation</label>
                            <h5><?= $data->fatheroccupation?></h5>
                        </div>
                        <div class="col-md-4">
                            <label for="father_number">Father Number</label><h5><?= $data->father_number?></h5>
                        </div>
                        <div class="col-md-4">
                            <label for="father_income">Father Income</label><h5><?= $data->father_income?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Mother Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="mother_name">Mother Name</label><input class="form-control m-1" type="text"
                                name="mother_name" id="mother_name" />
                        </div>
                        <div class="col-md-4">
                            <label for="mothereducation">Mother Education</label><input class="form-control m-1"
                                type="text" name="mothereducation" id="mothereducation" />
                        </div>
                        <div class="col-md-4">
                            <label for="motheroccupation">Mother Occupation</label><input class="form-control m-1"
                                type="text" name="motheroccupation" id="motheroccupation" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="mother_income">Mother Income</label><input class="form-control m-1"
                                type="number" name="mother_income" id="mother_income" />
                        </div>
                        <div class="col-md-4">
                            <label for="mother_number">Mother Number</label><input class="form-control m-1"
                                type="number" name="mother_number" id="mother_number" />
                        </div>
                        <div class="col-md-4">
                            <label for="motheremail">Mother E-mail</label><input class="form-control m-1" type="email"
                                name="motheremail" id="motheremail" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Guardian Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="guardian_name">Guardian Name</label><input class="form-control m-1" type="text"
                                name="guardian_name" id="guardian_name" />
                        </div>
                        <div class="col-md-3">
                            <label for="guardian_mobile">Guardian Mobile</label><input class="form-control m-1"
                                type="number" name="guardian_mobile" id="guardian_mobile" />
                        </div>
                        <div class="col-md-3">
                            <label for="guardianeducation">Guardian Education</label><input class="form-control m-1"
                                type="text" name="guardianeducation" id="guardianeducation" />
                        </div>
                        <div class="col-md-3">
                            <label for="guardian_income">Guardian Income</label><input class="form-control m-1"
                                type="number" name="guardian_income" id="guardian_income" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="guardianemail">Guardian E-mail</label><input class="form-control m-1"
                                type="email" name="guardianemail" id="guardianemail" />
                        </div>
                        <div class="col-md-4">
                            <label for="guardian_relation">Guardian Relation</label><input class="form-control m-1"
                                type="text" name="guardian_relation" id="guardian_relation" />
                        </div>
                        <div class="col-md-4">
                            <label for="guardianoccupation">Guardian Occupation</label><input class="form-control m-1"
                                type="text" name="guardianoccupation" id="guardianoccupation" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Address Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="permanentaddress">Permanent Address</label>
                            <textarea name="permanentaddress" id="permanentaddress" cols="30" rows="5"
                                class="form-control m-1"></textarea>

                        </div>
                        <div class="col-md-4">
                            <label for="temporaryaddress">Temporary Address</label>
                            <textarea name="temporaryaddress" id="temporaryaddress" cols="30" rows="5"
                                class="form-control m-1"></textarea>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" onclick="copyAddress()" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Same as Permanent Address
                                </label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label for="guardianaddress">Guardian Address</label>
                            <textarea name="guardianaddress" id="guardianaddress" cols="30" rows="5"
                                class="form-control m-1"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Misc Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nationality">Nationality</label>
                            <select name="nationality" class="form-control m-1" id="">
                                <option value="">Select Nationality</option>
                                <option value="INDIAN">INDIAN</option>
                                <option value="OTHERS">OTHERS</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="religion">Religion</label><select name="religion" class="form-control m-1"
                                id="">
                                <option value="">Select religion</option>
                                <option value="HINDU">HINDU</option>
                                <option value="MUSLIM">MUSLIM</option>
                                <option value="CHRISTIAN">CHRISTIAN</option>
                                <option value="BUDDHA">BUDDHA</option>
                                <option value="JAIN">JAIN</option>
                                <option value="OTHERS">OTHERS</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="caste">Caste</label><input class="form-control m-1" type="text" name="caste"
                                id="caste" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="subcaste">Subcaste</label><input class="form-control m-1" type="text"
                                name="subcaste" id="subcaste" />
                        </div>
                        <div class="col-md-4">
                            <label for="birthplace">Birthplace</label><input class="form-control m-1" type="text"
                                name="birthplace" id="birthplace" />
                        </div>
                        <div class="col-md-4">
                            <label for="taluk">Taluk</label><input class="form-control m-1" type="text" name="taluk"
                                id="taluk" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="district">District</label><input class="form-control m-1" type="text"
                                name="district" id="district" />
                        </div>
                        <div class="col-md-4">
                            <label for="village">Village</label><input class="form-control m-1" type="text"
                                name="village" id="village" />
                        </div>
                        <div class="col-md-4">
                            <label for="mothertongue">Mother Tongue</label><input class="form-control m-1" type="text"
                                name="mothertongue" id="mothertongue" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Previous School Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="previousclass">Previous Class</label>
                            <?= func::classlist("previousclass")?> <br>
                            <label for="admissionclass">Admission Class</label>
                            <?= func::classlist("admissionclass")?>
                        </div>
                        <div class="col-md-4">
                            <label for="previousschool">Previous School</label><input class="form-control m-1"
                                type="text" name="previousschool" id="previousschool" /> <br>
                            <label for="medium_c">Medium</label>
                            <select name="medium_c" class="form-control m-1" id="">
                                <option value="">Select Medium</option>
                                <option value="ENGLISH">ENGLISH</option>
                                <option value="KANNADA">KANNADA</option>
                                <option value="HINDI">HINDI</option>
                                <option value="URDU">URDU</option>
                                <option value="TAMIL">TAMIL</option>.0
                                <option value="TELUGU">TELUGU</option>
                                <option value="OTHERS">OTHERS</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="previousschool_address">Previous School Address</label>
                            <textarea name="previousschool_address" id="previousschool_address" cols="30" rows="6"
                                class="form-control m-1"></textarea>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Bank Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="studentbank">Student Bank Name</label><input class="form-control"
                                type="text" name="studentbank" id="studentbank" />                                                                
                            </div>
                            <div class="col-md-4">
                                <label for="acc_no">Student Bank Account No.</label><input class="form-control"
                                type="text" name="acc_no" id="acc_no" />
                                </div>
                                <div class="col-md-4">
                                <label for="ifsc">IFSC</label><input class="form-control" type="text" name="ifsc"
                                id="ifsc" />

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">                                
                                <label for="bankaddress">Bank Address</label>
                                <textarea name="bankaddress" class="form-control m-1" id="" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Required Document Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="studentaadhar">Student Aadhar</label><input class="form-control m-1" type="text"
                                name="studentaadhar" id="studentaadhar" />
                        </div>
                        <div class="col-md-3">
                            <label for="fatheraadhar">Father Aadhar</label><input class="form-control m-1" type="text"
                                name="fatheraadhar" id="fatheraadhar" />
                        </div>
                        <div class="col-md-3">
                            <label for="motheraadhar">Mother Aadhar</label><input class="form-control m-1" type="text"
                                name="motheraadhar" id="motheraadhar" />
                        </div>
                        <div class="col-md-3">
                            <label for="studentcastenumber">Student Caste Certificate No.</label><input
                                class="form-control m-1" type="text" name="studentcastenumber"
                                id="studentcastenumber" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="studentincomenumber">Student Income Certificate No.</label><input
                                class="form-control m-1" type="text" name="studentincomenumber"
                                id="studentincomenumber" />
                        </div>
                        <div class="col-md-3">
                            <label for="rationcard">Ration Card</label><input class="form-control m-1" type="text"
                                name="rationcard" id="rationcard" />
                        </div>
                        <div class="col-md-3">
                            <label for="fathercastenumber">Father Caste Certificate No.</label><input
                                class="form-control m-1" type="text" name="fathercastenumber" id="fathercastenumber" />
                        </div>
                        <div class="col-md-3">
                            <label for="fatherincomenumber">Father Income Certificate No.</label><input
                                class="form-control m-1" type="text" name="fatherincomenumber"
                                id="fatherincomenumber" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="mothercastenumber">Mother Caste Certificate No.</label><input
                                class="form-control m-1" type="text" name="mothercastenumber" id="mothercastenumber" />
                        </div>
                        <div class="col-md-4">
                            <label for="motherincomenumber">Mother Income Certificate No.</label><input
                                class="form-control m-1" type="text" name="motherincomenumber"
                                id="motherincomenumber" />
                        </div>
                        <div class="col-md-4">
                            <label for="birthcertificate">Birth Certificate</label><input class="form-control m-1"
                                type="text" name="birthcertificate" id="birthcertificate" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Current Admission Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="admission_date">Admission Date</label><input class="form-control m-1"
                                type="date" name="admission_date" id="admission_date" />
                        </div>
                        <div class="col-md-4">
                            <label for="present_class">Present Class</label>
                            <?= func::classlist("present_class") ?>
                        </div>
                        <div class="col-md-4">
                            <label for="present_section">Present Section</label>
                            <?= func::sectionList("present_section") ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="academic_year">Academic Year</label>
                            <?= func::academicYear("academic_year") ?>
                        </div>
                        <div class="col-md-4">
                            <label for="sts_no">STS No.</label><input class="form-control m-1" type="text" name="sts_no"
                                id="sts_no" />
                        </div>
                        <div class="col-md-4">
                            <label for="admission_no">Admission No.</label><input class="form-control m-1" type="text"
                                name="admission_no" id="admission_no" />
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </div>
    </div>

</body>

</html>