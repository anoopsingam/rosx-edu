<?php 

class js
{
    public static function consoleLog(string $log)
    {
        echo "<script>console.log('$log')</script>";
    }
    public static function alert($msg)
    {
        echo "<script>window.alert('$msg');</script>";
    }
    public static function redirect($url)
    {
        echo "<script>window.location.href='$url';</script>";
    }
    public static function prompt(string $data, string $navigate1, string $navigate2)
    {
        echo "<script>
            if (window.confirm('$data')) {
            window.location.href='$navigate1';
            }else{
            window.location.href='$navigate2';
            }
        </script>";
    }

    public static function WindowClose(){
        echo "<script>window.close();</script>";
    }
   
    public static function pcm(bool $data, string $mess, string $path)
    {
        if ($data==true) {
            js::alert("$mess");
            js::redirect($path);
        } else {
            js::alert("Process failed ! Contact Technical Administrator");
            js::redirect($path);
        }
    }

    public static function notFound(string $data)
    {
        return "<div class='alert alert-danger text-light'>
                <strong><h3>Note !</h3></strong><br>
                <h4>$data</h4>
            </div>";
    }
    
}
class url
{
    public static function myurl()
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
            === 'on' ? "https" : "http") .
            "://" . $_SERVER['HTTP_HOST'];
        return $link;
    }
}

function error_loger(string $msg, string $path,string $error_msg, string $user='')
{
    $log  = "Ip Address : " . $_SERVER['REMOTE_ADDR'] . ' - ' . date("F j, Y, g:i a") . PHP_EOL .
        "Error Message : $msg" . PHP_EOL .
        "file path: $path" . PHP_EOL .
        "User Meassage: $error_msg" . PHP_EOL .
        "User ID: $user" . PHP_EOL .
        "-------------------------" . PHP_EOL;
    file_put_contents('./error/log_' . date("j.n.Y") . '.log', $log, FILE_APPEND);
}


