<?php
require '././config.php';
$db = new database();
$conn = $db->conn;
$college = new app();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $college->setTitle("Transaction - $transaction ");?>
    <!-- Latest compiled and minified CSS -->
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
        width: 850px;
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
    @media print {
        body:before {
            content: url('<?= url::myurl().'/'.$app->logo; ?>');
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            color: #ff0000;
            font-size: 100px;
            font-weight: 500px;
            display: grid;
            justify-content: center;
            align-content: center;
            opacity: 0.2;
        }
    }
    </style>
</head>

<body>
    <?php
$bill_no = $transaction;
if (empty($bill_no)) {
    echo "<div class='alert alert-warning card shadow m-3 stretch-card '>
        <span class='h4'>Note !</span> &nbsp; <p class='alert-header'>Please Provide Valid Bill no. to print it...!</p>
    </div>";
} else {
    //fetches the bill details from account_admission_fee table 
    $sql = " SELECT * FROM fee_transactions f, student_enrollment e WHERE tid='$bill_no' and  f.student_id=e.studentid ";
    $result = mysqli_query($conn, $sql);
    $row = json_decode(json_encode(mysqli_fetch_assoc($result)));
?>
    <div class="main border border-dark border-5">
        <!-- HEADER PART -->
        <div class="" style="border-bottom: 1px solid black; padding-bottom: 5px;">
            <div class="row">
                <div class="col-3" style="text-align: start; ">
                    <a href="/Transaction/Reports"><img src="<?=  url::myurl().'/'.$college->logo; ?>" id="logo"
                            height="120px" width="120px" style="margin-left: 30px;" alt="logo"></a>
                </div>

                <div class="col-6" style="text-align: center; line-height: 1.2;">
                    <span style="font-weight:900; color: black; padding: 0px 50px; font-size: 12px;"> FEE
                        RECEIPT </span>
                    <span style="font-weight: 900; display: block; font-size: 25px;"><?php echo $college->name(); ?>
                    </span>
                    <span style="font-size: 12px;font-weight:bold;"><?php echo $college->address(); ?><br>PH.NO:
                        <?php echo $college->phone?> <br> <?php echo $college->email(); ?> </span>
                </div>
                <div class="col-3" style="text-align: start; ">
                    <a href="#"><img
                            src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo $college->name() . "   Name : " . $row->student_name . "   SID :" . $row->student_id . "   BILL NO:" . $row->bill_no . " Total Fee :" . $row->total_fee . " Installment :" . $row->installment . "   PAID AMOUNT :" . $row->paid_amount . "   BALANCE AMOUNT : " . $row->balance_amount . "  PAID ON :" . $row->created_on . " COLLECTED BY : " . $row->login_id . "  Transaction ID :" . $row->tid . " Bill Printed On :" . date("d-m-Y"); ?>"
                            id="QR" height="100px" width="100px" style="margin-left: 30px;" alt="logo"></a>
                </div>
            </div>
        </div>
        <center>
            <h6><strong><?php echo $row->installment ?> DETAILS</strong></h6><span
                style="float: right;font-size:10px;"><strong>REMITTER COPY</strong> </span>
        </center>
        <!-- INFOMATION PART -->
        <div class="info">
            <div class="info-1">
                <div class="col">
                    <label> Receipt No:</label>
                    <span><strong><?php echo $row->bill_no ?></strong></span>
                </div>
                <div class="col" style="text-align: center;">
                    <label>Transaction ID:</label>
                    <span><strong><?php echo $row->tid ?></strong></span>
                </div>

                <div class="col" style="text-align: right;">
                    <label>Date:</label>
                    <span><strong><?php $ver = explode("-", $row->billing_date);
                                        echo $ver[2] . "-" . $ver[1] . "-" . $ver[0]; ?>
                        </strong></span>
                </div>
            </div>
            <div class="info-1">
                <div class="col">
                    <label style="font-size: smaller;"> STUDENT ID:</label>
                    <span><?= includes::barcode($row->student_id,"true","50")?></span>

                </div>
                <div class="col" style="text-align: center;">
                    <label>Class:</label>
                    <span><strong><?php echo $row->present_class ?></strong></span>
                </div>
                <div class="col" style="text-align: center;">
                    <label>Section :</label>
                    <span><strong><?php echo $row->present_section ?></strong></span>
                </div>
                <div class="col" style="text-align: right;">
                    <label>Academic year:</label>
                    <span><strong><?php echo $row->ay ?></strong></span>
                </div>
            </div>
            <div class="info-2">
                <div class="col">
                    <label>Student Name:</label>
                    <span><strong><?php echo $row->student_name ?></strong></span>
                </div>
                <div class="col">
                    <label>Total Tution Fee:</label>
                    <span><strong>₹<?php echo $row->total_fee ?></strong></span>
                </div>
                <div class="col" style="text-align: right;font-size:xx-small;">
                    <label>Fee Collected By [ID]:</label>
                    <span><strong><?php echo $row->login_id ?></strong></span>
                </div>

            </div>

        </div>

        <!-- FEE STRUCTURE -->
        <div class="fee-content m-4">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th scope="col">SL No.</th>
                        <th scope="col">Particulars</th>
                        <th scope="col"> Paid Amount (RS)</th>
                        <th scope="col"> Balance Amount (RS)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Fee Payment</td>
                        <td><strong>₹<?php echo $row->paid_amount ?></strong></td>
                        <td><strong>₹<?php echo $row->balance_amount ?></strong></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 700;font-size:small;border:none"> Discount :</td>
                        <td style="font-weight: 700;border:none"> <strong>₹<?php echo $row->disc_amt; ?></strong></td>
                        <td style="font-weight: 700;font-size:small;border:none">Discount Issued By :</td>
                        <td style="font-weight: 700;border:none"><strong><?php echo $row->disc_by ?></strong></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 700;font-size:small;border:none"> Total Amount Paid :</td>
                        <td style="font-weight: 700;border:none"> <strong>₹<?php echo $row->paid_amount ?></strong></td>
                        <td style="font-weight: 700;font-size:small;border:none">Balance Amount :</td>
                        <td style="font-weight: 700;border:none"><strong>₹<?php echo $row->balance_amount ?></strong>
                        </td>
                    </tr>

                </tbody>
            </table>



            <div class="font-monospace">
                <h6 align="center">IN WORDS: <p style="font-weight: 900;" id="inwords"> </p>
                </h6>

            </div>

            <p><span style="float: left;font-weight: 900;">
                    Sign(<?php echo $_SESSION['username'] ?>) /-

                </span>
                <span style="float: right;font-weight: 900;">
                    Principal Sign /-
                </span><br>
                <span style="float: left;font-weight: 500;" class="text-center">Software Designed & Developed By
                    RoborosX Mutitech Solutions LLP, Bengaluru</span>
            </p>
        </div>
        <script>
        var num =
            "ZERO ONE TWO THREE FOUR FIVE SIX SEVEN EIGHT NINE TEN ELEVEN TWELVE THIRTEEN FOURTEEN FIFTEEN SIXTEEN SEVENTEEN EIGHTEEN NINETEEN"
            .split(" ");
        var tens = "TWENTY THIRTY FORTY FIFTY SIXTY SEVENTY EIGHTY NINETY".split(" ");
        var n = document.getElementById("num1");

        function number2words(n) {
            if (n < 20) return num[n];
            var digit = n % 10;
            if (n < 100) return tens[~~(n / 10) - 2] + (digit ? "-" + num[digit] : "");
            if (n < 1000) return num[~~(n / 100)] + " HUNDRED" + (n % 100 == 0 ? "" : " AND " + number2words(n % 100));
            return number2words(~~(n / 1000)) + " THOUSAND" + (n % 1000 != 0 ? " " + number2words(n % 1000) : "");
        }

        document.getElementById("inwords").innerHTML = number2words(<?php echo $row->paid_amount ?>) + ' RUPEES /-';
        </script>
    </div>
    <center> <span>-----------------------------------------------Cut
            Here-------------------------------------------</span></center>
    <div class="main border border-dark border-5">
        <!-- HEADER PART -->
        <div class="" style="border-bottom: 1px solid black; padding-bottom: 5px;">
            <div class="row">
                <div class="col-3" style="text-align: start; ">
                    <a href="/Transaction/Reports"><img src="<?=  url::myurl().'/'.$college->logo; ?>" id="logo"
                            height="120px" width="120px" style="margin-left: 30px;" alt="logo"></a>
                </div>

                <div class="col-6" style="text-align: center; line-height: 1.2;">
                    <span style="font-weight:900; color: black; padding: 0px 50px; font-size: 12px;"> FEE
                        RECEIPT </span>
                    <span style="font-weight: 900; display: block; font-size: 25px;"><?php echo $college->name(); ?>
                    </span>
                    <span style="font-size: 12px;font-weight:bold;"><?php echo $college->address(); ?><br>PH.NO:
                        <?php echo $college->phone?> <br> <?php echo $college->email(); ?> </span>
                </div>
                <div class="col-3" style="text-align: start; ">
                    <a href="#"><img
                            src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo $college->name() . "   Name : " . $row->student_name . "   SID :" . $row->student_id . "   BILL NO:" . $row->bill_no . " Total Fee :" . $row->total_fee . " Installment :" . $row->installment . "   PAID AMOUNT :" . $row->paid_amount . "   BALANCE AMOUNT : " . $row->balance_amount . "  PAID ON :" . $row->created_on . " COLLECTED BY : " . $row->login_id . "  Transaction ID :" . $row->tid . " Bill Printed On :" . date("d-m-Y"); ?>"
                            id="QR" height="100px" width="100px" style="margin-left: 30px;" alt="logo"></a>
                </div>
            </div>
        </div>
        <center>
            <h6><strong><?php echo $row->installment ?> DETAILS</strong></h6><span
                style="float: right;font-size:10px;"><strong>SCHOOL COPY</strong> </span>
        </center>
        <!-- INFOMATION PART -->
        <div class="info">
            <div class="info-1">
                <div class="col">
                    <label> Receipt No:</label>
                    <span><strong><?php echo $row->bill_no ?></strong></span>
                </div>
                <div class="col" style="text-align: center;">
                    <label>Transaction ID:</label>
                    <span><strong><?php echo $row->tid ?></strong></span>
                </div>

                <div class="col" style="text-align: right;">
                    <label>Date:</label>
                    <span><strong><?php $ver = explode("-", $row->billing_date);
                                        echo $ver[2] . "-" . $ver[1] . "-" . $ver[0]; ?>
                        </strong></span>
                </div>
            </div>
            <div class="info-1">
                <div class="col">
                    <label style="font-size: smaller;"> STUDENT ID:</label>
                    <span><?= includes::barcode($row->student_id,"true","60")?></span>

                </div>
                <div class="col" style="text-align: center;">
                    <label>Class:</label>
                    <span><strong><?php echo $row->present_class ?></strong></span>
                </div>
                <div class="col" style="text-align: center;">
                    <label>Section :</label>
                    <span><strong><?php echo $row->present_section ?></strong></span>
                </div>
                <div class="col" style="text-align: right;">
                    <label>Academic year:</label>
                    <span><strong><?php echo $row->ay ?></strong></span>
                </div>
            </div>
            <div class="info-2">
                <div class="col">
                    <label>Student Name:</label>
                    <span><strong><?php echo $row->student_name ?></strong></span>
                </div>
                <div class="col">
                    <label>Total Tution Fee:</label>
                    <span><strong>₹<?php echo $row->total_fee ?></strong></span>
                </div>
                <div class="col" style="text-align: right;font-size:xx-small;">
                    <label>Fee Collected By [ID]:</label>
                    <span><strong><?php echo $row->login_id ?></strong></span>
                </div>

            </div>

        </div>

        <!-- FEE STRUCTURE -->
        <div class="fee-content m-4">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th scope="col">SL No.</th>
                        <th scope="col">Particulars</th>
                        <th scope="col"> Paid Amount (RS)</th>
                        <th scope="col"> Balance Amount (RS)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Fee Payment</td>
                        <td><strong>₹<?php echo $row->paid_amount ?></strong></td>
                        <td><strong>₹<?php echo $row->balance_amount ?></strong></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 700;font-size:small;border:none"> Discount :</td>
                        <td style="font-weight: 700;border:none"> <strong>₹<?php echo $row->disc_amt; ?></strong></td>
                        <td style="font-weight: 700;font-size:small;border:none">Discount Issued By :</td>
                        <td style="font-weight: 700;border:none"><strong><?php echo $row->disc_by ?></strong></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 700;font-size:small;border:none"> Total Amount Paid :</td>
                        <td style="font-weight: 700;border:none"> <strong>₹<?php echo $row->paid_amount ?></strong></td>
                        <td style="font-weight: 700;font-size:small;border:none">Balance Amount :</td>
                        <td style="font-weight: 700;border:none"><strong>₹<?php echo $row->balance_amount ?></strong>
                        </td>
                    </tr>

                </tbody>
            </table>



            <div class="font-monospace">
                <h6 align="center">IN WORDS: <p style="font-weight: 900;" id="inwords2"> </p>
                </h6>

            </div>

            <p><span style="float: left;font-weight: 900;">
                    Sign(<?php echo $_SESSION['username'] ?>) /-

                </span>
                <span style="float: right;font-weight: 900;">
                    Principal Sign /-
                </span><br>
                <span style="float: left;font-weight: 500;" class="text-center">Software Designed & Developed By
                    RoborosX Mutitech Solutions LLP, Bengaluru</span>
            </p>
        </div>
        <script>
        var num =
            "ZERO ONE TWO THREE FOUR FIVE SIX SEVEN EIGHT NINE TEN ELEVEN TWELVE THIRTEEN FOURTEEN FIFTEEN SIXTEEN SEVENTEEN EIGHTEEN NINETEEN"
            .split(" ");
        var tens = "TWENTY THIRTY FORTY FIFTY SIXTY SEVENTY EIGHTY NINETY".split(" ");
        var n = document.getElementById("num1");

        function number2words(n) {
            if (n < 20) return num[n];
            var digit = n % 10;
            if (n < 100) return tens[~~(n / 10) - 2] + (digit ? "-" + num[digit] : "");
            if (n < 1000) return num[~~(n / 100)] + " HUNDRED" + (n % 100 == 0 ? "" : " AND " + number2words(n % 100));
            return number2words(~~(n / 1000)) + " THOUSAND" + (n % 1000 != 0 ? " " + number2words(n % 1000) : "");
        }

        document.getElementById("inwords2").innerHTML = number2words(<?php echo $row->paid_amount ?>) + ' RUPEES /-';
        </script>
    </div>
</body>

</html>
<?php
}



?>