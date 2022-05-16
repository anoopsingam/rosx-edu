<?php 
 if($userid!=null){
    require '././config.php';
    $db= new database();
    try{
        $token=mysqli_real_escape_string($db->conn,decrypt($userid));
        if($db->delete("users","id='$token'")){
            js::alert("User Successfully Deleted");
            js::redirect("/User/ManageUsers");
        }else{
            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting the User , User Name : $userid ",'');
            throw new Exception("Process Terminated with Error to Delete User");
        }
    }catch(Exception $e){
        js::alert($e->getMessage());
        js::redirect('/User/ManageUsers');
    }
}else{
    js::alert("Invalid Auth Token");
    js::redirect('/Dashboard');
}