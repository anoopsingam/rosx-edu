<?php
require_once './views/header.php';
$data = func::getStudentDetails(decrypt($ern));
$app->setTitle("Edit Admission | {$data->student_name}");
?>
<div class="card shadow-lg m-3">
    <div class="card-header">
        <button class="btn btn-primary">Edit Admission </button>
    </div>
    <div class="card-body">
        <form id="form1" name="form1" method="post" action="<?= func::href("/FullAdmissionController/edit/".$data->enrollment_no)?>">
        <?= set_csrf();?>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Student Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="studentid" value="<?= $data->studentid;?>" >
                        <div class="col-md-3">
                            <label for="student_name">Student Name</label><input class="form-control m-1" type="text"
                                name="student_name" value="<?= $data->student_name;?>" id="student_name" />
                        </div>
                        <div class="col-md-3">
                            <label for="gender">Gender</label>
                            <select name="gender"  class="form-control m-1">
                                <option value="<?= $data->gender;?>" selected><?= $data->gender;?> </option>
                                <option value="BOY">BOY</option>
                                <option value="GIRL">GIRL</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="dob">DOB</label><input class="form-control m-1" type="date" value="<?= $data->dob;?>" name="dob"
                                id="dob" />
                        </div>
                        <div class="col-md-3">
                            <label for="studentemail">Student E-mail</label><input class="form-control m-1" value="<?= $data->studentemail;?>" type="email"
                                name="studentemail" id="studentemail" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Father Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="father_name">Father Name</label><input class="form-control m-1" value="<?= $data->father_name;?>" type="text"
                                name="father_name" id="father_name" />
                        </div>
                        <div class="col-md-3">
                            <label for="fatheremail">Father E-mail</label><input class="form-control m-1" value="<?= $data->fatheremail;?>" type="email"
                                name="fatheremail" id="fatheremail" />
                        </div>
                        <div class="col-md-3">
                            <label for="fathereducation">Father Education</label><input class="form-control m-1" value="<?= $data->fathereducation;?>"
                                type="text"  name="fathereducation" id="fathereducation" />
                        </div>
                        <div class="col-md-3">
                            <label for="total_family">Total Members in Family</label><input class="form-control m-1" value="<?= $data->total_family;?>"
                                type="number" name="total_family" id="total_family" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="fatheroccupation">Father Occupation</label><input class="form-control m-1" value="<?= $data->fatheroccupation;?>"
                                type="text" name="fatheroccupation" id="fatheroccupation" />
                        </div>
                        <div class="col-md-4">
                            <label for="father_number">Father Number</label><input class="form-control m-1"  value="<?= $data->father_number;?>"
                                type="number" name="father_number" id="father_number" />
                        </div>
                        <div class="col-md-4">
                            <label for="father_income">Father Income</label><input class="form-control m-1" value="<?= $data->father_income;?>"
                                type="number" name="father_income" id="father_income" />
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
                            <label for="mother_name">Mother Name</label><input class="form-control m-1" type="text" value="<?= $data->mother_name;?>"
                                name="mother_name" id="mother_name" />
                        </div>
                        <div class="col-md-4">
                            <label for="mothereducation">Mother Education</label><input class="form-control m-1" value="<?= $data->mothereducation;?>"
                                type="text" name="mothereducation" id="mothereducation" />
                        </div>
                        <div class="col-md-4">
                            <label for="motheroccupation">Mother Occupation</label><input class="form-control m-1" value="<?= $data->motheroccupation;?>"
                                type="text" name="motheroccupation" id="motheroccupation" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="mother_income">Mother Income</label><input class="form-control m-1" value="<?= $data->mother_income;?>"
                                type="number" name="mother_income" id="mother_income" />
                        </div>
                        <div class="col-md-4">
                            <label for="mother_number">Mother Number</label><input class="form-control m-1" value="<?= $data->mother_number;?>"
                                type="number" name="mother_number" id="mother_number" />
                        </div>
                        <div class="col-md-4">
                            <label for="motheremail">Mother E-mail</label><input class="form-control m-1" type="email" value="<?= $data->motheremail;?>"
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
                            <label for="guardian_name">Guardian Name</label><input class="form-control m-1" type="text" value="<?= $data->guardian_name;?>"
                                name="guardian_name" id="guardian_name" />
                        </div>
                        <div class="col-md-3">
                            <label for="guardian_mobile">Guardian Mobile</label><input class="form-control m-1"     value="<?= $data->guardian_mobile;?>"
                                type="number" name="guardian_mobile" id="guardian_mobile" />
                        </div>
                        <div class="col-md-3">
                            <label for="guardianeducation">Guardian Education</label><input class="form-control m-1" value="<?= $data->guardianeducation;?>"
                                type="text" name="guardianeducation" id="guardianeducation" />
                        </div>
                        <div class="col-md-3">
                            <label for="guardian_income">Guardian Income</label><input class="form-control m-1" value="<?= $data->guardian_income;?>"
                                type="number" name="guardian_income" id="guardian_income" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="guardianemail">Guardian E-mail</label><input class="form-control m-1" value="<?= $data->guardianemail;?>"
                                type="email" name="guardianemail" id="guardianemail" />
                        </div>
                        <div class="col-md-4">
                            <label for="guardian_relation">Guardian Relation</label><input class="form-control m-1" value="<?= $data->guardian_relation;?>"
                                type="text" name="guardian_relation" id="guardian_relation" />
                        </div>
                        <div class="col-md-4">
                            <label for="guardianoccupation">Guardian Occupation</label><input class="form-control m-1" value="<?= $data->guardianoccupation;?>"
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
                            <textarea name="permanentaddress" id="permanentaddress" cols="30" rows="5" value=""
                                class="form-control m-1"><?= $data->permanentaddress;?></textarea>

                        </div>
                        <div class="col-md-4">
                            <label for="temporaryaddress">Temporary Address</label>
                            <textarea name="temporaryaddress" id="temporaryaddress" cols="30" rows="5" value=""
                                class="form-control m-1"><?= $data->temporaryaddress;?></textarea>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" onclick="copyAddress()" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Same as Permanent Address
                                </label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label for="guardianaddress">Guardian Address</label>
                            <textarea name="guardianaddress" id="guardianaddress" cols="30" rows="5" value=""
                                class="form-control m-1"><?= $data->guardianaddress;?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Other Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nationality">Nationality</label>
                            <select name="nationality" class="form-control m-1" id="">
                                <option value="<?= $data->nationality;?>" selected><?= $data->nationality;?>"</option>
                                <option value="INDIAN">INDIAN</option>
                                <option value="OTHERS">OTHERS</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="religion">Religion</label><select name="religion" class="form-control m-1"
                                id="">
                                <option value="<?= $data->religion;?>" selected> <?= $data->religion;?>"</option>
                                <option value="HINDU">HINDU</option>
                                <option value="MUSLIM">MUSLIM</option>
                                <option value="CHRISTIAN">CHRISTIAN</option>
                                <option value="BUDDHA">BUDDHA</option>
                                <option value="JAIN">JAIN</option>
                                <option value="OTHERS">OTHERS</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="caste">Caste</label><input class="form-control m-1" type="text" name="caste" value="<?= $data->caste;?>"
                                id="caste" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="subcaste">Subcaste</label><input class="form-control m-1" type="text" value="<?= $data->subcaste;?>"
                                name="subcaste" id="subcaste" />
                        </div>
                        <div class="col-md-4">
                            <label for="birthplace">Birthplace</label><input class="form-control m-1" type="text" value="<?= $data->birthplace;?>"
                                name="birthplace" id="birthplace" />
                        </div>
                        <div class="col-md-4">
                            <label for="taluk">Taluk</label><input class="form-control m-1" type="text" name="taluk" value="<?= $data->taluk;?>"
                                id="taluk" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="district">District</label><input class="form-control m-1" type="text" value="<?= $data->district;?>"
                                name="district" id="district" />
                        </div>
                        <div class="col-md-4">
                            <label for="village">Village</label><input class="form-control m-1" type="text" value="<?= $data->village;?>"
                                name="village" id="village" />
                        </div>
                        <div class="col-md-4">
                            <label for="mothertongue">Mother Tongue</label><input class="form-control m-1" type="text" value="<?= $data->mothertongue;?>"
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
                            <?= func::classlist("previousclass",[$data->previousclass=>(empty($data->previousclass))?"N/A":$data->previousclass.' std'])?> <br>
                            <label for="admissionclass">Admission Class</label>
                            <?= func::classlist("admissionclass",[$data->admissionclass=>(empty($data->admissionclass))?"N/A":$data->admissionclass.' std'])?>
                        </div>
                        <div class="col-md-4">
                            <label for="previousschool">Previous School</label><input class="form-control m-1"
                                type="text" name="previousschool" id="previousschool" /> <br>
                            <label for="medium_c">Medium</label>
                            <select name="medium_c" class="form-control m-1" id="">
                                <option value="<?= $data->medium_c;?>"><?= $data->medium_c;?></option>
                                <option value="ENGLISH" selected>ENGLISH</option>
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
                            <textarea name="previousschool_address" id="previousschool_address" cols="30" rows="6" value=""
                                class="form-control m-1"><?= $data->previousschool_address;?></textarea>

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
                            <label for="studentbank">Student Bank Name</label><input class="form-control" value="<?= $data->studentbank;?>"
                                type="text" name="studentbank" id="studentbank" />                                                                
                            </div>
                            <div class="col-md-4">
                                <label for="acc_no">Student Bank Account No.</label><input class="form-control" value="<?= $data->acc_no;?>"
                                    type="text" name="acc_no" id="acc_no" />
                                </div>
                                <div class="col-md-4">
                                <label for="ifsc">IFSC</label><input class="form-control" type="text" name="ifsc"
                                id="ifsc" value="<?= $data->ifsc;?>" />

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">                                
                                <label for="bankaddress">Bank Address</label>
                                <textarea name="bankaddress" class="form-control m-1" id="" cols="30" rows="5" value="" ><?= $data->bankaddress;?></textarea>
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
                                name="studentaadhar" id="studentaadhar" value="<?= $data->studentaadhar;?>" />
                        </div>
                        <div class="col-md-3">
                            <label for="fatheraadhar">Father Aadhar</label><input class="form-control m-1" type="text"
                                name="fatheraadhar" id="fatheraadhar" value="<?= $data->fatheraadhar;?>" />
                        </div>
                        <div class="col-md-3">
                            <label for="motheraadhar">Mother Aadhar</label><input class="form-control m-1" type="text"
                                name="motheraadhar" id="motheraadhar" value="<?= $data->motheraadhar;?>" />
                        </div>
                        <div class="col-md-3">
                            <label for="studentcastenumber">Student Caste Certificate No.</label><input
                                class="form-control m-1" type="text" name="studentcastenumber"
                                id="studentcastenumber" value="<?= $data->studentcastenumber;?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="studentincomenumber">Student Income Certificate No.</label><input
                                class="form-control m-1" type="text" name="studentincomenumber"
                                id="studentincomenumber" value="<?= $data->studentincomenumber;?>" />
                        </div>
                        <div class="col-md-3">
                            <label for="rationcard">Ration Card</label><input class="form-control m-1" type="text" 
                                name="rationcard" id="rationcard" value="<?= $data->rationcard;?>" />
                        </div>
                        <div class="col-md-3">
                            <label for="fathercastenumber">Father Caste Certificate No.</label><input
                                class="form-control m-1" type="text" name="fathercastenumber" id="fathercastenumber" value="<?= $data->fathercastenumber;?>" />
                        </div>
                        <div class="col-md-3">
                            <label for="fatherincomenumber">Father Income Certificate No.</label><input
                                class="form-control m-1" type="text" name="fatherincomenumber"
                                id="fatherincomenumber" value="<?= $data->fatherincomenumber;?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="mothercastenumber">Mother Caste Certificate No.</label><input
                                class="form-control m-1" type="text" name="mothercastenumber" id="mothercastenumber" value="<?= $data->mothercastenumber;?>" />
                        </div>
                        <div class="col-md-4">
                            <label for="motherincomenumber">Mother Income Certificate No.</label><input
                                class="form-control m-1" type="text" name="motherincomenumber"
                                id="motherincomenumber" value="<?= $data->motherincomenumber;?>" />
                        </div>
                        <div class="col-md-4">
                            <label for="birthcertificate">Birth Certificate</label><input class="form-control m-1"
                                type="text" name="birthcertificate" id="birthcertificate" value="<?= $data->birthcertificate;?>" />
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
                                type="date" name="admission_date" id="admission_date" value="<?= $data->admission_date;?>" />
                        </div>
                        <div class="col-md-4">
                            <label for="present_class">Present Class</label>
                            <?= func::classlist("present_class",[$data->present_class=>(empty($data->present_class))?"N/A":$data->present_class.' std']) ?>
                        </div>
                        <div class="col-md-4">
                            <label for="present_section">Present Section</label>
                            <?= func::sectionList("present_section",[$data->present_section=>(empty($data->present_section))?"N/A":$data->present_section]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="academic_year">Academic Year</label>
                            <?= func::academicYear("academic_year",[$data->academic_year=>(empty($data->academic_year))?"N/A":$data->academic_year]) ?>
                        </div>
                        <div class="col-md-4">
                            <label for="sts_no">STS No.</label><input class="form-control m-1" type="text" name="sts_no"
                                id="sts_no" value="<?= $data->sts_no;?>" />
                        </div>
                        <div class="col-md-4">
                            <label for="admission_no">Admission No.</label><input class="form-control m-1" type="text"
                                name="admission_no" id="admission_no" value="<?= $data->admission_no;?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Office Related Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="remarks">Remarks</label>                                
                            <textarea name="remarks" class="form-control m-1" id="" cols="30" rows="5" value="" ><?= $data->remarks;?></textarea>

                        </div>
                        <div class="col-md-4">
                            <label for="status">Status</label>
                            <select name="status" class="form-control m-1" id="">
                                <option value="<?= $data->status;?>"><?= $data->status;?></option>
                                <option value="WAITING">WAITING</option>
                                <option value="APPROVED">APPROVED</option>
                                <option value="REJECTED">REJECTED</option>
                                <option value="TC ISSUED">TC_ISSUED</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                    <label for="">Admission Type : </label>
                    <?= func::getAdmissionType('',[$data->admission_type=>$data->admission_type]); ?>
                </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-warning">Update Student</button>
        </form>
    </div>
</div>
<?php   
    require_once './views/footer.php';
?>