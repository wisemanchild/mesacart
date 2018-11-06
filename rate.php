<?
include 'connect.php';
$pass = $_POST['pass'];
$orderid = $_POST['prodid'];
$comments = $_POST['comments'];
$score = $_POST['scale'];

/*
to be redone
$checksql = mysql_query("select $rating.orderid from
$rating,$orders	
where $rating.orderid = $orders.orderid
and $orders.password = '$pass'");
if (mysql_num_rows($checksql) > 1)
  {
echo "Sorry, you've already voted";  
exit;
  }
mysql_query("insert into $rating (orderid,rating) values ('$orderid','$score')");
echo "thank you for voting";
*/
?>