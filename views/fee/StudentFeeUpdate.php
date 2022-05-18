<?php
require_once './views/header.php';
$app->setTitle('Student Fee Update');
?>
<div class="card mt-3">
    <div class="card-header">
        <a href="/" class="btn btn-dark btn-sm">Back</a>
        <br>
        <span class="btn bg-gradient-primary btn-lg">Student Fee Update</span>
    </div>
    <div class="card-body">
        <h5 class="text-center">Please Perform this operation after generating 1st Receipt only </h5>
       <form action="" method="post">
       <div class="row mt-3">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <label for=""><h5 >Transaction Id</h5> </label><br>
                <small><b>Note !</b> Please Insert only 1st Bill Transaction Id </small>
                <input type="text" class="form-control" id="transaction_id" name="transaction_id"
                    placeholder="Transaction Id">
            </div>
            <div class="col-md-4"></div>
        </div>
        <center>
            <button type="submit" name="get_info" class="btn bg-gradient-info mt-4">Get Info</button>
        </center>
       </form>
    </div>
</div>
<?php 
    if(isset($_POST['get_info'])){
        $trans_id=mysqli_real_escape_string($db->conn,$_POST['transaction_id']);
        $data=func::getFeeTransactionDetails($trans_id);

        if($data['installment']=="INSTALLMENT-1"){
                $student_id=$data['studentid'];
                $academic_year=$data['ay'];
                $total_fee=$data['total_fee'];
                ?>
                <div class="card mt-3">
                    <div class="card-header">
                        <span class="h4"><?= $trans_id?> Details </span>
                    </div>
                    <div class="card-body">
                        <form action="<?= func::href("/Transaction/StudentFeeUpdate/Save/$trans_id")?>" method="post">
                        <?= set_csrf();?>
                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Student Name : 
                                        <b><?= $data['student_name']?></b>
                                    </h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Class Section : 
                                        <b><?= $data['present_class'].' '.$data['present_section']?></b>
                                    </h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>
                                        Enrollment No : 
                                        <b><?= $data['enrollment_no']?></b>
                                    </h5>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="">Student Id </label>
                                    <input type="text" class="form-control" id="student_id" name="student_id"
                                        value="<?php echo $student_id; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Academic Year </label>
                                    <input type="text" class="form-control" id="academic_year" name="academic_year"
                                        value="<?php echo $academic_year; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Total Fee </label>
                                    <input type="text" class="form-control" id="total_fee" name="total_fee"
                                        value="<?php echo $total_fee; ?>" >
                                </div>
                            </div>
                            <center>
                                <button type="submit" name="update_fee" class="btn bg-gradient-danger mt-4">Update Fee</button>
                            </center>
                        </form>
                <?php

        }else{
            js::alert("The Editing of Fee is Restricted for $data[student_name] ... Contact Technical team ..");
            js::redirect("/Transaction/StudentFeeUpdate/".uniqid());
        }
    }

?>

<?php
    require_once './views/footer.php';
?>