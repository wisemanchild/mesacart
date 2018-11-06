<?
$dbh = new PDO("mysql:host=localhost;dbname=mmaaaco_ksecor", "mmaaaco_ksecor", "hamilton");
$prodid = $_GET['product'];
$rating = $_GET['rating'];
$kris = $dbh->prepare("insert into 3321_ratings (prodid,rating) values (?,?)");
$kris->execute(array($prodid,$rating));
//

//$_SERVER['REQUEST_METHOD'] == 'xmlhttprequest'
$sql = $dbh->prepare("SELECT avg(rating) as average from 3321_ratings where prodid = ?");
$sql->bindValue(1,$prodid);
//insertrating.php?fortune="+id + "&rating=" + rat
$sql->execute();
$row = $sql->fetch();
	$id = $row['average']; 
$i=1;
while ($i<=5){
if ($i <= ceil($id))	
{
echo '<img src = "images/favorite.png" width="20" height="20" />';	
}
else      
{            
echo '<img src = "images/favorite1.png" width="20" height="20" />';		                      
}
$i++;
}

?>