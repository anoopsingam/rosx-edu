<?php
require_once './views/header.php';
$app->setTitle('Transaction Reports');
?>
<div class="card m-2">
    <div class="card-header">
        <a href="/" class="btn btn-dark btn-sm">Back</a>
        <br>
        <span class="btn bg-gradient-primary btn-lg">Fee Payment Due List (Date)</span>
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
                            <input type="date" class="form-control" id="from_date" name="from_date"
                                value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-sm">
                            <label for="">To Date : </label>
                            <input type="date" class="form-control" id="to_date" name="to_date"
                                value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-sm">
                            <label for="">Academic Year : </label>
                            <?= func::academicYear("academic_year")?>
                        </div>
                        <div class="col-sm">
                            <label for="">Class : </label>
                            <?=func::classlist("class");?>
                        </div>
                        <div class="col-sm">
                            <label for="">User : </label>
                            <?= func::adminList("user_id")?>
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
            if(isset($_POST['search_transaction'])){
                $from_date = $_POST['from_date'];
                $to_date = $_POST['to_date'];
                $academic_year = $_POST['academic_year'];
                $class = $_POST['class'];
                $user_id = $_POST['user_id'];
                $transaction_mode = $_POST['transaction_mode'];
                $sql="SELECT * FROM fee_transactions f, student_enrollment e  WHERE f.student_id=e.studentid ";
                if(!empty($from_date)){
                    $sql.=" AND f.due_date>='$from_date'";
                }
                if(!empty($to_date)){
                    $sql.=" AND f.due_date<='$to_date'";
                }
                if($academic_year!=""){
                    $sql.=" AND ay='$academic_year' ";
                }
                if($class!=""){
                    $sql.=" AND class='$class' ";
                }
                if($user_id!=''){
                    $sql.=" AND loginid='$user_id' ";
                }
                if($transaction_mode!=""){
                    $sql.=" AND transaction_mode='$transaction_mode' ";
                }
                echo $sql;
                includes::Datatables(" Fee Transaction Due Date Data $_POST[from_date] to $_POST[to_date] ", '0,1,2,3,4,5,6,7,8', 'landscape');
            }else{
                $sql="SELECT * FROM fee_transactions f, student_enrollment e  WHERE f.student_id=e.studentid ";
                includes::Datatables(' Fee Transaction Due Date Data ', '0,1,2,3,4,5,6,7,8', 'landscape');
            }
        $result = mysqli_query($db->conn, $sql);
    ?>


        <div class="container" style="overflow:scroll;">
            <table id="example" class=" table table-bordered table-sm table-responsive-xl" >
            <thead>
                <tr class="bg-gradient-dark text-light">
                    <th>Student ID</th>
                    <th>Bill No.</th>
                    <th>Student Name</th>
                    <th>Class-Section</th>
                    <th>Billing Date</th>
                    <th>Installment</th>
                    <th>Fee Paid</th>
                    <th>Due Date</th>
                    <th>Transaction Id</th>
                    <th>Login Id</th>
                    <th>Academic Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
                <?php
               $total=0;
            while ($data = $result->fetch_object()) {
                echo'<tr>';
                echo'<td>'.$data->student_id.'</td>';
                echo'<td>'.$data->bill_no.'</td>';
                echo'<td>'.$data->student_name.'</td>';
                echo'<td>'.$data->present_class.'-'.$data->present_section.'</td>';
                echo'<td>'.$data->billing_date.'</td>';
                echo'<td>'.$data->installment.'</td>';
                echo'<td>'.'₹'.$data->paid_amount.'</td>';
                echo'<td>'.$data->due_date.'</td>';
                echo'<td>'.$data->tid.'</td>';
                echo'<td>'.$data->loginid.'</td>';
                echo'<td>'.$data->ay.'</td>';
                echo '<td>'; ?>
                <a onclick="window.open('/Transaction/Print/<?php echo $data->tid ?>','popup','width=800,height=750');"><button class="btn btn-success btn-sm"><i class="fa fa-print" aria-hidden="true"></i> print</button></a></td>
                <?php
            echo '</td>';
                echo '</tr>';
                $total=$total+$data->paid_amount;
            }
            ?>
            </tbody>
            <tfoot>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <b>Total</b>
                </td>
                   <td>
                   <?=  '₹'.$total ?>
                   </td>
                   <td></td>
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