Price Filter<br/>
<?
//get max and min prices
$sth = $dbh->prepare("select min(price) as mini, max(price) as maxi from $products");
$sth->execute();

$pricerow = $sth->fetchObject();

$min = $pricerow->mini;
 $max = $pricerow->maxi;

$diff = $max - $min;
$sep = $diff/5;

for ($i=$min;$i<$max;$i+=$sep)
  {
	$x = $i + $sep; 
	if ($x >= $max-1) $x = $x + 1;
	echo '<a href = "pricesort.php?min='.floor($i).'&max='.floor($x).'">'.money_format('%i',floor($i))."-".money_format('%i',floor($x))."</a><br/>";
  }
?>
<br/>