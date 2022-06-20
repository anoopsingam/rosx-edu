<?php 

get('/Academics/ManageSubjects','views/academics/manage_subjects.php');
any('/Academics/SubjectsController/$action/$acd_id','model/academics/SubjectsController.php');


get('/Academics/ManageTests','views/academics/manage_tests.php');






#Marks entry Routes
get('/Academics/MarksEntryMain','views/academics/marks_entry_main.php');
any('/Academics/ViewList','views/academics/marks_entry_list.php');
any('/Academics/MarksEntry/$student_id/$test_name/$ay','views/academics/entry_page.php');
any('/Academics/SubmitMarks/$action','model/academics/MarksEntryController.php');
any('/Academics/ResultSheet','views/academics/result_sheet.php');
any('/Academics/ViewResult/$student_id/$test_name/$ay','views/academics/view_result.php');
