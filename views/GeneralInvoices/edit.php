<?php
require_once './views/header.php';
$id=decrypt($invid);
$app->setTitle("Edit Invoice-".$id);
if(!empty($id)){
    $sql=mysqli_query($db->conn,"SELECT * FROM general_invoice g, student_enrollment e WHERE g.invoice_no = '$id' AND g.stu_id = e.studentid ");
    // echo $sql;
    $inv = mysqli_fetch_assoc($sql);
    ?>
    <div class="card mt-3">
    <div class="card-header text-center">
        <h5>General Invoice</h5>
    </div>
    <div class="card-body">
    <form action="/GeneralInvoice/Controller/edit/<?= encrypt($inv['invoice_no'])?>" method="post">
        <?= set_csrf();?>       
    <input type="hidden" name="token_id" value="<?= uniqid(); ?>" id="">
            <div class="row mb-2">
                <div class="col-sm">
                    <label for="">Student Name : </label>
                    <input type="text" class="form-control" value="<?= $inv['student_name']; ?>" readonly>
                </div>
                <div class="col-sm">
                    <label for="">Student Id : </label>
                    <input type="text" class="form-control" name="student_id" value="<?= $inv['studentid']; ?>"
                        readonly>
                </div>
                <div class="col-sm">
                    <label for="">Father Name : </label>
                    <input type="text" class="form-control" value="<?= $inv['father_name']; ?>" readonly>
                </div>
              
            </div>
            <div class="row mb-2">
            <div class="col-sm">
                    <label for="">Address : </label>
                    <textarea class="form-control" rows="5" cols="10"
                        readonly><?= $inv['permanentaddress']; ?></textarea>
                </div>
                <div class="col-sm">
                    <label for="">Class : </label>
                    <input type="text" class="form-control" value="<?= $inv['present_class']; ?>" readonly>
                </div>
                <div class="col-sm">
                    <label for="">Section : </label>
                    <input type="text" class="form-control" value="<?= $inv['present_section']; ?>" readonly>
                </div>
               
            </div>
            <div class="row mt-5 mb-3">
                    <div class="col-sm">
                        <label for="">Invoice No :</label>
                        <input type="text" class="form-control" name="invoice_no" value="<?= $inv['invoice_no']; ?>" readonly>
                        <input type="hidden" class="form-control" name="token_id" value="<?= $inv['inv_token_id']; ?>" readonly>
                    </div>
                <div class="col-sm">
                    <label for="">Account Type : </label>
                    <select class="form-control" id="account_type" name="account_type" required>
                        <option value="<?= $inv['account_type']?>" selected><?= $inv['account_type']?></option>
                        <option value="ACC">ACC</option>
                        <option value="NACC">NACC</option>
                    </select>
                </div>
                <div class="col-sm">
                    <label for="">Payment Mode : </label>
                    <select class="form-control" id="payment_mode" name="payment_mode" required>
                    <option value="<?= $inv['payment_mode']?>" selected><?= $inv['payment_mode']?></option>
                        <option value="CASH">CASH</option>
                        <option value="UPI">UPI/ONLINE</option>
                        <option value="CHEQUE">CHEQUE</option>
                        <option value="DD">DD</option>
                    </select>
                </div>
                <div class="col-sm">
                    <label for="">Invoice Date :</label>
                    <input type="date" class="form-control" name="invoice_date" value="<?= $inv['invoice_date']?>" required>
                </div>
                <div class="col-sm">
                    <label for="">Payment Status : </label>
                    <select class="form-control" id="payment_status" name="payment_status" required>
                    <option value="<?= $inv['payment_status']?>" selected><?= $inv['payment_status']?></option>
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
                        <?php 
                                $d=json_decode($inv['particulars'],true);
                                $i=1;
                                foreach($d as $det){
                                    ?>
                        <tr>

                            <td><input type='text' name='particular[]' class='form-control'
                                    value='<?= $det['particulars_id']?>' readonly> </td>
                            <td><input type='text' name='charges[]' class='form-control' value='<?= $det['charges']?>'
                                    readonly> </td>
                            <td>
                                <button class='m-2 btn btn-danger btn-sm'
                                    onclick='RemoveParticular(this)'>Remove</button>
                            </td>
                        </tr>
                        <?php 
                            $i++;
                            }?>
                    </tbody>
                </table>
                <center>
                    <button type="submit" name="generate_invoice"
                        class="btn bg-gradient-warning btn-md rounded-2 m-4">Update
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
}
?>

<?php   
    require_once './views/footer.php';
?>