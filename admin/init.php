<?php

include 'connect.php';


 /// Router

$tpl = 'includes/templates/'; // Templete Directory
$jsFileAdmin = 'layout/js/';
$cssFileAdmin = 'layout/css/';
$lang = 'includes/languages/';
$func = 'includes/functions/';

include $func . 'functions.php';
include $lang . 'english.php';
include $tpl . "header.php";


// Include Navbar on all pages
if(!isset($nonavbar)){
    include $tpl . 'navbar.php';
}


?>