<!--
    *   HTML FILE INFO
	* 	Application: final 173 ecommerce project
	*	Description: code for the prototype
	*	File Name: index.php
	*	Author: Norman McWilliams Tester:
	*	Date created: 10 - 28 - 2019 Date updated: 10 - 28 - 2019
	*	Time created: 12: 38 pm Time updated: 12: 38 pm
	*	Revisions: 2.0
	*	Copyright: ( c )2018 Norlab Business Solutions
	*
-->
<!--<!--nlm TODO need to clean up file-->
<!--nlm TODO add cookies and session storage-->
<!--/* added this for responsive design */ -->
--><meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Main Mesacart Page</title>
<!--<!--
<!-- Bootstrap -->
<link href="css/bootstrap-4.1.3.css" rel="stylesheet">
<!-- font awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css"
      integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
<?php ob_start();
include 'nlm_header.php';
?>

<?php require 'connect.php';
?>


<!--/*** where the menu nav-bar section starts ***/
    /* nav-bar moved to nlm_header.php */
-->

<section class="jumbotron text-left jumbotron_gradient">
    <!--
		<div class="float-left nlm-float-left">
		<a href="slider/slider.php"><i class="fas fa-sliders-h"></i> Check out our price slider</a></div>
		<div class="float-left nlm-float-left"><a href="viewcart.php"> <i class="fas fa-shopping-cart"></i> View your cart</a></div><br/>
-->
    <h1 class="display-4">Norlab Shopping Solutions
        <small>"Send it to the Lab!"</small>
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

<!--<div class="row">
<form class="form-inline" action="searchres.php" method="post">

	Search:
	<input type="text" name="query"/>
	<br/>
	<input type="submit" name="submit" value="Search!"/>
</form>
</div> -->

<?php
$sql = "select id, name from $maincategory";
print '<div class="row justify-content-center">';
foreach ( $dbh->query( $sql ) as $mainrow ) {
	$id   = $mainrow[0];
	$name = $mainrow[1];
	//$variable = 'Personal Products';
	$new      = strtolower( str_replace( ' ', '_', $name ) ) . '.gif';
	$infohtml = strtolower( str_replace( ' ', '_', $name ) ) . '.html';

	//
	//echo '<img src = "http://mesacart.nshift360.com/images/'.$new.'" alt="'.$variable.'"/>';
	/*print '<h5>' . $name . '</h5>';*/
	print '<div class="col-md-3">';
	print '<div class="card"><img class="card-img-top" src="http://mesacart.nshift360.com/images/' . $new . '" alt="' . $variable . '" alt="Card image cap">
      <div class="card-body">
   		<h5 class="card-title">' . $name . '</h5>
   		<p class="card-text">If you would like more information about our ' . $name . '<a href="category.php?catid=' . $id . '"><br/>
   		<a href="http://mesacart.nshift360.com/category.php?catid=1&soft=pricehigh">read more</a></p>
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
		$catid     = $row[0];
		$catname   = $row[1];
		$prodCount = $row[2];
		// echo '<a href = "' . $root . 'category.php?catid=' . $catid . '"> ' . $catname . '</a>' . $prodCount . '<br/>';
	}
}

//include 'pricefilter.php';
?>

    </div>
<br/>
<section class="container-fluid align row">
    <div class="col-md-1"></div>
    <div class="card col-md-5">
        <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
        <div class="card-body">
            <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>-->
        </div>
    </div>
    <div class="card col-md-5">
        <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
        <div class="card-body">
            <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>-->
        </div>
    </div>
    <div class="col-md-1"></div>
</section>
<!--	<row class = "container" >
<div class="col-md-4">
	<p><a href="slider/slider.php"><i class="fas fa-sliders-h"></i> Check out our price slider</a>
</div>
</p>
<div class="col-md-4">
	<p><a href="viewcart.php"> <i class="fas fa-shopping-cart"></i> View your cart</a>
	</p>
</div> <
/row>-->
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
		$img     = $secondrow[0] . '/1.jpg';
		$name    = $secondrow[1];
		$desc    = $secondrow[2];
		$price   = $secondrow[3];
		$catid   = $secondrow[4];
		$catname = $secondrow[5];
		//echo '<img src = "' . $root . 'thumbnail.php?pic=' . $img . '&ht=150&wd=150" alt="' . $name . '">';
//		echo $name . '<br/>' . $desc . '<br/>' . $price . '<br/><a href = "' . $root . 'category.php?catid=' . $catid . '">View All Products from this Category</a>';
//		echo '</span><br/><br/><br/>';
	}
	$dbh = null;
	?>


	<?php include 'nlm_footer.php'; ?>
    <!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
    <script src="js/jquery-3.2.1.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.1.3.js"></script>