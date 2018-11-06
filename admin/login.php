<?
include '../connect.php';
$submit = $_POST['submit'];

if ($submit) 
    {
$password = md5($_POST['password']);
$username = $_POST['username'];
$row = $dbh->prepare("select count(*) from $ecadmin where username=? and password=?");  
$row->execute(array($username,$password));
$num = $row->fetchColumn();
if ($num > 0)
   {

 $_SESSION['id'] = $id;
  $_SESSION['approved'] = 'wysiwyg';
 header ("Location: index.php");   
   }  
 else
    {  
echo "Sorry, there was no match, please try again<br/>"; 	
	}
$dbh=null;
	}
?>
<link type="text/css" rel="stylesheet" href="css/framework.css" />
<link type="text/css" rel="stylesheet" href="css/style_coffee.css" />
<html>
<div id="content" style="margin-top:135px;">
<div class="box">
<p>You must be logged in to view the administration section of this website</p>
<form action = "login.php" method = "post">
Username: <input type = "text" name = "username"><br/>
Password: <input type = "password" name = "password"><br/> 
<input type = "submit" name = "submit" class="submit" value = "Log in">
</form>
</div>
</div>
</html>