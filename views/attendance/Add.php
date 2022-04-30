<?php
require_once './views/header.php';
$app->setTitle("Add Attendance ".date("d-m-Y"));
?>

<div class="card shadow-lg m-3 p-2">
    <div class="card-header card-title ">
        <h3 class="text-left text-gradient text-dark m-1 p-1">Add Attendance</h3>
    </div>
    <div class="card-body">
        <form action="/Attendance/View/Students" method="POST">
            <div class="row">
            <div class="col-lg-4">
                    <label>Date : </label>
                    <input type="date" name="att_date" class="form-control" value="<?php echo date("Y-m-d")?>" required/>
                </div>
                <div class="col-lg-4">
                    <label>Class : </label>
                    <?=func::classlist("class");?>
                </div>
                <div class="col-lg-4">
                    <label for="">Academic Year</label>
                    <?= func::academicYear("academic_year")?>
                </div>
            </div>
            <center>
                <button type="submit" name="sub_fee" class="btn bg-gradient-primary btn-md rounded-2 m-4">Get List</button>
            </center>
        </form>
    </div>
</div>
<?php   
    require_once './views/footer.php';
?>