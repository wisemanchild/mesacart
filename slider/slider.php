<?php
require '../connect.php';
$res =  $dbh->prepare("select min(price) as mini,max(price) as maxi from $products");
$res->execute();
$results = $res->fetchObject();
$minValue = $results->mini;
$maxValue = $results->maxi;
?>

        <link type="text/css" href="jquery-ui-1.8rc1.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8rc1.custom.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $slider = $("#slider");//Caching slider object
                $amount = $("#amount");//Caching amount object
                $products = $('#products');//Caching product object
                $ajaxMessage =  $('#ajaxMessage');//Caching ajaxMessage object

                $slider.slider({
                    range: true, // necessary for creating a range slider
                    min: <?php echo $minValue;?>, // minimum range of slider
                    max: <?php echo $maxValue;?>, //maximimum range of slider
                    values: [<?php echo $minValue;?>, <?php echo $maxValue?>], //initial range of slider
                    slide: function(event, ui) { // This event is triggered on every mouse move during slide.
                        $amount.html('$' + ui.values[0] + ' - $' + ui.values[1]);//set value of  amount span to current slider values
                    },
                    stop: function(event, ui){//This event is triggered when the user stops sliding.
                        $ajaxMessage.css({display:'block'});
                        $products.find('ul').css({opacity:.2});
                        $products.load('ajaxSlider.php?minValue='+ui.values[0]+'&maxValue='+ui.values[1],'',function(){
                            $ajaxMessage.css({display:'none'});
                        });
                    }
                });

                $amount.html('$' + $slider.slider("values", 0) + ' - $' + $slider.slider("values", 1));
            });
        </script>
        <style type="text/css">
            body{font-size: 12px;font-family:"Arial","Helvetica","Verdana","sans-serif";}
            .left{float:left;}
            .clear{clear:both}
            #wrapper{margin:40px auto;width:940px}
            #leftSlider{width: 200px;margin-right: 30px;}
            #range{margin-bottom: 20px;}
            #productsWrap{width:710px;position: relative}
            #products ul{
                list-style: none;
                margin:0px;padding:0px
            }
            #products ul li{
                background-color:#333333;
                float:left;
                height:127px;
                margin:4px;
                padding:8px;
                width:190px;
                -moz-border-radius:6px;
                -webkit-border-radius:6px;
                -khtml-border-radius:6px;
                position: relative;
            }
            .price-tag{-moz-border-radius-bottomright:6px;
                       -moz-border-radius-topright:6px;
                       -webkit-border-radius-bottomright:6px;
                       -webkit-border-radius-topright:6px;
                       -khtml-border-radius-bottomright:6px;
                       -khtml-border-radius-topright:6px;
                       -moz-box-shadow:0px 0px 4px #000;
                       -webkit-box-shadow:0px 0px 4px #000;
                       -khtml-box-shadow:0px 0px 4px #000;
                       background-color:#C6CF6B;
                       bottom:22px;
                       color:#000000;
                       font-weight:bold;
                       left:8px;
                       padding:6px;
                       position:absolute;
            }
            #amount{font-size: 14px;text-shadow:0px 1px 0px #ccc}
            #ajaxMessage{position: absolute;z-index: 999;
                         color:crimson;
                         font-size: 40px;display: none}
        </style>
        <div id="wrapper">
            <div class="left" id="leftSlider">
                <div id="range">Price Range <span id="amount"></span></div>
                <div id="slider"></div>
            </div>
            <div class="left" id="productsWrap">
                <div id="ajaxMessage"></div>
                <div id="products">

<br/><br/><br/><br/>
<?

$innersql = "select * from $products ";
$innerqry = $dbh->prepare($innersql);
$innerqry->execute();
  while ($row = $innerqry->fetch())
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
?><br/><br />
                </div>
            </div>
        </div>
