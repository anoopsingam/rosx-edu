<?php 


if(isset($action) && !empty($action)){
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    switch($action){
        case "new":
                if($parid!=null && is_csrf_valid()){
                    //Sanitize the input
                    $token=mysqli_real_escape_string($conn,$parid);
                    //append the request data with the append_data
                    $PushData=[
                      "particular_name"=>$_POST['particular_name'],
                      "charges"=>$_POST['charges'],
                    ];                    
                    try{
                        if($db->insert("billing_particulars",$PushData)){
                            js::alert("$_POST[particular_name] Successfully Added");
                            js::redirect("/GeneralInvoices/ManageParticular");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the Particular , Particular Name : $_POST[billing_particulars] ",$_POST['login_id']);
                            throw new Exception("Process Terminated with Error to Add New Particular");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/GeneralInvoices/ManageParticular');
                    }
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
            break;
            case "edit":
                if($parid!=null && is_csrf_valid()){
                    //Sanitize the input
                    try{
                        // print_r($_POST);
                        $token=mysqli_real_escape_string($conn,$parid);
                        // print_r($_POST);
                        $lg=mysqli_real_escape_string($conn,$_POST['login_id']);
                        unset($_POST['login_id']);
                        if($db->update("billing_particulars",$_POST,"billing_particular_id='$parid'")){
                            js::alert("$_POST[particular_name] Successfully Updated");
                            js::redirect("/GeneralInvoices/ManageParticular");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating the Particular , Particular Name : $_POST[billing_particulars] ",$lg);
                            throw new Exception("Process Terminated with Error to Update Particular");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/GeneralInvoices/ManageParticular');
                    }
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
                break;
            case "delete":
                if($parid!=null){
                    //Sanitize the input
                    try{
                        $token=mysqli_real_escape_string($conn,$parid);
                        if($db->delete("billing_particulars","billing_particular_id='$parid'")){
                            js::alert("Particular Successfully Deleted");
                            js::redirect("/GeneralInvoices/ManageParticular");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting the Particular , Particular $parid",'');
                            throw new Exception("Process Terminated with Error to Delete Particular");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::WindowClose();
                    }
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
                break;
    }
}