<?php
require '././config.php';
$db = new database();
$conn = $db->conn;
$app = new app();
$id=decrypt($expenseid);
$sql="SELECT * FROM expense_details e, head_accounts h, payee_details p where e.expense_id='$id' AND e.ho_id=h.id AND e.payee__id=p.payee_id";
// echo $sql;
$result = mysqli_query($conn, $sql);
$data=[];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
$data=$data[0];
// print_r($data);
$payLoad=[
"Institution Name "=>$app->name,
"ho_name"=>$data['ho_name'],
"payee_name"=>$data['payee_name'],
"expense_desc"=>$data['expense_desc'],
"expense_amount"=>func::FormatMoney($data['expense_amount']),
"payment_mode"=>$data['payment_mode'],
"expense_date"=>$data['expense_date'],
"expense_fy"=>$data['expense_fy'],
"expense_trans_id"=>$data['expense_trans_id'],
"printed_on"=>date("d-m-Y h:i:s"),
"Auth-Token"=>uniqid()
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $app->setTitle("Payment Voucher | $id "); ?>
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


    hr {
        border-top: 2px solid black;
    }
    .voucher-border{
        border: 2px solid black;
    }
    </style>
</head>
<body class="container-fluid">
   <div class="container voucher-border">
   <div class="row m-1">
        <div class="col-md-3 mb-0">
            <?= $app->SetLogo('180','180','');?>
        </div>
        <div class="col-md-6 mb-0">
            <h2 class="text-center mt-3"><?= $app->name();?></h2>
            <h5 class="text-center"><?= $app->address();?></h5>
            <h6 class="text-center">Phone No: <?= $app->phone();?> <br> Email: <?= $app->email();?></h6>
            <p class="h3 text-center text-dark mb-0">PAYMENT VOUCHER</p>
        </div>
        <div class="col-md-3 text-center mb-0">
            <img src="<?= url::myurl()?>/web_assets/transperent.png" height="140" width="190" alt="">
            <p>Powered by RosX Edu Soft </p>
        </div>
    </div>
    <hr >
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered table-sm text-center">
                <th colspan="2">
                    <h5 class="text-center">Payee Details</h5>
                </th>
                <tr>
                    <td>
                        <h6 class="font-weight-bolder">Payee Name : </h6>
                    </td>
                    <td><?= $data['payee_name']?></td>
                </tr>
                <tr>
                    <td>
                        <h6 class="font-weight-bolder">Description </h6>
                    </td>
                    <td><?= $data['payee_desc']?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered table-sm text-center">
                <th colspan="2">
                    <h5 class="text-center">Expense Details</h5>
                </th>
                <tr>
                    <td>
                        <h6 class="font-weight-bolder"> Date : </h6>
                    </td>
                    <td><?= $data['expense_date']?></td>
                </tr>
                <tr>
                    <td>
                        <h6 class="font-weight-bolder">H.O : </h6>
                    </td>
                    <td><?= $data['ho_name']?></td>
                </tr>
                <tr>
                    <td>
                        <h6 class="font-weight-bolder">Voucher No : </h6>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">
                    FY :<?= $data['expense_fy']?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <table class="table table-bordered table-sm  border border-dark border-1">
        <tr>
            <td colspan="8">
                <h5 class="text-center">PAYMENT INFO :-</h5>
            </td>
        </tr>
        <tr class="text-center h5 text-uppercase">
            <th colspan="">Description:</th>
            <th colspan="2 ">Amount:</th>
            <th colspan="2 ">Payment Mode </th>
            <th colspan="2 " class="w-25">Transaction Id : </th>
        </tr>
        <tr class="text-center ">
            <td colspan=" " class="p-2 fs-4"><?= $data['expense_desc']?></td>
            <td colspan="2 " class="p-2 fs-4">₹<?= func::FormatMoney($data['expense_amount']);?></td>
            <td colspan="2 " class="p-2 fs-4"> <?= $data['payment_mode']?></td>
            <td colspan="2 " class="p-2 fs-4"><?= $data['expense_trans_id']?></td>
        </tr>
    </table>
    <table class="table table-bordered table-sm border border-dark border-1">
        <tr class="text-center h5 text-uppercase">
            <th colspan="2" class="p-3 text-center text-uppercase">Passed by:</th>
            <th colspan="2" class="p-3 text-center text-uppercase">Authorized Sign:</th>
            <th colspan="2" class="p-3 text-center text-uppercase"> Payee Sign :</th>
            <th colspan="2" class="p-3 text-center text-uppercase"> QR</th>
        </tr>
        <tr style="width: 100%; ">
            <th colspan="2 " class="m-1 p-3 text-center h5"><span class="mt-4"><br><br><?= $data['expense_added_by']?></span></th>
            <th colspan="2 " class="m-1 p-3 text-center"><span class="text-muted mt-4 mb-0 pt-5 pb-0"></span>
            </th>
            <th colspan="2 " class="m-1 p-3 text-center"> </th>
            <th colspan="2 " class=" text-center"> <img class="m-3" src='https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?=  json_encode($payLoad); ?>' id="QR" height="110" class="img-fluid" width="110" alt="logo"> </th>
        </tr>
    </table>
    <p class="text-center text-dark font-weight-bolder">Software Designed & Developed by RoborosX Multi Tech Solutions
        LLP</p>
   </div>

</body>

</html>