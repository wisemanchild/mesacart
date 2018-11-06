<?php
require '../connect.php';
$minValue = $_GET['minValue'];
$maxValue = $_GET['maxValue'];
if($minValue!=''&&$maxValue!='') {
$innersql = "select * from $products where price >= $minValue and price <= $maxValue ";
  foreach ($dbh->query($innersql) as $row)
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
for ($i = 0;$i<$numsentences-1;$i++)
    {
	$descrip .= $descarray[$i].". ";	 
    }
 $descrip .= "  <a href = \"".$link."\">Read More</a>";
$price = $row['3']; 
$img = $id.'/1.jpg';
echo $name.'<br/>'.$descrip.'<br/>';
if (file_exists('../'.$img))
  {
$size = getimagesize('../'.$img);
$height = $size[1];
$width = $size[0];
echo '<a href = "#" onclick="window.open(\'../'.$img.'\',\'\',\'height='.$height.',width='.$width.'\');"><img src = "../thumbnail.php?pic='.$img.'&ht=100&wd=100"></a>';
  }
echo '<br/>$'.$price;  
  $desc = '';
  ?>
<form action = "<category.php?pid=<?= $id;?>" method="post">
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
</form><br/>  
  <? 
   }
 $dbh = null;
}
?>