<?php
/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 15:08
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo xss_clean($title) ?> - Portfolio - CPLN</title>
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>img/apple-touch-icon.png">
        <link rel="icon" href="<?php echo base_url(); ?>img/favicon.ico" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/normalize.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/vis.min.css">
        <script src="<?php echo base_url(); ?>js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/vis.min.js"></script>
    </head>
    <body>
