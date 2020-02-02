<?php
session_start();

//require_once 'php_action/nucleo.php';

// deseta todas a variveis
session_unset();

session_destroy();

header('location: index.php');

?>
