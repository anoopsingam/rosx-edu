<?php 
   require '././config.php';
   $db=new database();
   $app= new app();
   if(empty(func::UnifiedTransportTransInfo($transaction)) || empty(func::getFeeTransactionDetails($transaction))){
       js::alert("Transport Not Opted ... Please Print other Receipt ");
       js::WindowClose();
   }
   $row= array_merge(func::UnifiedTransportTransInfo($transaction),func::getFeeTransactionDetails($transaction));
//    print_r($row);
   $total_Fee_paid= $row['paid_amount']+$row['trans_paid_amount'];
   $transport_balance=$row['route_stage_fare']-$row['acc_paid'];
   $total_balance=$row['balance_amount']+$transport_balance;
   $total_discount=$row['disc_amt']+$row['trans_discount'];
?>
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
footer {
    page-break-before: always;
}

</style>

<body>
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
                        <br>
                        <h5>
                            <b>
                                Fee Payment Receipt
                            </b>
                        </h5>
                    </div>
                    <div class="col-md-3">
                        <div class="float-right m-4">
                            <!-- <h6 class="mb-0">Bill No #<?= $row['trans_bill_no']?></h6> -->
                            Date: <?= $row['trans_date']?>
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
                        <h6>Student ID: <b><?= $row['studentid']?></b></h6>
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
                <table class="table table-striped table-bordered border-dark border-5">
                    <thead>
                        <tr>
                            <th class="center">Bill No</th>
                            <th>Particular Name</th>
                            <th>Total Fee</th>
                            <th class="right">Paid Amount</th>
                            <th class="right">Discount</th>
                            <th class="right"> Balance Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="center"><?= $row['bill_no'];?></td>
                            <td>Tuition Fee</td>
                            <td class="right">
                                ₹<?= $row['total_fee'];?>
                            </td>
                            <td class="right">
                                ₹<?= $row['paid_amount'];?>
                            </td>
                            <td class="right">
                                ₹<?= $row['disc_amt'];?>
                            </td>
                            <td>
                                ₹<?= $row['balance_amount'];?>
                            </td>
                        </tr>
                        <tr>
                            <td class="center"><?= $row['trans_bill_no'];?></td>
                            <td>Transport Fee</td>
                            <td class="right">
                                ₹<?= $row['route_stage_fare'];?>
                            </td>
                            <td class="right">
                                ₹<?= $row['trans_paid_amount'];?>
                            </td>
                            <td class="right">
                                ₹<?= $row['trans_discount']; ?>
                            </td>
                            <td>₹<?= $transport_balance;?></td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4">
                                <strong class="text-dark">Total Discount Issued </strong>
                            </td>
                            <td class="right">
                                <strong class="text-dark">₹<?= $total_discount; ?></strong>
                            </td>
                            <td rowspan="2" class="text-center">
                                <h4> ₹<?= $total_balance; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4">
                                <strong class="text-dark">Total Payable </strong>
                            </td>
                            <td class="right">
                                <strong class="text-dark">₹<?= $total_Fee_paid;?></strong>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <table class="table table-bordered table-sm">
                <tr>

                    <td>
                        <h6>
                            Date : <b><?= $row['trans_date']?></b>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            Payment Mode : <b><?= $row['trans_payment_mode']?></b>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            Transaction Id : <b><?= $row['trans_gen_id']?></b>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            Payment Recived By : <b><?= $row['trans_added_by']?></b>
                        </h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        Transaction Note :
                        <h6>
                             <b><?= $row['transaction_note']?></b>
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
                Software Designed & Developed by <b>RoborosX Multi Tech Solutions LLP</b>
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
                        <br>
                        <h5>
                            <b>
                                Fee Payment Receipt
                            </b>
                        </h5>
                    </div>
                    <div class="col-md-3">
                        <div class="float-right m-4">
                            <!-- <h6 class="mb-0">Bill No #<?= $row['trans_bill_no']?></h6> -->
                            Date: <?= $row['trans_date']?>
                            <h6 class="mt-2 text-bolder">
                                School Copy
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
                        <h6>Student ID: <b><?= $row['studentid']?></b></h6>
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
                <table class="table table-striped table-bordered border-dark border-5">
                    <thead>
                        <tr>
                            <th class="center">Bill No</th>
                            <th>Particular Name</th>
                            <th>Total Fee</th>
                            <th class="right">Paid Amount</th>
                            <th class="right">Discount</th>
                            <th class="right"> Balance Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="center"><?= $row['bill_no'];?></td>
                            <td>Tuition Fee</td>
                            <td class="right">
                                ₹<?= $row['total_fee'];?>
                            </td>
                            <td class="right">
                                ₹<?= $row['paid_amount'];?>
                            </td>
                            <td class="right">
                                ₹<?= $row['disc_amt'];?>
                            </td>
                            <td>
                                ₹<?= $row['balance_amount'];?>
                            </td>
                        </tr>
                        <tr>
                            <td class="center"><?= $row['trans_bill_no'];?></td>
                            <td>Transport Fee</td>
                            <td class="right">
                                ₹<?= $row['route_stage_fare'];?>
                            </td>
                            <td class="right">
                            ₹<?= $row['trans_paid_amount'];?>
                            </td>
                            <td class="right">
                                ₹<?= $row['trans_discount']; ?>
                            </td>
                            <td>₹<?= $transport_balance;?></td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4">
                                <strong class="text-dark">Total Discount Issued </strong>
                            </td>
                            <td class="right">
                                <strong class="text-dark">₹<?= $total_discount; ?></strong>
                            </td>
                            <td rowspan="2" class="text-center">
                                <h4> ₹<?= $total_balance; ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4">
                                <strong class="text-dark">Total Payable </strong>
                            </td>
                            <td class="right">
                                <strong class="text-dark">₹<?= $total_Fee_paid;?></strong>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <table class="table table-bordered table-sm">
                <tr>

                    <td>
                        <h6>
                            Date : <b><?= $row['trans_date']?></b>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            Payment Mode : <b><?= $row['trans_payment_mode']?></b>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            Transaction Id : <b><?= $row['trans_gen_id']?></b>
                        </h6>
                    </td>
                    <td>
                        <h6>
                            Payment Recived By : <b><?= $row['trans_added_by']?></b>
                        </h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        Transaction Note :
                        <h6>
                             <b><?= $row['transaction_note']?></b>
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
                Software Designed & Developed by <b>RoborosX Multi Tech Solutions LLP</b>
            </p>
        </div>
    </div>
</body>

</html>