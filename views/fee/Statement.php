<?php
require_once './views/header.php';
$app->setTitle("Transaction Statement");
?>
<script>
$(function() {
    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({
        allow_single_deselect: true
    });
});
</script>
<div class="card shadow-lg m-3">
    <div class="card-header">
        <button class="btn bg-gradient-warning">Transaction Statement</button>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <?= set_csrf();?>
            <div class="row">
                <div class="col-md-6">
                    <label class="h3">Student Id </label><br>
                    <?= func::studentList();?>
                </div>
                <div class="col-md-6">
                    <label class="h4">Academic Year</label>
                    <?= func::academicYear();?>

                </div>
            </div>
            <center>
                <button type="submit" name="trans_fetch"
                    class="btn bg-gradient-primary btn-md rounded-2 m-4">Submit</button>
            </center>
        </form>
    </div>
</div>
<?php 
    if(isset($_POST['trans_fetch'])){
        $studentid=$_POST['studentid'];
        $academic_year=$_POST['ay'];
        $sql="SELECT * FROM fee_transactions f, student_enrollment e WHERE f.student_id='$studentid' AND f.ay='$academic_year' AND f.student_id=e.studentid ";
        $result=  mysqli_query($db->conn, $sql);
        if(mysqli_num_rows($result)>0){
            echo "<div class='card shadow-lg m-3'>
            <div class='card-header'>
                <button class='btn bg-gradient-success text-light btn-lg fw-bolder'>Success..</button>
            </div>
            <div class='card-body'>
            <center class='m-3 h3 text-dark '>$studentid  Fee Statement for AY - $academic_year</center>
            <table class='table table-bordered table-striped table-hover text-center'>
                <thead>
                    <tr>
                        <th>Student Id</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Academic Year</th>
                        <th>Paid</th>
                        <th>Date</th>
                        <th>Transaction Mode</th>
                    </tr>
                </thead>
                <tbody>";
            while($row=  mysqli_fetch_assoc($result)){
                echo "<tr>
                    <td>".$row['student_id']."</td>
                    <td>".$row['student_name']."</td>
                    <td>".$row['present_class']."</td>
                    <td>".$row['ay']."</td>
                    <td>".$row['paid_amount']."</td>
                    <td>".$row['billing_date']."</td>
                    <td>".$row['transaction_mode']."</td>
                </tr>";
            }
            echo "</tbody>
            </table>
            </div>";
            ?>
            <form action="<?= func::href('/Transaction/Statement/Print')?>" target="_blank" method="post">
                <?= set_csrf();?>
                <input type="hidden" name="studentid" value="<?= $studentid?>">
                <input type="hidden" name="ay" value="<?= $academic_year?>">
                <button type="submit" name="print" class="btn bg-gradient-primary btn-md rounded-2 m-4">Print</button>
            </form>
            </div>
            <?php
             
    }else{
        echo "<div class='card shadow-lg m-3'>
        <div class='card-header'>
            <span class='btn bg-gradient-dark text-info'>Sorry...</span>
        </div>
        <div class='card-body'>
        <center class='m-3 h4 text-dark '>No Transaction Found for $studentid for Academic Year $academic_year</center>
        </div>
        </div>";
    }
}

?>
<?php   
    require_once './views/footer.php';
?>