<?
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

