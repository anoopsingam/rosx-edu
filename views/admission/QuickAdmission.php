<?php
require_once './views/header.php';
$app->setTitle("Quick Admission");
?>
<div class="card m-2">
    <div class="card-header">
        <span class="btn btn-info">Quick Admission</span>
    </div>
    <div class="card-body">
        <form action="<?=func::href('/QuickAdmissionController/new')?>" method="post">
        <h3 class="text-dark m-3">Student Details </h3>
            <div class="row">
                <div class="col-md-4">
                    <label for="student_name">Student Name</label><input class="form-control m-1" type="text"
                        name="student_name" id="student_name" />
                </div>
                <div class="col-md-4">
                    <label for="gender">Gender</label>
                    <select name="gender" class="form-control m-1">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="dob">DOB</label><input class="form-control m-1" type="date" name="dob" id="dob" />
                </div>
                <h3 class="text-dark m-3">Parents Details </h3>
                <div class="row">
                <div class="col-md-3">
                            <label for="father_name">Father Name</label><input class="form-control m-1" type="text"
                                name="father_name" id="father_name" />
                        </div>
                        <div class="col-md-4">
                            <label for="father_number">Father Number</label><input class="form-control m-1"
                                type="number" name="father_number" id="father_number" />
                        </div>
                        <div class="col-md-4">
                            <label for="mother_name">Mother Name</label><input class="form-control m-1" type="text"
                                name="mother_name" id="mother_name" />
                        </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php   
    require_once './views/footer.php';
?>