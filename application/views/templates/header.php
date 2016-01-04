<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('img/favicon.ico'); ?>">

    <title><?php echo $title; ?></title>

    <link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet"><!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('css/jasny-bootstrap.min.css'); ?>" rel="stylesheet"><!--Jasny Bootstrap Core CSS -->
    <link href="<?php echo base_url('css/metisMenu.min.css'); ?>" rel="stylesheet"><!-- MetisMenu CSS -->
    <link href="<?php echo base_url('css/demo-2.css'); ?>" rel="stylesheet"><!-- Custom CSS -->
    <link href="<?php echo base_url('css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"><!-- Custom Fonts -->
    <link href="<?php echo base_url('css/amaran.min.css'); ?>" rel="stylesheet"><!-- Amaran -->
    <link href="<?php echo base_url('css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet"><!-- dataTables -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Kiet -->
    <link href="<?php echo base_url();?>css/jquery-ui.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <link href="<?php echo base_url('css/bootstrap-select.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('css/fullcalendar.css'); ?>" rel="stylesheet" type="text/css">
    
    <?php date_default_timezone_set("Asia/Ho_Chi_Minh"); 
    echo '<input type="hidden" id="base_url" value="'.base_url().'" />';
   
        if(isset($_SESSION['name_user'])){
            echo '<input type="hidden" id="name_user" value="'.$_SESSION['name_user'].'" />';
            echo '<input type="hidden" id="id_user" value="'.$_SESSION['id'].'" />';
       
        }
        
            ?>
</head>
<body>

<div id="wrapper">
