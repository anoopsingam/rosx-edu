<?php 

get('/Attendance/Add','views/attendance/Add.php');
post('/Attendance/View/Students','views/attendance/ViewStudents.php');
post('/Attendance/View/Confirm','views/attendance/ViewConfirm.php');
post('/Attendance/View/Confirm/Submit','model/attendance/AttendanceApi.php');
any('/Attendance/View/Report','views/attendance/ViewReport.php');