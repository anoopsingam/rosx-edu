<?php
require_once './views/header.php';
$app->setTitle("Manage Billing Particulars");
?>
<script>
        $(function() {
          $('.chosen-select').chosen();
          $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
        });
      </script>
<div class="card">
    <div class="card-header">
        <span class="btn bg-gradient-primary">Generate Invoice</span>
    </div>
    <div class="card-body text-center">
       <form action="" method="post">
           <?= set_csrf(); ?>
       <div class="row">
           <div class="col-md-4"></div>
           <div class="col-md-4">
                 <label class="h3">Student Id </label><br>
                <?= func::studentList();?>
           </div>
           <div class="col-md-4"></div>
       </div>
       <center>
              <button type="submit" name="add_new_inv" class="btn bg-gradient-primary btn-md rounded-2 m-5">Submit</button>
       </center>
       </form>
    </div>
</div>

<?php
    if(isset($_POST['add_new_inv']) && is_csrf_valid()){
        $student_id=mysqli_real_escape_string($db->conn,$_POST['studentid']);
        if(!empty($student_id)){
            $row=func::getStudentDetails($student_id);
        if(!empty($row->studentid)){
            ?>
            
            <div class="card mt-3">
    <div class="card-header text-center">
        <h5>General Invoice</h5>
    </div>
    <div class="card-body">
        <form action="/GeneralInvoice/Controller/new/<?= uniqid(); ?>" method="post">
            <input type="hidden" name="token_id" value="<?= uniqid(); ?>" id="">
            <div class="row mb-2">
                <div class="col-sm">
                    <label for="">Student Name : </label>
                    <input type="text" class="form-control" value="<?= $row->student_name; ?>" readonly>
                </div>
                <div class="col-sm">
                    <label for="">Student Id : </label>
                    <input type="text" class="form-control" name="student_id" value="<?= $row->studentid ?>"
                        readonly>
                </div>
                <div class="col-sm">
                    <label for="">Father Name : </label>
                    <input type="text" class="form-control" value="<?= $row->father_name ?>" readonly>
                </div>
              
            </div>
            <div class="row mb-2">
            <div class="col-sm">
                    <label for="">Address : </label>
                    <textarea class="form-control" rows="5" cols="10"
                        readonly><?= $row->permanentaddress ?></textarea>
                </div>
                <div class="col-sm">
                    <label for="">Class : </label>
                    <input type="text" class="form-control" value="<?= $row->present_class; ?>" readonly>
                </div>
                <div class="col-sm">
                    <label for="">Section : </label>
                    <input type="text" class="form-control" value="<?= $row->present_section ?>" readonly>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
                    <label for="">Account Type : </label>
                    <select class="form-control" id="account_type" name="account_type" required>
                        <option value="">Select Account Type</option>
                        <option value="ACC">ACC</option>
                        <option value="NACC">NACC</option>
                    </select>
                </div>
                <div class="col-sm">
                    <label for="">Payment Mode : </label>
                    <select class="form-control" id="payment_mode" name="payment_mode" required>
                        <option value="">Select Payment Mode</option>
                        <option value="CASH">CASH</option>
                        <option value="UPI">UPI/ONLINE</option>
                        <option value="CHEQUE">CHEQUE</option>
                        <option value="DD">DD</option>
                    </select>
                </div>
                <div class="col-sm">
                    <label for="">Invoice Date :</label>
                    <input type="date" class="form-control" name="invoice_date" value="<?= date('Y-m-d'); ?>" required>
                </div>
                <div class="col-sm">
                    <label for="">Payment Status : </label>
                    <select class="form-control" id="payment_status" name="payment_status" required>
                        <option value="">Select Payment Status</option>
                        <option value="PENDING">PENDING</option>
                        <option value="PAID">PAID</option>
                    </select>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row mt-2">
                    <div class="col-sm">
                        <label for="">Particular Name : </label>
                        <input type="text" class="form-control" id="item_name_particular" list="particulars">
                        <?php 
                $sql = "SELECT * FROM billing_particulars order by particular_name ASC";
                $result = mysqli_query($db->conn,$sql);
                if(mysqli_num_rows($result)>0){
                    echo "<datalist id='particulars'>";
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='".$row['billing_particular_id']."'>".$row['particular_name']."</option>";
                    }
                    echo "</datalist>";
                }else{
                    echo "Please Add Particulars to Generate Invoice";
                }
                ?>
                    </div>
                    <div class="col-sm">
                        <span class="btn bg-gradient-danger mt-4 text-light fw-bolder btn-md" onclick="AddParticular()"
                            id="add_particular_row">
                            Add Particular
                        </span>
                    </div>
                </div>
                <?= set_csrf(); ?>
                <table class="table table-bordered mt-3" id="particular_table">
                    <thead>
                        <tr class="bg-dark text-light">
                            <th>Particular</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <center>
                    <button type="submit" name="generate_invoice"
                        class="btn bg-gradient-primary btn-md rounded-2 m-4">Generate
                        Invoice</button>
                </center>
                <script>
                //onlclick add_particular_row button
                function AddParticular() {
                    //get the value of particular_name
                    var particular_name = document.getElementById('item_name_particular').value;
                    if (particular_name == "") {
                        alert("Please Select Particular");
                    } else {
                        //get the value of amount throught xhr
                        var xhr = new XMLHttpRequest();
                        //post the value of particular_name
                        xhr.open('POST', '<?= func::href('/Api/ParticularData')?>', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.send('id=' + particular_name);
                        xhr.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                let data = JSON.parse(this.responseText);
                                if (data.status == "success") {
                                    //add a new row to the table with the value of particular_name and amount
                                    var table = document.getElementById('particular_table');
                                    data = data.data;
                                    let total_amount = 0;
                                    var row = table.insertRow(table.rows.length);
                                    var cell1 = row.insertCell(0);
                                    var cell2 = row.insertCell(1);
                                    var cell3 = row.insertCell(2);
                                    cell1.innerHTML =
                                        "<input type='text' name='particular[]' class='form-control' value='" + data
                                        .particular_name + "' readonly>";
                                    cell2.innerHTML =
                                        "<input type='text' name='charges[]' class='form-control' value='" + data
                                        .charges + "' readonly>";
                                    cell3.innerHTML =
                                        "<button class='m-2 btn btn-danger btn-sm' onclick='RemoveParticular(this)'>Remove</button>";
                                    //clear the value of particular_name
                                    document.getElementById('item_name_particular').value = "";

                                } else {
                                    alert("Please Enter Valid Particular");
                                    //set the value of particular_name to empty
                                    document.getElementById('item_name_particular').value = "";
                                }
                            }
                        }

                    }
                }

                function RemoveParticular(element) {
                    //remove the row of the table
                    element.parentNode.parentNode.remove();
                }
                </script>
            </div>
        </form>
    </div>
</div>
            
            <?php
        }else{
            ?>
            <div class="alert alert-danger text-light mt-5" role="alert">
                <strong>Error !!</strong> No Student Found for this Id <?= $student_id; ?>.
            </div>
            <?php 
        }
        }else{
            js::alert('Please Select Student Id');
        }

    }

?>

<?php   
    require_once './views/footer.php';
?>