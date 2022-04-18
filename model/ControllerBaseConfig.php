<?php 

    if(isset($action) && $action!=null){
        require '././config.php';
        $db= new database();
        $conn=$db->conn;
        switch($action){
            case 'new':
                    if($student_id!=null && is_csrf_valid()){
                        //Sanitize the input
                        $token=mysqli_real_escape_string($conn,$student_id);
                        
                        $PushData=[
                            "student_name"=>$student_name,
                           
                        ];
                        // print_r($PushData);
                        try{
                            if($db->insert("student_enrollment",$PushData)){
                                js::alert("$student_name Successfully Registered with Enrollment No: $enrollment_no");
                                js::redirect("/Admission/QuickAdmission");
                            }else{
                                error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the Student , Student Name : $student_name ",$login_id);
                                throw new Exception("Process Terminated with Error to Add Student");
                            }
                        }catch(Exception $e){
                            js::alert($e->getMessage());
                            js::redirect('/Admission/QuickAdmission');
                        }
                    }else{
                        js::alert("Invalid Auth Token");
                        js::redirect('/Dashboard');
                    }
                break;
            case 'edit':
                if($student_id!=null && is_csrf_valid()){
                    //Sanitize the input
                 

                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
                break;

            case 'delete':
                if($student_id!=null){

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

