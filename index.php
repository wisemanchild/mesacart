<!--
*
HTML FILE INFO
	*
	Application: final 173 ecommerce project *
	Description: code
for the prototype
	*
	File Name: untittled . php *
	Author: Norman McWilliams Tester:
	*
	Date created: 10 - 28 - 2019 Date updated: 10 - 28 - 2019 *
	Time created: 12: 38 pm Time updated: 12: 38 pm *
	Revisions: 1.0 *
	Copyright: ( c )2018 Norlab Business Solutions *
	-->
	<!--/* added this for responsive design */ -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Main Mesacart Page</title>
<!--<!--
<!-- Bootstrap -->
<link href="css/bootstrap-4.0.0.css" rel="stylesheet">
<!-- font awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
<?php //ob_start(); 
include 'nlm_header.php';
?>
<head>-->
	<!--/*** CSS override section begin ***/-->
<!--	<style>
		.nlm-ctr {
			/*	align-content: center; */
			text-align: center;
		}
		
		.fa-angle-left,
		.fa-angle-right {
			font-size: 6em;
			padding-top: 3em;
		}
		/** Making bootstrap columns a little bit small making room for arrows ***/
		
		.col-md-4 {
			-webkit-box-flex: 0;
			-ms-flex: 0 0 30%;
			flex: 0 0 33.30%;
			max-width: 30%;
		}
		
		#navbar-nlm-space {
			width: 100%;
			background-color: bg-secondary;
			color: yellow;
			text-align: center;
			letter-spacing: .30em;
		}
		
		.mr-auto {
			background-color: navbar-dark;
			width: 100%;
			margin: 10, 10, 10, 10;
		}
		/*  .navbar-item {
        float: right !important;
       word-spacing: 40px !important;
    }*/
		
		#navbar-nlm-space ul {
			padding-left: 50%;
		}
		
		.nlm_icons {
			height: 45;
			width: 60;
		}
		
		.nlm_cart {
			color: white;
			font-size: 2em;
		}
		
		.nlm_cart a::hover {
			background-color: #FF7A00;
		}
		/* font awesome font size */
		
		.navbar-nav .fas {
			font-size: 3em;
			padding-right: .5em;
			text-align: center;
			color: whitesmoke;
		}
		
		.jumbotron_gradient {
			background: linear-gradient(to bottom, grey 0%, lightgrey 100%);
		}
		
		.nlm-float-left {
			padding-left: 80%;
			font-size: 1.5em;
		}
		
		footer {
			font-size: 1.5em;
		}
		
		<!-- media query --> 
<!--	@media (max-width: 1900px) {
			#navbar-nlm-space ul {
				padding-left: 30%;
			}
		}
		
		@media (max-width: 992px) {
			footer {
				display: none;
			}
		}
		/*** css override section ends ***/
	</style>
</head>-->
--><?php require 'connect.php'; ?>


<!--/*** where the menu nav-bar section starts ***/-->
<header class="container-fluid">
	<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="#" class="text-right"><img src="images/logo.png" width=50 height=50
                                                                 alt="Norlab Business Solutions">
            <small>Norlab Business Solutions</small>
        </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
	

		<div id="navbar-nlm-space">
			<div class="navbar-spacing collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">

					<li class="nav-item">
						<i class="fas fa-gift"></i><br>
						<a class="nav-link" href="#"><h6>Specials</h6><span class="sr-only">(current)</span></a>
					</li>

					<li class="nav-item">
						<i class="fas fa-life-ring"></i>
						<!--<img src="images/hamburger60x45.png" alt="menu item" height="45" width="60"><br>-->
						<a class="nav-link" href="#">Support</a>
					</li>

					<li class="nav-item">
						<i class="fas fa-shopping-cart"></i><br>
						<!--<img src="images/hamburger60x45.png" alt="menu item" height="45" width="60"><br>-->
						<a class="nav-link" href="#">Shopping</a>
					</li>

					<li class="nav-item">
						<i class="fas fa-search"></i><br/>

						<a class="nav-link" href="#">Search</a>
					</li>
					<li class="nav-item">
						<i class="fas fa-sign-in-alt"></i><br/>

						<a class="nav-link" href="#">Login </a>
					</li>

					<li class="nav-item">
						<i class="fas fa-user-alt"></i><br/>
						<a class="nav-link" href="#">Profile</a>
					</li>

					<li>
						<i class="nlm_cart">Items In <?php include 'numcart.php'; ?></i>
					</li>
				</ul>
				<span class="navbar-text"></span>
				<!--
************** keeping this section in case I want to put it back on the main nav-bar ***/
			  <form class="form-inline" action="searchres.php" method="post">
    <label>Search:</label>
    <input type="text" name="query" class="fas fa-search" placeholder="Search"/>
    <input type="submit" name="submit" value="Search! "/>
*****************************************************************************************
</form>-->
<!-- end of menu sections -->

			</div>
	</nav>
	<section class="jumbotron text-left jumbotron_gradient">
		<!--    <div class="float-left nlm-float-left">
        <a href="slider/slider.php"><i class="fas fa-sliders-h"></i> Check out our price slider</a></div>
    <div class="float-left nlm-float-left"><a href="viewcart.php"> <i class="fas fa-shopping-cart"></i> View your cart</a></div><br/>
-->
		<h1 class="display-4">Norlab Shopping Solutions<small>"Send it to the Lab!"</small>
    </h1>
		<p class="lead">"The place where you can find all things internet"</p>
		<hr class="my-4">
		<!--<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>-->

		<!--<row class="container">-->
			<!--<div class="col-md-4">-->
				<a class="btn btn-primary btn-lg fas fa-sliders-h" href="slider/slider.php" role="button"> Check out our price slider</a>
				<!--<a href="slider/slider.php"><i class="fas fa-sliders-h"></i> Check out our price slider</a>-->
			<!--</div>-->
			<!--<div class="col-md-4">-->
				<a class="btn btn-primary btn-lg fas fa-shopping-cart" href="viewcart.php" role="button"> View your cart</a>
				<!--<a href="viewcart.php"> <i class="btn btn-lg fas fa-shopping-cart"></i> View your cart</a>-->
            <!--</div>-->

		<!--</row>-->
	</section>
</header>
<!--<div class="row">
<form class="form-inline" action="searchres.php" method="post">

    Search:
    <input type="text" name="query"/>
    <br/>
    <input type="submit" name="submit" value="Search!"/>
</form>
</div>-->

<?php
$sql = "select id, name from $maincategory";
print '<div class="row justify-content-center">';
foreach ( $dbh->query( $sql ) as $mainrow ) {
	$id = $mainrow[ 0 ];
	$name = $mainrow[ 1 ];
	$variable = 'Personal Products';
	$new = strtolower( str_replace( ' ', '_', $name ) ) . '.gif';
	$infohtml = strtolower( str_replace( ' ', '_', $name ) ) . '.html';

	//
	//  echo '<img src = "http://mesacart.nshift360.com/images/'.$new.'" alt="'.$variable.'"/>';
	//echo '<h5>' . $name . '</h5>';
	print '<div class="col-md-3">
    <div class="card"> <img class="card-img-top" src="http://mesacart.nshift360.com/images/' . $new . '" alt="' . $variable . '" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">' . $name . '</span></h5>
        <p class="card-text">If you would like more information about <span> ' . $name . '</span> click this read more link 
        <a href="" </p>
      </div>
      <ul class="list-group list-group-flush justify-content-center">
       <!-- <li class="list-group-item">Cras justo odio</li>-->
       <!-- <li class="list-group-item">Dapibus ac facilisis in</li>-->
      </ul>
      <!--<div class="card-body"> <a href="#" class="card-link">Card link</a> <a href="#" class="card-link">Another link</a> </div>-->
      <div class="nlm-ctr">
        <button type="button" class="btn btn-info btn-md col-md-3  justify-content-center">add to cart</button>
        <br><button type="button" class="btn btn-success btn-md col-md-3">buy now</button>
      </div>
    </div>
  </div>';
	$innersql = "select $category.id,$category.name,count($products.id) from $category,$products WHERE $category.id=$products.catid  and $category.maincatid = '$id' group by $category.id order by $category.name asc";
	foreach ( $dbh->query( $innersql ) as $row ) {
		$catid = $row[ 0 ];
		$catname = $row[ 1 ];
		//		$prodCount = $row[2];
		//		echo '<a href = "' . $root . 'category.php?catid=' . $catid . '"> ' . $catname . '</a>' . $prodCount . '<br/>';
	}
}

// include 'pricefilter.php';
?>
</div> 
<!--	<row class = "container" >
	<div class="col-md-4">
		<p><a href="slider/slider.php"><i class="fas fa-sliders-h"></i> Check out our price slider</a>
	</div>
	</p>
	<div class="col-md-4">
		<p><a href="viewcart.php"> <i class="fas fa-shopping-cart"></i> View your cart</a>
		</p>
	</div> 
	</row>-->
<?php
$secondsql = "select $products.id,$products.name,$products.descrip,$products.price,$category.id,$category.name 
from $spec,$products,$category where $products.id = $spec.prodid and $products.catid = $category.id and $spec.spec = 'yes'";
?>
<div id="products">
	<?php

	$stm = $dbh->prepare( $secondsql );
	$stm->execute();


	foreach ( $stm->fetchAll() as $secondrow ) {
		echo '<span class="product">';
		$img = $secondrow[ 0 ] . '/1.jpg';
		$name = $secondrow[ 1 ];
		$desc = $secondrow[ 2 ];
		$price = $secondrow[ 3 ];
		$catid = $secondrow[ 4 ];
		$catname = $secondrow[ 5 ];
		echo '<img src = "' . $root . 'thumbnail.php?pic=' . $img . '&ht=150&wd=150" alt="' . $name . '">';
		echo $name . '<br/>' . $desc . '<br/>' . $price . '<br/><a href = "' . $root . 'category.php?catid=' . $catid . '">View All Products from this Category</a>';
		echo '</span><br/><br/><br/>';
	}
	$dbh = null;
	?>

	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<footer class="container-fluid bg-secondary test-white">
		<br>
		<div class="row justify-content-center">
			<div class="col-md-4 text-white"><small>CONTACT US</small>
			</div>
			<div class="col-md-4 text-white">SERVICES</div>
			<div class="col-md-4 text-white">INFORMATION</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-4 text-white"><small> Tel: (858)555-1212</small>
			</div>
			<div class="col-md-4 text-white"><small>Contact Us</small>
			</div>
			<div class="col-md-4 text-white">Work With US</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-4 text-white"><small>EMAIL: info@nshift360.com</small>
			</div>
			<div class="col-md-4 text-white"><small>Ordering & Payment</small>
			</div>
			<div class="col-md-4 text-white">Privacy Policy</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-4 text-white"><small>San Diego Office </small>
			</div>
			<div class="col-md-4 text-white"><small>FAQ</small>
			</div>
			<div class="col-md-4 text-white"><small>Terms & Conditions</small>
			</div>
			<div class="col-md-4 text-white"><small></small>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-4 text-white"><small></small>
			</div>
			<div class="col-md-4 text-white"><small>Web Design and Development</small>
			</div>
			<div class="col-md-4 text-white"><small>Press Enquiries</small>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-4 text-white"><small></small>
			</div>
			<div class="col-md-4 text-white"><small>Consulting Services</small>
			</div>
			<div class="col-md-4 text-white"><small></small>
			</div>
		</div>
		<br>
	</footer>
	<!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
	<script src="js/jquery-3.2.1.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap-4.0.0.js"></script>