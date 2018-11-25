<!--
    *   HTML FILE INFO
	*	Application: final 173 ecommerce project
	*	Description: code for the prototype
	*	File Name: connect.php
	*	Author: Norman McWilliams Tester:
	*	Date created: 11-24-2018 Date updated: 11-24-2018
	*	Time created: 05:21 pm Time updated: 05:21 pm
	*	Revisions: 2.0
	*	Copyright: ( c )2018 Norlab Business Solutions
	*
-->
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