<?php

if(isset($action) && !empty($action)){
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    switch($action){
        case "new":
            if(isset($_POST['student_id']) && is_csrf_valid()){
              try{
                $student_id =mysqli_real_escape_string($db->conn,$_POST['student_id']);
                $accounbt_type=mysqli_real_escape_string($db->conn,$_POST['account_type']);
                $payment_mode=mysqli_real_escape_string($db->conn,$_POST['payment_mode']);
                $invoice_date=mysqli_real_escape_string($db->conn,$_POST['invoice_date']);
                $login_id=mysqli_real_escape_string($db->conn,$_POST['login_id']);
                $token_id =mysqli_real_escape_string($db->conn,$invid);
                $payment_status=mysqli_real_escape_string($db->conn,$_POST['payment_status']);
                $invoice_date=mysqli_real_escape_string($db->conn,$_POST['invoice_date']);
                //generate invoice number 
                $sql = "SELECT * FROM general_invoice ORDER BY billing_id DESC LIMIT 1";
                $result = mysqli_query($db->conn,$sql);
                if(mysqli_num_rows($result)>0){
                    $row = $result->fetch_assoc();
                    $invoice_no = ++$row['invoice_no'];
                }else{
                    $invoice_no = "INV".date('Y').'00001';
                }
                $particulars=[];
                $charges=[];
                $total_amount=0;
                for($i=0;$i<count($_POST['particular']);$i++){
                    $particulars[$i]=$_POST['particular'][$i];
                    $charges[$i]=$_POST['charges'][$i];
                    $total_amount=$total_amount+$charges[$i];
                }
                //make an unified array of particulars and charges
                $data=[];
                for($i=0;$i<count($particulars);$i++){
                    $data[$i]['particulars_id']=$particulars[$i];
                    $data[$i]['charges']=$charges[$i];
                }

                $finalArray=[
                    "invoice_no"=>$invoice_no,
                    "invoice_date"=>$invoice_date,
                    "payment_status"=>$payment_status,
                    "stu_id"=>$student_id,
                    "particulars"=>json_encode($data),
                    "total_amount"=>$total_amount,
                    "payment_mode"=>$payment_mode,
                    "account_type"=>$accounbt_type,
                    "invoice_added_by"=>$login_id,
                    "inv_token_id"=>$token_id
                ];
                $sql = "SELECT * FROM general_invoice WHERE inv_token_id = '$token_id'";
                $result = mysqli_query($db->conn,$sql);
                if(mysqli_num_rows($result)>0){
                    js::alert("Invoice already exists");
                    js::redirect("/GeneralInvoice/new");
                }else{
                    if($db->insert('general_invoice',$finalArray)){
                        js::alert("Invoice added successfully $invoice_no");
                        js::redirect('/GeneralInvoice/View/'.encrypt($invoice_no));
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding a new Invoice ",$login_id);
                        throw new Exception("Process Terminated with Error to add invoice");
                    }
                }
               
              }catch(Exception $e){
                js::alert($e->getMessage());
                js::redirect("/GeneralInvoice/new");
              }
                
            }else{
                js::alert("Invalid Request");
                js::redirect("/Dashboard");
            }
            break;
            case "edit":
                    if(!empty($invid) && is_csrf_valid()){
                     try{
                        $student_id =mysqli_real_escape_string($db->conn,$_POST['student_id']);
                        $accounbt_type=mysqli_real_escape_string($db->conn,$_POST['account_type']);
                        $payment_mode=mysqli_real_escape_string($db->conn,$_POST['payment_mode']);
                        $invoice_date=mysqli_real_escape_string($db->conn,$_POST['invoice_date']);
                        $login_id=mysqli_real_escape_string($db->conn,$_POST['login_id']);
                        $token_id =mysqli_real_escape_string($db->conn,$invid);
                        $payment_status=mysqli_real_escape_string($db->conn,$_POST['payment_status']);
                        $invoice_date=mysqli_real_escape_string($db->conn,$_POST['invoice_date']);
                        $invoice_no=decrypt($invid);
                        $particulars=[];
                        $charges=[];
                        $total_amount=0;
                        for($i=0;$i<count($_POST['particular']);$i++){
                            $particulars[$i]=$_POST['particular'][$i];
                            $charges[$i]=$_POST['charges'][$i];
                            $total_amount=$total_amount+$charges[$i];
                        }
                        //make an unified array of particulars and charges
                        $data=[];
                        for($i=0;$i<count($particulars);$i++){
                            $data[$i]['particulars_id']=$particulars[$i];
                            $data[$i]['charges']=$charges[$i];
                        }
                        $finalUpdateArry=[
                            "invoice_date"=>$invoice_date,
                            "payment_status"=>$payment_status,
                            "stu_id"=>$student_id,
                            "particulars"=>json_encode($data),
                            "total_amount"=>$total_amount,
                            "payment_mode"=>$payment_mode,
                            "account_type"=>$accounbt_type,
                            "invoice_added_by"=>$login_id,
                            "inv_updated_on"=>date('Y-m-d H:i:s')
                        ];
                        if($db->update('general_invoice',$finalUpdateArry,"invoice_no='$invoice_no'")){
                            js::alert("Invoice Updated successfully $invoice_no");
                            js::redirect('/GeneralInvoice/View/'.encrypt($invoice_no));
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating Invoice $invoice_no ",$login_id);
                            throw new Exception("Process Terminated with Error to Update invoice");
                        }
                     }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect("/GeneralInvoice/Reports");
                     }  
                    }else{
                        js::alert("Invalid Request");
                        js::redirect("/Dashboard");
                    }
            break;
            case "delete": 
                if(!empty($invid)){
                    try{
                        $inv_no=decrypt($invid);
                        if($db->delete('general_invoice',"invoice_no='$inv_no'")){
                            js::alert("Invoice Deleted successfully $inv_no");
                            js::redirect('/GeneralInvoice/Reports');
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting Invoice $inv_no ","");
                            throw new Exception("Process Terminated with Error to Delete invoice");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect("/GeneralInvoice/Reports");
                    }
                }else{
                    js::alert("Invalid Request");
                    js::redirect("/Dashboard");
                }
            break;
            default:
                js::alert("Invalid Request");
                js::redirect("/Dashboard");
            break;
    }
}