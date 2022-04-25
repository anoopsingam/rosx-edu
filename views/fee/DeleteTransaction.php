<?php
require_once './views/header.php';
$app->setTitle("Delete Transaction");
?>
<div class="card shadow m-3 p-3">
    <div class="card-header mb-0 pb-0">
        <a href="/" class="btn btn-dark btn-sm">Back</a>
        <center>
            <h5 class=" btn text-light font-weight-bolder bg-gradient-primary btn-lg">Delete Transaction</h5>
        </center>
    </div>
    <div class="card-body">
        <form action="" method="post">

            <center>
                <label for="">
                    <h5>Transaction ID :</h5>
                </label>
                <input type="text" name="transaction_id" class="form-control pw-75 h-auto"
                    value="<?= (isset($_POST['transaction_id']))?$_POST['transaction_id']:''; ?>"
                    style="width: max-content;">
                <button type="submit" name="get_id" class="btn btn-warning m-3 text-dark">Get Info</button>
            </center>


        </form>
        <?php
        if (isset($_POST['get_id'])) {
            $conn = $db->conn;
            $transaction_id = trim(mysqli_real_escape_string($conn, $_POST['transaction_id']));
            if (empty($transaction_id)) {
               js::alert("Please enter transaction id");
            } else {
                $query = "SELECT * FROM fee_transactions f, student_enrollment s WHERE tid = '$transaction_id' and f.student_id = s.studentid";
                $run = mysqli_query($conn, $query);
                if (mysqli_num_rows($run) > 0) {
                    while ($row = mysqli_fetch_array($run)) {
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                        $sqln = "SELECT * FROM fee_transactions WHERE student_id='$row[student_id]' AND ay='$row[academic_year]' ORDER BY created_on DESC ";
                                        $resultn = mysqli_query($conn, $sqln);
                                        if (mysqli_num_rows($resultn) > 0) {
                                            while ($ro = mysqli_fetch_assoc($resultn)) {
                                                $listn = json_decode(json_encode($ro));
                                        ?>
                        <tr>
                            <td><a
                                    onclick="window.open('/Transaction/Print/<?php echo $listn->tid ?>','popup','width=800,height=750');"><button
                                        class="btn btn-success"><?php echo $listn->bill_no; ?></button></a></td>
                            <td><?php echo $listn->student_id; ?></td>
                            <td><?php echo $listn->total_fee;?></td>
                            <td><?php echo $listn->paid_amount; ?></td>
                            <td><?php echo $listn->balance_amount; ?></td>
                            <td><?php echo $listn->disc_amt; ?></td>
                            <td><?php echo $listn->created_on; ?></td>
                            <td><?php echo $listn->due_date; ?></td>
                            <td><?php echo $listn->loginid; ?></td>
                        </tr>
                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='9' class='text-center bg-warning text-dark h5'>No Previous Transactions Found for " . $key['name'] . "  for Academic Year " . $ay . "</td></tr>";
                                        }

                                        ?>
                    </tbody>
                </table>
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
        <div class="card shadow">
            <div class="card-header text-center">
                <span class="btn  bg-gradient-dark text-info">Bill Details</span>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Student ID</label>
                                <input type="text" class="form-control" value="<?php echo $row['student_id'] ?>"
                                    readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Student Name</label>
                                <input type="text" class="form-control" value="<?php echo $row['student_name'] ?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Class</label>
                                <input type="text" class="form-control" value="<?php echo $row['present_class'] ?>"
                                    readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Section</label>
                                <input type="text" class="form-control" value="<?php echo $row['present_section'] ?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">Bill No</label>
                                <input type="text" class="form-control" value="<?php echo $row['bill_no'] ?>" readonly>
                            </div>
                            <div class="col-sm-3">
                                <label for="">Billing Date</label>
                                <input type="text" class="form-control" value="<?php echo $row['billing_date'] ?>"
                                    readonly>
                            </div>
                            <div class="col-sm-3">
                                <label for="">Installment</label>
                                <input type="text" class="form-control" value="<?php echo $row['installment'] ?>"
                                    readonly>
                            </div>
                            <div class="col-sm-3">
                                <label for="">Due Date</label>
                                <input type="text" class="form-control" value="<?php echo $row['due_date'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">Amount Paid</label>
                                <input type="text" class="form-control" value="<?php echo $row['paid_amount'] ?>"
                                    readonly>
                            </div>
                            <div class="col-sm-3">
                                <label for="">Discount : </label>
                                <input type="text" class="form-control" name="disc_amt"
                                    value="<?php echo $row['disc_amt'] ?>" readonly>
                            </div>

                            <div class="col-sm-6">
                                <label for="">Balance Amount</label>
                                <input type="text" class="form-control" value="<?php echo $row['balance_amount'] ?>"
                                    readonly>
                                <br>

                            </div>
                        </div>
                        <form action="/DeleteFeeTransaction/<?= $row['tid'];?>" method="post">
                            <?= set_csrf();?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Transaction ID</label>
                                    <input type="text" name="transaction_id" class="form-control"
                                        value="<?php echo $row['tid'] ?>" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Payment Received By</label>
                                    <input type="text" class="form-control" value="<?php echo $row['loginid'] ?>"
                                        readonly>
                                </div>
                            </div><?php
                                                    $var = str_split($transaction_id);
                                                    // print_r($var);
                                                    if ($var[8] == 'T' && $var[9] == 'T') {
                                                        $query = "SELECT * FROM account WHERE student_id = '" . $row['student_id'] . "' AND acdy='" . $row['ay'] . "' ";
                                                        $fetch_bal = mysqli_query($conn, $query);
                                                        $row_bal = mysqli_fetch_array($fetch_bal);
                                                        $total_fee = $row_bal['total_fee'];
                                                        $balance_amount = $row['disc_amt']+$row_bal['fee_balance'];
                                                        $paid_amount = $row_bal['fee_paid'];
                                                        $f_disc_amt=$row_bal['discount']-$row['disc_amt'];
                                                        $parm = "account&fee_transactions&" . $row['ay'] . "&$total_fee&$row[installment]&$f_disc_amt";
                                                    } 
                                                    elseif ($var[9] == 'T' && $var[10] == 'A') {
                                                        $query = "SELECT * FROM account1 WHERE student_id = '" . $row['student_id'] . "' AND academic_year='" . $row['academic_year'] . "' ";
                                                        $fetch_bal = mysqli_query($conn, $query);
                                                        $row_bal = mysqli_fetch_array($fetch_bal);
                                                        $total_fee = $row_bal['total_fee'];
                                                        $balance_amount = $row_bal['fee_balance'];
                                                        $paid_amount = $row_bal['fee_paid'];
                                                        $parm = "account1&account_admission_fee&" . $row['academic_year'] . "&$total_fee&$row[installment]";
                                                    }
                                                    ?>
                            <span class="text-danger font-weight-bolder">Adjustment Details after Deleting Bill </span>
                            <div class="row">
                                <div class="col-sm-6">

                                    <label for="">Paid Amount</label>
                                    <input type="text" class="form-control" name="paid_amount"
                                        value="<?php echo $paid_amount - $row['paid_amount'] ?>" readonly>

                                </div>
                                <div class="col-sm-3">
                                    <label for="">Balance Amount</label>
                                    <input type="text" class="form-control" name="balance_amount"
                                        value="<?php echo $balance_amount + $row['paid_amount']; ?>" readonly>
                                </div>
                                <div class="col-sm-3">
                                    <label for="">Status</label>
                                    <input type="text" class="form-control" name="status"
                                        value="<?php if (($balance_amount + $row['paid_amount']) == 0) {
                                                                                                                        echo "PAID";
                                                                                                                    } else {
                                                                                                                        echo "PENDING";
                                                                                                                    } ?>" readonly>
                                </div>
                            </div>
                            <input type="text" name="param" value="<?php echo $parm; ?>" hidden id="">
                            <input type="text" name="sid" value="<?php echo $row['student_id']; ?>" hidden id="">
                            <center><button type="submit" class="btn btn-success btn-sm m-3">Delete</button></center>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                    }
                } else {
                    echo "<div class='alert alert-danger'>
                            <strong>Error!</strong> No Transaction Details not found for $transaction_id.
                            </div>";
                }
            }
        }

            ?>
        </div>
    </div>
    <?php   
    require_once './views/footer.php';
?>