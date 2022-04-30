<?php 
get('/Expense/Manage/Ho','views/expense/newHo.php');
any('/Expense/HoController/$action/$hoid','model/expense/ho.php');

get('/Expense/Manage/Payee','views/expense/newPayee.php');
any('/Expense/PayeeController/$action/$payeeid','model/expense/payee.php');


any('/Expense/Manage','views/expense/manageExpense.php');
any('/Expense/ExpenseController/$action/$expenseid','model/expense/expense.php');
get('/Expense/PrintVocher/$expenseid','views/expense/printVocher.php');
