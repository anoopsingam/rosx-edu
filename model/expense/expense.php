<pre>
<?php 

if(isset($action) && $action!=null){
    require '././config.php';
    $db= new database();
    $conn=$db->conn;
    switch($action){
        case $action=='new':
                if($expenseid!=null && is_csrf_valid()){
                    //Sanitize the input
                    $token=mysqli_real_escape_string($conn,$expenseid);
                    //append the request data with the append_data
                    $PushData=[
                    "ho_id"=>$_POST['ho_id'],
                    "payee__id"=>$_POST['payee__id'],
                    "expense_desc"=>$_POST['expense_desc'],
                    "expense_amount"=>$_POST['expense_amount'],
                    "payment_mode"=>$_POST['payment_mode'],
                    "expense_trans_id"=>(!isset($_POST['expense_trans_id']) || empty($_POST['expense_trans_id']))?rand(9999,99999999):$_POST['expense_trans_id'],
                    "expense_fy"=>$_POST['expense_fy'],
                    "expense_date"=>$_POST['expense_date'],
                    "expense_added_by"=>$_POST['login_id'],
                    "expense_token"=>$token
                    ];
                    
                    try{
                        if($db->insert("expense_details",$PushData)){
                           js::alert("Expense Added Successfully");
                           js::redirect("/Expense/Manage");
                        }else{
                            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the Expense ",$_POST['login_id']);
                            throw new Exception("Process Terminated with Error to Register the Expense");
                        }
                    }catch(Exception $e){
                        js::alert($e->getMessage());
                        js::redirect('/Expense/Manage');
                    }
                }else{
                    js::alert("Invalid Auth Token");
                    js::redirect('/Dashboard');
                }
            break;
        case 'edit':
            if($expenseid!=null && is_csrf_valid()){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,$expenseid);
                    $PushData=[
                    "ho_id"=>$_POST['ho_id'],
                    "payee__id"=>$_POST['payee__id'],
                    "expense_desc"=>$_POST['expense_desc'],
                    "expense_amount"=>$_POST['expense_amount'],
                    "payment_mode"=>$_POST['payment_mode'],
                    "expense_fy"=>$_POST['expense_fy'],
                    "expense_date"=>$_POST['expense_date'],
                    "expense_added_by"=>$_POST['login_id'],
                    "expense_token"=>$token
                    ];
                    if($db->update("expense_details",$PushData,"expense_id='$expenseid'")){
                        js::alert("Expense Updated Successfully");
                        js::redirect("/Expense/Manage");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Updating the Expense ",$_POST['login_id']);
                        throw new Exception("Process Terminated with Error to Update the Expense");
                    }
                }catch(Exception $e){
                    js::alert($e->getMessage());
                    js::redirect('/Expense/Manage');
                }
            }else{
                js::alert("Invalid Auth Token");
                js::redirect('/Dashboard');
            }
            break;

        case 'delete':
            if($expenseid!=null){
                //Sanitize the input
                try{
                    $token=mysqli_real_escape_string($conn,$expenseid);
                    if($db->delete("expense_details","expense_id='$expenseid'")){
                        js::alert("Expense Deleted Successfully");
                        js::redirect("/Expense/Manage");
                    }else{
                        error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Deleting the Expense ",'');
                        throw new Exception("Process Terminated with Error to Delete the Expense");
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
</pre>
