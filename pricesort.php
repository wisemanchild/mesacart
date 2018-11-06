<?
ob_start();
require 'connect.php';
include 'pricefilter.php';
$qty = $_POST['qty'];
if ($qty > 0)
    {
$options = $_POST['options'];
$itemid = $_POST['itemid'];
if ($itemid)
    {
		
$check = $dbh->prepare("select count(id) from $cartitems where cartitems = ? and sessid = ?"); 
$check->execute(array($itemid,$sessid));
$num = $check->fetchColumn();
if ($num > 0)
     {
$upsql = $dbh->prepare("update $cartitems set qty = qty + ? where cartitems = ? and sessid = ?");	
$upsql->execute(array($qty,$itemid,$sessid));	 
	 }
else
     {	 
$upsql=$dbh->prepare("insert into $cartitems (cartitems,attribute,qty,sessid,timeofentry) values	('$itemid','$options','$qty','$sessid',now())");
$time =   date('Y-m-d H:i:s');  
$upsql->execute(array($itemid,$options,$qty,$sessid,$time));
     }
	}
$string = $_SERVER['QUERY_STRING'];	
header ("Location: products.php?".$string);	
}	 
$catid = $_GET['catid'];
$catsql = $dbh->prepare("select name from $category where id = ?");
$catsql->bindValue(1,$catid);
$catsql->execute();
$catrow = $catsql->fetchObject();
$catname = $catrow->name;
$min = $_GET['min'];
$max = $_GET['max'];
echo 'Searching for products between $'.money_format('%i',$min).' and $'.money_format('%i',$max).'<br/>';
$sql = $dbh->prepare("select cound(id) from $products where price between ? and ?");
$sql->execute(array($min,$max));
$numresults  = 0;
while ($numrows = $sql->fetch()){
$numresults++;
}

echo '<a href = "'.$root.'"index.php">Home</a> > Price Sorting'; 
?>

<br/>
<br/>
<br/>
<br/>
<?
$numperpage = '2';
$page = $_GET['page'];
if (!$page) $page = 0;
$numlinks = ceil($numresults/$numperpage);
$start = $page * $numperpage;
$pagesql = "select * from $products where price between $min and $max limit $start,$numperpage";

foreach ($dbh->query($pagesql) as $row)
   {
  $id = $row['0']; 
  $opt = $dbh->prepare("select options from $attributes where  prodid = '$id'");
    $opt->execute();
    $innerrow = $opt->fetchObject();
    $options = $innerrow->options;
    $atribarray = explode(",",$options);

  $name = $row['1'];
 $desc = $row['2'];
 $link = $row['6'];
 if ($link == "") $link = "product.php?pid=".$id; 
 $descarray = explode(".",$desc);
 $numsentences = count($descarray);
 $catname = trim($catname);
 for ($i = 0;$i < 2;$i++)
     {
	$desc .= $descarray[$i].". ";	 
	 }
 $desc .= "  <a href = \"".$link."\">Read More</a>";
 $price = $row['3']; 
   $img = "$id.jpg";
  echo "$name<br/>
  $desc<br/><img src = \"./thumbnail.php?pic=$img.1.jpg&ht=150&wd=150\"><br/>\$$price";  
  $desc = '';
  ?>
<form action = "<?= 'product.php?pid='.$id;?>" method="post">
  <input type="hidden" name = "itemid" value = "<?= $id;?>" />
  <?
if (count($atribarray)>1)
   {
echo "<select name = \"options\">";   
   for ($x=0;$x<count($atribarray);$x++)
     {
 echo "<option value = \"$atribarray[$x]\">$atribarray[$x]</option>";
	 }   
echo "</select>";    
   }
?>
  <br/>
  Quantity
  <input type = "text" name = "qty" size="2" />
  <input type = "submit" value = "add to cart" />
</form>
<br/>
<? 
   }
$y = $page - 1;
if ($page > 0) $url .= '<a href = "'.$root.'"pricesort.php?min='.$min.'&max='.$max.'&page='.$y.'">Previous</a>   ';   
  for ($i=1;$i<=$numlinks;$i++)
     {
$x = $i -1;		
$y = $x - 1; 
if ($page == $x) $url .= $i.'   ';
else
$url .= '<a href = "'.$root.'pricesort.php?min='.$min.'&max='.$max.'&page='.$x.'">'.$i.'</a>   '; 
	 }
$z = $page + 1;
if ($page < $numlinks - 1) $url .= '<a href = "'.$root.'pricesort.php?min='.$min.'&max='.$max.'&page='.$z.'">Next</a>   '; 
 if ($numlinks > 1) echo $url; 
 $dbh = null;
?>
<br/>
<br />
<a href = "<?= $root;?>viewcart.php">View your cart</a>
</body></html>