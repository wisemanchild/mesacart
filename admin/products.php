<?
include '../connect.php';
include 'protect.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Products</title>
<link type="text/css" rel="stylesheet" href="css/framework.css" />
<link type="text/css" rel="stylesheet" href="css/style_coffee.css" />
</head>
<body>
<div id="container"> 
  <!-- Container begins here -->
  <div id="sidebar"> 
    <!-- Sidebar begins here -->
    <div class="header logo"> 
      <!-- Logo begins here --> 
    </div>
    <!-- END Logo -->
    <div id="navigation"> 
      <!-- Navigation begins here -->
      <div class="sidenav"> 
        <!-- Sidenav -->
        <div class="navhead_blank"><span><a href="index.php" title="">Home</a></span></div>
        <!-- Sidenav Headline --> 
        <!-- /Sidenav Box --> 
        <!-- /Sidenav Box --> 
      </div>
      <!-- /Sidenav --> 
    </div>
    <!-- END Navigation --> 
  </div>
  <!-- END Sidebar -->
  <div id="primary"> 
    <!-- Primary begins here -->
    <div class="navhead">
      <div class="header top_nav"> <span class="title"><a href="#" title="">Your Website</a></span> 
        <!-- Put your website name here --> 
        <span class="session" style="float:right;">Signed in as <a href="#" title="">Administrator</a> (<a href="logout.php" title="Sign out">Sign out</a>)</span> </div>
    </div>
    <div id="content"> 
      <!-- Content begins here -->
      
      <div class="box"> Editing Products for Category:
        <?= $catname;?>
        <br/>
        <?

$getcatid = $_GET['catid'];
$catsql = $dbh->prepare("select name from $category where id = '$catid'");
$catsql->execute();
$catrow = $catsql->fetchObject();
$catname = $catrow->name;
$script = $_SERVER['PHP_SELF'];
 $submit = $_POST['submit'];
 	$updateid = $_GET['updateid'];
	$deleteid = $_GET['deleteid'];
 if ($submit != '')
    { 
	$desc = addslashes($_POST['desc']);
	$name = addslashes($_POST['item']);
	$price = $_POST['price'];
	$catid = $_POST['itemcat'];
	$attribute = $_POST['attribute'];

	$idtoupdate = $_POST['idtoupdate'];
	$tmp = $_FILES['pic']['tmp_name'];
	$tmp2 = $_FILES['prodpic2']['tmp_name'];
	$tmp3 = $_FILES['prodpic3']['tmp_name'];
	$tmp4 = $_FILES['prodpic4']['tmp_name'];
	$tmp5 = $_FILES['prodpic5']['tmp_name'];
	$spectoupdate = $_POST['spec'];
	$qty = $_POST['qty'];
	$link = trim($_POST['link']);
	$weight = $_POST['weight'];
	}
	if ($deleteid) $dbh->exec("delete from $products where id = '$deleteid'"); 
	 
	if ($idtoupdate != "")
	    {
$sql = $dbh->exec("update $products set name = '$name',descrip = '$desc', price = '$price',link='$link',weight='$weight',catid = '$catid' where id = '$idtoupdate'");	

  if ($tmp) move_uploaded_file($tmp,"../".$idtoupdate."/1.jpg"); 	
if ($tmp2) move_uploaded_file($tmp2,"../".$idtoupdate."/2.jpg");
if ($tmp3) move_uploaded_file($tmp3,"../".$idtoupdate."/3.jpg");
if ($tmp4) move_uploaded_file($tmp4,"../".$idtoupdate."/4.jpg");
if ($tmp5) move_uploaded_file($tmp5,"../".$idtoupdate."/5.jpg");

$attsql = $dbh->exec("update $attributes set options = '$attribute' where prodid = '$idtoupdate'");
$invsql = $dbh->exec("update $inv set qty = '$qty' where prodid = '$idtoupdate'");
		}
if ($spectoupdate == 'yes')
            {
 $speccheck= $dbh->prepare("select id from $spec where prodid = '$idtoupdate'");   
$speccheck->execute();
$specrow = $speccheck->fetch();
 $specid = $specrow['id'];
		 
 if ($spectoupdate == 'no' || $specid != '' )
     {
 $specupsql = $dbh->exec("update $spec set spec = '$spectoupdate'
    ,timef=now() where prodid = '$idtoupdate'");	
	 }
	
if ($spectoupdate == 'yes' && $specid == '')
     {
 $specupsql = $dbh->exec("insert into $spec (prodid,times,spec)
 values ('$idtoupdate',now(),'yes')"); 	
 if (!$specupsql) echo mysql_error; 
	 }   	
			}


	
if ($submit == "Add Item" )
	     {
 $dbh->exec("insert into $products (name,descrip,price,link,weight,catid) values ('$name','$desc','$price','$link','$weight','$catid')");
     
	 $last = $dbh->prepare("select id from $products order by id desc limit 1");
  $last->execute();
  $lastitem = $last->fetchObject();
 $picid= $lastitem->id;
 $updateid = $picid;
  mkdir('../'.$picid);
   $invsql = $dbh->exec("insert into $inv (prodid,qty) values ('$picid','$qty')");
  $attsql = $dbh->exec("insert into $attributes (prodid,options) values ('$picid','$attribute')");
    if ($tmp) move_uploaded_file($tmp,"../".$updateid."/1.jpg"); 	
if ($tmp2) move_uploaded_file($tmp2,"../".$updateid."/2.jpg");
if ($tmp3) move_uploaded_file($tmp3,"../".$updateid."/3.jpg");
if ($tmp4) move_uploaded_file($tmp4,"../".$updateid."/4.jpg");
if ($tmp5) move_uploaded_file($tmp5,"../".$updateid."/5.jpg");
if ($_POST['spec'] == 'yes')
       {
$dbh->exec("insert into $spec (prodid,times,spec) values ('$picid', now(),'yes')") ; 	 	
       }
		 }
		 
if ($updateid != '')
    {
	$innersql = $dbh->prepare("select name, descrip, price,catid,weight,link from $products where id = '$updateid'");
	$innersql->execute();
	$innerrow = $innersql->fetchObject();
	$innername = $innerrow->name;
	$innerdesc = $innerrow->descrip;
	$innerprice = $innerrow->price;
	$upweight = $innerrow->weight;
	$uplink = $innerrow->link;
	$innercat = $innerrow->catid; 

    $qtysql = $dbh->prepare("select qty from $inv where prodid = '$updateid'"); 
    $qtysql->execute();
	$qtyrow = $qtysql->fetchObject();
	$upqty = $qtyrow->qty;
	
    $attsql = $dbh->prepare("select options from $attributes where prodid = '$updateid'");
    $attsql->execute();
	$thwattributes = $attsql->fetchObject();
	$att = $thwattributes->options;
		}
	
$content = "ErrorDocument 404 /index.php\n";
$content .= "Options +FollowSymLinks\n";
$content .= "RewriteEngine on\n";
$linksql = "select id,link from $products";
foreach ($dbh->query($linksql) as $linkrow )
    {
$id = $linkrow[0];
$link = trim($linkrow[1]);
  if ($link != "")
        {
trim($link);	
$link = str_replace(' ','',$link);
$content .= 'RewriteRule ^'.$link.'$ product.php?pid='.$id." [L]\n";
		}
	}
	
$fh = fopen("../.htaccess",w);
fwrite($fh,$content);
fclose($fh);
echo $dbh->errorInfo();
 		 		
?>
        Add an Item<br/>
        <?
	$query = 'updateid='.$updateid.'&catid='.$getcatid;
//	if ($updateid != '') $query .= '&updateid='.$updateid;
	
	 	
?>
        <form action = "products.php?<?= $query;?>" method = "post" enctype="multipart/form-data">
          <input type = "hidden" name = "idtoupdate" value = "<?= $updateid;?>" />
          Item:
          <input type = "text" name = "item" value = "<?= $innername;?>"/>
          <br/>
          Category:
          <select name = "itemcat">
            <option value = "">Select a Category</option>
            <?
$catsql = "select * from $category";
foreach ($dbh->query($catsql) as $catrow)
		{
	$catid = $catrow[0];
	$catname = $catrow[1];
	if ($catid == $innercat) 
	      {
   echo '<option value = "'.$catid.'" selected="selected">'.$catname.'</option>';
          }
	else  {
echo '<option value = "'.$catid.'">'.$catname.'</option>';	
	       }	  
		}
?>
          </select>
          <br/>
          Description:
          <textarea name = "desc"><?= $innerdesc;?>
</textarea>
          <br/>
          Price:
          <input type = "text" name = "price" value = "<?= $innerprice;?>" />
          <br/>
          <?
if (file_exists("../".$updateid."/1.jpg"))
    {
echo '<img src = "../thumbnail.php?pic='.$updateid.'/1.jpg">';
	}
?>
          Upload main picture(JPEG format only)
          <input type = "file" name = "pic" >
          <br/>
          <?
if (file_exists("../".$updateid."/2.jpg"))
    {
echo '<img src = "../thumbnail.php?pic='.$updateid.'/2.jpg">';
	}
?>
          Upload picture 2(JPEG format only)
          <input type = "file" name = "prodpic2" >
          <br/>
          <?
if (file_exists("../".$updateid."/3.jpg"))
    {
echo '<img src = "../thumbnail.php?pic='.$updateid.'/3.jpg">';
	}
?>
          Upload picture 3(JPEG format only)
          <input type = "file" name = "prodpic3" >
          <br/>
          <?
if (file_exists("../".$updateid."/4.jpg"))
    {
echo '<img src = "../thumbnail.php?pic='.$updateid.'/4.jpg">';
	}
?>
          Upload picture 4(JPEG format only)
          <input type = "file" name = "prodpic4" >
          <br/>
          <?
if (file_exists("../".$updateid."/5.jpg"))
    {
echo '<img src = "../thumbnail.php?pic='.$updateid.'/5.jpg">';
	}
?>
          Upload picture 5(JPEG format only)
          <input type = "file" name = "prodpic5" >
          <br/>
          <?
$specsql = $dbh->prepare("select spec from $spec where prodid = '$updateid'");
$specsql->execute();
$specrow= $specsql->fetchObject();
$spec = $specrow->spec; 
?>
   Attributes:(Create Each Attribute in the following format <br/>
 <textarea name = "attribute"><?= $att;?></textarea>
          <br/>
          Would you like to put this item on the homepage?
          Yes
          <input type = "radio" name = "spec" value = "yes" <? if ($spec == 'yes') echo "checked";?>  >
          No
          <input type = "radio" name = "spec" value = "no"  <? if ($spec == 'no') echo "checked";?>>
          <br/>
          Inventory:
          <input type = "text" name = "qty" size = "2" value = "<?= $upqty;?>"/>
          <br/>
          Weight:
          <input type = "text" size = "5" name = "weight" 
    value = "<?= $upweight;?>" />
          <br/>
          Link:
          <input type = "text" name = "link" value = "<?= $uplink;?>" />
          <br/>
          <input type = "submit" name = "submit" value = "<?
if(isset($innername))	{
	echo 'Update Item'; 
$btn = '<input type = "button" name = "return" value = "Return to Add" onclick="window.location= \'products.php?catid='.$getcatid.'\'"/>';
}
	else 
{
	echo 'Add Item';
}
	echo '"/>';

echo $btn;
?>
        </form>
        <br/>
        <br/>
        Current Items, Click to Update<br/>
        <?
$catid = $_GET['catid'];
if ($catid) $addtosql = "where catid = '$catid'";
$sql = "select * from $products $addtosql";
echo "<table border=\"0\"  cellpadding=\"5\">";
  foreach ($dbh->query($sql) as $row)
		{
	$id = $row[0];
	$itemname = $row[1];
	echo "<tr>";
	echo "<td><a href = \"$script?updateid=$id&catid=$catid\">Update $itemname</a></td><td><a href = \"$script?deleteid=$id&catid=$catid\">Delete</a></td>";
	echo "</tr>";
		} 
echo "</table>";
$dbh = null;
?>
      </div>
      <!-- END Box--> 
    </div>
    <!-- END Box --> 
  </div>
  <!-- END Content --> 
</div>
<!-- END Primary -->
<div class="clear"></div>
</body>
</html>
