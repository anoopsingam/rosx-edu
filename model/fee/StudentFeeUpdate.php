<?php 
// print_r($_POST);
require '././config.php';
$db= new database();
$conn=$db->conn;
if(!empty($token) && is_csrf_valid()){
    $trans_id=mysqli_real_escape_string($db->conn,$token);
    $student_id=mysqli_real_escape_string($db->conn,$_POST['student_id']);
    $ay=mysqli_real_escape_string($db->conn,$_POST['academic_year']);
    $total_fee=mysqli_real_escape_string($db->conn,$_POST['total_fee']);

    $acc_update=[
        "total_fee"=>$total_fee,
    ];
    $transaction_update=[
        "total_fee"=>$total_fee,
    ];
    $com=true;
    try{
        if($db->update("account",$acc_update,"student_id='$student_id' AND acdy='$ay'")){
            if($db->update("fee_transactions",$transaction_update,"student_id='$student_id' AND ay='$ay' AND tid='$trans_id' ")){
                $com=true;
                js::alert("Fee Structure of $student_id is Updated Successfully to $total_fee for Academic Year $ay ");
                js::redirect('/Transaction/StudentFeeUpdate/'.uniqid());
            }{
                $com=false;
            }
        }else{
            $com=false;
        }
        if($com==false){
            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating Fee Structure of $student_id  $total_fee  ",$_POST['login_id']);
            throw new Exception("Process Terminated with Error to Update the Fee Structure of $student_id  $total_fee ");
        }
    }catch(Exception $e){
        js::alert($e->getMessage());
        js::redirect('/Transaction/StudentFeeUpdate/'.uniqid());
    }

}