<?php 

get('/Admission/new','views/admission/FullAdmission.php');
any('/Admission/Manage','views/admission/manage.php');
get('/Admission/View/$ern','views/admission/ViewAdmission.php');
get('/Admission/Edit/$ern','views/admission/EditAdmission.php');
get('/Admission/Delete/$ern','views/admission/DeleteAdmission.php');

get('/Admission/QuickAdmission','views/admission/QuickAdmission.php');
any('/QuickAdmissionController/$action/$student_id','model/admission/QuickAdmissionController.php');
any('/FullAdmissionController/$action/$student_id','model/admission/FullAdmissionController.php');



get('/Admission/StudentsList/$class','views/admission/StudentsList.php');