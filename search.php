<?
include 'connect.php';
?>
<script type="text/javascript">
function populate(result)
{	

if(result.childNodes[0].value == 'all')
    {
	document.formname.submit()
	}
else
   {
  document.getElementById("qry").value=result.childNodes[2].innerHTML;
	document.getElementById("results").style.display = 'none';
	updateHits(result.childNodes[0].value);
	window.location = 'product.php?pid=' + result.childNodes[0].value;
   }
}


function updateHits(itemToUp)
{
UniqueIp = '<?=$_SERVER['REMOTE_ADDR']?>';
searchUrl = 'google.php?i='+itemToUp+'&uip='+UniqueIp;
request.open("GET", searchUrl, true);
request.send(null);	
}


function doOnClickBody() {
	if(document.getElementById("results"))
	{
	document.getElementById("results").style.display = 'none';
	}
}
document.onclick = doOnClickBody;

function makeRequest() 
{
	if(window.XMLHttpRequest)
	{
		request = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		request = new ActiveXObject("MSXML2.XMLHTTP");
	}
	
	sendRequest();
}

function sendRequest()
{
	var cacheclear = new Date();
	var seconds = cacheclear.getMilliseconds();
	var data = document.getElementById("qry").value;
    url =  'google.php?qry=' + data + '&time=' + seconds;
	request.onreadystatechange = onResponse;
	request.open("GET", url, true);
	request.send(null);
	document.getElementById('copy').innerHTML = request.responseText;
}


function checkReadyState(obj)
{
	if(obj.readyState == 0) { document.getElementById('copy').innerHTML = "Sending Request...";
	}
	if(obj.readyState == 1) { document.getElementById('copy').innerHTML = "Loading Response...";
	}
	if(obj.readyState == 2) { document.getElementById('copy').innerHTML = "Response Loaded...";

	}
	if(obj.readyState == 3) { document.getElementById('copy').innerHTML = "Response Ready...";
}
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
		
		document.getElementById('copy').innerHTML = request.responseText;
		
	}
}
</script>

<style>
#results p:hover
	{
	background-color:#316ac5;
	color:white;
	}
	#results p
	{
	margin:0px;
	padding:0px;
	width:400px;
	}
	#results
	{
	border: 1px solid black;
	width:400px;
	height:auto;
	overflow:hidden;
	}
	#results label.hits
	{
	color: green;
	float:right;
	}
	#results label.result
	{
	color: black;
	}
</style>


<?
include 'connect.php';
$query = $_POST['query'];
if ($query)
   {
$sql = "select $category.id, $category.name, $products.id, 
$products.name, $products.descrip from $category, $products
where ($category.name like '%$query%' or $products.name like '%$query%' or
$products.descrip like '%$query%') and $category.id = $products.catid";	
foreach ($dbh->query($sql) as $row)
     {
$id = $row[0];
$img = "<a href = \"product.php?pid=".$prodid."\"><img src = \"thumbnail.php?pic=".$id."/1.jpg\"/></a>";
$catname = $row[1];
$prodid = $row[2];
$name = $row[3];
$proddesc = $row[4];
$descarr = explode(".",$proddesc);
$desc = $descarr[0]."   <a href = \"product.php?pid=".$prodid."\">Read More</a>";
echo $img.' '.$name."<br/>".$desc."<br/><br/>";
	 }   
   }
?>
<form action = "search.php" autocomplete="off" name = "formname" method = "post">
Search for Products  : <input type = "text" name = "query" id = "qry" onkeyup="makeRequest();"/>
            <div id = "copy"></div>
            	<input type="submit" value="Search" />
