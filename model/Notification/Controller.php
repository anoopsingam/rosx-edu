<?php 
if(isset($action) && $action!=null){
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    switch($action){
        case $action=='new':
                if($no_token!=null && is_csrf_valid()){
                    //Sanitize the input
                    $token=mysqli_real_escape_string($conn,$no_token);
                    //append the request data with the append_data
                    $PushData=[
                      "no_type"=>$_POST['no_type'],
                      "no_heading"=>$_POST['no_heading'],
                      "no_message"=>$_POST['no_message'],
                      "no_to"=>$_POST['no_to'],
                      "no_date"=>$_POST['no_date'],
                      "no_login_id"=>$_POST['login_id'],
                      "no_media_link"=>$_POST['no_media_link'],
                      "no_token"=>$no_token
                    ];                    
                    try{
                        if($db->insert("app_notifications",$PushData)){
                            js::alert("$_POST[no_heading] Successfully Added");
                            js::redirect("/Notification/Manage");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding notification  : $_POST[no_heading] ",$_POST['login_id']);
                            throw new Exception("Process Terminated with Error to Add Notification..");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/Notification/Manage');
                    }
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
            break;
        case 'edit':
            if($no_token!=null && is_csrf_valid()){
                //Sanitize the input
                try{
                    // print_r($_POST);
                    $token=mysqli_real_escape_string($conn,$no_token);
                    // print_r($_POST);
                    $lg=mysqli_real_escape_string($conn,$_POST['login_id']);
                    unset($_POST['login_id']);
                    if($db->update("app_notifications",$_POST,"no_token='$token'")){
                        js::alert("$_POST[no_heading] Successfully Updated");
                        js::redirect("/Notification/Manage");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating notification  : $_POST[no_heading] ",$lg);
                        throw new Exception("Process Terminated with Error to Update Notification..");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Notification/Manage');
                }
            }else{
                js::alert("Invalid Auth Token");
                js::redirect('/Dashboard');
            }
            break;
        case 'delete':
            if($no_token!=null){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,$no_token);
                    if($db->delete("app_notifications","no_token='$token'")){
                        js::alert("Notification Successfully Deleted");
                        js::WindowClose();
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting notification  : $token ",'');
                        throw new Exception("Process Terminated with Error to Delete Notification..");
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

