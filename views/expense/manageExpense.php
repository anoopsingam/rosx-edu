<?php
require_once './views/header.php';
$app->setTitle("Manage Payee");
?>

<div class="card m-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
                <span class="btn btn-danger btn-lg">Manage Expenses</span>
            </div>
            <div class="col-md-9 text-right ">
                <p align="right">
                    <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal"
                        data-bs-target="#modal-form-new-expense">New Expense</button>
                </p>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="modal fade" id="modal-form-new-expense" tabindex="-1" role="dialog"
            aria-labelledby="modal-form-new-expense" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h3 class="font-weight-bolder text-info text-gradient">New Expense </h3>
                            </div>
                            <div class="card-body">
                                <form action="/Expense/ExpenseController/new/<?= uniqid(); ?>" method="post">
                                    <?= set_csrf();?>
                                    <div class="row">
                                        <div class="col-sm">
                                            <label for="payee_name">Payee Name : </label>
                                           <?= func::PayeeAccountList(); ?>
                                        </div>
                                        <div class="col-sm">
                                            <label for="payee_desc"> Expense Description : </label>
                                            <textarea name="expense_desc" id="expense_desc" cols="4" rows="5"
                                                class="form-control" required></textarea>
                                        </div>
                                        <div class="col-sm">
                                            <label for="expense_amount"> Amount ₹: </label><input type="number"
                                                name="expense_amount" class="form-control" id="expense_amount" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <label for="payment_mode">Payment Mode</label>
                                            <select name="payment_mode" id="payment_mode" class="form-control" required>
                                                <option value="">-select Payment Mode-</option>
                                                <option value="cash">Cash</option>
                                                <option value="cheque">Cheque</option>
                                                <option value="online">Online(UPI,ESBI..)</option>
                                                <option value="bank">Bank</option>
                                            </select>
                                        </div>
                                        <div class="col-sm" id="tid_view">
                                        </div>
                                        <div class="col-sm">
                                            <label for="ho_id">Head Of Account : </label>
                                            <?= func::HoAccountList();?>
                                        </div>
                                        <div class="col-sm">
                                            <label for="exp_date">Expense Date : </label><input type="date"
                                                class="form-control" name="expense_date" id="expense_date" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <label for="exp_added_by">Expense Added By : </label><input type="text"
                                                name="expense_added_by" id="expense_added_by" class="form-control"
                                                value="<?= $user['username']; ?>" readonly />
                                        </div> 
                                        <div class="col-sm">
                                            <label for="fy">Academic Year : </label>
                                            <?= func::academicYear('expense_fy');?>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-round bg-gradient-success btn-lg w-100 mt-4 mb-0">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
    document.getElementById('tid_view').style.display = 'none';
    $(document).ready(function() {
        $("#payment_mode").change(function() {
            var mode = $("#payment_mode").val();
            if (mode == "cheque" || mode == "online" || mode == "bank") {
                document.getElementById('tid_view').style.display = 'block';
                $("#tid_view").html('<label for="tid">Transaction ID : </label><input type="text" class="form-control" name="expense_trans_id" id="tid" />');
            } else {
                document.getElementById('tid_view').style.display = 'none';
                $("#tid_view").html('');
            }
        });
    });
    //if  exp_added_by ="administrator" then show approval view
    $(document).ready(function() {
        var exp_added_by = $("#expense_added_by").val();
        if (exp_added_by == "admin") {
            document.getElementById('approval_view').style.display = 'block';
            $("#approval_view").html('<label for="tid"> Approval Date: </label><input type="date" class="form-control" name="ap_date" id="tid" />');
        } else {
            document.getElementById('approval_view').style.display = 'none';
            $("#approval_view").html('');
        }
    });
</script>
<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <?= set_csrf()?>
            <div class="row mb-3">
                <div class="col-sm">
                    <label for="payee_name">Form Date : </label>
                    <input type="date" name="from_date" class="form-control" id="from_date"  />
                </div>
                <div class="col-sm">
                    <label for="payee_name">To Date : </label>
                    <input type="date" name="to_date" class="form-control" id="to_date"  />
                </div>
                <div class="col-sm">
                    <label for="">Payee : </label>
                    <?= func::PayeeAccountList(); ?>
                </div>
                
            </div>
            <div class="row mb-5">
            <div class="col-sm">
                    <label for="">Head Of Account : </label>
                    <?= func::HoAccountList();?>
                </div>
                <div class="col-sm">
                    <label for="">Academic Year : </label>
                    <?= func::academicYear('expense_fy');?>
                </div>
                <div class="col-sm">
                    <label for="">Payment Mode : </label>
                    <select name="payment_mode" id="payment_mode" class="form-control" >
                        <option value="">-select Payment Mode-</option>
                        <option value="cash">Cash</option>
                        <option value="cheque">Cheque</option>
                        <option value="online">Online(UPI,ESBI..)</option>
                        <option value="bank">Bank</option>
                    </select>
                </div>
            </div>
            <center class="mb-3">
                <button type="submit" name="expense_filter"
                    class="btn btn-round bg-gradient-success btn-lg  mt-4 mb-0">Search</button>
            </center>
        </form>
    </div>
</div>
    <?php

        if(isset($_POST['expense_filter'])){
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $payee = $_POST['payee__id'];
            $ho_id = $_POST['ho_id'];
            $payment_mode = $_POST['payment_mode'];
            $expense_fy = $_POST['expense_fy'];
            $payment_mode = $_POST['payment_mode'];
            $sql = 'SELECT * FROM expense_details e, head_accounts h, payee_details p where e.ho_id=h.id AND e.payee__id=p.payee_id';
            $text='';
            if($from_date != ''){
                $sql .= " AND e.expense_date >= '$from_date'";
                $text .= " From <b>$from_date</b>";
            }
            if($to_date != ''){
                $sql .= " AND e.expense_date <= '$to_date'";
                $text .= " To <b>$to_date</b>";
            }
            if($payee != ''){
                $sql .= " AND e.payee__id = '$payee'";
                $text .= " Payee ".func::getPayeeDetails($payee)->payee_name;
            }
            if($ho_id != ''){
                $sql .= " AND e.ho_id = '$ho_id'";
                $text .= " Head Of Account ".func::getHeadAccountDetails($ho_id)->ho_name;
            }
            if($payment_mode != ''){
                $sql .= " AND e.payment_mode = '$payment_mode'";
                $text .= " Payment Mode <b>$payment_mode</b>";
            }
            if($expense_fy != ''){
                $sql .= " AND e.expense_fy = '$expense_fy'";
                $text .= " Academic Year <b>$expense_fy</b>";
            }
            $sql .= " ORDER BY e.expense_id DESC";

        }else{
            $sql = 'SELECT * FROM expense_details e, head_accounts h, payee_details p where e.ho_id=h.id AND e.payee__id=p.payee_id ORDER BY e.expense_id DESC';
            $text='';
        }
        $result = mysqli_query($db->conn, $sql);
    ?>
        <?= includes::Datatables('Expense Details', '0,1,2,3,4,5', 'landscape'); ?>
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Expense Details</h4>
                <p class="card-text">
                    <?= $text; ?>
                </p>
            </div>
            <div class="card-body">
            <table id="example" class="tbale table-sm" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>Ho</th>
                    <th>Payee Name</th>
                    <th>Amount</th>
                    <th>Expense Date</th>
                    <th>Payment Mode</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
                <?php
                $i = date("Y").'1';
                $total=0;
            while ($data = $result->fetch_object()) {
                if($data->payment_mode=="cash"){
                    $mode="<span class='badge badge-pill bg-success'>Cash</span>";
                }
                if($data->payment_mode=="cheque"){
                    $mode="<span class='badge badge-pill bg-warning'>Cheque</span>";
                }
                if($data->payment_mode=="online"){
                    $mode="<span class='badge badge-pill bg-info'>Online</span>";
                }
                if($data->payment_mode=="bank"){
                    $mode="<span class='badge badge-pill bg-danger'>Bank</span>";
                }
                echo'<tr>';
                echo'<td>'.$i++.'</td>';
                echo'<td>'.$data->ho_name.'</td>';
                echo'<td>'.$data->payee_name.'</td>';
                echo'<td>₹'.func::FormatMoney($data->expense_amount).'</td>';
                echo'<td>'.$data->expense_date.'</td>';
                echo'<td>'.$mode.'</td>';
                $total=$total+$data->expense_amount;
                ?>
                <td>
                <a onclick="window.open('<?= func::href('/Expense/PrintVocher/'.encrypt($data->expense_id)); ?>','popup','width=800,height=1000');"
                    class="badge bg-success badge-pill"><i class="fa fa-print" aria-hidden="true"></i></a>
                <button type="button" class="badge bg-warning mb-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form<?= encrypt($data->expense_id) ?>"><i class="fa fa-pencil-square"
                        aria-hidden="true"></i></button>
                <a onclick="window.open('<?= func::href('/Expense/ExpenseController/delete/'.$data->expense_id); ?>','popup','width=1000,height=1000');"
                    class="badge bg-danger badge-pill"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
                <div class="modal fade" id="modal-form<?= encrypt($data->expense_id) ?>" tabindex="-1" role="dialog"
            aria-labelledby="modal-form<?= encrypt($data->expense_id) ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h3 class="font-weight-bolder text-info text-gradient">Edit Expense <?= $data->expense_id ?> </h3>
                            </div>
                            <div class="card-body">
                                <form action="/Expense/ExpenseController/edit/<?= $data->expense_id ?>" method="post">
                                    <?= set_csrf();?>
                                    <div class="row">
                                        <div class="col-sm">
                                            <label for="payee_name">Payee Name : </label>
                                           <?= func::PayeeAccountList(["payee_id"=>$data->payee__id,"payee_name"=>$data->payee_name]); ?>
                                        </div>
                                        <div class="col-sm">
                                            <label for="payee_desc"> Expense Description : </label>
                                            <textarea name="expense_desc" id="expense_desc"  cols="4" rows="5"
                                                class="form-control" required><?= $data->expense_desc ?></textarea>
                                        </div>
                                        <div class="col-sm">
                                            <label for="expense_amount"> Amount ₹: </label><input type="number"
                                                name="expense_amount" class="form-control" id="expense_amount" value="<?= $data->expense_amount ?>" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <label for="payment_mode">Payment Mode</label>
                                            <select name="payment_mode" id="payment_mode" class="form-control" required>
                                                <option value="<?= $data->payment_mode ?>"><?= $data->payment_mode ?></option>
                                                <option value="cash">Cash</option>
                                                <option value="cheque">Cheque</option>
                                                <option value="online">Online(UPI,ESBI..)</option>
                                                <option value="bank">Bank</option>
                                            </select>
                                        </div>
                                        <div class="col-sm" id="tid_view">
                                        <label for="tid">Transaction ID : </label><input value="<?= $data->expense_trans_id ?>" type="text"  class="form-control" name="expense_trans_id" id="tid" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="ho_id">Head Of Account : </label>
                                            <?= func::HoAccountList(["id"=>$data->ho_id,"ho_name"=>$data->ho_name]);?>
                                        </div>
                                        <div class="col-sm">
                                            <label for="exp_date">Expense Date : </label><input type="date"
                                                class="form-control" value="<?= $data->expense_date ?>" name="expense_date" id="expense_date" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <label for="exp_added_by">Expense Added By : </label><input type="text"
                                                name="expense_added_by" id="expense_added_by" class="form-control"
                                                value="<?= $data->expense_added_by ?>" readonly />
                                        </div> 
                                        <div class="col-sm">
                                            <label for="fy">Academic Year : </label>
                                            <?= func::academicYear('expense_fy',[$data->expense_fy=>$data->expense_fy]);?>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-round bg-gradient-success btn-lg w-100 mt-4 mb-0">Edit Expense</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <?php 
                echo '</tr>';
            }
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Total</th>
                    <th>₹<?= $total ?></th>
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