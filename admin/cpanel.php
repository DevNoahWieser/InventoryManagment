<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Inventory Management</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" />

	<!-- Owl Carousel -->
	<link type="text/css" rel="stylesheet" href="../css/owl.carousel.css" />
	<link type="text/css" rel="stylesheet" href="../css/owl.theme.default.css" />

	<!-- Magnific Popup -->
	<link type="text/css" rel="stylesheet" href="../css/magnific-popup.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="../css/style.css" />
</head>

<body>
	<?php
	    include("../required_items/config.php");
	    session_start();
	    
	    if($_SESSION['clearance'] != 'admin'){
	        header("Location: ../login");
	    }
	?>
	<!-- Header -->
	<header id="home">
	
		<!-- Background Image -->
		<div class="bg-img" style="background-image: url('../img/background1.jpg');">
			<div class="overlay"></div>
		</div>
		<!-- /Background Image -->

		<!-- Nav -->
		<nav id="nav" class="navbar nav-transparent">
			<div class="container">
				<div class="navbar-header">
				
					<!-- Logo -->
					<div class="navbar-brand">
						<a href="../index.php">
							<img class="logo" src="../img/logo.png" alt="logo">
							<img class="logo-alt" src="../img/logo-alt.png" alt="logo">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Collapse nav button -->
					<div class="nav-collapse">
						<span></span>
					</div>
					<!-- /Collapse nav button -->
				</div>

                <!--  Main navigation  -->
				<?php
                    if(isset($_SESSION['username']) && $_SESSION['clearance'] == "admin"){
    					echo '<ul class="main-nav nav navbar-nav navbar-right">
                    				<li><a href="../logout" style="color: darkgrey;">Logout</a></li>
                    				<li><a href="../index#home">Home</a></li>
                    				<li class="has-dropdown"><a href="#">Database</a>
                            			<ul class="dropdown">
                            				<li><a href="../inventory">Inventory</a></li>
                    				        <li><a href="../customers">Customers</a></li>
                    				        <li><a href="../transactions">Transactions</a></li>
                    				        <li><a href="../order_details">Orders</a></li>
                            			</ul>
                    			    </li>
                    				<li class="has-dropdown"><a href="cpanel">Admin cPanel</a>
                            			<ul class="dropdown">
                            				<li><a href="new-register">Add User</a></li>
                            				<li><a href="remove-user">Remove User</a></li>
                            			</ul>
                    			    </li>
                		    	</ul>';
    				}
    				else if(isset($_SESSION['username']) && $_SESSION['clearance'] == "employee"){
    				    echo '<ul class="main-nav nav navbar-nav navbar-right">
                				    <li><a href="../logout" style="color: darkgrey;">Logout</a></li>
                    				<li><a href="../index#home">Home</a></li>
                    				<li class="has-dropdown"><a href="#">Database</a>
                            			<ul class="dropdown">
                            				<li><a href="../inventory">Inventory</a></li>
                    				        <li><a href="../customers">Customers</a></li>
                    				        <li><a href="../transactions">Transactions</a></li>
                    				        <li><a href="../order_details">Orders</a></li>
                            			</ul>
                    			    </li>
                				</ul>';
    				}
    				else{
    				    echo '<ul class="main-nav nav navbar-nav navbar-right">
                				    <li><a href="../login">Login</a></li>
                				    <li><a href="../index#home">Home</a></li>
                				</ul>';
    				}
					?>
				<!-- /Main navigation -->
				
			</div>
		</nav>
		<!-- /Nav -->
		
		<!-- SECTION 1 -->
    	<div id="section1" class="section md-padding">
    
    		<!-- Container -->
    		<div class="container">
    
    			<!-- Row -->
    			<div class="row" style="margin-top: -100px;">
    
    			    <!-- Section 1 -->
    			    <h2 style="color: white;background-color: black;border: solid white 1px;padding: 5px;">Admin cPanel</h2>
    			    <div style="margin-left: 10px;display-inline">
        			    <a href="new-register.php"><button style="width: 25%;">Add a User</button></p>
        			    <a href="remove-user.php"><button style="width: 25%;">Remove a User</button></p>
        			</div>
    				<!-- /Section 1 -->
    
    		    </div>
    			<!-- /Row -->
    
    		</div>
    		<!-- /Container -->
    
    	</div>
    	<!-- /SECTION 1 -->

	</header>
	<!-- /Header -->

	<!-- Footer -->
	<footer id="footer" class="sm-padding bg-dark">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<div class="col-md-12">

					<!-- footer logo -->
					<div class="footer-logo">
						<a href="../index.php"><img src="../img/logo-alt.png" alt="logo"></a>
					</div>
					<!-- /footer logo -->

					<!-- footer copyright -->
					<div class="footer-copyright">
						<p>Copyright © 2017. All Rights Reserved. Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
					</div>
					<!-- /footer copyright -->

				</div>

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</footer>
	<!-- /Footer -->

	<!-- Back to top -->
	<div id="back-to-top"></div>
	<!-- /Back to top -->

	<!-- Preloader -->
	<div id="preloader">
		<div class="preloader">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<!-- /Preloader -->

	<!-- jQuery Plugins -->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="../js/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>

</body>

</html>