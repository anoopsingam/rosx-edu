<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    </head>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Sora', sans-serif;
}

/* .padding {

    padding: 2rem !important;
}

.card {
    margin-bottom: 30px;
    border: none;
    -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
    -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
    box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
}

.card-header {
    background-color: #fff;
    border-bottom: 1px solid #e6e6f2;
}

h3 {
    font-size: 20px;
}

h5 {
    font-size: 15px;
    line-height: 26px;
    color: #3d405c;
    margin: 0px 0px 15px 0px;
    font-family: 'Circular Std Medium';
} */

footer {
    page-break-before: always;
}

.text-dark {
    color: #3d405c !important;
}
    </style>

    <body>
        <?php 
        
        if(isset($invid) || empty($invid)){
            require '././config.php';
            $db=new database();
            $app= new app();
            $inv_no =mysqli_real_escape_string($db->conn,decrypt($invid));
            $sql=mysqli_query($db->conn,"SELECT * FROM general_invoice g, student_enrollment e WHERE g.invoice_no = '$inv_no' AND g.stu_id=e.studentid");
            if(mysqli_num_rows($sql)>0){
                $row = mysqli_fetch_assoc($sql);
            // print_r($row);
                ?>
        
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding border border-5 border-dark">
            <div class="card">
                <div class="card-header p-4">
                    <div class="row mt-2">
                        <div class="col-md-3 text-center">
                            <?= $app->SetLogo('150','150');?>
                        </div>
                        <div class="col-md-6 text-center">
                            <h2 class="mt-4">
                                <?= $app->name();?>
                            </h2>
                            <h6>
                                <b>
                                    Powered by RosX Edu Soft
                                </b>
                            </h6>
                        </div>
                        <div class="col-md-3">
                            <div class="float-right m-4">
                                <h6 class="mb-0">Invoice #<?= $row['invoice_no']?></h6>
                                Date: <?= $row['invoice_date']?>
                                <h6 class="mt-2 text-bolder">
                                    Student Copy
                                </h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            <h6>Student Name: <b><?= $row['student_name']?></b></h6>
                        </td>
                        <td>
                            <h6>Student ID: <b><?= $row['stu_id']?></b></h6>
                        </td>
                        <td>
                            <h6>Class : <b><?= $row['present_class']?></b></h6>
                        </td>
                        <td>
                            <h6>Section : <b><?= $row['present_section']?></b></h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Father's Name: <b><?= $row['father_name']?></b></h6>
                        </td>
                        <td>
                            <h6>Mother's Name: <b><?= $row['mother_name']?></b></h6>
                        </td>
                        <td>
                            <h6>Contact No: <b><?= $row['father_number']?></b></h6>
                        </td>
                        <td colspan="3">
                            <h6>Address : <br>
                                <?= $row['permanentaddress']?>
                            </h6>
                        </td>
                    </tr>
                </table>
                <div class="table-responsive-sm">
                    <h5 class="text-center">
                        <b>Bill Details </b>
                    </h5>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Particular Name</th>
                                <th class="right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $d=json_decode($row['particulars'],true);
                                $i=1;
                                foreach($d as $det){
                                    ?>
                            <tr>
                                <td class="center"><?= $i?></td>
                                <td><?= $det['particulars_id']?></td>
                                <td class="right">₹ <?= $det['charges']?></td>
                            </tr>
                            <?php 
                            $i++;
                            }?>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <strong class="text-dark">Total Payable </strong>
                                </td>
                                <td class="right">
                                    <strong class="text-dark">₹<?= $row['total_amount']?></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="table table-bordered table-sm">
                            <tr>
                                <td class="text-center">
                                    <h6>
                                        Invoice No : <b><?= $row['invoice_no']?></b>
                                    </h6>
                                </td>
                                <td>
                                    <h6>
                                        Date : <b><?= $row['invoice_date']?></b>
                                    </h6>
                                </td>
                                <td>
                                    <h6>
                                        Payment Mode : <b><?= $row['payment_mode']?></b>
                                    </h6>
                                </td>
                                <td>
                                    <h6>
                                        Status : <b><?= $row['payment_status']?></b>
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-center">
                                    <h6>
                                        Payment Recived By : <b><?= $row['invoice_added_by']?></b>
                                    </h6>
                                </td>
                            </tr>
                        </table>
                <table class="table table-borderless text-center">
                    <tr>
                        <td>
                            <h6 class="mt-4">
                                Signature /-
                            </h6>
                        </td>
                        <td>
                            <h6 class="mt-4">
                                Cashier Signature /-
                            </h6>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer bg-white text-center">
                <small class="mb-0">
                    <p><b>Contact :</b> <?= $app->phone();?>, <b>Email :
                        </b><?= $app->email();?>, <b>Address : </b>
                        <?= $app->address();?></p>
                </small>
                <p>
                    Software Designed & Developed by <b>RoborosX Omni Tech Solutions LLP</b>
                </p>
            </div>
        </div>
        <footer></footer>
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding border border-5 border-dark">
            <div class="card">
                <div class="card-header p-4">
                    <div class="row mt-2">
                        <div class="col-md-3 text-center">
                            <?= $app->SetLogo('150','150');?>
                        </div>
                        <div class="col-md-6 text-center">
                            <h2 class="mt-4">
                                <?= $app->name();?>
                            </h2>
                            <h6>
                                <b>
                                    Powered by RosX Edu Soft
                                </b>
                            </h6>
                        </div>
                        <div class="col-md-3">
                            <div class="float-right m-4">
                                <h6 class="mb-0">Invoice #<?= $row['invoice_no']?></h6>
                                Date: <?= $row['invoice_date']?>
                                <h6 class="mt-2 text-bolder">
                                    School/College Copy
                                </h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            <h6>Student Name: <b><?= $row['student_name']?></b></h6>
                        </td>
                        <td>
                            <h6>Student ID: <b><?= $row['stu_id']?></b></h6>
                        </td>
                        <td>
                            <h6>Class : <b><?= $row['present_class']?></b></h6>
                        </td>
                        <td>
                            <h6>Section : <b><?= $row['present_section']?></b></h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Father's Name: <b><?= $row['father_name']?></b></h6>
                        </td>
                        <td>
                            <h6>Mother's Name: <b><?= $row['mother_name']?></b></h6>
                        </td>
                        <td>
                            <h6>Contact No: <b><?= $row['father_number']?></b></h6>
                        </td>
                        <td colspan="3">
                            <h6>Address : <br>
                                <?= $row['permanentaddress']?>
                            </h6>
                        </td>
                    </tr>
                </table>
                <div class="table-responsive-sm">
                    <h5 class="text-center">
                        <b>Bill Details </b>
                    </h5>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Particular Name</th>
                                <th class="right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $d=json_decode($row['particulars'],true);
                                $i=1;
                                foreach($d as $det){
                                    ?>
                            <tr>
                                <td class="center"><?= $i?></td>
                                <td><?= $det['particulars_id']?></td>
                                <td class="right">₹ <?= $det['charges']?></td>
                            </tr>
                            <?php 
                            $i++;
                            }?>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <strong class="text-dark">Total Payable </strong>
                                </td>
                                <td class="right">
                                    <strong class="text-dark">₹<?= $row['total_amount']?></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="table table-bordered table-sm">
                            <tr>
                                <td class="text-center">
                                    <h6>
                                        Invoice No : <b><?= $row['invoice_no']?></b>
                                    </h6>
                                </td>
                                <td>
                                    <h6>
                                        Date : <b><?= $row['invoice_date']?></b>
                                    </h6>
                                </td>
                                <td>
                                    <h6>
                                        Payment Mode : <b><?= $row['payment_mode']?></b>
                                    </h6>
                                </td>
                                <td>
                                    <h6>
                                        Status : <b><?= $row['payment_status']?></b>
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-center">
                                    <h6>
                                        Payment Recived By : <b><?= $row['invoice_added_by']?></b>
                                    </h6>
                                </td>
                            </tr>
                        </table>
                <table class="table table-borderless text-center">
                    <tr>
                        <td>
                            <h6 class="mt-4">
                                Signature /-
                            </h6>
                        </td>
                        <td>
                            <h6 class="mt-4">
                                Cashier Signature /-
                            </h6>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer bg-white text-center">
                <small class="mb-0">
                    <p><b>Contact :</b> <?= $app->phone();?>, <b>Email :
                        </b><?= $app->email();?>, <b>Address : </b>
                        <?= $app->address();?></p>
                </small>
                <p>
                    Software Designed & Developed by <b>RoborosX Omni Tech Solutions LLP</b>
                </p>
            </div>
        </div>
        </div>
        <?php
            }else{
                ?>
        <div class="container">
            <div class="alert alert-danger">
                <strong>Error!</strong> Invoice not found.
            </div>
        </div>
        <?php
            }
        }else{
            ?>
        <div class="container">
            <div class="alert alert-danger">
                <strong>Error!</strong> Please Provide Inovice No to view the invoice.
            </div>
        </div>
        <?php
        }
        
        
        ?>

    </body>

    </html>