<?php
require_once './views/header.php';
$app->setTitle("Transport Billing - ".$_POST['studentid']);
$stu_id=mysqli_real_escape_string($db->conn,$_POST['studentid']);
$academic_year=mysqli_real_escape_string($db->conn,$_POST['ay']);
if(empty($stu_id) || empty($academic_year)){
    js::alert("Please select a student and academic year");
    js::redirect("/Transport/Billing/new");
}else{
$sql="SELECT * FROM transport_enroll e 
       LEFT JOIN student_enrollment s ON e.enroll_student_id=s.studentid
        LEFT JOIN transport_stages t ON e.enroll_stage_id=t.route_stage_id 
        LEFT JOIN transport_routes r ON t.stage_route_id =r.route_id 
        LEFT JOIN transport_bus b ON r.route_bus_id = b.db_id WHERE e.enroll_student_id='$stu_id' and e.enroll_academic_year='$academic_year' ";
$fetch=mysqli_query($db->conn,$sql);
$data=mysqli_fetch_assoc($fetch);
// print_r($data);
if(empty($data['enroll_id'])){
    js::alert("No data found for this student");
    js::redirect("/Transport/Billing/new");
}
$last_trans=mysqli_query($db->conn," SELECT SUM(trans_discount) AS total_discount from transport_transaction WHERE trans_student_id='$data[studentid]' AND trans_enroll_id='$data[enroll_id]'");
$ltd=mysqli_fetch_object($last_trans);
$total_dicount=(empty($ltd->total_discount))?0:$ltd->total_discount;
$acc_data=mysqli_query($db->conn,"SELECT * FROM transport_account WHERE acc_student_id='$stu_id' and acc_academic_year='$academic_year'");
$acc_data=mysqli_fetch_assoc($acc_data);
$paid_amount=(empty($acc_data['acc_paid']))?0:$acc_data['acc_paid'];
$balance_amount=$data['route_stage_fare']-$paid_amount-$total_dicount;
}
?>
<div class="card shadow-lg m-3">
    <div class="card-header">
        <button class="btn btn-danger">Transport Service Billing </button>
    </div>
    <div class="card-body">
    <form action="/Transport/Billing/Save/<?= $token_id?>" method="post">
    <?= set_csrf();?>
        <h6>Student Details : </h6>    
    <div class="row mt-3">
        <div class="col-sm">
            <label for="">Student Id </label>
            <input type="text" name="student_id" class="form-control" value="<?= $data['enroll_student_id']?>" readonly>
        </div>
            <div class="col-sm">
                <label for="">Student Name : </label>
                <input type="text" name="student_name" class="form-control" value="<?= $data['student_name']?>" readonly>
            </div>
            <div class="col-sm">
                <label for="">Present Class : </label>
                <input type="text" name="present_class" class="form-control" value="<?= $data['present_class']?>" readonly>
            </div>
            <div class="col-sm">
                <label for="">Present Section : </label>
                <input type="text" name="present_section" class="form-control" value="<?= $data['present_section']?>" readonly>
            </div>
        </div>
        <h6>
            Transport Details :
        </h6>
        <div class="row mt-3">
                <div class="col-sm">
                    <label for="">Route Name : </label>
                    <input type="text" name="route_name" class="form-control" value="<?= $data['route_name']?>" readonly>
                </div>
                <div class="col-sm">
                    <label for="">Bus Name : </label>
                    <input type="text" name="bus_name" class="form-control" value="<?= $data['bus_name']?>" readonly>
                </div>
                <div class="col-sm">
                    <input type="hidden" name="enroll_id" value="<?= $data['enroll_id']?>">
                    <label for="">Stage Name : </label>
                    <input type="text" name="stage_name" class="form-control" value="<?= $data['route_stage_name']?>" readonly>
                </div>
                <div class="col-sm">
                    <label for="">Stage Fare :</label>
                    <input type="text" name="stage_fare" id="stage_fare" class="form-control" value="<?= $data['route_stage_fare']?>" readonly>
                </div>
                <div class="col-sm">
                    <label for="">Enrolled Academic Year :</label>
                    <input type="text" name="enroll_ay"  class="form-control" value="<?= $data['enroll_academic_year']?>" readonly>
                </div>
        </div>
        <h6>Payment Detials : </h6>
        <div class="row mt-3">
            <div class="col-sm">
                <label for="">Paid Amount : </label>
                <input type="text" name="paid_amount" class="form-control" value="<?= $paid_amount?>" readonly>
            </div>
            <div class="col-sm">
                <label for="">Balance Amount : </label>
                <input type="text" name="balance_amount" id="balance_amount" class="form-control" value="<?= $balance_amount?>" readonly>
            </div>
            <div class="col-sm">
                <label for="">Payment Mode : </label>
                <select name="payment_mode" id="" class="form-control">
                    <option value="" selected disabled>Select Payment Mode</option>
                    <option value="Cash">Cash</option>
                    <option value="Cheque">Cheque</option>
                    <option value="DD">DD</option>
                    <option value="UPI">UPI(Phone Pe, Paytm, Bhartpe)</option>
                </select>
            </div>
            <div class="col-sm">
                <label for="">Payment Date : </label>
                <input type="date" name="payment_date" value="<?= date("Y-m-d")?>" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
                <div class="col-sm">
                    <label for="\">Amount Paying Now : </label>
                    <input type="text" name="amount_paying" id="paying_no" onkeyup="CalculateBalance()" class="form-control">
                </div>
                <div class="col-sm">
                    <label for="">Updated Balance : </label>
                    <input type="text" name="updated_balance" id="updated_balance" class="form-control" readonly>
                </div>
                <div class="col-sm">
                    <label for="">Discount : </label>
                    <input type="text" name="discount" id="discount" onkeyup="CalculateBalance()" class="form-control">
                </div>
        </div>
            <center>
                <button type="submit" name="add_new_transa" class="btn bg-gradient-primary btn-md rounded-2 m-4">Submit</button>
            </center>
        </form>
        <script>
            function CalculateBalance(){
                var paying_no=document.getElementById('paying_no').value;
                var stage_fare=document.getElementById('balance_amount').value;
                var discount=document.getElementById('discount').value;
                var updated_balance=stage_fare-paying_no-discount;
                document.getElementById('updated_balance').value=updated_balance;
            }
        </script>
    </div>
</div>
<?php   
    require_once './views/footer.php';
?>