<pre>
<?php 

if(isset($action) && $action!=null){
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    switch($action){
        case $action=='new':
                if($enrollid!=null && is_csrf_valid()){
                    //Sanitize the input
                    $token=mysqli_real_escape_string($conn,$enrollid);
                    //append the request data with the append_data
                    $PushData=[
                     "enroll_student_id"=>$_POST['student_id'],
                     "enroll_stage_id"=>$_POST['stage_id'],
                     "enroll_academic_year"=>$_POST['academic_year'],
                     "enroll_added_by"=>$_POST['login_id'],
                     "enroll_token"=>$token,
                    ];                    
                    try{
                        //check if the student is already enrolled in the stage
                        $check=mysqli_query($db->conn,"SELECT * FROM transport_enroll WHERE enroll_student_id='$_POST[student_id]' AND enroll_academic_year='$_POST[academic_year]'");
                        if(mysqli_num_rows($check)>0){
                            js::alert("Student Already Enrolled in the Stage");
                            js::redirect("/Transport/ManageEnrollment");
                        }else{
                            if($db->insert("transport_enroll",$PushData)){
                                js::alert("$_POST[student_id] Successfully Added");
                                js::redirect("/Transport/ManageEnrollment");
                            }else{
                                error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the Enrollment , Student ID  : $_POST[student_id] ",$_POST['login_id']);
                                throw new Exception("Process Terminated with Error to Add New Transport Enrollment");
                            }
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/Transport/ManageEnrollment');
                    }
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
            break;
        case 'edit':
            if($enrollid!=null && is_csrf_valid()){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,decrypt($enrollid));
                    //append the request data with the append_data
                    $PushData=[
                     "enroll_student_id"=>$_POST['student_id'],
                     "enroll_stage_id"=>$_POST['stage_id'],
                     "enroll_academic_year"=>$_POST['academic_year'],
                     "enroll_added_by"=>$_POST['login_id'],
                    ];   
                    if($db->update("transport_enroll",$PushData,"enroll_id='$token' AND  enroll_student_id='$_POST[student_id]'")){
                        js::alert("$_POST[student_id] Successfully Updated");
                        js::redirect("/Transport/ManageEnrollment");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating the Enrollment , Student ID  : $_POST[student_id] ",$_POST['login_id']);
                        throw new Exception("Process Terminated with Error to Update the Transport Enrollment");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Transport/ManageEnrollment');
                }
            }else{
                js::alert("Invalid Auth Token");
                js::redirect('/Dashboard');
            }
            break;
        case 'delete':
            if($enrollid!=null){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,decrypt($enrollid));
                    if($db->delete("transport_enroll","enroll_id='$token'")){
                        js::alert("Transport Enrollment Successfully Deleted");
                        js::redirect("/Transport/ManageEnrollment");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting the Enrollment , Enroll ID  : $token ",'');
                        throw new Exception("Process Terminated with Error to Delete the Transport Enrollment");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Transport/ManageEnrollment');
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
