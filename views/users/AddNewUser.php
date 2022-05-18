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
        <?= set_csrf()?>
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
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="accounts" value="access">Accounts
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="academics" value="access">Academics
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="transport" value="access">Transport
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="users_management" value="access">User Management
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
    // print_r($_POST);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = encrypt(mysqli_real_escape_string($conn, $_POST['password']));
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    $admission = ((mysqli_real_escape_string($conn, isset($_POST['admission'])))) ? mysqli_real_escape_string($conn, $_POST['admission']) : 'denied';
    $accounts = (mysqli_real_escape_string($conn, isset($_POST['accounts']))) ? mysqli_real_escape_string($conn, $_POST['accounts']) : 'denied';
    $academics = (mysqli_real_escape_string($conn, isset($_POST['academics']))) ? mysqli_real_escape_string($conn, $_POST['academics']) : 'denied';
    $transport = (mysqli_real_escape_string($conn, isset($_POST['transport']))) ? mysqli_real_escape_string($conn, $_POST['transport']) : 'denied';
    $users_management = (mysqli_real_escape_string($conn, $_POST['users_management'])) ? mysqli_real_escape_string($conn, $_POST['users_management']) : 'denied';
    if (empty($username) || empty($password) || empty($name) || empty($email) ||empty($user_type)) {
        js::alert('Please Fill All Fields');
    }else{
        $access_data = [
            "admission" => $admission,
            "accounts" => $accounts,
            "academics" => $academics,
            "transport" => $transport,
            "users" => $users_management
        ];
        $mail_txt= "Dear $name,\n\nYour account has been created successfully.\n\nUsername: $username\nPassword: $password\n\nThank You.\n\nRegards,\n\n$user[username]";
        $inserData= [
            "name" => $name,
            "username" => $username,
            "password" => $password,
            "email" => $email,
            "img_url"=>'',
            "user_type" => $user_type,
            "accesss" => json_encode($access_data),
            "class" => $class,
            "section" => $section,
        ];
        // print_r($inserData);
       try{
        if($db->insert("users", $inserData)){
            if(!empty($email)){
                $subject = "User Login | RoborosX ";
                $headers = "From: support@roborosx.com" . "\r\n";
                if(mail($email,$subject,$mail_txt,$headers)){
                    js::alert("Email Successfully Sent to $email");
                }
                js::alert("User Successfully Created");
            }
        }else{
            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the user ",$_POST['login_id']);
            throw new Exception("Process Terminated with Error to Add new user");   
        }
       }catch(Exception $e){
        js::alert($e->getMessage());
       }
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