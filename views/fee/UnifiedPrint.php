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
   $transport_balance=$row['route_stage_fare']-$row['acc_paid']-$row['trans_discount'];
   $total_balance=$row['balance_amount']+$transport_balance;
   $total_discount=$row['disc_amt']+$row['trans_discount'];

   $qrArray= [
    "Institution Name :  ".$app->name,
    "Student Id :  ".$row['student_id'],
    "Student Name :  ".$row['student_name'],
    "Class  :  ".$row['present_class'].' - '.$row['present_section'],
    "Billing Date :  ".$row['trans_date'],
    "Transaction Id  :  ".$row['trans_gen_id'],
    "Total Fee Paid  :  ".$total_Fee_paid,
    "Total Fee Balance :  ".$total_balance,
    "Total Discount Issued :  ".$total_discount,
    "Bill No :   ".$row['bill_no'].' '.$row['trans_bill_no'],
    "Academnic Year :  ".$row['acc_academic_year']
   ];
    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap');


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Sora', sans-serif;
}
    

    body {
        /* font-family: 'Montserrat', sans-serif; */
        height: fit-content;
        background-color: white;
    }

    .main {
        width: 1150px;
        height: 810px;
        margin: 10px auto;
        padding: 10px 0px;
        color: rgb(26, 26, 26);
    }

    /* #logo {
            max-height: 60px;
            min-height: 50px;
            padding: 0em 3em;
        } */

    .info-1,
    .info-2 {
        padding: 0px 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .info {
        height: 20px;
    }

    .col {
        font-size: large;
        margin-top: 0px;
    }

    .col label {
        font-weight: 500;
    }

    .info,
    .footer {
        width: 95%;
        height: min-content;
        margin: 0px auto;
        padding: 5px;
    }

    table {
        width: 100%;
        padding: 0px 10px;
    }

    th,
    td {
        padding-left: 10px;
    }

    .fee-content {
        width: 90%;
        height: 4.5cm;
        padding: 0%;

    }

    .fee-content .row,
    .fee-content .row .col-7 {
        line-height: 0;
        border-left: 3px solid #000;
    }

    .row h4 {
        border: 3px solid gray;
    }

    span {
        font-size: small;
    }

    label {
        font-size: medium;
    }


    .footer {
        padding: 0%;
        height: auto;
        padding-bottom: 0%;
    }

    </style>
</head>


<body class="fs-5">
<div class="main border border-dark border-5 mt-2  bg-logo">
        <!-- HEADER PART -->
        <div class="" style="border-bottom: 1px solid black; padding-bottom: 5px;">
            <div class="row">
                <div class="col-3" style="text-align: start; ">
                    <a href="/Transaction/Reports"><img src="<?=  url::myurl().'/'.$app->logo; ?>" id="logo"
                            height="120px" width="120px" style="margin-left: 30px;" alt="logo"></a>
                </div>

                <div class="col-6 text-center" style="text-align: center; line-height: 1.2;">
                    <span style="font-weight:900; color: black; padding: 0px 50px; font-size: 12px;"> FEE
                        RECEIPT </span>
                    <span style="font-weight: 900; display: block; font-size: 25px;"><?= $app->name();?>                    </span>
                    <span style="font-size: 12px;font-weight:bold;"><?= $app->address();?><br>PH.NO:
                    <?= $app->phone();?> <br> <?= $app->email();?> </span> <br>
                        <p style="font-weight: 900;" class="text-center">Powered By
                    RoborosX Omni TechSolutions LLP, Bengaluru</p>
                </div>
                <div class="col-3" style="text-align: start; ">
                    <a href="#"><img
                            src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= implode(" ",$qrArray);?>"
                            id="QR" height="100px" width="100px" style="margin-left: 30px;" alt="logo"></a>
                          <br>
                          <p class="text-center">AY- <strong><?= $row['acc_academic_year']?></strong></p>
                </div>
            </div>
        </div>
        <center>
            <h6><strong>INSTALLMENT-1 DETAILS</strong></h6><span
                style="float: right;font-size:10px;"><strong>REMITTER COPY</strong> </span>
        </center>
        <!-- INFOMATION PART -->
        <div class="info">
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
                    <td>
                        <h6>TYPE: <b><?= $row['admission_type']?></b></h6>
                    </td>
                    <td colspan="2">
                        <h6>Address : <br>
                            <?= $row['permanentaddress']?>
                        </h6>
                    </td>
                </tr>
            </table>

        </div>

        <!-- FEE STRUCTURE -->
        <div class="fee-content mr-4 ml-4 mb-4">
        <table class="table table-striped table-sm table-bordered border-dark border-5">
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
                <table class="table table-bordered table-sm">
                    <tr>
                        <td colspan="4">
                        <h6 class="mt-2" align="center">IN WORDS: <span style="font-weight: 900;" id="inwords"><?= func::convert_number($total_Fee_paid);?> </span>
                    </h6>
                        </td>
                    </tr>
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



           

            <div class="row mt-5">
                <div class="col-md-4">
                <span style="float: left;font-weight: 900;">
                    Sign(admin) /-

                </span>
                </div>
                <div class="col-md-4 text-center">
                <span style="font-weight: 900;">
                    Parent Sign /-
                </span> <br>
            </div>
            <div class="col-md-4">
                <span style="float: right;font-weight: 900;">
                    Principal Sign /-
                </span>
            </div>
        </div>
        <p style="font-weight: 500;" class="text-center mt-2"><b>Note : </b> Fee Once paid its Non-refundable </p>
            
            
        </div>
    </div>

    <div class="main border border-dark border-5 mt-4  bg-logo">
        <!-- HEADER PART -->
        <div class="" style="border-bottom: 1px solid black; padding-bottom: 5px;">
            <div class="row">
                <div class="col-3" style="text-align: start; ">
                    <a href="/Transaction/Reports"><img src="<?=  url::myurl().'/'.$app->logo; ?>" id="logo"
                            height="120px" width="120px" style="margin-left: 30px;" alt="logo"></a>
                </div>

                <div class="col-6" style="text-align: center; line-height: 1.2;">
                    <span style="font-weight:900; color: black; padding: 0px 50px; font-size: 12px;"> FEE
                        RECEIPT </span>
                    <span style="font-weight: 900; display: block; font-size: 25px;"><?= $app->name();?>                    </span>
                    <span style="font-size: 12px;font-weight:bold;"><?= $app->address();?><br>PH.NO:
                    <?= $app->phone();?> <br> <?= $app->email();?> </span>
                        <p style="font-weight: 900;" class="text-center">Powered By
                    RoborosX Omni TechSolutions LLP, Bengaluru</p>
                </div>
                <div class="col-3" style="text-align: start; ">
                    <a href="#"><img
                            src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= implode(" ",$qrArray);?>"
                            id="QR" height="100px" width="100px" style="margin-left: 30px;" alt="logo"></a>
                          <br>
                    <p class="text-center">AY- <strong><?= $row['acc_academic_year']?></strong></p>
                </div>
            </div>
        </div>
        <center>
            <h6><strong>INSTALLMENT-1 DETAILS</strong></h6><span
                style="float: right;font-size:10px;"><strong>SCHOOL COPY</strong> </span>
        </center>
        <!-- INFOMATION PART -->
        <div class="info">
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
                    <td>
                        <h6>TYPE: <b><?= $row['admission_type']?></b></h6>
                    </td>
                    <td colspan="2">
                        <h6>Address : <br>
                            <?= $row['permanentaddress']?>
                        </h6>
                    </td>
                </tr>
            </table>

        </div>

        <!-- FEE STRUCTURE -->
        <div class="fee-content mr-4 ml-4 mb-4">
        <table class="table table-striped table-sm table-bordered border-dark border-5">
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
                <table class="table table-bordered table-sm">
                    <tr>
                        <td colspan="4">
                        <h6 class="mt-2" align="center">IN WORDS: <span style="font-weight: 900;" id="inwords"><?= func::convert_number($total_Fee_paid);?> </span>
                    </h6>
                        </td>
                    </tr>
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



           

            <div class="row mt-5">
                <div class="col-md-4">
                <span style="float: left;font-weight: 900;">
                    Sign(admin) /-

                </span>
                </div>
                <div class="col-md-4 text-center">
                <span style="font-weight: 900;">
                    Parent Sign /-
                </span> <br>
            </div>
            <div class="col-md-4">
                <span style="float: right;font-weight: 900;">
                    Principal Sign /-
                </span>
            </div>
        </div>
        <p style="font-weight: 500;" class="text-center mt-2"><b>Note : </b> Fee Once paid its Non-refundable </p>
            
            
        </div>
    </div>

</body>

</html>