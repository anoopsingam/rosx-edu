<?php
require_once './views/header.php';
$app->setTitle('Transaction Statement Class Wise');
?>
<div class="card m-2">
    <div class="card-header">
        <a href="/" class="btn btn-dark btn-sm">Back</a>
        <br>
        <span class="btn bg-gradient-primary btn-lg">Fee Statement For Class</span>
    </div>
    <div class="card-body">
        <div class="card shadow-lg m-3 p-2">
            <div class="card-header">
                <span class="h3">Search Statement</span>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm">
                            <label for="">Academic Year : </label>
                            <?= func::academicYear("academic_year")?>
                        </div>
                        <div class="col-sm">
                            <label for="">Class : </label>
                            <?=func::classlist("class");?>
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
                
                $academic_year = $_POST['academic_year'];
                $class = $_POST['class'];
            
                $sql="SELECT * FROM account f, student_enrollment e  WHERE f.student_id=e.studentid ";
                if($class!=""){
                    $sql.=" AND class='$class' ";
                }
                if($academic_year!=""){
                    $sql.=" AND acdy='$academic_year' ";
                }
                includes::Datatables(" Fee Statement for Class $_POST[class] ", '0,1,2,3,4,5,6', 'landscape');
                $result = mysqli_query($db->conn, $sql);
                ?>
        <div class="container" >
            <form action="/Transaction/Statement/Class/print" target="_balnk" method="post">
                <?= set_csrf(); ?>
                <input type="hidden" name="academic_year" value="<?=$academic_year?>">
                <input type="hidden" name="class" value="<?=$class?>">
                <button type="submit" class="btn bg-gradient-danger">Print Extract</button>
            </form>
            <table id="example" class=" table table-bordered table-sm table-responsive-xl">
                <thead>
                    <tr class="bg-gradient-dark text-light">
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Total Fee</th>
                        <th>Fee Paid</th>
                        <th>Fee Balance</th>
                        <th>Discount</th>
                        <th>Academic Year</th>
                    </tr>
                </thead>
                <tbody style="font-size:small;">
                    <?php
               $total_fee_collected=0;
               $count=0;
               $total_fee_balance=0;
               $total_discount=0;
            while ($data = $result->fetch_object()) {
                echo'<tr>';
                echo'<td>'.$data->student_id.'</td>';
                echo'<td>'.$data->student_name.'</td>';
                echo'<td>'.$data->class.'</td>';
                echo'<td>'.$data->total_fee.'</td>';
                echo'<td>'.$data->fee_paid.'</td>';
                echo'<td>'.$data->fee_balance.'</td>';
                echo'<td>'.$data->discount.'</td>';
                echo'<td>'.$data->acdy.'</td>';
                echo'</tr>';
                $total_fee_collected=$total_fee_collected+$data->fee_paid;
                $total_fee_balance=$total_fee_balance+$data->fee_balance;
                $total_discount=$total_discount+$data->discount;
                $count++;
            }
            ?>
                </tbody>
            </table>
        </div>
        <?php
            }else{
                
            }
        ?>
    </div>
</div>
<?php
    require_once './views/footer.php';
?>