<?php

// Error Reporting

ini_set('display_errors', 'On');
error_reporting(E_ALL);
date_default_timezone_set('Africa/Cairo');

include 'admin/connect.php';

$sessionUser = '';

if (isset($_SESSION['user'])) {
    $sessionUser = $_SESSION['user'];
}

// Routes

$tpl 	= 'includes/templates/'; // Template Directory
// $lang 	= 'includes/lang/'; // Language Directory
$func	= 'includes/functions/'; // Functions Directory
$css 	= 'assets/css/'; // Css Directory
$js 	= 'assets/js/'; // Js Directory

// Include The Important Files

include $func . 'functions.php';
// include $lang . 'en.php';


