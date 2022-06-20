<?php
require_once './views/header.php';
$app->setTitle("Quick Admission");
?>
<div class="card m-2">
    <div class="card-header">
        <span class="btn btn-info">Quick Admission</span>
    </div>
    <div class="card-body">
        <form action="<?=func::href('/QuickAdmissionController/new/'.uniqid())?>" method="post">
             <?= set_csrf(); ?>
            <h3 class="text-dark m-3">Student Details </h3>
            <div class="row">
                <div class="col-md-3">
                    <label for="student_name">Student Name</label><input class="form-control m-1" type="text"
                        name="student_name" id="student_name" />
                </div>
                <div class="col-md-3">
                    <label for="gender">Gender</label>
                    <select name="gender" class="form-control m-1">
                        <option value="">Select Gender</option>
                        <option value="BOY">BOY</option>
                        <option value="GIRL">GIRL</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dob">DOB</label><input class="form-control m-1" type="date" name="dob" id="dob" />
                </div>
                <div class="col-md-3">
                    <label for="studentaadhar">Student Aadhar No.</label><input class="form-control m-1" type="text"
                        name="studentaadhar" id="studentaadhar" />
                </div>
            </div>
            <h3 class="text-dark m-3">Parents Details </h3>
            <div class="row mb-1">
                <div class="col-md-6">
                    <label for="father_name">Father Name</label><input class="form-control m-1" type="text"
                        name="father_name" id="father_name" />
                </div>
                <div class="col-md-6">
                    <label for="father_number">Father Number</label><input class="form-control m-1" type="number"
                        name="father_number" id="father_number" />
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-6">
                    <label for="mother_name">Mother Name</label><input class="form-control m-1" type="text"
                        name="mother_name" id="mother_name" />
                </div>
                <div class="col-md-6">
                    <label for="mother_number">Mother Number</label><input class="form-control m-1" type="number"
                        name="mother_number" id="mother_number" />
                </div>
            </div>
            <h3 class="text-dark m-3">Residence Details </h3>
            <div class="row mb-1">
                <div class="col-md-6">
                    <label for="permanentaddress">Permanent Address</label>
                    <textarea name="permanentaddress" id="permanentaddress" cols="30" rows="5"
                        class="form-control m-1"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="temporaryaddress">Temporary Address</label>
                    <textarea name="temporaryaddress" id="temporaryaddress" cols="30" rows="5"
                        class="form-control m-1"></textarea>
                </div>
            </div>
            <h3 class="text-dark m-3">Academic Details </h3>
            <div class="row mb-1">
                <div class="col-sm">
                    <label for="medium_c">Medium</label>
                    <select name="medium_c" class="form-control m-1" id="">
                        <option value="">Select Medium</option>
                        <option value="ENGLISH" selected>ENGLISH</option>
                        <option value="KANNADA">KANNADA</option>
                        <option value="HINDI">HINDI</option>
                        <option value="URDU">URDU</option>
                        <option value="TAMIL">TAMIL</option>.0
                        <option value="TELUGU">TELUGU</option>
                        <option value="OTHERS">OTHERS</option>
                    </select>
                </div>
                <div class="col-sm">
                    <label for="sts_no">STS No</label><input class="form-control m-1" type="text" name="sts_no"
                        id="sts_no" />
                </div>
                <div class="col-sm">
                    <label for="academic_year">Academic Year</label>
                    <?= func::academicYear("academic_year"); ?>
                </div>

            </div>
            <div class="row mb-1">
                <div class="col-sm">
                    <label for="present_class">Present Class</label>
                    <?= func::classlist('present_class'); ?>
                </div>
                <div class="col-sm">
                    <label for="present_section">Present Section</label>
                    <?= func::sectionList('present_section'); ?>
                </div>
                <div class="col-sm">
                    <label for="">Admission Type : </label>
                    <?= func::getAdmissionType(); ?>
                </div>
            </div>
    
            <button class="btn btn-success btn-lg m-2" type="submit">Submit</button>
    </form> 
</div>
</div>
<?php   
    require_once './views/footer.php';
?>