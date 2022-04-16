<?php
/**
 * Main Router File 
 */
require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

/* 
Dashboard Routes
*/
get('/Dashboard', 'views/dashboard.php');
/* 
Login Routes
*/
require_once("{$_SERVER['DOCUMENT_ROOT']}/routes/Auth.php");

/**
 * Admission
 */
require_once("{$_SERVER['DOCUMENT_ROOT']}/routes/Admission.php");

/* 
Error Routes
*/
any('/404','views/error/404.php');