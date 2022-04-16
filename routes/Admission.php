<?php 

get('/Admission/new','views/admission/FullAdmission.php');
get('/Admission/QuickAdmission','views/admission/QuickAdmission.php');
any('/QuickAdmissionController/$action/$student_id','model/admission/QuickAdmissionController.php');