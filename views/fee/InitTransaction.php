<?php
require_once './views/header.php';
error_reporting(0);
$app->setTitle("Transaction $token");
if(!empty($token) && !empty($_POST['studentid']) && is_csrf_valid() ){
    $ay=$_POST['ay'];
    $id=$_POST['studentid'];
    $d=func::getStudentDetails($id);
    $balance=func::LastPaymentInfo($id,$ay);
    $account_data=func::studentAccountData($id,$ay);
    $t_fee=func::getFeeStructure($d->present_class,$ay);

    $sql="SELECT * FROM transport_enroll e 
    LEFT JOIN student_enrollment s ON e.enroll_student_id=s.studentid
     LEFT JOIN transport_stages t ON e.enroll_stage_id=t.route_stage_id 
     LEFT JOIN transport_routes r ON t.stage_route_id =r.route_id 
     LEFT JOIN transport_bus b ON r.route_bus_id = b.db_id WHERE e.enroll_student_id='$id' and e.enroll_academic_year='$ay' ";
$fetch=mysqli_query($db->conn,$sql);
$data=mysqli_fetch_assoc($fetch);
$trns=false;
if(!empty($data['enroll_id'])){
 $trns=true;
}



?>
<div class="card shadow-lg m-3">
    <div class="card-header">
        <button class="btn btn-primary">Pay Fee for <?= $d->student_name?> </button>
    </div>
    <div class="card-body">
        <?php 
            // print_r($d);
    if($t_fee->academic_year!=$ay){
        ?>
        <div class="alert alert-danger text-light" role="alert">
            <strong>Note !</strong>
            <p> Please Add Fee For <?= $ay ?> to pay fee...</p>
        </div>
        <?php
    }else{
        ?>
        <span onclick="ShowTransactions()" class=" btn bg-gradient-dark text-light font-weight-bolder m-3 p-2"> View
            Previous
            Transactions</span>
        <div class="card m-4 p-1 shadow" id="previous_t">
            <div class="card-body" style="overflow:scroll;">
                <table class="table table-bordered table-responsive-lg table-hover">
                    <thead class="font-weight-bolder text-info bg-gradient-dark">
                        <tr>
                            <td>Bill No</td>
                            <td>Student ID</td>
                            <td>Total Fee</td>
                            <td>Paid Amount</td>
                            <td>Balance Amount</td>
                            <td>Discount</td>
                            <td>Paid On</td>
                            <td>Due Date</td>
                            <td>Recived By</td>
                            <td>Note</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                        $sqln = "SELECT * FROM fee_transactions WHERE student_id='$id' AND ay='$ay' ORDER BY created_on DESC ";
                                        $resultn = mysqli_query($db->conn, $sqln);
                                        if (mysqli_num_rows($resultn) > 0) {
                                            while ($listn = mysqli_fetch_object($resultn)) {
                                                 
                                        ?>
                        <tr>
                            <td><a
                                    onclick="window.open('/Transaction/Print/<?php echo $listn->tid ?>','popup','width=800,height=750');"><button
                                        class="btn btn-success"><?php echo $listn->bill_no; ?></button></a></td>
                            <td><?php echo $listn->student_id; ?></td>
                            <td><?php echo $t_fee->tution_fee;?></td>
                            <td><?php echo $listn->paid_amount; ?></td>
                            <td><?php echo $listn->balance_amount; ?></td>
                            <td><?php echo $listn->disc_amt; ?></td>
                            <td><?php echo $listn->created_on; ?></td>
                            <td><?php echo $listn->due_date; ?></td>
                            <td><?php echo $listn->loginid; ?></td>
                            <td><?php echo $listn->transaction_note; ?></td>
                        </tr>
                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='10' class='text-center bg-warning text-dark h5'>No Previous Transactions Found for " . $d->student_name . "  for Academic Year " . $ay . "</td></tr>";
                                        }
                                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <form action="/Transaction/Save/<?=$token?>" method="post">
            <h6 class="text-center">
                <span class="text-dark m-5">
                    Tuition Fee :
                </span>
                <br>
            </h6>
            <div class="row mb-3">
                <div class="col-lg-4">
                    <label for="">Student ID :</label>
                    <input type="text" name="student_id" readonly value="<?= $id?>" id="sid" class="form-control">
                </div>
                <div class="col-lg-4">
                    <label for="">Student Name :</label>
                    <input type="text" name="student_name" readonly value="<?= $d->student_name?>" id=""
                        class="form-control">
                </div>
                <div class="col-lg-4">
                    <label for="">Class :</label>
                    <input type="text" name="class" readonly value="<?= $d->present_class;?>" id=""
                        class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-2">
                    <label for="">Section :</label>
                    <input type="text" name="section" readonly value="<?= $d->present_section?>" id=""
                        class="form-control">
                </div>
                <div class="col-lg-2">
                    <label for="">Mobile No :</label>
                    <input type="text" name="phone_no" readonly value="<?= $d->father_number?>" id=""
                        class="form-control">
                    <?= (empty($d->father_number))?"<span class='text-danger'>Please Update the Email Id to Process the Transaction </span>":"";?>
                </div>
                <div class="col-lg-2">
                    <label for="">Email Id :</label>
                    <input type="text" name="email_id" readonly value="<?php echo $d->fatheremail; ?>" id=""
                        class="form-control">
                    <?= (empty($d->fatheremail))?"<span class='text-danger'>Please Update the Email Id to Process the Transaction </span>":"";?>
                </div>
                <div class="col-lg-3">
                    <label for="">Academic Year :</label>
                    <input type="text" name="academic_year" readonly value="<?php echo $ay; ?>" id=""
                        class="form-control">
                </div>
                <div class="col-lg-3">
                    <label for="">Installment Paying Now : </label>
                    <input type="text" name="installment" id="" class="form-control" readonly
                        value="<?php echo (empty($balance->installment))?"INSTALLMENT-1":++$balance->installment;?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label for="">Total Tution Fee :</label>
                    <input type="text" name="admission_fee" readonly
                        value="<?php echo (empty($balance->installment))? $t_fee->tution_fee:$account_data->total_fee; ?>"
                        id="admission_fee" class="form-control">
                </div>
                <div class="col-lg-6">
                    <label for="">Total Balance Tution Fee :</label>
                    <input type="text" name="balance_admission_fee" readonly
                        value="<?php echo (empty($balance->installment))? $t_fee->tution_fee:$account_data->fee_balance; ?>"
                        id="balance_admission_fee" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label for="">Tution Fee Paying Now :</label>
                    <input type="number" name="admission_fee_paid"
                        value="<?php echo (empty($balance->installment))? $t_fee->tution_fee:$account_data->fee_balance; ?>"
                        id="fee_paying" onkeyup="CalculateFee()" class="form-control">
                </div>
                <div class="col-lg-6">
                    <label for="">Tution Fee Balance :</label>
                    <input type="text" name="admission_fee_due" readonly id="fee_balance" class="form-control">
                </div>
            </div>

            <div class="row mb-3">

                <div class="col-sm">
                    <div class="row mb-3">
                        <div class="col-sm">
                            <label for="user">Discount Issued By</label>
                            <?= func::adminList("discount_by")?>
                        </div>
                        <div class="col-sm">
                            <label for="">Discount Amount</label>
                            <input type="number" name="discount_amount" id="" value="0" class="form-control">
                        </div>
                    </div>
                </div>


                <div class="col-sm">
                    <label for="">Next Tution Fee Paying Date:</label>
                    <input type="date" name="due_date" id="due_date" required class="form-control">
                </div>
                <script>
                function CalculateFee() {
                    var balance_admission_fee = document.getElementById('balance_admission_fee').value;
                    var fee_paying = document.getElementById('fee_paying').value;
                    var fee_balance = document.getElementById('fee_balance').value;
                    var total = balance_admission_fee - fee_paying;
                    document.getElementById('fee_balance').value = total;
                }
                </script>
            </div>
            <?php 
                    if($trns){
                        $last_trans=mysqli_query($db->conn," SELECT SUM(trans_discount) AS total_discount from transport_transaction WHERE trans_student_id='$data[studentid]' AND trans_enroll_id='$data[enroll_id]'");
                        $ltd=mysqli_fetch_object($last_trans);
                        $total_dicount=(empty($ltd->total_discount))?0:$ltd->total_discount;
                        $acc_data=mysqli_query($db->conn,"SELECT * FROM transport_account WHERE acc_student_id='$id' and acc_academic_year='$ay'");
                        $acc_data=mysqli_fetch_assoc($acc_data);
                        $paid_amount=(empty($acc_data['acc_paid']))?0:$acc_data['acc_paid'];
                        $balance_amount=$data['route_stage_fare']-$paid_amount-$total_dicount;
                        ?>
            <input type="hidden" name="transport_opted" value="yes">
            <h6 class="text-center m-5">
                <span class="text-dark ">
                    Transport Fee :
                </span>
                <br>
            </h6>
            <div class="row mt-3">
                <div class="col-sm">
                    <label for="">Route Name : </label>
                    <input type="text" name="route_name" class="form-control" value="<?= $data['route_name']?>"
                        readonly>
                </div>
                <div class="col-sm">
                    <label for="">Bus Name : </label>
                    <input type="text" name="bus_name" class="form-control" value="<?= $data['bus_name']?>" readonly>
                </div>
                <div class="col-sm">
                    <input type="hidden" name="enroll_id" value="<?= $data['enroll_id']?>">
                    <label for="">Stage Name : </label>
                    <input type="text" name="stage_name" class="form-control" value="<?= $data['route_stage_name']?>"
                        readonly>
                </div>
                <div class="col-sm">
                    <label for="">Stage Fare :</label>
                    <input type="text" name="stage_fare" id="stage_fare" class="form-control"
                        value="<?= $data['route_stage_fare']?>" readonly>
                </div>
                <div class="col-sm">
                    <label for="">Enrolled Academic Year :</label>
                    <input type="text" name="enroll_ay" class="form-control" value="<?= $data['enroll_academic_year']?>"
                        readonly>
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
                    <input type="text" name="balance_amount" id="balance_amount" class="form-control"
                        value="<?= $balance_amount?>" readonly>
                </div>
                <!-- <div class="col-sm">
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
            </div> -->
            </div>
            <div class="row mt-3">
                <div class="col-sm">
                    <label for="\">Amount Paying Now : </label>
                    <input type="text" name="amount_paying" id="paying_no" onkeyup="CalculateBalance()"
                        class="form-control">
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
            <script>
            function CalculateBalance() {
                var paying_no = document.getElementById('paying_no').value;
                var stage_fare = document.getElementById('balance_amount').value;
                var discount = document.getElementById('discount').value;
                var updated_balance = stage_fare - paying_no - discount;
                document.getElementById('updated_balance').value = updated_balance;
            }
            </script>
            <?php
                    }else{
                        ?>
            <input type="hidden" name="transport_opted" value="no">
            <h6 class="text-center m-5">
                <span class="text-danger ">
                    Transport Not Opted
                </span>
                <br>
            </h6>
            <?php
                    }
           
           ?>
            <div class="row mt-5  mb-3">
                <div class="col-lg-4">
                    <label for="">Transaction Note :</label>
                    <textarea name="transaction_note" id="" cols="5" rows="5" class="form-control">N/A</textarea>
                </div>
                <div class="col-lg-4">
                    <label for="">Transaction Mode : </label>
                    <select name="transaction_mode" id="" class="form-control">
                        <option value="" selected disabled>Select Payment Mode</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        <option value="DD">DD</option>
                        <option value="UPI">UPI(Phone Pe, Paytm, Bhartpe)</option>
                    </select>
                </div>
            </div>
            <?= set_csrf()?>
            <input type="text" name="p_fee_paid" hidden value="<?php if (empty($balance->installment)) {
                                                                                    echo "0";
                                                                                } else {
                                                                                    echo $account_data->fee_paid;
                                                                                } ?>" id="">
            <input type="text" name="p_fee_bal" value="<?php if (empty($balance->installment)) {
                                                                                    echo  $t_fee->tution_fee;
                                                                                } else {
                                                                                    echo $account_data->fee_balance;
                                                                                } ?>" hidden id="">
            <input type="text" name="p_fee_disc" value="<?php if (empty($balance->installment)) {
                                                                                    echo 0;
                                                                                } else {
                                                                                    echo $account_data->discount;
                                                                                } ?>" hidden id="">
            <input type="text" name="transaction_id" id="tid" hidden>
            <script>
            var transaction = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            //trim transaction id to 7 characters
            let transaction_id = transaction.substring(0, 7);
            let sid = document.getElementById('sid').value;
            document.getElementById("tid").value = sid + 'TT' + transaction_id;
            </script>
            <center>
                <button type="submit" name="submit" class="btn bg-gradient-success btn-lg  mt-4 ">Pay Fee</button>
            </center>
            </center>
        </form>
        <?php
    }
    ?>
    </div>
</div>
<script>
document.getElementById("previous_t").style.display = "none";

function ShowTransactions() {
    var x = document.getElementById("previous_t");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
<?php   
}else{
    echo "<div class='alert alert-danger'>No Transaction Auth Token Found to Initiate Token </div>";
}
require_once './views/footer.php';
?>