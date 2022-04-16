<?php 
require '././config.php';
login::UserLogin__($_POST,encrypt(date(time())));