<pre>
<?php 

if(isset($token_id) && $token_id!=null){
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    print_r($_POST);
    $trans_student_id=mysqli_real_escape_string($conn,$_POST['student_id']);
    $trans_date=mysqli_real_escape_string($conn,$_POST['payment_date']);
    $trans_gen_id=time();
    $trans_paid_amount=mysqli_real_escape_string($conn,$_POST['amount_paying']);
    $trans_discount=mysqli_real_escape_string($conn,$_POST['discount']);
    $trans_enroll_id=mysqli_real_escape_string($conn,$_POST['enroll_id']);
    $trans_added_by=mysqli_real_escape_string($conn,$_POST['login_id']);
    $academic_year=mysqli_real_escape_string($conn,$_POST['enroll_ay']);
    $sql = "SELECT * FROM `transport_transaction` ORDER BY `tt_id` DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $trans_bill_no = ++$row['trans_bill_no'];
    } else {
        $trans_bill_no = "TR0001";
    }
    $balance=mysqli_real_escape_string($conn,$_POST['updated_balance']);
    $trans_payment_mode=mysqli_real_escape_string($conn,$_POST['payment_mode']);
    
    $acc_data=mysqli_query($db->conn,"SELECT * FROM transport_account WHERE acc_student_id='$trans_student_id' and acc_academic_year='$academic_year'");
    
    $data=[
        "trans_student_id"=>$trans_student_id,
        "trans_date"=>$trans_date,
        "trans_payment_mode"=>$trans_payment_mode,
        "trans_gen_id"=>$trans_gen_id,
        "trans_paid_amount"=>$trans_paid_amount,
        "trans_discount"=>$trans_discount,
        "trans_enroll_id"=>$trans_enroll_id,
        "trans_added_by"=>$trans_added_by,
        "trans_bill_no"=>$trans_bill_no
    ];
    print_r($data);
   if(empty($trans_paid_amount) || $balance<0){
       js::alert("Please Enter Valid Amount to Initiate Transaction");
   }else{
    $paid_amount=mysqli_real_escape_string($conn,$_POST['paid_amount']);
    $u_paid_amount=$paid_amount+$trans_paid_amount;
    $acc_data_feed=[
        "acc_student_id"=>$trans_student_id,
        "acc_paid"=>$u_paid_amount,
        "acc_enroll_id"=>$trans_enroll_id,
        "acc_academic_year"=>$academic_year
    ];
    $com=true;
    if($db->insert('transport_transaction',$data)){
        $com=true;
        if(mysqli_num_rows($acc_data)>0){
            //update the paid Amount
            if($db->update('transport_account',$acc_data_feed,"acc_student_id='$trans_student_id' AND acc_academic_year='$academic_year'")){
                $com=true;
            }else{
                $com=false;
            }
        }else{
            //insert the new row
            if($db->insert('transport_account',$acc_data_feed)){
                $com=true;
            }else{
                $com=false;
            }
        }
    }else{
        $com=false;
    }
    if($com){
        js::alert("Payment Successfully Added for Student ID: $trans_student_id, Bill No : $trans_bill_no , Paid : $trans_paid_amount , Updated Balance : $balance ");
        js::redirect("/Transport/Print/$trans_gen_id");
    }else{
        js::alert("Failed to Generate Transaction !");
        js::redirect('/Transport/Billing/new');
    } 
   }

}
?>
</pre>