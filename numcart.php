<?php
$row = $dbh->prepare("select count(id) from $cartitems where sessid = ?");  
$row->bindValue(1,$sessid);
$row->execute();
$num = $row->fetchColumn();
echo '<a href = "viewcart.php">cart('.$num.')</a><br/>';
?>