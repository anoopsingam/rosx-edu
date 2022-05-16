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


#Transport Billing 
any('/Transport/Billing/new','views/transport/Billing.php');
any('/Transport/Billing/Init/$token_id','views/transport/InitBilling.php');
any('/Transport/Billing/Save/$token_id','model/transport/SaveBilling.php');
any('/Transport/Billing/Reports','views/transport/Reports.php');

get('/Transport/Print/$tansport_t','views/transport/Bill.php');

any('/Transport/Billing/BillPrintMain','views/transport/PrintMain.php');
any('/Transport/Billing/BillPrint','views/transport/BillPrint.php');


any('/Transport/Billing/DeleteTransaction','views/transport/DeleteTransaction.php');
