<?php
//error_reporting(E_ALL);mesacart_remote;
session_start();

$sessid = session_id();

/*
Please fill out your database info and your root address in url terms ie: http://mm214.com/mescart
*/
$hostname = 'localhost';
//$username = 'oewuxpad9gs7';
//$password = 'Tree12Light#';
$username = 'mesacart';
$password = 'mesacart123#';

$dbh = new PDO("mysql:host=$hostname;dbname=mesacart", $username, $password);
$prefix = 'mc_';
$buyers = 'mc_buyers';
$cartitems = 'mc_cartitems';
$category = 'mc_category';
$ecadmin = 'mc_ecadmin';
$inv = 'mc_inv';
$orders = 'mc_orders';
$products = 'mc_products';
$spec = 'mc_spec';
$zipcodes = 'mc_zipcodes';
$attributes= 'mc_attributes';
$maincategory = 'mc_maincategory';
$coupons = 'mc_coupons';
$rating = 'mc_ratings';
$root = '';

?>