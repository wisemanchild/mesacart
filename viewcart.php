<?php
ob_start();
require 'connect.php';
include 'nlm_header.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <title>View Cart</title>

    <script type="text/javascript">
        function sameship() {
            if (document.getElementById("ship").checked == true) {
                document._xclick.billfirst_name.value = document._xclick.first_name.value;
                document._xclick.billlast_name.value = document._xclick.last_name.value;
                document._xclick.billaddress1.value = document._xclick.address1.value;
                document._xclick.billcity.value = document._xclick.city.value;
                document._xclick.billstate.value = document._xclick.state.value;
                document._xclick.billzip.value = document._xclick.zip.value;
            }
            else {
                document._xclick.billfirst_name.value = '';
                document._xclick.billlast_name.value = '';
                document._xclick.billaddress1.value = '';
                document._xclick.billcity.value = '';
                document._xclick.billstate.value = '';
                document._xclick.billzip.value = '';
            }
        }

        function makeRequest(url) {

            request = new XMLHttpRequest();
            sendRequest(url);
        }

        // nlm_note TODO change all == comparison operators to === to eliminate ambiguous warnings
        function sendRequest(url) {
            if (url === 'ship') {
                state = document._xclick.billstate.value;
                service = document._xclick.service.value;
                zip = document._xclick.billzip.value;
                url = "try.php?server=" + service + "&state=" + state + "&zip=" + zip;
            }
            else if (url == 'curr') {
                currlink = document.getElementById("currency").value;
                url = "curr.php?curr=" + currlink + "&rate=" + tot;
            }
            else if (url == 'coup') {
                couponlink = document.getElementById("coupon").value;
                url = "coupon.php?coupon=" + couponlink;
            }
            else {
                zip = document._xclick.billzip.value;
                url = "zip.php?zip=" + zip;
            }
            request.onreadystatechange = onResponse;
            alert(url);
            request.open("GET", url, true);
            request.send(null);
        }

        function checkReadyState(obj) {
            if (obj.readyState == 0) {
                document.getElementById('copy').innerHTML = "Sending Request...";
            }
            if (obj.readyState == 1) {
                document.getElementById('copy').innerHTML = "Loading Response...";
            }
            if (obj.readyState == 2) {
                document.getElementById('copy').innerHTML = "Response Loaded...";
            }
            if (obj.readyState == 3) {
                document.getElementById('copy').innerHTML = "";
            }
            if (obj.readyState == 4) {
                if (obj.status == 200) {
                    return true;
                }
                else if (obj.status == 404) {
                    // Add a custom message or redirect the user to another page
                    document.getElementById('copy').innerHTML = "File not found";
                }
                else {
                    document.getElementById('copy').innerHTML = "There was a problem retrieving the content.";
                }
            }
        }

        function onResponse() {
            if (checkReadyState(request)) {

                if (request.responseText.indexOf("|") != -1) {
                    var cityarray = request.responseText.split("|");
                    document._xclick.billcity.value = cityarray[1];
                    document._xclick.billstate.value = cityarray[0];
                    document.getElementById("citystate").style.display = 'block';
                }
                else if (request.responseText.indexOf("$") != -1) {
                    data = request.responseText;
                    curr = data.substr(data.length - 3, 3);
                    document._xclick.currency_code.value = curr;
                }
                else if (request.responseText.indexOf("-") != -1) {
                    //this is a coupon
                    data = request.responseText;
                    coup = data.split('-');
                    typeofdiscount = coup[0];
                    var cartval = document.getElementById("subtotal").value;
                    if (typeofdiscount == 'percent') {
                        mon = '';
                        tot = '%';
                        cartval = cartval * (100 - coup[1]);
                    }
                    if (typeofdiscount == 'amount') {
                        mon = '$';
                        tot = '';
                        cartval = cartval - coup[1];
                    }
                    document.getElementById('discount').innerHTML = cartval;
                    document.getElementById("couponresponse").innerHTML = "Your discount is " + mon + coup[1] + tot;
                    //document._xclick.currency_code.value = 	curr;
                }
                else {
                    document.getElementById("copy").innerHTML = request.responseText;
                    document._xclick.shipping_1.value = request.responseText;
                }
            }
        }
    </script>
    <style>
        item.solid {
            border-style: solid;
            padding: 20px;
        }

        .nlm_label {
            padding-right: 10px;
            margin-right: 10px;
            padding-left: 10px;
            margin-left: 10px;
        }

    </style>
</head>
<body>

<section class="jumbotron text-left jumbotron_gradient">
    <!--
		<div class="float-left nlm-float-left">
		<a href="slider/slider.php"><i class="fas fa-sliders-h"></i> Check out our price slider</a></div>
		<div class="float-left nlm-float-left"><a href="viewcart.php"> <i class="fas fa-shopping-cart"></i> View your cart</a></div><br/>
-->
    <h1 class="display-4">Norlab Shopping Cart
        <small>"Please review your order."</small>
    </h1>
    <p class="lead">"The place where you can find all things internet"</p>
    <hr class="my-4">
    <!--<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>-->

    <!--<row class="container">-->
    <!--<div class="col-md-4">-->
    <a class="btn btn-primary btn-lg fas fa-sliders-h" href="slider/slider.php" role="button"> Check out our price
        slider</a>
    <!--<a href="slider/slider.php"><i class="fas fa-sliders-h"></i> Check out our price slider</a>-->
    <!--</div>-->
    <!--<div class="col-md-4">-->
    <a class="btn btn-primary btn-lg fas fa-shopping-cart" href="viewcart.php" role="button"> View your cart</a>
    <!--<a href="viewcart.php"> <i class="btn btn-lg fas fa-shopping-cart"></i> View your cart</a>-->
    <!--</div>-->

    <!--</row>-->
</section>
<main class="container">
	<?php
	$removeid = $_GET['remove'];
	if ( $removeid ) {
		$dbh->exec( "delete from $cartitems where id = '$removeid'" );
	}
	$qtytoupdate = $_POST['qty'];
	if ( isset( $qtytoupdate ) ) {
		$prodid = $_POST['prodid'];
		$dbh->exec( "update	$cartitems set qty = '$qtytoupdate' where cartitems = '$prodid' and sessid = '$sessid'" );
	}

	$sql = "select $cartitems.id,$cartitems.cartitems,$products.name,$products.price ,$cartitems.qty,$products.id,$cartitems.attribute, $products.weight from $cartitems,$products where $cartitems.sessid = '$sessid' and $cartitems.cartitems = $products.id";

	foreach ( $dbh->query( $sql ) as $showrow ) {
		$cartitemnum = $showrow[0];
		$name        = $showrow[2];
		$price       = $showrow[3];
		$qty         = $showrow[4];
		$prodid      = $showrow[5];
		$attribute   = $showrow[6];
		?>
        <item class="solid row">
            <img src="<?= $root; ?>thumbnail.php?pic=<?= $prodid . '/1.jpg&ht=100&wd=100'; ?>"/><br/>
			<? echo $name . $attribute; ?> <a href="<?= $root; ?>viewcart.php?remove=<?= $cartitemnum; ?>">Remove</a>
            <br/>
            <!--<br>-->
            Enter Coupon or Gift Certificate Code
            <input type="text" id="coupon" onblur="makeRequest('coup');"/>
            <!--<br/>
			<br>-->
            <p id="couponresponse"></p>
            <form action="<?= $root; ?>viewcart.php" method="post">
                Quantity:
                <input type="text" name="qty" size="2"
                       value="<?= $qty; ?>">
                <br/>
                <input type="hidden" name="prodid" value="<?= $prodid; ?>"/>
                <br/>
                <input type="submit" name="submit" value="update"/>
                <br/>
            </form>
        </item>
		<?php
	}
	?>

    <form action="https://www.sandbox.paypal.com/us/cgi-bin/webscr"
          method="post" name="_xclick">
        <h4>Shipping:</h4>
        <!--<div class="row">-->
        <TABLE BORDER="0">
            <TR>
                <TD><label class="nlm_label" for="first_name">First Name:</label></TD>
                <TD><input type="text" name="first_name" value="First Name"/></TD>

                <TD><label class="nlm_label" for="last_name" class="d-inline">Last Name:</label></TD>
                <TD><input type="text" name="last_name" value="Last Name"/></TD>
            </TR>

            <!--</div>-->
            <!--<div class="row">-->
            <TR>
                <TD><label class="nlm_label" for="address1">Address:</label></TD>
                <TD><textarea name="address1" cols="30" rows="5" value="Address"></textarea></TD>
            </TR>

            <!-- </div>-->
            <!--<div class="row">-->
            <TR>
                <TD><label class="nlm_label" for="city">City:</label></TD>
                <TD><input type="text" name="city" id="city" value="City"/></TD>
                <TD><label class="nlm_label" for="state">State:</label></TD>
                <TD><input type="text" name="state" id="state"/></TD>
                <TD><label class="nlm_label" for="zip">Zip:</label></TD>
                <TD><input type="text" name="zip" id="zip"/>
            </TR>

        </TABLE>
            <h3><label class="nlm_label" for="checkbox">Same as Shipping?</label></h3></TD>
           <h3><input type="checkbox" id="ship" onClick="sameship();"/></h3></TD>



        Billing:<br/>
        First Name
        <input type="text" name="billfirst_name"/>
        <br/>
        Last Name
        <input type="text" name="billlast_name"/>
        <br/>
        Address
        <textarea name="billaddress1"></textarea>
        <br/>
        <span id="citystate" style="display:none"> City
  <input type="text" name="billcity"/>
  <br/>
  State
  <input type="text" name="billstate"/>
  <br/>
  </span> Zip:
        <input type="text" name="billzip" onblur="makeRequest('state');"/>
        <br/>
        Email:
        <input type="text" name="email"/>
        <br/>
        Phone:
        <input type="text" name="night_phone_a"/>
        <br/>
        <!--Service: <select name = "service" onChange="makeRequest('ship')">
<option value = ''>Choose Service Below</option> 
 <option value = "PRIORITYOVERNIGHT" <? if ( $service == 'PRIORITYOVERNIGHT' ) {
			echo "SELECTED";
		} ?>>FedEx Priority Overnight</option>
  <option value = "STANDARDOVERNIGHT" <? if ( $service == 'STANDARDOVERNIGHT' ) {
			echo "SELECTED";
		} ?>>FedEx Standard Overnight</option>
  <option value = "FIRSTOVERNIGHT" <? if ( $service == 'FIRSTOVERNIGHT' ) {
			echo "SELECTED";
		} ?>>FedEx First Overnight</option>
  <option value = "FEDEX2DAY" <? if ( $service == 'FEDEX2DAY' ) {
			echo "SELECTED";
		} ?>>FedEx 2 Day</option>
  <option value = "FEDEXEXPRESSSAVER" <? if ( $service == 'FEDEXEXPRESSSAVER' ) {
			echo "SELECTED";
		} ?>>FedEx Express Saver</option>
  <option value = "INTERNATIONALPRIORITY" <? if ( $service == 'INTERNATIONALPRIORITY' ) {
			echo "SELECTED";
		} ?>>FedEx International Priority</option>
  <option value = "INTERNATIONALECONOMY" <? if ( $service == 'INTERNATIONALECONOMY' ) {
			echo "SELECTED";
		} ?>>FedEx International Economy</option>
    <option value = "INTERNATIONALFIRST" <? if ( $service == 'INTERNATIONALFIRST' ) {
			echo "SELECTED";
		} ?>>FedEx International First</option>
    <option value = "FEDEX1DAYFREIGHT" <? if ( $service == 'FEDEX1DAYFREIGHT' ) {
			echo "SELECTED";
		} ?>>FedEx International Freight</option>
    <option value = "FEDEX2DAYFREIGHT" <? if ( $service == 'FEDEX2DAYFREIGHT' ) {
			echo "SELECTED";
		} ?>>FedEx 2 day Freight</option>
    <option value = "FEDEX3DAYFREIGHT" <? if ( $service == 'FEDEX3DAYFREIGHT' ) {
			echo "SELECTED";
		} ?>>FedEx 3 day Freight</option>
    <option value = "FEDEXGROUND" <? if ( $service == 'FEDEXGROUND' ) {
			echo "SELECTED";
		} ?>>FedEx Ground</option>
    <option value = "GROUNDHOMEDELIVERY" <? if ( $service == 'GROUNDHOMEDELIVERY' ) {
			echo "SELECTED";
		} ?>>FedEx Home Delivery</option>
</select><br/>-->
        347933438
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="business" value="ksecor_1326497985_biz@adelphia.net">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="currency_code" value="USD">
		<?
		$i      = 1;
		$newsql = "select $cartitems.cartitems,$products.name,$products.price ,$cartitems.qty,$products.id,$cartitems.attribute from $cartitems,$products where $cartitems.sessid = '$sessid' and $cartitems.cartitems = $products.id";
		foreach ( $dbh->query( $newsql ) as $row ) {
			$name      = $row[1];
			$price     = $row[2];
			$qty       = $row[3];
			$prodid    = $row[4];
			$attribute = $row[5];
			$weight    = $showrow[7];
			?>
            <input type="hidden" name="item_name_<?= $i; ?>" value="<?= $name; ?>"/>
            <input type="hidden" name="item_number_<?= $i; ?>" value="<?= $prodid; ?>"/>
			<?
			$each = explode( ',', $attribute );
			$y    = 0;
			for ( $x = 0; $x < count( $each ) - 1; $x ++ ) {
//Size:small		 
				$att    = $each[ $x ];
				$catarr = explode( ':', $att );
				$onname = $catarr[0];
				$choice = $catarr[1];
				?>
                <input type="hidden" name="on<?= $y; ?>_<?= $i; ?>" value="<?= $onname; ?>"/>
                <input type="hidden" name="os<?= $y; ?>_<?= $i; ?>" value="<?= $choice; ?>"/>

				<?
				$y ++;
			}
			?>
            <input type="hidden" name="amount_<?= $i; ?>" value="<?= $price; ?>">
            <input type="hidden" name="quantity_<?= $i; ?>" value="<?= $qty; ?>">
			<?
			$i ++;
			$total       = $price * $qty;
			$total       = money_format( "%i", $total );
			$cartcontent .= "$name $qty $attribute at $price Total: $total<br/>";
			$subtotal    += $total;
		}
		echo '<input type = "hidden" name = "shipping_1" value = "25.00"/>';
		$subtotal = money_format( "%i", $subtotal );
		echo $cartcontent;
		echo '<input type ="hidden" id ="subtotal" name = "subtotal" value = "' . $subtotal . '">';
		echo '<br/>Subtotal:$<p id = "discount">' . $subtotal . '</p>';
		$dbh = null;

		/*
		$GBP = "http://finance.yahoo.com/d/quotes.csv?s=USDGBP=X&f=sl1d1t1c1ohgv&e=.csv";
		$EUR = "http://finance.yahoo.com/d/quotes.csv?s=USDEUR=X&f=sl1d1t1c1ohgv&e=.csv";
		setcookie("EUR",$EUR);
		setcookie("EUR",$GBP);
		*/
		?>
        <div id="copy">Shipping is</div>
        <input type="submit" name="submit" value="Check Out">
    </form>
    <br/>
</main>
<?php
include 'nlm_footer.php'
?>
</body>
</html>
