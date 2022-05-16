<?php
require_once './views/header.php';
$app->setTitle("Add New User");
?>
<div class="card mt-3">
    <div class="card-header">
        <span class="btn bg-gradient-success">
            <i class="fas fa-user-plus"></i>
            Add New User
        </span>
    </div>
    <div class="card-body">
    <form method="POST" action="">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <span onclick="show()" class="btn btn-success btn-sm">Show Password</span>
                    <span onclick="GeneratePassword()" class="btn btn-success btn-sm">Generate Password</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <label for="">Name </label>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                    </div>
                </div>
                <div class="col-sm">
                <label for="">Email </label>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                    <label for="">User Type</label>
                        <select name="user_type" id="user_type" class="form-control" required>
                            <option value="">Select User Type</option>
                            <option value="ADMIN">Admin</option>
                            <option value="TEACHER">Teacher</option>
                        </select>
                    </div>
                </div>
                <div class=" col-sm row">
                    <div class="col-sm form-group">
                       <label for="">Class</label>
                       <?= func::classlist("class")?>
                    </div>
                    <div class="col-sm">
                        <label for="">Section </label>
                        <?= func::sectionList("section")?>
                    </div>
                </div>
            </div>
                <center>
                    <h4 class="text-uppercase ">privileges</h4>
                </center>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="admission" value="access">Admission's
                        </div>
                        <ul>
                            <li>
                                <input type="checkbox" class="m-3" name="admission_add" value="access">Add
                            </li>
                            <li>
                                <input type="checkbox" class="m-3" name="admission_data" value="access">Data
                            </li>
                            <li>
                                <input type="checkbox" class="m-3" name="admission_modify" value="access">Modify
                            </li>
                            <li>
                                <input type="checkbox" class="m-3" name="admission_approve" value="access">Approval
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="accounts" value="access">Accounts
                            <ul>
                                <li>
                                    <input type="checkbox" class="m-3" name="accounts_add_fee_structure" value="access">Add Fee Structure
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="accounts_view_fee_structure" value="access" id=""> View Fee Structure
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="accounts_modify_fee_structure" value="access">
                                    Modify Fee Structure
                                </li>
                                <li>
                                    <input type="checkbox" name="accounts_collect_fee" class="m-3" value="access" id=""> Collect Fee
                                </li>
                                <li>
                                    <input type="checkbox" name="accounts_view_fee_collection" class="m-3" value="access" id=""> Reports    
                                </li>
                                <li>
                                    <input type="checkbox" name="accounts_delete_transaction" value="access" class="m-3" id=""> Delete Transaction
                                    
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="academics" value="access">Academics
                        </div>
                        <ul>
                            <li>
                                <input type="checkbox" class="m-3" name="academics_add_attendance" value="access">Add Attendance
                            </li>
                            <li>
                                <input type="checkbox" class="m-3" name="academics_view_attendance" value="access">View Attendance
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="transport" value="access">Transport 
                            <ul>
                                <li>
                                    <input type="checkbox" class="m-3" name="transport_add_vehicle" value="access">Add Bus & Driver
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="transport_manage_vehicle" value="access">Manage Bus & Driver
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="transport_add_route" value="access">Add Route
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="transport_manage_route" value="access">Manage Route
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="transport_add_stage" value="access">Add Stage
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="transport_manage_stage" value="access">Manage Stage
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="transport_enroll" value="access">Enroll
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="transport_enroll_modify" value="access">Modify Enrollment
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="transport_collect_fee" value="access">Collect Fee
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="transport_view_fee_collection" value="access">Fee Reports
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="transport_delete_transaction" value="access">Delete Transaction
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="users" value="access">User Management
                            <ul>
                                <li>
                                    <input type="checkbox" class="m-3" name="users_add_user" value="access">Add User
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="users_view_user" value="access">View User
                                </li>
                                <li>
                                    <input type="checkbox" class="m-3" name="users_modify_user" value="access">Modify User
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
                <center>
                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </center>
        </form> 
    </div>
</div>
<?php 
if(isset($_POST['submit'])){
    $conn = $db->conn;
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = encrypt(mysqli_real_escape_string($conn, $_POST['password']));
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
//access Data
$admission = (mysqli_real_escape_string($conn, $_POST['admission'])) ? mysqli_real_escape_string($conn, $_POST['admission']) : 'denied';
$admission_add= (mysqli_real_escape_string($conn, $_POST['admission_add'])) ? mysqli_real_escape_string($conn, $_POST['admission_add']) : 'denied';
$admission_view= (mysqli_real_escape_string($conn, $_POST['admission_view'])) ? mysqli_real_escape_string($conn, $_POST['admission_view']) : 'denied';
$admission_modify= (mysqli_real_escape_string($conn, $_POST['admission_modify'])) ? mysqli_real_escape_string($conn, $_POST['admission_modify']) : 'denied';
$admission_approve= (mysqli_real_escape_string($conn, $_POST['admission_approve'])) ? mysqli_real_escape_string($conn, $_POST['admission_approve']) : 'denied';

$accounts= (mysqli_real_escape_string($conn, $_POST['accounts'])) ? mysqli_real_escape_string($conn, $_POST['accounts']) : 'denied';
$accounts_add_fee_structure= (mysqli_real_escape_string($conn, $_POST['accounts_add_fee_structure'])) ? mysqli_real_escape_string($conn, $_POST['accounts_add_fee_structure']) : 'denied';
$accounts_view_fee_structure= (mysqli_real_escape_string($conn, $_POST['accounts_view_fee_structure'])) ? mysqli_real_escape_string($conn, $_POST['accounts_view_fee_structure']) : 'denied';
$accounts_modify_fee_structure= (mysqli_real_escape_string($conn, $_POST['accounts_modify_fee_structure'])) ? mysqli_real_escape_string($conn, $_POST['accounts_modify_fee_structure']) : 'denied';
$accounts_collect_fee= (mysqli_real_escape_string($conn, $_POST['accounts_collect_fee'])) ? mysqli_real_escape_string($conn, $_POST['accounts_collect_fee']) : 'denied';
$accounts_view_fee_collection= (mysqli_real_escape_string($conn, $_POST['accounts_view_fee_collection'])) ? mysqli_real_escape_string($conn, $_POST['accounts_view_fee_collection']) : 'denied';
$accounts_delete_transaction= (mysqli_real_escape_string($conn, $_POST['accounts_delete_transaction'])) ? mysqli_real_escape_string($conn, $_POST['accounts_delete_transaction']) : 'denied';

$academics= (mysqli_real_escape_string($conn, $_POST['academics'])) ? mysqli_real_escape_string($conn, $_POST['academics']) : 'denied';
$academics_add_attendance= (mysqli_real_escape_string($conn, $_POST['academics_add_attendance'])) ? mysqli_real_escape_string($conn, $_POST['academics_add_attendance']) : 'denied';
$academics_view_attendance= (mysqli_real_escape_string($conn, $_POST['academics_view_attendance'])) ? mysqli_real_escape_string($conn, $_POST['academics_view_attendance']) : 'denied';

$transport= (mysqli_real_escape_string($conn, $_POST['transport'])) ? mysqli_real_escape_string($conn, $_POST['transport']) : 'denied';
$transport_add_vehicle= (mysqli_real_escape_string($conn, $_POST['transport_add_vehicle'])) ? mysqli_real_escape_string($conn, $_POST['transport_add_vehicle']) : 'denied';
$transport_manage_vehicle= (mysqli_real_escape_string($conn, $_POST['transport_manage_vehicle'])) ? mysqli_real_escape_string($conn, $_POST['transport_manage_vehicle']) : 'denied';
$transport_add_route= (mysqli_real_escape_string($conn, $_POST['transport_add_route'])) ? mysqli_real_escape_string($conn, $_POST['transport_add_route']) : 'denied';
$transport_manage_route= (mysqli_real_escape_string($conn, $_POST['transport_manage_route'])) ? mysqli_real_escape_string($conn, $_POST['transport_manage_route']) : 'denied';
$transport_add_stage= (mysqli_real_escape_string($conn, $_POST['transport_add_stage'])) ? mysqli_real_escape_string($conn, $_POST['transport_add_stage']) : 'denied';
$transport_manage_stage= (mysqli_real_escape_string($conn, $_POST['transport_manage_stage'])) ? mysqli_real_escape_string($conn, $_POST['transport_manage_stage']) : 'denied';
$transport_enroll= (mysqli_real_escape_string($conn, $_POST['transport_enroll'])) ? mysqli_real_escape_string($conn, $_POST['transport_enroll']) : 'denied';
$transport_enroll_modify= (mysqli_real_escape_string($conn, $_POST['transport_enroll_modify'])) ? mysqli_real_escape_string($conn, $_POST['transport_enroll_modify']) : 'denied';
$transport_collect_fee= (mysqli_real_escape_string($conn, $_POST['transport_collect_fee'])) ? mysqli_real_escape_string($conn, $_POST['transport_collect_fee']) : 'denied';
$transport_view_fee_collection= (mysqli_real_escape_string($conn, $_POST['transport_view_fee_collection'])) ? mysqli_real_escape_string($conn, $_POST['transport_view_fee_collection']) : 'denied';
$transport_delete_transaction= (mysqli_real_escape_string($conn, $_POST['transport_delete_transaction'])) ? mysqli_real_escape_string($conn, $_POST['transport_delete_transaction']) : 'denied';


$user= (mysqli_real_escape_string($conn, $_POST['user'])) ? mysqli_real_escape_string($conn, $_POST['user']) : 'denied';
$users_add_user= (mysqli_real_escape_string($conn, $_POST['users_add_user'])) ? mysqli_real_escape_string($conn, $_POST['users_add_user']) : 'denied';
$users_view_user= (mysqli_real_escape_string($conn, $_POST['users_view_user'])) ? mysqli_real_escape_string($conn, $_POST['users_view_user']) : 'denied';
$users_modify_user= (mysqli_real_escape_string($conn, $_POST['users_modify_user'])) ? mysqli_real_escape_string($conn, $_POST['users_modify_user']) : 'denied';


    if (empty($username) || empty($password) || empty($name) || empty($email) ||empty($user_type)) {
        js::alert('Please Fill All Fields');
    }else{
        $access_data = [
            "admission" => $admission,
            "admission_add" => $admission_add,
            "admission_view" => $admission_view,
            "admission_modify" => $admission_modify,
            "admission_approve" => $admission_approve,
            "accounts" => $accounts,
            "accounts_add_fee_structure" => $accounts_add_fee_structure,
            "accounts_view_fee_structure"=> $accounts_view_fee_structure,
            "accounts_modify_fee_structure"=> $accounts_modify_fee_structure,
            "accounts_collect_fee"=> $accounts_collect_fee,
            "accounts_view_fee_collection"=> $accounts_view_fee_collection,
            "accounts_delete_transaction"=> $accounts_delete_transaction,
            "academics" => $academics,
            "academics_add_attendance" => $academics_add_attendance,
            "academics_view_attendance" => $academics_view_attendance,
            "transport" => $transport,
            "transport_add_vehicle" => $transport_add_vehicle,
            "transport_manage_vehicle" => $transport_manage_vehicle,
            "transport_add_route" => $transport_add_route,
            "transport_manage_route" => $transport_manage_route,
            "transport_add_stage" => $transport_add_stage,
            "transport_manage_stage" => $transport_manage_stage,
            "transport_enroll" => $transport_enroll,
            "transport_enroll_modify" => $transport_enroll_modify,
            "transport_collect_fee" => $transport_collect_fee,
            "transport_view_fee_collection" => $transport_view_fee_collection,
            "transport_delete_transaction" => $transport_delete_transaction,
            "user" => $user,
            "users_add_user" => $users_add_user,
            "users_view_user" => $users_view_user,
            "users_modify_user" => $users_modify_user,
        ];
        print_r($access_data);
    }
}
?>
<script>
    function GeneratePassword() {
        var length = 8,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        document.getElementsByName("password")[0].value = retVal;
    }

    function show() {
        var x = document.getElementsByName("password")[0];
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?php   
    require_once './views/footer.php';
?>