<?

ob_start();

require 'connect.php';

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

$upsql=$dbh->prepare("insert into $cartitems (cartitems,attribute,qty,sessid,timeofentry) values	(?,?,?,?,?)");

$time =   date('Y-m-d H:i:s');  

$upsql->execute(array($itemid,$options,$qty,$sessid,$time));

     }

	}

	}



?>

<!DOCTYPE html>

<html >

<head>

<link href="cloud-zoom.css" rel="stylesheet" type="text/css" />

<!-- You can load the jQuery library from the Google Content Network.

Probably better than from your own server. -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<!-- Load the Cloud Zoom JavaScript file -->

<script type="text/JavaScript" src="cloud-zoom.1.0.2.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript">
function sendRequest(id,rat)
{   
    request = new XMLHttpRequest();
    url = "insertrating.php?product="+id + "&rating=" + rat; 
    
  request.onreadystatechange = onResponse;
  request.open("GET", url, true);
  request.send(null);

}


function checkReadyState(obj)
{
  if(obj.readyState == 0) { document.getElementById('copy').innerHTML = "Sending Request..."; }
  if(obj.readyState == 1) { document.getElementById('copy').innerHTML = "Loading Response..."; }
  if(obj.readyState == 2) { document.getElementById('copy').innerHTML = "Response Loaded..."; }
  if(obj.readyState == 3) { document.getElementById('copy').innerHTML = "Response Ready..."; }
  if(obj.readyState == 4)
  {
    if(obj.status == 200)
    {
      return true;
    }
    else if(obj.status == 404)
    {
      // Add a custom message or redirect the user to another page
      document.getElementById('copy').innerHTML = "File not found";
    }
    else
    {
      document.getElementById('copy').innerHTML = "There was a problem retrieving the content.";
    }
  }
}

function onResponse() 
{
  if(checkReadyState(request))
  {
    //alert(request.responseXML);
  
    document.getElementById('copy').innerHTML = request.responseText;
  }
}




function switchpic(pic){

document.main.src = '<?= $pid;?>/' + pic;	

}

</script>

<title></title>

<?

$pid = $_GET['pid'];

if ($_GET['pid']) {

    $opt = $dbh->prepare("select link from $products where id = '$pid'");

    $opt->execute();

    $innerrow = $opt->fetchObject();

    $link = $innerrow->link;

    echo '<link rel="canonical" href="http://www.mm214.com/wdimcart/'.$link.'" />';

    unset($opt);

    unset($innerrow);

}

?>

</head>

<body>

<?

    $att = $dbh->prepare("select options from $attributes where  prodid = '$pid'");

    $att->execute();

    $innerrow = $att->fetchObject();

    $attr = $innerrow->options;

    $linearray = explode("\n",$attr);

    $numoptions = count($linearray);



$cat = $dbh->prepare("select $category.id,$category.name,$inv.qty from $category,$products,$inv where 

$products.id = '$pid' and $category.id = $products.catid");

$cat->execute();

$catrow=$cat->fetchObject();

$catid = $catrow->id;

$catname = $catrow->name;

$inv = $catrow->qty;

if ($qty > 0)

    {

$uid = session_id();	

for ($h=1;$h<=$numoptions;$h++)

   {

$options .= $_POST['option'.$h].',';

   }

$options = substr($options,0,strlen($options)-1);$itemid = $_POST['itemid'];

if ($itemid)

    {

$row = $dbh->query("select count(id) from $cartitems where cartitems = '$itemid' and sessid = '$sessid' and attribute = '$options'");  

$num = $row->fetchColumn();

if ($num > 0)

    {

$dbh->exec("update $cartitems set qty = qty + '$qty' where cartitems = '$itemid' and sessid = '$sessid'");

    }

else

    {	 

$count = $dbh->exec("insert into $cartitems (cartitems,attribute,qty,sessid,timeofentry) values	('$itemid','$options','$qty','$sessid',now())");

    }

 }

}	 

$prod = $dbh->prepare("select * from $products where id = '$pid'");

$prod->execute();

$row=$prod->fetchObject();

$breadcrumb = "<a href = \"".$root."index.php\">Home</a> > <a href = \"".$root."category.php?catid=".$catid."\">".$catname; 

$name = $row->name;

$breadcrumb .= "</a> > ".$name."<br/><br/>";

 echo $breadcrumb;

 $desc = $row->descrip;

 $price = $row->price; 

if ($price == 0) $price = 'Free!';

 $link = $root.$row->link;

 if ($link == "") $link = $root."product.php?pid=".$pid; 

  $size = getimagesize($pid."/1.jpg");

  $height = $size[1] - 75;

  $width = $size[0] - 75;

    $att = $size[3];

  /*

      <a href='/images/zoomengine/bigimage00.jpg' class = 'cloud-zoom' id='zoom1'

            rel="adjustX: 10, adjustY:-4">

            <img src="/images/zoomengine/smallimage.jpg" alt='' title="Optional title display" />

        </a>

  */

  echo $name.'<br/>'.$desc.'<br/>';

  echo '<a href="'.$pid.'/1.jpg" class = "cloud-zoom" id="zoom1" rel="zoomHeight:250,zoomWidth:250"><img src = "'.$pid.'/1.jpg" name = "main" alt="" title="'.$name.'" height="200" width ="300" ></a><br/>';

  $open = opendir($pid);

  $y = 1;

  while ($file = readdir($open))

    {

if ($file == '1.jpg' || $file == '.' || $file == '..') continue;

//echo '<img src = "thumbnail.php?pic='.$id.'/'.$file.'" onclick=switchpic(\''.$file.'\');"/>';

echo '<a href="'.$pid.'/'.$file.'" class="cloud-zoom-gallery" title="" rel="useZoom:\'zoom1\',smallImage:\''.$pid.'/'.$file.'\'"><img class="zoom-tiny-image" src="'.$pid.'/'.$file.'" alt = "Thumbnail '.$y.'" height = "100" width = "100"/></a>';

$y++;

   }

echo "Inventory: ".$inv."<br/>";

  ?>

<form action = "product.php?pid=<?= $pid;?>" method="post">

<input type="hidden" name = "itemid" value = "<?= $pid;?>" />

<?

$y=1;

for ($z=0;$z<count($linearray);$z++)

  {

$atribarray = explode(',',$linearray[$z]);

if (count($atribarray)>1)

   {

echo '<select name = "option'.$y.'">';   

   for ($x=0;$x<count($atribarray);$x++)

     {

 echo '<option value = "'.$atribarray[$x].'">'.$atribarray[$x].'</option>';

	 }   

 echo '</select>';   

 $y++;



   }

  }

?>

<br/>

Quantity

<input type = "text" name = "qty" size="2" />

<input type = "submit" value = "add to cart" />

</form><br/>  
<div id = "copy">
  <? 

  $avg = $dbh->prepare("select avg($rating.rating) as average

 from $rating

 where prodid = $pid");

$avg->execute();

$avgrow=$avg->fetchObject();

$score = $avgrow->average;

for ($i=1;$i<=5;$i++)

  {

if ($i<=ceil($score)) echo '<img src = "images/favorite.png" height="15" width = "15" onclick="sendRequest(\''.$pid.'\',\''.$i.'\');">'; 

else echo  '<img src = "images/favorite1.png" height="15" width = "15" onclick="sendRequest(\''.$pid.'\',\''.$i.'\');">'; 

  }

  $dbh=null;

?>
</div>

<br/><br />

<a href = "<?= $root;?>viewcart.php">View your cart</a> 

</body>

</html>

