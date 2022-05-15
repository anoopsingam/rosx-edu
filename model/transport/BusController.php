<pre>
<?php 

if(isset($action) && $action!=null){
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    switch($action){
        case $action=='new':
                if($busid!=null && is_csrf_valid()){
                    //Sanitize the input
                    $token=mysqli_real_escape_string($conn,$busid);
                    //append the request data with the append_data
                    $PushData=[
                      "driver_name"=>$_POST['driver_name'],
                      "driver_number"=>$_POST['driver_number'],
                      "driver_address"=>$_POST['driver_address'],
                      "bus_reg_no"=>$_POST['bus_reg_no'],
                      "bus_name"=>$_POST['bus_name'],
                    ];                    
                    try{
                        if($db->insert("transport_bus",$PushData)){
                            js::alert("$_POST[bus_reg_no] Successfully Added");
                            js::redirect("/Transport/ManageBus");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the Bus , Bus Name : $_POST[bus_name] ",$_POST['login_id']);
                            throw new Exception("Process Terminated with Error to Add New Bus");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/Transport/ManageBus');
                    }
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
            break;
        case 'edit':
            if($busid!=null && is_csrf_valid()){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,decrypt($busid));
                    //append the request data with the append_data
                    $PushData=[
                      "driver_name"=>$_POST['driver_name'],
                      "driver_number"=>$_POST['driver_number'],
                      "driver_address"=>$_POST['driver_address'],
                      "bus_reg_no"=>$_POST['bus_reg_no'],
                      "bus_name"=>$_POST['bus_name'],
                    ];   
                    if($db->update("transport_bus",$PushData,"db_id='$token'")){
                        js::alert("$_POST[bus_reg_no] Successfully Updated");
                        js::redirect("/Transport/ManageBus");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating the Bus , Bus Name : $_POST[bus_name] ",$_POST['login_id']);
                        throw new Exception("Process Terminated with Error to Update the Bus");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Transport/ManageBus');
                }
            }else{
                js::alert("Invalid Auth Token");
                js::redirect('/Dashboard');
            }
            break;
        case 'delete':
            if($busid!=null){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,$busid);
                    if($db->delete("transport_bus","db_id='$busid'")){
                        js::alert("Bus Successfully Deleted");
                        js::redirect("/Transport/ManageBus");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting the Bus , Bus  : $token ",'');
                        throw new Exception("Process Terminated with Error to Delete the Bus");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Transport/ManageBus');
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
