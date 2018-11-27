<!--
    *   HTML FILE INFO
	*	Application: final 173 ecommerce project
	*	Description: display items in cart
	*	File Name: numcart.php
	*	Author: Norman McWilliams Tester:
	*	Date created: 11-24-2018 Date updated: 11-24-2018
	*	Time created: 05:21 pm Time updated: 05:21 pm
	*	Revisions: 2.0
	*	Copyright: ( c )2018 Norlab Business Solutions
	*
-->
<!--nlm TODO need to analyze this file to see how it works-->
<?php
$row = $dbh->prepare("select count(id) from $cartitems where sessid = ?");  
$row->bindValue(1,$sessid);
$row->execute();
$num = $row->fetchColumn();
echo '<a href = "viewcart.php">cart('.$num.')</a><br/>';
?>