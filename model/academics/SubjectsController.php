<?php 
    if(isset($action) && $action!=null){
        require '././config.php';
        $db= new database();
        $conn=$db->conn;
        switch($action){
            case 'new':
                    if($acd_id!=null && is_csrf_valid()){
                        //Sanitize the input
                        $token=mysqli_real_escape_string($conn,$acd_id);
                        try{
                            unset($_POST['submit']);
                            $_POST['acd_login_id']=$_POST['login_id'];
                            unset($_POST['login_id']);
                            if($db->insert("academic_subjects_info",$_POST)){
                                js::alert("Subjects Successfully added to Class $_POST[acd_class] for Academic Year $_POST[acd_ay]");
                                js::redirect("/Academics/ManageSubjects");
                            }else{
                                error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the Subjects for  $_POST[acd_class] $_POST[acd_ay] ",$_POST["acd_login_id"]);
                                throw new Exception("Process Terminated with Error to Add Subjects");
                            }
                        }catch(Exception $e){
                            js::alert($e->getMessage());
                            js::redirect('/Academics/ManageSubjects');
                        }
                    }else{
                        js::alert("Invalid Auth Token");
                        js::redirect('/Dashboard');
                    }
                break;
            case 'edit':
                if($acd_id!=null && is_csrf_valid()){
                    //Sanitize the input
                    unset($_POST['update']);
                    $_POST['acd_login_id']=$_POST['login_id'];
                    unset($_POST['login_id']);
                    $token=mysqli_real_escape_string($conn,decrypt($acd_id));
                    try{
                        if($db->update("academic_subjects_info",$_POST,"acd_id='$token'")){
                            js::alert("Subjects Successfully Updated for Class $_POST[acd_class] for Academic Year $_POST[acd_ay]");
                            js::redirect("/Academics/ManageSubjects");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating the Subjects for  $_POST[acd_class] $_POST[acd_ay] ",$_POST["acd_login_id"]);
                            throw new Exception("Process Terminated with Error to Update Subjects");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/Academics/ManageSubjects');
                    }
                 
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
                break;

            case 'delete':
                if($acd_id!=null){
                    //Sanitize the input
                    $token=mysqli_real_escape_string($conn,decrypt($acd_id));
                    try{
                        if($db->delete("academic_subjects_info","acd_id='$token'")){
                            js::alert("Subjects Successfully Deleted ");
                            js::redirect("/Academics/ManageSubjects");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting the Subjects $token ",$token);
                            throw new Exception("Process Terminated with Error to Delete Subjects");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/Academics/ManageSubjects');
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

