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
                        $student_name=mysqli_real_escape_string($conn,$_POST['student_name']);
                        $gender=mysqli_real_escape_string($conn,$_POST['gender']);
                        $dob=mysqli_real_escape_string($conn,$_POST['dob']);
                        $studentaadhar=mysqli_real_escape_string($conn,$_POST['studentaadhar']);
                        $father_name=mysqli_real_escape_string($conn,$_POST['father_name']);
                        $father_number=mysqli_real_escape_string($conn,$_POST['father_number']);
                        $mother_name=mysqli_real_escape_string($conn,$_POST['mother_name']);
                        $mother_number=mysqli_real_escape_string($conn,$_POST['mother_number']);
                        $permanentaddress=mysqli_real_escape_string($conn,$_POST['permanentaddress']);
                        $temporaryaddress=mysqli_real_escape_string($conn,$_POST['temporaryaddress']);
                        $medium_c=mysqli_real_escape_string($conn,$_POST['medium_c']);
                        $sts_no=mysqli_real_escape_string($conn,$_POST['sts_no']);
                        $present_class=mysqli_real_escape_string($conn,$_POST['present_class']);
                        $present_section=mysqli_real_escape_string($conn,$_POST['present_section']);
                        $academic_year=mysqli_real_escape_string($conn,$_POST['academic_year']);
                        $login_id=mysqli_real_escape_string($conn,$_POST['login_id']);
                        $dob=mysqli_real_escape_string($conn,$_POST['dob']);
                        $enrollment_no=func::getEnrollementNo();
                        $app_no=func::getApplicationNo();
                        $PushData=[
                            "student_name"=>$student_name,
                            "gender"=>$gender,
                            "dob"=>$dob,
                            "father_name"=>$father_name,
                            "father_number"=>$father_number,
                            "mother_name"=>$mother_name,
                            "mother_number"=>$mother_number,
                            "permanentaddress"=>$permanentaddress,
                            "temporaryaddress"=>$temporaryaddress,
                            "medium_c"=>$medium_c,
                            "studentaadhar"=>$studentaadhar,
                            "sts_no"=>$sts_no,
                            "present_class"=>$present_class,
                            "present_section"=>$present_section,
                            "academic_year"=>$academic_year,
                            "login_id"=>$login_id,
                            "enrollment_no"=>$enrollment_no,
                            "app_no"=>$app_no,
                            "token"=>$token,
                            "status"=>"WAITING"
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
            default:
                js::alert("Invalid Request");
                js::redirect('/Dashboard'); 
        }
    }

