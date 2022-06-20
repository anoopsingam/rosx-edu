<?php
require_once './views/header.php';
$app->setTitle("Genral Invoices Reports");
?>

<div class="card">
    <div class="card-header">
        <span class="btn btn-primary">UBS Invoices</span>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">From Date :</label>
                        <input type="date" name="from_date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="">To Date :</label>
                        <input type="date" name="to_date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Payment Mode : </label>
                        <select class="form-control" id="payment_mode" name="payment_mode">
                            <option value="">Select Payment Mode</option>
                            <option value="CASH">CASH</option>
                            <option value="UPI">UPI/ONLINE</option>
                            <option value="CHEQUE">CHEQUE</option>
                            <option value="DD">DD</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="">Payment Status : </label>
                        <select class="form-control" id="payment_status" name="payment_status">
                            <option value="">Select Payment Status</option>
                            <option value="PENDING">PENDING</option>
                            <option value="PAID">PAID</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Account Type : </label>
                        <select class="form-control" id="account_type" name="account_type">
                            <option value="">Select Account Type</option>
                            <option value="ACC">ACC</option>
                            <option value="NACC">NACC</option>
                        </select>
                    </div>
                </div>
            </div>
            <center class="mt-3"><button class="btn btn-dark" type="submit" name="filter_inv">Filter</button></center>
        </form>
    </div>
    <?=
    includes::Datatables("General Invoices Data - " . date("Y") . "", "0,1,2,3,4,5,6,7,8", "landscape");
    $db = new database();
    $sql = "SELECT * FROM general_invoice g, student_enrollment e WHERE g.stu_id = e.studentid ";
    $txt = '';
    if (isset($_POST['filter_inv'])) {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $payment_mode = $_POST['payment_mode'];
        $payment_status = $_POST['payment_status'];
        $account_type = $_POST['account_type'];
        if ($from_date != "" && $to_date != "") {
            $sql .= " AND g.invoice_date BETWEEN '$from_date' AND '$to_date'";
            $txt .= "From Date : $from_date | To Date : $to_date";
        }
        if ($payment_mode != "") {
            $sql .= " AND g.payment_mode = '$payment_mode'";
            $txt .= " | Payment Mode : $payment_mode";
        }
        if ($payment_status != "") {
            $sql .= " AND g.payment_status = '$payment_status'";
            $txt .= " | Payment Status : $payment_status";
        }
        if ($account_type != "") {
            $sql .= " AND g.account_type = '$account_type'";
            $txt .= " | Account Type : $account_type";
        }
    }
    $sql .= " ORDER BY g.invoice_no DESC";

    $result = mysqli_query($db->conn, $sql);
    // echo $sql;
    ?>
    <div class="card mt-3">
        <div class="card-header">
            <span class="h4"> Invoices Reports </span>
            <p class="text-muted">
                <?= $txt; ?>
            </p>
        </div>
        <div class="card-body">
            <div class="container table-responsive">
                <table id="example" class="display">
                    <thead>
                        <th>Sl. No</th>
                        <th>Student Id</th>
                        <th>Student Name</th>
                        <th>Class - Section</th>
                        <th>Invoice No</th>
                        <th>Invoice Date</th>
                        <th>Invoice Amount</th>
                        <th>Payment Mode</th>
                        <th>Payment Status</th>
                        <th>Account Type</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $total = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $row['stu_id']; ?></td>
                                <td><?= $row['student_name'] ?></td>
                                <td><?= $row['present_class'] . ' - ' . $row['present_section'] ?></td>
                                <td><?= $row['invoice_no']; ?></td>
                                <td><?= $row['invoice_date']; ?></td>
                                <td>₹<?= $row['total_amount']; ?></td>
                                <td><?= $row['payment_mode']; ?></td>
                                <td><?= $row['payment_status']; ?></td>
                                <td><?= $row['account_type']; ?></td>
                                <td>
                                    <a onclick="window.open('/GeneralInvoice/View/<?= encrypt($row['invoice_no']); ?>','popup','width=800,height=750');"><button class="btn btn-success">View</button></a>
                                    <a href="/GeneralInvoice/Edit/<?= encrypt($row['invoice_no']); ?>" class="btn btn-primary">Edit</a>
                                    <a href="/GeneralInvoice/Controller/delete/<?= encrypt($row['invoice_no']); ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php
                            $total += $row['total_amount'];
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th><b>Total Invoices</b></th>
                            <th><?= $i ?></th>
                            <th><b>Total</b></th>
                            <th>₹<?= $total; ?></th>
                            <th><b>In Words</b></th>
                            <th><?= func::convert_number($total); ?></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
require_once './views/footer.php';
?>