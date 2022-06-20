<?php 

get('/FeeStructure/new','views/fee/AddNewFee.php');
get('/FeeStructure/Manage','views/fee/ManageFee.php');

any('/FeeStructureController/$action/$token_id','model/fee/FeeStructureController.php');

get('/Transaction/New','views/fee/AddNewTransaction.php');
post('/Transaction/Init/$token','views/fee/InitTransaction.php');
post('/Transaction/Save/$token','model/fee/SaveTransaction.php');
get('/Transaction/Print/$transaction','views/fee/bill.php');
get('/Transaction/Manage','views/fee/manage_transaction.php');
any('/Transaction/Delete','views/fee/DeleteTransaction.php');
any('/DeleteFeeTransaction/$token_id','model/fee/DeleteTransaction.php');

any('/Transaction/Reports','views/fee/Reports.php');
any('/Transaction/Statement','views/fee/Statement.php');
post('/Transaction/Statement/Print','views/fee/PrintStatement.php');
any('/Transaction/Statement/Class','views/fee/ClassStatement.php');
post('/Transaction/Statement/Class/print','views/fee/PrintClassStatement.php');
any('/Transaction/DueList','views/fee/DueList.php');


get('/Transaction/UnifiedPrint/$transaction','views/fee/UnifiedPrint.php');


any('/Transaction/StudentFeeUpdate/$token','views/fee/StudentFeeUpdate.php');

post('/Transaction/StudentFeeUpdate/Save/$token','model/fee/StudentFeeUpdate.php');