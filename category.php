<?
<!--/*
* HTML FILE INFO
*    Application:final 173 ecommerce project
*   Description: code for the prototype
*     File Name: category.php
*        Author: Norman McWilliams     Tester:
*  Date created: 10-28-2019            Date updated: 10-28-2019
*  Time created: 12:38pm          Time updated: 12:38pm
*     Revisions: 1.0
*     Copyright: (c) 2018 Norlab Business Solutions
*   some code is from mesacart, bootstrap,
* */-->
echo '<head>

echo '<style>
    #desc {
    color: green;
    }
</style>';

require 'connect.php';

$string = $_SERVER['QUERY_STRING'];
$qty = $_POST['qty'];
if ($qty > 0)
    {
$options = $_POST['options'];
$itemid = $_POST['itemid'];
for ($h=1;$h<=$numoptions;$h++)
   {
$options .= $_POST['option'.$h].',';
   }
$options = substr($options,0,strlen($options)-1);
if ($itemid)
    {
$row = $dbh->prepare("select count(*) from $cartitems where sessid = ? and cartitems = ? and attribute = ?");  
$row->bindValue(1,$sessid);
$row->bindValue(2,$itemid);
$row->bindValue(3,$options);

$row->execute();
$num = $row->fetchColumn();

if ($num > 0)
    {
$sth = $dbh->prepare("update $cartitems set qty = qty + ?,attribute = ?  where cartitems = ? and sessid = ?");
$sth->execute(array($qty,$options,$itemid,$sessid));
    }
else
    {	 
$sth=$dbh->prepare("insert into $cartitems (cartitems,attribute,qty,sessid,timeofentry) values	(?,?,?,?,?)");
$time =   date('Y-m-d H:i:s');  
$sth->execute(array($itemid,$options,$qty,$sessid,$time));
    }
 }
}	 

//numcart anywhere
if (!$sth) //echo $dbh->errorInfo();
$catid = $_GET['catid'];
$sth = $dbh->prepare("select name from $category where id = '$catid'");
$sth->execute();
$catrow = $sth->fetchObject();
$catname = $catrow->name;

echo '<a href = "'.$root.'"index.php">Home</a> >'.$catname; 
?>

<br/>
<br/>
<a href ="category.php?catid=<?= $catid;?>&sort=pricelow">Sort by Price (Low to High)</a><br/>
<a href ="category.php?catid=<?= $catid;?>&sort=pricehigh">Sort by Price (High to Low)</a><br/>
<a href ="category.php?catid=<?= $catid;?>&sort=name">Sort by Name</a><br/>
<br/>
<br/>
<?
$checknum= $dbh->prepare("select * from $products where catid = ?");
$checknum->bindValue(1,$catid);
$checknum->execute();
$numresults=0;
while ($checkrow = $checknum->fetch()){
	$numresults++;
}
$numperpage = '3';
$page = $_GET['page'];
if (!$page) $page = 0;
$numlinks = ceil($numresults/$numperpage);
$start = $page * $numperpage;
$sort = $_GET['sort'];
if ($sort) {
if ($sort == 'pricelow'){
	$dynamicqry = ' order by price asc ';
                                      }
  if ($sort == 'pricehigh'){
	$dynamicqry = ' order by price desc ';
                        }
	  if ($sort == 'name'){
	$dynamicqry = ' order by name asc ';
                        }					
}

$innersql = "select * from $products where catid = '$catid'  $dynamicqry limit  $start,$numperpage";

echo "<br/>select * from $products where catid = '$catid'  $dynamicqry limit  $start,$numperpage<br/>";
  foreach ($dbh->query($innersql) as $row)
     {
	$id = $row['0'];
    $opt = $dbh->prepare("select options from $attributes where  prodid = '$id'");
    $opt->execute();
    $innerrow = $opt->fetchObject();
    $options = $innerrow->options;
$atribarray = explode(",",$options);
$name = $row[1];
$desc = $row[2];
$link = $row[6];
if ($link == "") $link = "product.php?pid=".$id; 
$descarray = explode(".",$desc);
$numsentences = count($descarray);
$catname = trim($catname);
for ($i = 0;$i<$numsentences-1;$i++)
    {
	$descrip .= $descarray[$i].". ";
    }
 $descrip .= '  <a href = "'.$link.'"><h1>Reads More</h1></a>';
$price = $row[3]; 
$img = $id.'/1.jpg';
echo $name.'<br/><h1 id="desc">'.$descrip.'<br/></h1>';
if (file_exists($img))
  {
$size = getimagesize($img);
$height = $size[1];
$width = $size[0];
echo '<span id="image"><a href = "#" onclick="window.open(\''.$img.'\',\'\',\'height='.$height.',width='.$width.'\');"><img src = "./thumbnail.php?pic='.$img.'&ht=100&wd=100"></a></span>';
  }
echo '<br/><span id="price">$'.$price . '</span>';
  $desc = '';
  ?>
<form action = "category.php?catid=<?= $catid;?>" method="post">
  <input type="hidden" name = "itemid" value = "<?= $id;?>" />
  <?
if (count($atribarray)>1)
   {
echo '<select name = "options">';   
   for ($x=0;$x<count($atribarray);$x++)
     {
 echo '<option value = "'.$atribarray[$x].'">'.$atribarray[$x].'</option>';
	 }   
echo '</select>';    
   }
?>
  <br/>
  Quantity
  <input type = "text" name = "qty" size="2" />
  <input type = "submit" value = "add to cart" />
</form>
<br/>
<? 
  unset($descrip);
   }
$y = $page - 1;
if ($page > 0) $url .= '<a href = "'.$root.'"category.php?page='.$y.'&catid='.$catid.'">Previous</a>   ';   
  for ($i=1;$i<=$numlinks;$i++)
     {
$x = $i -1;		
$y = $x - 1; 
if ($page == $x) $url .= $i.'   ';
else
$url .= '<a href = "'.$root.'category.php?page='.$x.'&catid='.$catid.'">'.$i.'</a>   '; 
	 }
$z = $page + 1;
if ($page < $numlinks - 1) $url .= '<a href = "'.$root.'category.php?page='.$z.'&catid='.$catid.'">Next</a>   '; 
echo $url; 
 $dbh = null;
?>
<br/>
<br />
<a href = "<?= $root;?>viewcart.php">View your cart</a> 