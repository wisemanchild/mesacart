<?
include 'connect.php';
$query = $_GET['query'];
$sql = "select name from cart_products where name like '%$query%'";
?>
<select name = "suggest" id = "sugwords" multiple="multiple"> 
<?
foreach ($dbh->query($sql) as $row)
  {
?>	  
<option value = "<?= $row[0];?>"><?= $row[0];?></option>
<?
  }
  $dbh=null;

?>
</select>

<style>
	#sugwords option:hover
	{
	background-color:#316ac5;
	color:white;
	}
</style>
