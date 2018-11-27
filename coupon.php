<!--
    *   HTML FILE INFO
	*	Application: final 173 ecommerce project
	*	Description: code for the prototype
	*	File Name: coupon.php
	*	Author: Norman McWilliams Tester:
	*	Date created: 11-24-2018 Date updated: 11-24-2018
	*	Time created: 05:21 pm Time updated: 05:21 pm
	*	Revisions: 2.0
	*	Copyright: ( c )2018 Norlab Business Solutions
	*
-->
nlm TODO need to analyze this file to see how it works
<?php
include 'connect.php';
$coupon = $_GET['coupon'];
try {
    $sql = "select amount,gifttype from $coupons where active = '1' and dateeffect < now() and dateexpire > now() and code = '$coupon'";



$sth = $dbh->prepare("select amount,gifttype from $coupons where active = '1' and dateeffect < now() and dateexpire > now() and code = '$coupon'");
$sth->execute();

$row = $sth->fetchAll();
$amount = $row[0]['amount'];
$gifttype = $row[0]['gifttype'];
if ($gifttype == 'money')
   {
echo 'amount-'.$amount;	   
   }
if ($gifttype == 'percent')
   {
echo 'percent-'.$amount;	   
   }
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>

