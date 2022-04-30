<?php 

if(empty($token) && is_csrf_valid()){
    js::alert("Invalid Auth Token");
    js::redirect('/Dashboard');
}else{
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
  //transactions
  $data=$_POST;
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
  $disc_by = (empty($data['discount_by'])?"N/A":$data['discount_by']);
  $discount_amount = (empty($data['discount_amount'])) ? 0 : $data['discount_amount'];
  $trans_note = $data['transaction_note'];
  $p_fee_disc = $data['p_fee_disc'];
  $transaction_mode=$data['transaction_mode'];
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
  if($installment=="INSTALLMENT-0"){
      $installment = "INSTALLMENT-10";
  }

  if ($u_fee_bal == "0") {
      $sts = "PAID";
  }

  $sql_check_transaction = "SELECT * FROM fee_transactions WHERE tid='$tid'";
  $result_check_transaction = mysqli_query($conn, $sql_check_transaction);
  $count_check_transaction = mysqli_num_rows($result_check_transaction);
  if ($count_check_transaction > 0) {
      js::alert("Transaction ID already exist");
      js::redirect('/Transaction/New');
  } else {
      if ($u_fee_bal < 0 || $admission_fee_paid == 0) {
          js::alert("Transaction Aborted Please enter valid amount");
          js::redirect('/Transaction/New');
      } else {
          $query = " INSERT INTO fee_transactions (student_id,class,total_fee, paid_amount, balance_amount, installment, bill_no, billing_date,due_date, loginid, ay,tid,disc_by,disc_amt,transaction_note,transaction_mode)  VALUES ( '$sid','$class','$admission_fee', '$admission_fee_paid', '$u_fee_bal', '$installment', '$bill_no', '$date','$due_date', '$login_id', '$academic_year','$tid','$disc_by','$discount_amount','$trans_note','$transaction_mode') ";
          if (mysqli_query($conn, $query)) {

              switch ($installment) {
                  case "INSTALLMENT-1":
                      $sql_fee = "INSERT INTO `account`( `student_id`,`class`,`total_fee`, `fee_paid`, `fee_balance`,`discount`, `fee_status`, `last_installment`, `last_paid_date`, `last_collected_by`, `acdy`, `token_id`) VALUES ('$sid','$class','$admission_fee','$u_fee_paid','$u_fee_bal','$disc_amt','$sts','$installment','$date','$login_id','$academic_year','" . uniqid($sid) . "')";
                      break;
                  default:
                      $sql_fee = "UPDATE `account` SET `fee_paid`='$u_fee_paid',`fee_balance`='$u_fee_bal',`discount`='$disc_amt',`fee_status`='$sts',`last_installment`='$installment',`last_paid_date`='$date',`last_collected_by`='$login_id' WHERE `student_id`='$sid' and acdy='$academic_year'";
              }
              $my_emails = [$email_id, "anoopnarayan@starktechlabs.in", "support@starktechlabs.in"];
              if (mysqli_query($conn, $sql_fee)) {
                  if (!empty($email_id)) {
                      $msg = "<h4>Dear $name ($sid),</h4><br>Transaction Id : $tid <br><p>Your fee payment for $installment ($date) of Rs. $admission_fee_paid/- has been successfully collected by $login_id, Bill No is $bill_no.<br> Your current fee balance is Rs. $u_fee_bal/-. Next Fee Payment Due Date is $due_date, Fee Payment Status : $sts,<br>Thank you for your support.<br>Regards,<br>Accounts Team,<br>" . $app->name() . ",<br>" . $app->address() . "<br>" . $app->phone() . '</p>';
                   
                    // js::alert(SendMail($msg, $email_id, $name." -".$tid,1));
                     
                  } else {
                      // 
                      $apiKey = urlencode('MDJmNGY3OWVmZDQyMmNlNWUwNmRmYmUyNGRkMWIyZWI=');
                      $numbers = $phone_no;
                      $sender = urlencode('RBRXTH');
                      $message = rawurlencode("Dear Parent, school Fee Paid-$admission_fee_paid in $transaction_mode, balance-$u_fee_bal, disc:-$discount_amount date:$date $bill_no SNHS, RBRXTH");
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
                  js::alert('Fee Paid Successfully  Student : ' . $name . ' Paid : ' . $admission_fee_paid . ', Balance : ' . $u_fee_bal . ', Discount : ' . $discount_amount . '  Transaction ID:- ' . $tid.' Please Check Spam Folder in your email for Confirmation Message !!! ');
                  js::redirect('/Transaction/Print/'.$tid);
              } else {
                  echo $conn->error;
              }
          } else {
              js::alert('Transaction Aborted . Error Code:- 115, Contact Technical Team ');
              js::redirect('/Transaction/New');
              //echo $conn->error;
          }
      }
  }

}