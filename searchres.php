<?
include 'connect.php';
$query = $_POST['query'];
if ($query)
   {
$sql=$dbh->prepare("select count($category.id) from $category, $products
where ($category.name like '%$query%' or $products.name like '%$query%' or
$products.descrip like '%$query%') and $category.id = $products.catid group by $category.id");
$sql->execute();
$num = 0;
while ($sqlrow = $sql->fetch()){
	$num++;
}
echo 'Your search for '.$query.' generated '.$num.' result(s)';

if ($num>0)
{
$newsql = $dbh->prepare("select $category.id, $category.name, $products.id, 
$products.name, $products.descrip from $category, $products
where ($category.name like '%$query%' or $products.name like '%$query%' or $products.descrip like '%$query%') and $category.id = $products.catid");
$newsql->execute();
while ($row = $newsql->fetch())
     {
$id = $row[0];
$catname = $row[1];
$prodid = $row[2];
$name = $row[3];
$proddesc = $row[4];
$descarr = explode(".",$proddesc);
$desc = $descarr[0].' <a href = "product.php?pid='.$prodid.'">Read More</a>';
echo $name.'<br/>'.$desc.'<br/><br/>';
	 }   
   }
 }
   $dbh=null;
?>
<form action = "searchres.php" method = "post">
Search: <input type = "text" name = "query" /><br/>
<input type = "submit" name = "submit" value = "Search!" />
</form>
