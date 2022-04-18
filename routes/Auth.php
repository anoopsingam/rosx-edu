<?php
get('/', 'views/index.php');
get('/sample','sample.php');
post('/Auth/login', 'model/Login/login.php');
get('/Auth/signOut', 'model/Login/signout.php');
get('/barcode/$size/$text/$print', 'Lib/barcode.php');