<?php
/**
 * Conncts to secure_login DB
 * 
 * */
include_once 'psl-config.php';
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
?>