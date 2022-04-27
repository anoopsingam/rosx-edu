<pre>
<?php 

if(isset($action) && $action!=null){
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    switch($action){
        case $action=='new':
                if($hoid!=null && is_csrf_valid()){
                    //Sanitize the input
                    $token=mysqli_real_escape_string($conn,$hoid);
                    //append the request data with the append_data
                    $PushData=[
                      "ho_name"=>$_POST['ho_name'],
                      "ho_desc"=>$_POST['ho_desc'],
                      "added_by"=>$_POST['login_id'],
                    ];                    
                    try{
                        if($db->insert("head_accounts",$PushData)){
                            js::alert("$_POST[ho_name] Successfully Added");
                            js::redirect("/Expense/Manage/Ho");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the Head of Account , H.O Name : $_POST[ho_name] ",$_POST['login_id']);
                            throw new Exception("Process Terminated with Error to Add New Head of Account");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/Expense/Manage/Ho');
                    }
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
            break;
        case 'edit':
            if($hoid!=null && is_csrf_valid()){
                //Sanitize the input
                try{
                    // print_r($_POST);
                    $token=mysqli_real_escape_string($conn,$hoid);
                    // print_r($_POST);
                    $lg=mysqli_real_escape_string($conn,$_POST['login_id']);
                    unset($_POST['login_id']);
                    if($db->update("head_accounts",array_merge($_POST,["updated_by"=>$lg]),"id='$hoid'")){
                        js::alert("$_POST[ho_name] Successfully Updated");
                        js::redirect("/Expense/Manage/Ho");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating the Head of Account , H.O Name : $_POST[ho_name] ",$lg);
                        throw new Exception("Process Terminated with Error to Update Head of Account");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Expense/Manage/Ho');
                }
            }else{
                js::alert("Invalid Auth Token");
                js::redirect('/Dashboard');
            }
            break;

        case 'delete':
            if($hoid!=null){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,$hoid);
                    if($db->delete("head_accounts","id='$hoid'")){
                        js::alert("Head of Account Successfully Deleted");
                        js::WindowClose();
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting the Head of Account , H.O ID : $hoid ",'');
                        throw new Exception("Process Terminated with Error to Delete Head of Account");
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
