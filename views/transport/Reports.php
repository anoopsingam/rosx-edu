<?php
require_once './views/header.php';
$app->setTitle('Transport Transaction Reports');
?>
<div class="card m-2">
    <div class="card-header">
        <a href="/" class="btn btn-dark btn-sm">Back</a>
        <br>
        <span class="btn bg-gradient-primary btn-lg">Transport Transaction Reports</span>
    </div>
    <div class="card-body">

        <div class="card shadow-lg m-3 p-2">
            <div class="card-header">
                <span class="h3">Search Transport Transaction</span>
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
            $user_id = $_POST['user_id'];
            $transaction_mode = $_POST['transaction_mode'];

            $sql = "SELECT * FROM `transport_transaction` 
                    LEFT JOIN `student_enrollment` ON `transport_transaction`.`trans_student_id` = `student_enrollment`.`studentid` WHERE 1 ";
            if ($from_date != "" && $to_date != "") {
                $sql .= " AND transport_transaction.trans_created_on BETWEEN '$from_date' AND '$to_date' ";
            }

            if ($user_id != '') {
                $sql .= " AND transport_transaction.trans_added_by='$user_id' ";
            }
            if ($transaction_mode != "") {
                $sql .= " AND transport_transaction.trans_payment_mode='$transaction_mode' ";
            }
            includes::Datatables(" Transport Transaction Data $_POST[from_date] to $_POST[to_date] ", '0,1,2,3,4,5,6,7,8,9', 'landscape');
        } else {
            $sql = "SELECT * FROM `transport_transaction` 
                LEFT JOIN `student_enrollment` ON `transport_transaction`.`trans_student_id` = `student_enrollment`.`studentid` ";
            includes::Datatables(' Transport Transaction Data ', '0,1,2,3,4,5,6,7,8,9,10,11,12', 'landscape');
        }
        $result = mysqli_query($db->conn, $sql);
        ?>


        <div class="container-fluid table-responsive mt-5">
            <table id="example" class=" table table-bordered table-sm table-responsive-xl">
                <thead>
                    <tr class="bg-gradient-dark text-light">
                        <th>Sl No.</th>
                        <th>Student ID</th>
                        <th>Bill No.</th>
                        <th>Student Name</th>
                        <th>Class-Section</th>
                        <th>Billing Date</th>
                        <th>Fee Paid</th>
                        <th>Discount</th>
                        <th>Transaction Id</th>
                        <th>Mode</th>
                        <th>Route </th>
                        <th>Stage</th>
                        <th>Login Id</th>

                    </tr>
                </thead>
                <tbody style="font-size:small;">
                    <?php
                    $kk = 0;
                    $total = 0;
                    while ($data = $result->fetch_object()) {
                        echo '<tr>';
                        echo '<td>' . ++$kk . '</td>';
                        echo '<td>' . $data->studentid . '</td>';
                        echo '<td>' . $data->trans_bill_no . '</td>';
                        echo '<td>' . $data->student_name . '</td>';
                        echo '<td>' . $data->present_class . '-' . $data->present_section . '</td>';
                        echo '<td>' . $data->trans_date . '</td>';
                        echo '<td>' . '₹' . $data->trans_paid_amount . '</td>';
                        echo '<td>' . $data->trans_discount . '</td>';
                    ?>
                        <td onclick="window.open('<?= func::href('/Transport/Print/' . $data->trans_gen_id); ?>','popup','width=1000,height=1000');"> <?= $data->trans_gen_id ?></td>
                    <?php
                        echo '<td>' . $data->trans_payment_mode . '</td>';
                        echo '<td>' . func::UnifiedTransportTransInfo($data->trans_gen_id)['route_name'] . '</td>';
                        echo '<td>' . func::UnifiedTransportTransInfo($data->trans_gen_id)['route_stage_name'] . '</td>';
                        echo '<td>' . $data->trans_added_by . '</td>';
                        echo '</tr>';
                        $total = $total + $data->trans_paid_amount;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Total Bills: </b></td>
                        <td><?= $kk; ?></td>
                        <td><b>Total</b></td>
                        <td><?= '₹' . func::FormatMoney($total) ?></td>
                        <td><b>In Words </b></td>
                        <td><?= func::convert_number($total) ?></td>
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