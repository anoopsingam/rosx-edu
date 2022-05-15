<pre>
<?php 

if(isset($action) && $action!=null){
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    switch($action){
        case $action=='new':
                if($routeid!=null && is_csrf_valid()){
                    //Sanitize the input
                    $token=mysqli_real_escape_string($conn,$routeid);
                    //append the request data with the append_data
                    $PushData=[
                      "route_name"=>$_POST['route_name'],
                      "route_src"=>$_POST['route_src'],
                      "route_dest"=>$_POST['route_dest'],
                      "route_bus_id"=>$_POST['route_bus_id'],
                    ];                    
                    try{
                        if($db->insert("transport_routes",$PushData)){
                            js::alert("$_POST[route_name] Successfully Added");
                            js::redirect("/Transport/ManageRoute");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the Route , Route Name : $_POST[route_name] ",$_POST['login_id']);
                            throw new Exception("Process Terminated with Error to Add New Route");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/Transport/ManageRoute');
                    }
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
            break;
        case 'edit':
            if($routeid!=null && is_csrf_valid()){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,decrypt($routeid));
                    //append the request data with the append_data
                    $PushData=[
                        "route_name"=>$_POST['route_name'],
                        "route_src"=>$_POST['route_src'],
                        "route_dest"=>$_POST['route_dest'],
                        "route_bus_id"=>$_POST['route_bus_id'],
                      ];   
                    if($db->update("transport_routes",$PushData,"route_id='$token'")){
                        js::alert("$_POST[route_name] Successfully Updated");
                        js::redirect("/Transport/ManageRoute");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating the Route , Route Name : $_POST[route_name] ",$_POST['login_id']);
                        throw new Exception("Process Terminated with Error to Update the Route");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Transport/ManageRoute');
                }
            }else{
                js::alert("Invalid Auth Token");
                js::redirect('/Dashboard');
            }
            break;
        case 'delete':
            if($routeid!=null){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,$routeid);
                    if($db->delete("transport_routes","route_id='$token'")){
                        js::alert("Route Successfully Deleted");
                        js::redirect("/Transport/ManageRoute");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting the Route , Route : $token ",'');
                        throw new Exception("Process Terminated with Error to Delete the Route");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Transport/ManageRoute');
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
