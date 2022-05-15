<?php
get('/', 'views/index.php');
get('/sample','sample.php');
post('/Auth/login', 'model/login/login.php');
get('/Auth/signOut', 'model/login/signout.php');
get('/barcode/$size/$text/$print', 'Lib/barcode.php');