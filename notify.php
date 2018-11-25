<!--
    *   HTML FILE INFO
	*	Application: final 173 ecommerce project
	*	Description: code for the prototype
	*	File Name: notify.php
	*	Author: Norman McWilliams Tester:
	*	Date created: 11-24-2018 Date updated: 11-24-2018
	*	Time created: 05:21 pm Time updated: 05:21 pm
	*	Revisions: 2.0
	*	Copyright: ( c )2018 Norlab Business Solutions
	*
-->
<?php
include 'connect.php';
$db = $dbh ->prepare("delete from $cartitems where sessid = '$sessid'");
$db->execute();
foreach ($_POST as $key=> $value)
     {
$content .= $key." ".$value."<br/>";	 
	 }
mail("wisemanchild@outlook.com","PaypalVars",$content,"Content:text/html");
//update buyers 
$fullname = $_POST['first_name']." ".$_POST['last_name'];
$address = $_POST['address_street'];
$city = $_POST['address_city'];
$state = $_POST['address_state'];
$zip = $_POST['address_zip'];
$email = $_POST['payer_email'];
$sql = $dbh->prepare("insert into $buyers (fullname,address,city,state,zip,email) values (?,?,?,?,?,?)");
$sql->execute(array($fullname,$address,$city,$state,$zip,$email));
$id = $dbh->prepare("select id from $buyers order by id desc limit 1");
$id->execute();
$val = $id->fetchObject();
$lastid = $val->id;
/*
$lastid = $dbh->lastInsertId($sql);
*/
$num_cart_items = $_POST['num_cart_items'];
for ($i=1;$i<=$num_cart_items;$i++)
    {
$password = base64_encode($email);		
$prodid = $_POST['item_number'.$i];
$qty = $_POST['quantity'.$i];
$mc_gross = $_POST['mc_gross_'.$i];
$itemnumber = $_POST['item_number'.$i];
$qty = $_POST['quantity'.$i];
$option = $_POST['option_name'.$i];
$option_selection = $_POST['option_selection2_'.$i];
$statement = $dbh->prepare("insert into $orders (prodid,qty,options,cost,buyerid,datepurchased,password) values (?,?,?,?,?,now(),?)");
$content = "insert into $orders (prodid,qty,options,cost,buyerid,datepurchased,password) values ($prodid,$qty,$options,$mc_gross,$lastid,now(),$password)";


$statement->execute(array($prodid,$qty,$options,$mc_gross,$lastid,$password));

$content .= $statement->errorInfo();

mail ('kdsecor@gmail.com','Test',$content);
$invsql = $dbh->prepare("update $inv set qty = qty - ? where prodid = ?"); 

$dbh->execute($qty,$itemnumber); 
	}
//update orders
$dbh=null;

?>
