<?
include 'connect.php';
$zip = $_GET['zip'];
$zipsql = $dbh->prepare("select state,city from $zipcodes where zipcode = '$zip'");
$zipsql->execute();
$ziprow=$zipsql->fetchObject();
$state = $ziprow->state;
$city = $ziprow->city;
echo "$state|$city";
$dbh=null;
?>