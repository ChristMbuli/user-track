<?php
$url = "";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
}

if ($url === '') {
    require './action.php';

} else {
    require "./404.php";
}