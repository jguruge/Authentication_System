<?php
   include_once('header.php');
   ob_start();
   session_start();
   unset($_SESSION['user']); 
   header('location:login.php?');
   exit;

?>