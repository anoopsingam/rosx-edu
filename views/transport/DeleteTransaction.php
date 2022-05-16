<?php
require_once './views/header.php';
$app->setTitle("Delete Transport Transaction");
?>
<div class="card shadow-lg m-3">
    <div class="card-header">
        <button class="btn btn-danger">Delete Transaction</button>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <?= set_csrf();?>
            <h5 class="text-center text-danger">Please Provide Transaction Id </h5>
            <div class="row">

                <div class="col-md-6">
                    <label for="">Enter Transaction Id (Transport) : </label>
                    <input type="text" name="transport_trans_id" class="form-control"
                        placeholder="Enter Transaction Id">
                </div>
                <div class="col-md-6">
                    <label for="">Academic Year : </label>
                    <?=  func::academicYear("ay"); ?>
                </div>
            </div>
            <center>
                <button type="submit" name="del_init"
                    class="btn bg-gradient-primary btn-md rounded-2 m-4">Submit</button>
            </center>
        </form>
    </div>
</div>
<?php 
if(isset($_POST['del_init'])){
    $transport_trans_id=$_POST['transport_trans_id'];
    $ay=$_POST['ay'];
    if(!empty($transport_trans_id) && !empty($ay)){
       $updateSql=mysqli_query($db->conn,"SELECT* FROM `transport_transaction`, `transport_account` 
           LEFT JOIN `student_enrollment` ON `transport_account`.`acc_student_id` = `student_enrollment`.`studentid`
        WHERE `transport_transaction`.`trans_gen_id` = '$transport_trans_id' AND `transport_account`.`acc_academic_year`='$ay' ");
       if(mysqli_num_rows($updateSql)>0){
                $row=mysqli_fetch_object($updateSql);
                print_r($row);
                $t_paid=$row->trans_paid_amount;
                $t_disc=$row->trans_discount;
                $stu_id=$row->trans_student_id;
                $acc_total=$row->acc_paid;
                $e_id=$row->acc_enroll_id;
                $trans_final_paid=$t_paid+$t_disc;
                $final_balance=$acc_total-$trans_final_paid; 
                $com=true;
                try{
                    if($final_balance<0 || $final_balance==0){
                        //delete account  
                            if($db->delete("transport_account","acc_student_id='$stu_id' AND acc_enroll_id='$e_id' AND acc_academic_year='$ay'")){
                                $com=true;
                                if($db->delete("transport_transaction","trans_gen_id='$transport_trans_id'")){
                                    $com=true;
                                }else{
                                    $com=false;
                                    error_loger($db->conn->error, __FILE__, "Cant able to Process the request to delete Transaction of Transport $transport_trans_id ",$user['username']);
                                    throw new Exception("Process Terminated with Error to add invoice");
                                }
                            }else{
                                $com=false;
                                error_loger($db->conn->error, __FILE__, "Cant able to Process the request to delete Transaction of Transport $transport_trans_id ",$user['username']);
                                throw new Exception("Process Terminated with Error to add invoice");
                            }
                    }else{
                        //update account
                        $update_Array=[
                            "acc_paid"=>$final_balance
                        ];
                        if($db->update("transport_account",$update_Array,"acc_student_id='$stu_id' AND acc_enroll_id='$e_id' AND acc_academic_year='$ay'")){
                            $com=true;
                            if($db->delete("transport_transaction","trans_gen_id='$transport_trans_id'")){
                            $com=true;
                            }else{
                                $com=false;
                                error_loger($db->conn->error, __FILE__, "Cant able to Process the request to delete Transaction of Transport $transport_trans_id ",$user['username']);
                                throw new Exception("Process Terminated with Error to add invoice");
                            }
                        }else{
                            $com=false;
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request to delete Transaction of Transport $transport_trans_id ",$user['username']);
                            throw new Exception("Process Terminated with Error to add invoice");
                        }
                        
                    }
                }catch(Exception $e){
                    $com=false;
                }
                if($com){
                    js::alert("Transaction $transport_trans_id Deleted Successfully updated Balance of $stu_id is $final_balance");
                    js::redirect(func::href("Transport/Billing/DeleteTransaction"));
                }else{
                    js::alert("Transaction $transport_trans_id Failed to delete , Contact Technical Team !!");
                    js::redirect(func::href("Transport/Billing/DeleteTransaction"));
                }
                
       }else{
           ?>
<div class="card mt-3 bg-gradient-danger text-light">
    <div class="card-header  bg-gradient-danger">
        <h3 class="text-light"><b>Error</b></h3>
    </div>
    <div class="card-body">
        <h5 class="text-center">Transaction Id Not Found</h5>
    </div>
</div>
<?php 
       }

    }else{
        js::alert("Please Transaction Id to Delete !!");
    }
}
?>

<?php   
    require_once './views/footer.php';
?>