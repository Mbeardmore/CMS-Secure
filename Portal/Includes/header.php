<?php session_start();
ob_start();
date_default_timezone_set('Europe/London');
if(isset($_SESSION['u_name']) && $_SERVER['SERVER_ADDR']) {} else {header("Location: ../../index.php"); die(); }
$settings = parse_ini_file('Includes/company_config.ini', true);
include "db.php";
include "functions.php";
include "classes.php";
?>
<html>
<head>
        <!-- Copyright © 2016-2017 Martin. All Rights Reserved. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="../js/jquery-3.1.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <!-- Calender -->
    <link href="../css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="../css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>
    <!-- datatables -->
    <link href="../css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
    <link href="../css/plugins/blueimp/css/blueimp-gallery.css" rel="stylesheet">
    <link href="../css/plugins/blueimp/css/blueimp-gallery-indicator.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/jquery.steps.css">
    <script src="../js/plugins/steps/jquery.steps.min.js"></script>
    <script src="../js/numeric-1.2.6.min.js"></script>
</head>
<body>
