<pre>
<?php 

if(isset($action) && $action!=null){
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    switch($action){
        case $action=='new':
                if($payeeid!=null && is_csrf_valid()){
                    //Sanitize the input
                    $token=mysqli_real_escape_string($conn,$payeeid);
                    //append the request data with the append_data
                    $PushData=[
                      "payee_name"=>$_POST['payee_name'],
                      "payee_desc"=>$_POST['payee_desc'],
                      "payee_added_by"=>$_POST['login_id'],
                    ];                    
                    try{
                        if($db->insert("payee_details",$PushData)){
                            js::alert("$_POST[payee_name] Successfully Added");
                            js::redirect("/Expense/Manage/Payee");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the Payee , Payee Name : $_POST[payee_name] ",$_POST['login_id']);
                            throw new Exception("Process Terminated with Error to Add New Payee");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/Expense/Manage/Payee');
                    }
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
            break;
        case 'edit':
            if($payeeid!=null && is_csrf_valid()){
                //Sanitize the input
                try{
                    // print_r($_POST);
                    $token=mysqli_real_escape_string($conn,$payeeid);
                    // print_r($_POST);
                    $lg=mysqli_real_escape_string($conn,$_POST['login_id']);
                    unset($_POST['login_id']);
                    if($db->update("payee_details",array_merge($_POST,["payee_updated_by"=>$lg]),"payee_id='$payeeid'")){
                        js::alert("$_POST[payee_name] Successfully Updated");
                        js::redirect("/Expense/Manage/Payee");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating the Payee , Payee Name : $_POST[payee_name] ",$lg);
                        throw new Exception("Process Terminated with Error to Update Payee");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Expense/Manage/Payee');
                }
            }else{
                js::alert("Invalid Auth Token");
                js::redirect('/Dashboard');
            }
            break;
        case 'delete':
            if($payeeid!=null){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,$payeeid);
                    if($db->delete("payee_details","payee_id='$payeeid'")){
                        js::alert("Payee Successfully Deleted");
                        js::WindowClose();
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting the Payee , Payee Id : $payeeid ",'');
                        throw new Exception("Process Terminated with Error to Delete Payee");
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
        default:
            js::alert("Invalid Request");
            js::redirect('/Dashboard'); 
    }
}
?>
</pre>