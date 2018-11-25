<!doctype html>
<html>
<!--
    *   HTML FILE INFO
	*	Application: final 173 ecommerce project
	*	Description: code for the prototype
	*	File Name: nlm_header.php
	*	Author: Norman McWilliams Tester:
	*	Date created: 11-24-2018 Date updated: 11-24-2018
	*	Time created: 05:21 pm Time updated: 05:21 pm
	*	Revisions: 2.0
	*	Copyright: ( c )2018 Norlab Business Solutions
	*
-->
<head>
	<meta charset="utf-8">
	<title>Header File</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap-4.1.3.css" rel="stylesheet">
	<!-- font awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
	<link href="css/nlm_css.css" rel="stylesheet">
	<?php ob_start(); ?>

</head>

<body>
	<!--/*** where the menu nav-bar section starts ***/ -->
	<header class="container-fluid">
		<nav class="navbar  sticky-top navbar-expand-lg navbar-dark bg-dark">
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
							<a class="nav-link" href="#">Support</a>
						</li>

						<li class="nav-item">
							<i class="fas fa-shopping-cart"></i><br>
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
							<i class="nlm_cart">Items In <?php /*include 'numcart.php'; */?></i>
						</li>
					</ul>
					<span class="navbar-text"></span>
				</div>
			</div>
		</nav> 
		<!--
************** keeping this section in case I want to put it back on the main nav-bar ***/
			  <form class="form-inline" action="searchres.php" method="post">
    <label>Search:</label>
    <input type="text" name="query" class="fas fa-search" placeholder="Search"/>
    <input type="submit" name="submit" value="Search! "/>
*****************************************************************************************
</form> -->
	</header>
	<!-- end of menu sections 

	<!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) 
	<script src="js/jquery-3.2.1.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed 
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap-4.1.3.js"></script> -->
</body>
</html>