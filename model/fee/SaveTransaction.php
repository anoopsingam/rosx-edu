<?php

if (empty($token) && is_csrf_valid()) {
    js::alert("Invalid Auth Token");
    js::redirect('/Dashboard');
} else {
    require '././config.php';
    $db = new database();
    $conn = $db->conn;
    $app = new app();
    //transactions
    $data = $_POST;
    $sid = $data['student_id'];
    $name = $data['student_name'];
    $class = $data['class'];
    $section = $data['section'];
    $academic_year = $data['academic_year'];
    $installment = $data['installment'];
    $admission_fee = $data['admission_fee'];
    $balance_admission_fee = $data['balance_admission_fee'];
    $admission_fee_paid = $data['admission_fee_paid'];
    $admission_fee_due = $data['admission_fee_due'];
    $due_date = $data['due_date'];
    $email_id = $data['email_id'];
    $phone_no = $data['phone_no'];
    $date = date("Y-m-d");
    $login_id = $data['login_id'];
    $tid = $data['transaction_id'];
    $disc_by = (empty($data['discount_by']) ? "N/A" : $data['discount_by']);
    $discount_amount = (empty($data['discount_amount'])) ? 0 : $data['discount_amount'];
    $trans_note = $data['transaction_note'];
    $p_fee_disc = $data['p_fee_disc'];
    $transaction_mode = $data['transaction_mode'];
    $disc_amt = $p_fee_disc + $discount_amount;            //get last bill_no from tution_fee table
    $sql = "SELECT * FROM `fee_transactions` ORDER BY `id` DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bill_no = ++$row['bill_no'];
    } else {
        $bill_no = date("Y") . "0001";
    }
    $p_fee_paid = $data['p_fee_paid'];
    $p_fee_bal = $data['p_fee_bal'];

    $u_fee_paid = $p_fee_paid + $admission_fee_paid;
    $u_fee_bal = $p_fee_bal - $admission_fee_paid - $discount_amount;

    if ($installment == "INSTALLMENT-1" || $u_fee_bal != "0") {
        $sts = "PENDING";
    } else {
        $sts = "PAID";
    }
    if ($installment == "INSTALLMENT-0") {
        $installment = "INSTALLMENT-10";
    }

    if ($u_fee_bal == "0") {
        $sts = "PAID";
    }
    $transport = $_POST['transport_opted'];

    $short_name = $app->short_name;

    $sql_check_transaction = "SELECT * FROM fee_transactions WHERE tid='$tid'";
    $result_check_transaction = mysqli_query($conn, $sql_check_transaction);
    $count_check_transaction = mysqli_num_rows($result_check_transaction);
    if ($count_check_transaction > 0) {
        js::alert("Transaction ID already exist");
        js::redirect('/Transaction/New');
    } else {
        $com = true;
        $pam = 0;
        if ($transport == "yes") {
            $trans_student_id = mysqli_real_escape_string($conn, $sid);
            $trans_date = mysqli_real_escape_string($conn, $date);
            $trans_gen_id = $tid;
            $trans_paid_amount = mysqli_real_escape_string($conn, $_POST['amount_paying']);
            $trans_discount = mysqli_real_escape_string($conn, $_POST['discount']);
            $trans_enroll_id = mysqli_real_escape_string($conn, $_POST['enroll_id']);
            $trans_added_by = mysqli_real_escape_string($conn, $login_id);
            $academicyear = mysqli_real_escape_string($conn, $academic_year);
            $sql1 = "SELECT * FROM `transport_transaction` ORDER BY `tt_id` DESC LIMIT 1";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                $row1 = $result1->fetch_assoc();
                $trans_bill_no = ++$row1['trans_bill_no'];
            } else {
                $trans_bill_no = "TR0001";
            }
            $balance = mysqli_real_escape_string($conn, $_POST['updated_balance']);
            $trans_payment_mode = mysqli_real_escape_string($conn, $transaction_mode);

            $acc_data = mysqli_query($db->conn, "SELECT * FROM transport_account WHERE acc_student_id='$trans_student_id' and acc_academic_year='$academicyear'");

            $data = [
                "trans_student_id" => $trans_student_id,
                "trans_date" => $trans_date,
                "trans_payment_mode" => $trans_payment_mode,
                "trans_gen_id" => $trans_gen_id,
                "trans_paid_amount" => $trans_paid_amount,
                "trans_discount" => $trans_discount,
                "trans_enroll_id" => $trans_enroll_id,
                "trans_added_by" => $trans_added_by,
                "trans_bill_no" => $trans_bill_no
            ];
            // print_r($data);
            if (empty($trans_paid_amount) || $balance < 0) {
                js::alert("Please Enter Valid Amount to Initiate Transport Transaction");
                //   $com=false;
                $transport = 'no';
            } else {
                $paid_amount = mysqli_real_escape_string($conn, $_POST['paid_amount']);
                $pam = $paid_amount;
                $u_paid_amount_t = $paid_amount + $trans_paid_amount;
                $acc_data_feed = [
                    "acc_student_id" => $trans_student_id,
                    "acc_paid" => $u_paid_amount_t,
                    "acc_enroll_id" => $trans_enroll_id,
                    "acc_academic_year" => $academicyear
                ];
                $com = true;
                if ($db->insert('transport_transaction', $data)) {
                    $com = true;
                    if (mysqli_num_rows($acc_data) > 0) {
                        //update the paid Amount
                        if ($db->update('transport_account', $acc_data_feed, "acc_student_id='$trans_student_id' AND acc_academic_year='$academicyear'")) {
                            $com = true;
                        } else {
                            $com = false;
                        }
                    } else {
                        //insert the new row
                        if ($db->insert('transport_account', $acc_data_feed)) {
                            $com = true;
                        } else {
                            $com = false;
                        }
                    }
                } else {
                    $com = false;
                }
            }
        }

        if ($u_fee_bal < 0 || $admission_fee_paid == 0) {
            js::alert("Transaction Aborted Please enter valid amount");
            js::redirect('/Transaction/New');
        } else {
            $query = " INSERT INTO fee_transactions (student_id,class,total_fee, paid_amount, balance_amount, installment, bill_no, billing_date,due_date, loginid, ay,tid,disc_by,disc_amt,transaction_note,transaction_mode)  VALUES ( '$sid','$class','$admission_fee', '$admission_fee_paid', '$u_fee_bal', '$installment', '$bill_no', '$date','$due_date', '$login_id', '$academic_year','$tid','$disc_by','$discount_amount','$trans_note','$transaction_mode') ";
            if (mysqli_query($conn, $query) && $com) {

                switch ($installment) {
                    case "INSTALLMENT-1":
                        $sql_fee = "INSERT INTO `account`( `student_id`,`class`,`total_fee`, `fee_paid`, `fee_balance`,`discount`, `fee_status`, `last_installment`, `last_paid_date`, `last_collected_by`, `acdy`, `token_id`) VALUES ('$sid','$class','$admission_fee','$u_fee_paid','$u_fee_bal','$disc_amt','$sts','$installment','$date','$login_id','$academic_year','" . uniqid($sid) . "')";
                        break;
                    default:
                        $sql_fee = "UPDATE `account` SET `fee_paid`='$u_fee_paid',`fee_balance`='$u_fee_bal',`discount`='$disc_amt',`fee_status`='$sts',`last_installment`='$installment',`last_paid_date`='$date',`last_collected_by`='$login_id' WHERE `student_id`='$sid' and acdy='$academic_year'";
                }
                $my_emails = [$email_id, "anoopnarayan@starktechlabs.in", "support@starktechlabs.in"];
                if (mysqli_query($conn, $sql_fee)) {
                    if (!empty($email_id) && !empty($phone_no)) {
                        $subject = "Fee Transaction- $tid | RosX Edu Soft ";
                        $headers = "From: support@roborosx.com" . "\r\n";
                        //  "CC: sssvn561207@gmail.com";
                        $msg = "Dear $name ($sid),\n\n Transaction Id : $tid . \n Your fee payment for $installment ($date) of Rs. $admission_fee_paid /- has been successfully collected by $login_id, \n\n Bill No is $bill_no.\n Your current fee balance is Rs. $u_fee_bal/-. \n Next Fee Payment Due Date is $due_date,\n Fee Payment Status : $sts,\n\n Thank you for your support.\n Regards,\n Accounts Team";
                        if (mail($email_id, $subject, $msg, $headers)) {
                            //   js::alert("Email Successfully Sent to $email_id");
                        }
                        //   MDJmNGY3OWVmZDQyMmNlNWUwNmRmYmUyNGRkMWIyZWI=
                        $apiKey = urlencode('');
                        $numbers = $phone_no;
                        $sender = urlencode("RBRXTH");
                        $message = rawurlencode("Dear Parent, school Fee Paid-$admission_fee_paid in $transaction_mode, balance-$u_fee_bal, disc:-$discount_amount date:$date $bill_no $short_name, RBRXTH");
                        // Prepare data for POST request
                        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
                        // Send the POST request with cURL
                        $ch = curl_init('https://api.textlocal.in/send/');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);
                        curl_close($ch);
                    } elseif (!empty($phone_no)) {
                        //   MDJmNGY3OWVmZDQyMmNlNWUwNmRmYmUyNGRkMWIyZWI=
                        $apiKey = urlencode('');
                        $numbers = $phone_no;
                        $sender = urlencode('RBRXTH');
                        $message = rawurlencode("Dear Parent, school Fee Paid-$admission_fee_paid in $transaction_mode, balance-$u_fee_bal, disc:-$discount_amount date:$date $bill_no SSVN, RBRXTH");
                        // Prepare data for POST request
                        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
                        // Send the POST request with cURL
                        $ch = curl_init('https://api.textlocal.in/send/');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);
                        curl_close($ch);
                    }
                    js::alert('Fee Paid Successfully  Student : ' . $name . ' Paid : ' . $admission_fee_paid . ', Balance : ' . $u_fee_bal . ', Discount : ' . $discount_amount . '  Transaction ID:- ' . $tid . ' Please Check Spam Folder in your email for Confirmation Message !!! ');

                    if ($transport == "yes") {
                        js::redirect("/Transaction/UnifiedPrint/$tid");
                    } else {
                        js::redirect('/Transaction/Print/' . $tid);
                    }
                } else {
                    echo $conn->error;
                }
            } else {
                js::alert('Transaction Aborted . Error Code:- 115, Contact Technical Team ');
                js::redirect('/Transaction/New');
                echo $conn->error;
            }
        }
    }
}
