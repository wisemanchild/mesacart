<?php
ob_start();
require 'connect.php';

?>

<form action = "searchres.php" method = "post">
  Search:
  <input type = "text" name = "query" />
  <br/>
  <input type = "submit" name = "submit" value = "Search!" />
</form>
<?
		

//include 'numcart.php';


       $sql = "select id, name from $maincategory";
      foreach ($dbh->query($sql) as $mainrow)
    {
$id = $mainrow[0];
$name = $mainrow[1];
echo '<h5>'.$name.'</h5>';
   
$innersql = "select $category.id,$category.name,count($products.id) from $category,$products WHERE $category.id=$products.catid  and $category.maincatid = '$id' group by $category.id order by $category.name asc";
  foreach ($dbh->query($innersql) as $row)
		{
	$catid = $row[0];
	$catname = $row[1];
	$prodCount = $row[2];
   echo '<a href = "'.$root.'category.php?catid='.$catid.'"> '.$catname.'</a>('.$prodCount.')<br/>';
		}
	}
	
// include 'pricefilter.php';
?>
<a href = "slider/slider.php">Check out our price slider</a><br/>
<a href = "viewcart.php">View your cart</a>
<?
$secondsql = "select $products.id,$products.name,$products.descrip,$products.price,$category.id,$category.name 
from $spec,$products,$category where $products.id = $spec.prodid and $products.catid = $category.id and $spec.spec = 'yes'";
?>
<div id = "products">
<?

  $stm = $dbh->prepare($secondsql);
   $stm->execute();



  foreach ($stm->fetchAll() as $secondrow)
  {
echo '<span class="product">';
$img = $secondrow[0].'/1.jpg';
$name = $secondrow[1];
$desc = $secondrow[2];
$price = $secondrow[3];
$catid = $secondrow[4];
$catname = $secondrow[5]; 
echo '<img src = "'.$root.'thumbnail.php?pic='.$img.'&ht=150&wd=150" alt="'.$name.'">';
echo $name.'<br/>'.$desc.'<br/>'.$price.'<br/><a href = "'.$root.'category.php?catid='.$catid.'">View All Products from this Category</a>';
   echo '</span><br/><br/><br/>';
  }
      $dbh = null;

?>
