<?
$to = $_GET['to'];
$amt = $_GET['amt'];
$from = $_GET['from'];
$values = file_get_contents('http://finance.yahoo.com/d/quotes.csv?s='.$from.$to.'=X&f=sl1d1t1c1ohgv&e=.csv');
$rate = explode(",",$values);
$rate = $rate[1];
$total = $amt * $rate;
echo '$'.$total.$to;
?>