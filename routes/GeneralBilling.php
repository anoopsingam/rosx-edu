<?php 

any('/GeneralInvoices/ManageParticular', 'views/GeneralInvoices/Manage.php');
any('/GeneralInvoices/ParticularsController/$action/$parid','model/generalinvoices/particulars.php');

any('/GeneralInvoice/new', 'views/GeneralInvoices/new.php');
any('/GeneralInvoice/Controller/$action/$invid','model/generalinvoices/invoicesController.php');
get('/GeneralInvoice/View/$invid','views/GeneralInvoices/invoices.php');
get('/GeneralInvoice/Edit/$invid','views/GeneralInvoices/edit.php');
any('/GeneralInvoice/Reports','views/GeneralInvoices/reports.php');
