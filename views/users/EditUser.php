<?php
require_once './views/header.php';
$app->setTitle("Edit User");
?>
<div class="card m-3 p-3 shadow-lg">
        <div class="card-header">
            <h4 class="text-left text-gradient text-primary">Edit User</h4>
        </div>
        <div  class="card-body">
            <?php 
            $db = new database();
            $conn = $db->conn;
            if(isset($userid)){
                $uid = decrypt($userid);
                $sql = "SELECT * FROM users WHERE id = '$uid'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                // print_r($row);
                $v=json_decode($row['accesss']);
                 
            }
            ?>
        <form method="POST" action="">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Enter Username" required value="<?= $row['username']?>">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required value="<?= decrypt($row['password'])?>">
                    </div>
                    <span onclick="show()" class="btn btn-success btn-sm">Show Password</span>
                    <span onclick="GeneratePassword()" class="btn btn-success btn-sm">Generate Password</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required value="<?= $row['name']?>">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Enter Email" required value="<?= $row['email']?>">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <select name="user_type" id="user_type" class="form-control" required>
                            <option value="<?= $row['user_type']?>"><?= $row['user_type']?></option>
                            <option value="ADMIN">Admin</option>
                            <option value="TEACHER">Teacher</option>
                        </select>
                    </div>
                </div>
                <div class=" col-sm row">
                    <div class="col-sm form-group">
                        <?= func::classlist("class",[$row['class']=>(empty($row['class']))?"NULL":$row['class']]) ?>
                    </div>
                    <div class="col-sm">
                    <?= func::sectionList("section",[$row['section']=>(empty($row['section']))?"NULL":$row['section']]) ?>
                    </div>
                </div>
                <center>
                    <h4>Previllages</h4>
                </center>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="admission" <?= ($v->admission=="access")?"checked":"";?> value="access">Admission's
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="accounts" <?= ($v->accounts=="access")?"checked":"";?> value="access">Accounts
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" <?= ($v->academics=="access")?"checked":"";?> name="academics" value="access">Academics
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" <?= ($v->transport=="access")?"checked":"";?> name="transport" value="access">Transport
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="checkbox" class="m-3" name="users" <?= ($v->users=="access")?"checked":"";?> value="access">User Management
                        </div>
                    </div>
                </div>
                <input hidden type="text" name="id" value="<?= $row['id']?>">
                <center>
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                </center>
        </form>

        </div>

    </div>
        </div>
<?php 
if(isset($_POST['update'])){
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
        $mail_txt= "Dear $name,\n\nYour account has been Updated successfully.\n\nUsername: $username\nPassword: $password\n\nThank You.\n\nRegards,\n\n$user[username]";
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
        if($db->update("users", $inserData,"id='$uid'")){
            if(!empty($email)){
                $subject = "User Login Update | RoborosX ";
                $headers = "From: support@roborosx.com" . "\r\n";
                if(mail($email,$subject,$mail_txt,$headers)){
                    js::alert("Email Successfully Sent to $email");
                }
                js::alert("User Successfully Updated");
                js::redirect("/User/ManageUsers");
            }
        }else{
            error_loger($db->conn->error, __FILE__, "Cant able to Process the request for Adding the user ",$_POST['login_id']);
            throw new Exception("Process Terminated with Error to Update user");   
        }
       }catch(Exception $e){
        js::alert($e->getMessage());
        js::redirect("/User/ManageUsers");
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