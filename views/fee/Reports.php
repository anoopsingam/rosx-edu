<?php
require_once './views/header.php';
$app->setTitle('Transaction Reports');
$func= new func;
?>
<div class="card m-2">
    <div class="card-header">
        <a href="/" class="btn btn-dark btn-sm">Back</a>
        <br>
        <span class="btn bg-gradient-primary btn-lg">Fee Transaction Reports</span>
    </div>
    <div class="card-body">

        <div class="card shadow-lg m-3 p-2">
            <div class="card-header">
                <span class="h3">Search Transaction</span>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm">
                            <label for="">From Date : </label>
                            <input type="date" class="form-control" id="from_date" name="from_date" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-sm">
                            <label for="">To Date : </label>
                            <input type="date" class="form-control" id="to_date" name="to_date" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-sm">
                            <label for="">Academic Year : </label>
                            <?= func::academicYear("academic_year") ?>
                        </div>
                        <div class="col-sm">
                            <label for="">Class : </label>
                            <?= func::classlist("class"); ?>
                        </div>
                        <div class="col-sm">
                            <label for="">User : </label>
                            <?= func::adminList("user_id") ?>
                        </div>
                        <div class="col-sm">
                            <label for="">Transaction Mode : </label>
                            <select name="transaction_mode" id="" class="form-control">
                                <option value="">Select</option>
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="DD">DD</option>
                                <option value="UPI">UPI(Phone Pe, Paytm, Bhartpe)</option>
                            </select>
                        </div>
                    </div>
                    <center class="mt-4 mb-2">
                        <button type="submit" name="search_transaction" class="btn bg-gradient-info">Search</button>
                    </center>
                </form>
            </div>
        </div>
        <?php
        if (isset($_POST['search_transaction'])) {
            $from_date = $_POST['from_date'] . " 00:00:00";
            $to_date = $_POST['to_date'] . " 23:59:59";
            $academic_year = $_POST['academic_year'];
            $class = $_POST['class'];
            $user_id = $_POST['user_id'];
            $transaction_mode = $_POST['transaction_mode'];

            $sql = "SELECT * FROM fee_transactions f, student_enrollment e  WHERE f.student_id=e.studentid ";
            if ($from_date != "" && $to_date != "") {
                $sql .= " AND created_on BETWEEN '$from_date' AND '$to_date' ";
            }
            if ($academic_year != "") {
                $sql .= " AND ay='$academic_year' ";
            }
            if ($class != "") {
                $sql .= " AND class='$class' ";
            }
            if ($user_id != '') {
                $sql .= " AND loginid='$user_id' ";
            }
            if ($transaction_mode != "") {
                $sql .= " AND transaction_mode='$transaction_mode' ";
            }
            $sql .= " ORDER BY created_on ASC";
            includes::Datatables(" Fee Transaction Data $_POST[from_date] to $_POST[to_date] ", '0,1,2,3,4,5,6,7,8,9,10,11,12', 'landscape');
        } else {
            $sql = "SELECT * FROM fee_transactions f, student_enrollment e  WHERE f.student_id=e.studentid  ORDER BY created_on ASC";
            includes::Datatables(' Fee Transaction Data ', '0,1,2,3,4,5,6,7,8,9,10,11,12', 'landscape');
        }
        $result = mysqli_query($db->conn, $sql);
        ?>


        <div class="container-fluid" style="overflow:scroll;">
            <table id="example" class=" table table-bordered table-sm table-responsive-xl text-center">
                <thead>
                    <tr class="bg-gradient-dark text-light">
                        <th>Sl no.</th>
                        <th>Student ID</th>
                        <th>Bill No.</th>
                        <th>Student Name</th>
                        <th>Class-Section</th>
                        <th>Billing Date</th>
                        <th>Installment</th>
                        <th>Fee Paid</th>
                        <th>Fee Balance</th>
                        <th>Discount</th>
                        <th>Transaction Id</th>
                        <th>Mode</th>
                        <th>Login Id</th>
                        <th>Academic Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="font-size:small;">
                    <?php
                    $total = 0;
                    $sl = 0;
                    $data;
                    while ($data = $result->fetch_object()) {
                        echo '<tr>';
                        echo '<td>' . ++$sl . '</td>';
                        echo '<td>' . $data->student_id . '</td>';
                        echo '<td>' . $data->bill_no . '</td>';
                        echo '<td>' . $data->student_name . '</td>';
                        echo '<td>' . $data->present_class . '-' . $data->present_section . '</td>';
                        echo '<td>' . $data->billing_date . '</td>';
                        echo '<td>' . $data->installment . '</td>';
                        echo '<td>' . '₹' . $data->paid_amount . '</td>';
                        echo '<td>' . '₹' . $data->balance_amount . '</td>';
                        echo '<td>' . $data->disc_amt . '</td>';
                    ?>
                        <td onclick="window.open('<?= func::href('/Transaction/UnifiedPrint/' . $data->tid); ?>','popup','width=1000,height=1000');" class="btn"><?= $data->tid ?></td>
                        <?php
                        echo '<td>' . $data->transaction_mode . '</td>';
                        echo '<td>' . $data->loginid . '</td>';
                        echo '<td>' . $data->ay . '</td>';
                        echo '<td>'; ?>
                        <a onclick="window.open('/Transaction/Print/<?php echo $data->tid ?>','popup','width=800,height=750');"><button class="btn btn-success btn-sm"><i class="fa fa-print" aria-hidden="true"></i> print</button></a></td>
                    <?php
                        echo '</td>';
                        echo '</tr>';
                        $total = $total + $data->paid_amount;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total No Bills : </td>
                        <td> <?= $sl;?> </td>
                        <td></td>
                        <td>
                            <b>Total</b>
                        </td>
                        <td>
                            <?= '₹' . func::FormatMoney($total) ?>
                        </td>
                        <td></td>

                        <td>
                            In Words :
                        </td>
                        <td>
                        <h6><?= $func->convert_number($total);?></h6>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php
require_once './views/footer.php';
?>