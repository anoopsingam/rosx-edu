<?php
require '././config.php';
$db = new database();
$conn = $db->conn;
$app = new app();
$class = $_POST['class'];
$ay = $_POST['academic_year'];

$sql="SELECT * FROM account f, student_enrollment e  WHERE f.student_id=e.studentid AND f.class='$class' AND f.acdy='$ay' ORDER BY e.student_name ASC";
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
    <?= $app->setTitle("Statement - $ay - $class ");?>
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
            content: "CLASS-<?= $data[0]['class']?>";
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
                <h2 class="text-center mt-3"><?= $app->name();?></h2>
                <h5 class="text-center"><?= $app->address();?></h5>
                <h6 class="text-center">Phone No: <?= $app->phone();?> <br> Email: <?= $app->email();?></h6>
            </div>
            <div class="col-md-3 text-center">
                <img src="<?= url::myurl()?>/web_assets/transperent.png" height="140" width="190" alt="">
                <p>Powered by RosX Edu Soft </p>
            </div>
        </div>
        <hr class="my-4">

        <center class="m-3 h3 text-dark ">
           Class <?= $class ?> Fee Statement for AY - <?= $ay ?>
        </center>
        <table class="table table-bordered table-striped table-sm text-center border-4 border-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Academic Year</th>
                    <th>Total Fee's</th>
                    <th>Fee Paid</th>
                    <th>Fee Balance</th>
                    <th>Discount </th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $total_paid=0;
                $total_balance=0;
                $total_discount=0;
                $total_fee_collected=0;
                        $z=1;
                        $i='';
                        foreach($data as $row){
                                echo "<tr>
                                        <td>".$z++."</td>
                                        <td>$row[studentid]</td>
                                        <td>$row[student_name]</td>
                                        <td>$row[class]</td>
                                        <td>$row[acdy]</td>
                                        <td>$row[total_fee]</td>
                                        <td>$row[fee_paid]</td>
                                        <td>$row[fee_balance]</td>
                                        <td>$row[discount]</td>
                                    </tr>";
                                $total_paid+=$row['fee_paid'];
                                $total_balance+=$row['fee_balance'];
                                $total_discount+=$row['discount'];
                                $total_fee_collected+=$row['total_fee'];
                                $i++;
                            }
                        
                        ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">
                                <h5>
                                    Summary of Statement of Class <?= $class ?> for academic year <?= $ay?>
                                </h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Fee Structure :
                            </td>
                            <td>
                                ₹<?= func::FormatMoney(func::getFeeStructure($class,$ay)->tution_fee);?>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Fee Paid : </td>
                            <td>
                               ₹ <?= func::FormatMoney($total_paid); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Fee Balance : </td>
                            <td>
                               ₹ <?= func::FormatMoney($total_balance); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Discount : </td>
                            <td>
                                ₹<?= func::FormatMoney($total_discount); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <th colspan="3" class="text-center">
                            <h5>
                                Estimate Fee Collection Summary of Class <?= $class ?> for academic year <?= $ay?>
                            </h5>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Fee to be Collected : </td>
                            <td>
                            ₹<?= func::FormatMoney(func::getFeeStructure($class,$ay)->tution_fee);?> *  <?= func::getStudentCount($class,$ay)?> =
                            </td>
                            <td>
                                ₹<?= func::FormatMoney($total_fee_collected); ?>
                            </td>
                        </tr>
                        <tr class="text-center">
                                <td colspan="3">
                                    <?php 

                                        $dt=[
                                            "class"=>$class,
                                            "ay"=>$ay,
                                            "fee_structure"=>func::FormatMoney(func::getFeeStructure($class,$ay)->tution_fee),
                                            "total_student"=>func::getStudentCount($class,$ay),
                                            "total_fee_paid"=>func::FormatMoney($total_paid),
                                            "total_fee_balance"=>func::FormatMoney($total_balance),
                                            "total_discount"=>func::FormatMoney($total_discount),
                                            "total_fee_collection"=>func::FormatMoney(func::getStudentCount($class,$ay)*$data[0]['total_fee'])
                                        ];
                                    ?>
                                    <img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?=  json_encode([$dt]); ?>'
                                        id="QR" height="110" class="img-fluid" width="110" alt="logo">
                                </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center">
                <h5>Authority Verification</h5>
                <p>Statement Requested By : <?= $_SESSION['username']?></p>
                <p>Date : <?=date('d-m-Y')?></p>
            </div>
            <div class="card text-center">
                <div class="row">
                    <div class="col-sm-4">
                        <h6 class=" ml-4 mt-5">Accounts Manager Signature /-</h6>
                    </div>
                    <div class="col-sm-4">
                        <h6 class=" ml-4 mt-5">Class Teacher Signature /-</h6>
                    </div>
                    <div class="col-sm-4">
                        <h6 class=" ml-4 mt-5">Head Master Signature /-</h6>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center font-weight-bolder mt-3">
                <h6>Software Designed & Developed by RoborosX Omni Tech Solutions LLP</h6>
            </div>
        </div>

    </div>
</body>

</html>