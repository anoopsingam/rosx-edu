<pre>
<?php 

if(isset($action) && $action!=null){
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    switch($action){
        case $action=='new':
                if($stageid!=null && is_csrf_valid()){
                    //Sanitize the input
                    $token=mysqli_real_escape_string($conn,$stageid);
                    //append the request data with the append_data
                    $PushData=[
                     "stage_route_id"=>$_POST['stage_route_id'],
                      "route_stage_name"=>$_POST['route_stage_name'],
                      "route_stage_fare"=>$_POST['route_stage_fare'],
                    ];                    
                    try{
                        if($db->insert("transport_stages",$PushData)){
                            js::alert("$_POST[route_stage_name] Successfully Added");
                            js::redirect("/Transport/ManageStages");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the Stage , Stage Name : $_POST[route_stage_name] ",$_POST['login_id']);
                            throw new Exception("Process Terminated with Error to Add New Stage");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/Transport/ManageStages');
                    }
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
            break;
        case 'edit':
            if($stageid!=null && is_csrf_valid()){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,decrypt($stageid));
                    //append the request data with the append_data
                    $PushData=[
                     "stage_route_id"=>$_POST['stage_route_id'],
                      "route_stage_name"=>$_POST['route_stage_name'],
                      "route_stage_fare"=>$_POST['route_stage_fare'],
                    ];   
                    if($db->update("transport_stages",$PushData,"route_stage_id='$token'")){
                        js::alert("$_POST[route_stage_name] Successfully Updated");
                        js::redirect("/Transport/ManageStages");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating the Stage , Stage Name : $_POST[route_stage_name] ",$_POST['login_id']);
                        throw new Exception("Process Terminated with Error to Update the Stage");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Transport/ManageStages');
                }
            }else{
                js::alert("Invalid Auth Token");
                js::redirect('/Dashboard');
            }
            break;
        case 'delete':
            if($stageid!=null){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,decrypt($stageid));
                    if($db->delete("transport_stages","route_stage_id='$token'")){
                        js::alert("Stage Successfully Deleted");
                        js::redirect("/Transport/ManageStages");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting the Stage , Stage $token ",'');
                        throw new Exception("Process Terminated with Error to Delete the Stage");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Transport/ManageStages');
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
