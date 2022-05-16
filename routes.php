<?php
/**
 * Main Router File.
 */
require_once "{$_SERVER['DOCUMENT_ROOT']}/router.php";
/**
 * Api Routes
 */
require_once "{$_SERVER['DOCUMENT_ROOT']}/routes/Api.php";
/*
Dashboard Routes
*/
get('/Dashboard', 'views/dashboard.php');
/*
Login Routes
*/
require_once "{$_SERVER['DOCUMENT_ROOT']}/routes/Auth.php";

/**
 * Admission.
 */
require_once "{$_SERVER['DOCUMENT_ROOT']}/routes/Admission.php";
/*
 * Fee Transactions
 */
require_once  "{$_SERVER['DOCUMENT_ROOT']}/routes/FeeTransactions.php";
/**
 * Expense.
 */
require_once "{$_SERVER['DOCUMENT_ROOT']}/routes/Expense.php";

/**
 * Attendance.
 */
require_once "{$_SERVER['DOCUMENT_ROOT']}/routes/Attendance.php";
/**
 * General Billing
 */
require_once "{$_SERVER['DOCUMENT_ROOT']}/routes/GeneralBilling.php";

/**
 *  Transportaation
 */
require_once "{$_SERVER['DOCUMENT_ROOT']}/routes/Transport.php";

/**
 * User Management
 */
require_once "{$_SERVER['DOCUMENT_ROOT']}/routes/Users.php";














/*
Error Routes
*/
any('/404', 'views/error/404.php');
