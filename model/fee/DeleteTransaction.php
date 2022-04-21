<?php 

if(empty($token) && is_csrf_valid()){
    js::alert("Invalid Auth Token");
    js::redirect('/Dashboard');
}else{
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    $data=$_POST;
    //transactions
    $transaction_id = $data['transaction_id'];
    $status = $data['status'];
    $paid_amount = $data['paid_amount'];
    $balance_amount = $data['balance_amount'];
    $param = explode("&", $data['param']);
    $acc = $param[0];
    $tbl = $param[1];
    $ay = $param[2];
    $tot_fee = $param[3];
    $sid = $data['sid'];
    $ins = $param[4];
    $disc_amt = $param[5];

    switch ($tbl) {
        case "tution_fee":
            $sql = "DELETE FROM `fee_transactions` WHERE student_id='$sid' AND ay='$ay' AND tid='$transaction_id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $sc1 = 1;
            } else {
                $sc1 = 0;
            }
            break;
        case "account_admission_fee":
            $sql = "DELETE FROM `account_admission_fee` WHERE student_id='$sid' AND ay='$ay' AND tid='$transaction_id' ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $sc1 = 1;
            } else {
                $sc1 = 0;
            }
            break;
        default:
            $sql = "DELETE  FROM `$tbl` WHERE student_id='$sid' AND ay='$ay' AND tid='$transaction_id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $sc1 = 1;
            } else {
                $sc1 = 0;
            }
    }
    if ($sc1 == 1) {
        if ($ins == "INSTALLMENT-1") {
            $sql = "DELETE FROM `$acc` WHERE student_id='$sid' AND acdy='$ay'";
        } else {
            $sql = "UPDATE `$acc` SET fee_status='$status',fee_paid='$paid_amount',fee_balance='$balance_amount',discount='$disc_amt' WHERE student_id='$sid' AND acdy='$ay'";
        }
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $sc2 = 1;
        } else {
            $sc2 = 0;
        }
    }
    if ($sc1 == 1 && $sc2 == 1) {
        js::alert('Transaction Deleted Successfully');
        js::redirect('/Transaction/Delete');
    } else {
        js::alert('Transaction Aborted . Error Code:- 115, Contact Technical Team ');
        js::redirect('/Dashboard');
    }
}