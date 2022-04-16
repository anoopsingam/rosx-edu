<?php
require_once './views/header.php';
$app->setTitle("New Admission");
?>
<div class="card shadow-lg m-3">
    <div class="card-header">
        <button class="btn btn-primary">New Admission</button>
    </div>
    <div class="card-body">
        <form id="form1" name="form1" method="post" action="admission.php">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-dark">Student Details </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="student_name">Student Name</label><input class="form-control m-1" type="text"
                                name="student_name" id="student_name" />
                        </div>
                        <div class="col-md-3">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control m-1">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="dob">DOB</label><input class="form-control m-1" type="date" name="dob"
                                id="dob" />
                        </div>
                        <div class="col-md-3">
                            <label for="studentemail">Student E-mail</label><input class="form-control m-1" type="email"
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
                            <label for="father_name">Father Name</label><input class="form-control m-1" type="text"
                                name="father_name" id="father_name" />
                        </div>
                        <div class="col-md-3">
                            <label for="fatheremail">Father E-mail</label><input class="form-control m-1" type="email"
                                name="fatheremail" id="fatheremail" />
                        </div>
                        <div class="col-md-3">
                            <label for="fathereducation">Father Education</label><input class="form-control m-1"
                                type="text" name="fathereducation" id="fathereducation" />
                        </div>
                        <div class="col-md-3">
                            <label for="total_family">Total Members in Family</label><input class="form-control m-1"
                                type="number" name="total_family" id="total_family" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="fatheroccupation">Father Occupation</label><input class="form-control m-1"
                                type="text" name="fatheroccupation" id="fatheroccupation" />
                        </div>
                        <div class="col-md-4">
                            <label for="father_number">Father Number</label><input class="form-control m-1"
                                type="number" name="father_number" id="father_number" />
                        </div>
                        <div class="col-md-4">
                            <label for="father_income">Father Income</label><input class="form-control m-1"
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
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
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
                            <textarea name="previousschool_address" id="previousschool_address" cols="30" rows="5"
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
                        <div class="col-md-6">
                            <label for="studentbank">Student Bank Name</label><input class="form-control m-1"
                                type="text" name="studentbank" id="studentbank" />
                        </div>
                        <div class="col-md-6">
                            <label for="acc_no">Student Bank Account No.</label><input class="form-control m-1"
                                type="text" name="acc_no" id="acc_no" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="ifsc">IFSC</label><input class="form-control m-1" type="text" name="ifsc"
                                id="ifsc" />
                        </div>
                        <div class="col-md-6">
                            <label for="bankaddress">Bank Address</label><input class="form-control m-1" type="text"
                                name="bankaddress" id="bankaddress" />
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
                                type="text" name="admission_date" id="admission_date" />
                        </div>
                        <div class="col-md-4">
                            <label for="present_class">Present Class</label><input class="form-control m-1" type="text"
                                name="present_class" id="present_class" />
                        </div>
                        <div class="col-md-4">
                            <label for="present_section">Present Section</label><input class="form-control m-1"
                                type="text" name="present_section" id="present_section" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="academic_year">Academic Year</label><input class="form-control m-1" type="text"
                                name="academic_year" id="academic_year" />
                        </div>
                        <div class="col-md-4">
                            <label for="sts_no">STS No</label><input class="form-control m-1" type="text" name="sts_no"
                                id="sts_no" />
                        </div>
                        <div class="col-md-4">
                            <label for="admission_no">Admission No.</label><input class="form-control m-1" type="text"
                                name="admission_no" id="admission_no" />
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
                            <label for="remarks">Remarks</label><input class="form-control m-1" type="text"
                                name="remarks" id="remarks" />
                        </div>
                        <div class="col-md-4">
                            <label for="status">Status</label><input class="form-control m-1" type="text" name="status"
                                id="status" />
                        </div>
                        <div class="col-md-4">
                            <label for="login_id">Login Id</label><input class="form-control m-1" type="text"
                                name="login_id" id="login_id" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php   
    require_once './views/footer.php';
?>