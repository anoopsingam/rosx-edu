<?php 

any('/User/AddNewUser', 'views/users/AddNewUser.php');
any('/User/ManageUsers', 'views/users/ManageUsers.php');
any('/User/EditUser/$userid', 'views/users/EditUser.php');
any('/User/DeleteUser/$userid', 'model/users/DeleteUser.php');