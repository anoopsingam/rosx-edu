<?php 

    if(isset($action) && $action!=null){
        require '././config.php';
        $db= new database();
        $conn=$db->conn;
        switch($action){
            case 'new':
                    if($token_id!=null && is_csrf_valid()){
                        // print_r($PushData);
                        try{
                            unset($_POST['sub_fee']);
                            if($db->select('fee_structure','*','class="'.$_POST['class'].'" AND academic_year="'.$_POST['academic_year'].'"')){
                                js::alert("Fee Structure Already Exists");
                                js::redirect("/FeeStructure/Manage");
                            }else{
                                if($db->insert("fee_structure",$_POST)){
                                    js::alert("Fee Structure Successfully Added to Class : {$_POST['class']}");
                                    js::redirect("/FeeStructure/Manage");
                                 }else{
                                     error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the Fee Structure ",$_POST['login_id']);
                                     throw new Exception("Process Terminated with Error to Add Fee Structure");
                                 }
                            }
                        }catch(Exception $e){
                            js::alert($e->getMessage());
                            js::redirect('/FeeStructure/new');
                        }
                    }else{
                        js::alert("Invalid Auth Token");
                        js::redirect('/Dashboard');
                    }
                break;
            case 'edit':
                if($token_id!=null && is_csrf_valid()){
                    try{
                        unset($_POST['sub_fee']);
                        $lg=array_merge($_POST,[
                            "updated_by"=>$_POST['login_id'],
                            "updated_on"=>date("Y-m-d H:i:s")
                        ]);
                        unset($_POST['login_id']);
                        if($db->update("fee_structure",array_merge($_POST,$lg),'token_id="'.$token_id.'"')){
                            js::alert("Fee Structure Successfully Updated for Class : $_POST[class] for Academic Year : $_POST[academic_year] ");
                            js::redirect("/FeeStructure/Manage");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating the Fee Structure ",$lg['updated_by']);
                            throw new Exception("Process Terminated with Error to Update Fee Structure");
                        }
                    }catch (Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/FeeStructure/Manage');
                    }

                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
                break;

            case 'delete':
                if($token_id!=null){
                    try{
                        if($db->delete("fee_structure",'token_id="'.$token_id.'"')){
                            js::alert("Fee Structure Successfully Deleted");
                            js::WindowClose();
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting the Fee Structure ",$_POST['login_id']);
                            throw new Exception("Process Terminated with Error to Delete Fee Structure");
                        }
                    }
                    catch(Exception $e){
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

