<!--nlm TODO need to analyze this file to see how it works-->
<?
session_start();
include 'connect.php';
mysql_connect("localhost","mmaaaco_ksecor","hamilton");
mysql_select_db("mmaaaco_ksecor");
/*CREATE TABLE IF NOT EXISTS `searchHits` (
  `unique_ip` varchar(15) NOT NULL,
  `prodId` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
*/
?>
<style type="text/css">
</style>
	<div id="results">

<?
/*

CREATE TABLE IF NOT EXISTS `searchHits` (
  `unique_ip` varchar(15) NOT NULL,
  `prodId` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
*/
include ('connect.php');
if($_GET['qry'] != '')
{
$qry = $_GET['qry'];
$_SESSION['qry'] = $qry;
if ($qry != ' ' || $qry != '')
   {
$sql = mysql_query("select $category.id, $category.name, $products.id, 
$products.name, $products.descrip from $category, $products
where ($category.name like '%$query%' or $products.name like '%$query%' or
$products.descrip like '%$query%') and $category.id = $products.catid limit 10");
$msg = "Search for ".$qry;
   }


while ($row = mysql_fetch_array($sql))
   {
$id = $row[0];	  
$hitSQL = mysql_query("select prodId from 3321_searchHits where prodId='$id'");
$numHits = mysql_num_rows($hitSQL);
$name = $row[1];	
echo '<p onclick="populate(this)"><input type="hidden" value="'.$id.'" /><label class="hits">'.$numHits.' Hits</label><label class="result">'.$name.'</label></p>';
   }
     echo '<p onclick="populate(this)"><input type="hidden" value="all" /><label class="result">'.$msg.'</label></p>'; 
 ?>  
</div>
<? 
}	
else if(isset($_GET['uip']))
{
		$ipToAdd = $_GET['uip'];
		if(isset($_GET['i']))
		{
		$item = $_GET['i'];
/*
$ipChecksql = mysql_query("select unique_ip,prodId from 3321_searchHits where unique_ip ='$ipToAdd' and prodId='$item' and query = '$qry'");
		
		if(mysql_num_rows($ipChecksql) < 1) */
		
		$qry = $_SESSION['qry'];
$sql = mysql_query("insert into 3321_searchHits (unique_ip, prodId,keyword) values ('$ipToAdd','$item','$qry')");

		}
	
}
?>

