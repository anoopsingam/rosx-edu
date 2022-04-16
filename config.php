<?php
   if(!isset($_SESSION))
    {
        session_start();
    }
date_default_timezone_set('Asia/Kolkata');
include __DIR__.'/Lib/encrypt.php';
include __DIR__.'/Lib/Misc.php';
include __DIR__.'/Lib/App.php';
include __DIR__.'/Lib/Db.php';
include __DIR__.'/Lib/Auth.php';
include __DIR__.'/Lib/includes.php';
include __DIR__.'/Lib/Functions.php';