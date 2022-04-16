<?php
class login
{


    public static function UserLogin__(array $data, string $token)
    {
        //check login details with database and return true or false
        $db = new database();
        $conn = $db->conn;
        $username=mysqli_real_escape_string($conn,$data['username']);
        $password=mysqli_real_escape_string($conn,$data['password']);

        $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '" .encrypt($password). "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['password'] == encrypt($password)) {
                //set session 
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['ip_address'] = $data['ip_addr'];
                $_SESSION['token'] = $token;
                js::redirect("/Dashboard");
            }
        } else {
            js::alert("Invalid Username or Password");
            js::redirect("/");
        }
    }
    public static function checkLogin()
    {
        if (!isset($_SESSION['token'])) {
            js::redirect("/");
        }
    }
    public static function loginPage(){
        if(isset($_SESSION['token'])){
            js::redirect("/Dashboard");
        }
    }
   
    public static function logout()
    {
        session_unset();
        session_destroy();
        js::alert("Logged Out Successfully");
        js::redirect("/");
    }

    public static function UserInfo(string $username=''){
        $db = new database();
        $conn = $db->conn;
        $u=mysqli_real_escape_string($conn,$username);
        $sql = "SELECT * FROM `users` WHERE `username` = '$u'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }
}