<?php 

any('/Transport/ManageBus','views/transport/ManageBus.php');
any('/Transport/BusController/$action/$busid','model/transport/BusController.php');


#Transport Routes 
any('/Transport/ManageRoute','views/transport/ManageRoute.php');
any('/Transport/RouteController/$action/$routeid','model/transport/RouteController.php');


#Transport Stage Routes
any('/Transport/ManageStages','views/transport/ManageStages.php');
any('/Transport/StageController/$action/$stageid','model/transport/StageController.php');


#Transpoprt Enrollment 
any('/Transport/ManageEnrollment','views/transport/ManageEnrollment.php');
any('/Transport/EnrollmentController/$action/$enrollid','model/transport/EnrollmentController.php');