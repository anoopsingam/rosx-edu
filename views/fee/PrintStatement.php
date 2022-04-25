<?php
require '././config.php';
$db = new database();
$conn = $db->conn;
$app = new app();
$studentid = $_POST['studentid'];
$ay = $_POST['ay'];

$sql = "SELECT * FROM fee_transactions f, student_enrollment e , account a  WHERE f.student_id='$studentid' AND f.ay='$ay' AND a.student_id=f.student_id AND a.acdy='$ay' AND  f.student_id=e.studentid ";
// echo $sql;
$result = mysqli_query($conn, $sql);
$data=[];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $app->setTitle("Statement - $ay - $studentid ");?>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Sora', sans-serif;
    }

    table {
        border-collapse: collapse;
    }

    tr,
    td,
    th {
        border: 1px solid #000000;
    }

    @media print {
        body:before {
            content: "<?= $data[0]['studentid']?>";
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: +1;
            color: #0080ff;
            font-size: 80px;
            font-weight: 600px;
            display: grid;
            justify-content: center;
            align-content: center;
            opacity: 0.2;
            border: 5px solid black;
        }
    }

    hr {
        border-top: 2px solid black;
    }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row m-1">
            <div class="col-md-3">
                <?= $app->SetLogo('180','180','');?>
            </div>
            <div class="col-md-6">
                <h1 class="text-center mt-3"><?= $app->name();?></h1>
                <h4 class="text-center"><?= $app->address();?></h4>
                <h5 class="text-center">Phone No: <?= $app->phone();?> <br> Email: <?= $app->email();?></h5>
            </div>
            <div class="col-md-3 text-center">
                <img src="../../web_assets/transperent.png" height="140" width="190" alt="">
                <p>Powered by RosX Edu Soft </p>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-left">
                        Student Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <tr>
                                <td>Student ID : </td>
                                <td><b><?= $studentid?></b></td>
                            </tr>
                            <tr>
                                <td>Student Name : </td>
                                <td><b><?= $data[0]['student_name'];?></b></td>
                            </tr>
                            <tr>
                                <td>Class : </td>
                                <td><b><?= $data[0]['class'];?></b></td>
                            </tr>
                            <tr>
                                <td>Section : </td>
                                <td><b><?= $data[0]['present_section'];?></b></td>
                            </tr>
                            <tr>
                                <td>Academic Year : </td>
                                <td><b><?= $data[0]['ay'];?></b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card ">
                    <div class="card-header text-left">
                        Fee Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <tr>
                                <td>Fee Structure</td>
                                <td><b><?= $data[0]['total_fee'];?></b></td>
                            </tr>
                            <tr>
                                <td>Fee Paid</td>
                                <td><b><?= $data[0]['fee_paid'];?></b></td>
                            </tr>
                            <tr>
                                <td>Fee Balance</td>
                                <td><b><?= $data[0]['fee_balance'];?></b></td>
                            </tr>
                            <tr>
                                <td>Fee Discount</td>
                                <td><b><?= $data[0]['discount'];?></b></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><b><?= $data[0]['fee_status'];?></b></td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="2">
                                    <img src='https://api.qrserver.com/v1/create-qr-code/?size=110x110&data=<?=  json_encode(['Student Name' => $data[0]['student_name'], 'Student Id' => $data[0]['studentid'], 'Auth Token' => $data[0]['token'], 'Total Fees ' => $data[0]['total_fee'],' Fee Paid '=>$data[0]['fee_paid'],'Fee Balance '=>$data[0]['fee_balance'],'Discount '=>$data[0]['discount'],' Fee Payment Status '=>$data[0]['fee_status']]); ?>'
                                        id="QR" height="110" class="img-fluid" width="110" alt="logo">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <center class="m-3 h3 text-dark ">
            <?= $studentid ?> Fee Statement for AY - <?= $ay ?>
        </center>
        <table class="table table-bordered table-striped table-sm text-center border-4 border-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Class</th>
                    <th>Academic Year</th>
                    <th>Installment</th>
                    <th>Fee Collected By</th>
                    <th>Transaction ID</th>
                    <th>Transaction Mode</th>
                    <th>Date</th>
                    <th>Paid/Credit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" class="h5">Opening Balance </td>
                    <td colspan="3">₹
                        <?= $data[0]['total_fee'];?>
                    </td>
                </tr>
                <?php 
                        $i=1;
                        foreach($data as $row){
                                echo "<tr>
                                <td>".$i++."</td>
                                <td>{$row['class']}</td>
                                <td>{$row['ay']}</td>
                                <td>{$row['installment']}</td>
                                <td>{$row['loginid']}</td>
                                <td>{$row['tid']}</td>
                                <td>{$row['transaction_mode']}</td>
                                <td>{$row['billing_date']}</td>
                                <td>₹{$row['paid_amount']}</td>
                                </tr>";
                            }
                        
                        ?>
                         <tr>
                    <td colspan="6" class="h5">Closing Balance </td>
                    <td colspan="3">₹
                        <?= $data[0]['fee_balance'];?>
                    </td>
                </tr>
                <tr>
                    <td colspan="8" class="text-right">Total</td>
                    <td>₹<?= $data[0]['total_fee'];?></td>
                </tr>
                <?php 
                        if($data[0]['discount']!=0){
                            echo "<tr>
                            <td colspan='8' class='text-right'>Discount : </td>
                            <td>₹{$data[0]['discount']}</td>
                            </tr>";
                        }
                        ?>
                <tr>
                    <td colspan="8" class="text-right">Total Paid :</td>
                    <td>₹<?= $data[0]['fee_paid'];?></td>
                </tr>
                <tr>
                    <td colspan="8" class="text-right">Total Due :</td>
                    <td>₹<?= $data[0]['fee_balance'];?></td>
                </tr>
            </tbody>
        </table>
        <div class="card">
            <div class="card-header text-center">
                <h5>Authority Verification</h5>
                <p>Date : <?=date('d-m-Y')?></p>
            </div>
            <div class="card text-center">
                <div class="row">
                    <div class="col-sm-4">
                        <h6 class=" ml-4 mt-5">Accounts Manager Signature /-</h6>
                    </div>
                    <div class="col-sm-4">
                        <h6 class=" ml-4 mt-5">Parent Signature /-</h6>
                    </div>
                    <div class="col-sm-4">
                        <h6 class=" ml-4 mt-5">Head Master Signature /-</h6>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center font-weight-bolder mt-3">
                <h6>Software Designed & Developed by RoborosX Multi Tech Solutions LLP</h6>
            </div>
        </div>

    </div>
</body>

</html>