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
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Owl Carousel -->
	<link type="text/css" rel="stylesheet" href="css/owl.carousel.css" />
	<link type="text/css" rel="stylesheet" href="css/owl.theme.default.css" />

	<!-- Magnific Popup -->
	<link type="text/css" rel="stylesheet" href="css/magnific-popup.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
</head>


<!--
---------------------------------------------------------------------------------------------

	Focus BELOW Here
	
---------------------------------------------------------------------------------------------
-->


<body>
	<?php
		include("required_items/config.php");
	    session_start();
	?>
	<!-- Header -->
	<header id="home">
	
		<!-- Background Image -->
		<div class="bg-img" style="background-image: url('./img/background1.jpg');">
			<div class="overlay"></div>
		</div>
		<!-- /Background Image -->

		<!-- Nav -->
		<nav id="nav" class="navbar nav-transparent">
			<div class="container">
				<div class="navbar-header">
				
					<!-- Logo -->
					<div class="navbar-brand">
						<a href="index.php">
							<img class="logo" src="img/logo.png" alt="logo">
							<img class="logo-alt" src="img/logo-alt.png" alt="logo">
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
                    				<li><a href="logout.php" style="color: darkgrey;">Logout</a></li>
                    				<li><a href="#">Admin CPanel</a></li>
                    				<li><a href="index.php#home">Home</a></li>
                    				<li><a href="inventory.php">Inventory</a></li>
                    				<li class="has-dropdown"><a href="#">Other</a>
                            			<ul class="dropdown">
                            				<li><a href="#">Misc</a></li>
                            			</ul>
                    			    </li>
                		    	</ul>';
    				}
    				else if(isset($_SESSION['username']) && $_SESSION['clearance'] == "employee"){
    				    echo '<ul class="main-nav nav navbar-nav navbar-right">
                				    <li><a href="logout.php" style="color: darkgrey;">Logout</a></li>
                				    <li><a href="index.php#home">Home</a></li>
                					<li><a href="inventory.php">Inventory</a></li>
                					<li class="has-dropdown"><a href="#">Other</a>
                        				<ul class="dropdown">
                        					<li><a href="none.php">Misc</a></li>
                        				</ul>
                				    </li>
                				</ul>';
    				}
    				else{
    				    echo '<ul class="main-nav nav navbar-nav navbar-right">
                				    <li><a href="login.php">Login</a></li>
                				    <li><a href="index.php#home">Home</a></li>
                					<li class="has-dropdown"><a href="#">Other</a>
                        				<ul class="dropdown">
                        					<li><a href="none.php">Misc</a></li>
                        				</ul>
                				    </li>
                				</ul>';
    				}
					?>
				<!-- /Main navigation -->
			</div>
		</nav>
		<!-- /Nav -->

		<!-- home wrapper -->
		<div class="home-wrapper">
			<div class="container">
				<div class="row">

                    <!-- home content -->
                    <?php
                    if(isset($_SESSION['username'])){
    					echo '<div class="col-md-10 col-md-offset-1">
        						<div class="home-content">
        							<h1 class="white-text">Inventory Management:'.$_SESSION['clearance'].'</h1>
        							<p class="white-text">
        								<a href="inventory.php">Enter Inventory</a>
        							</p>
        						</div>
        					</div>';
    				}
    				else{
    				    echo '<div class="col-md-10 col-md-offset-1">
        						<div class="home-content">
        							<h1 class="white-text">Inventory Management</h1>
        							<p class="white-text">
        								<a href="login.php">Login to View Inventory</a>
        							</p>
        						</div>
        					</div>';
    				}
					?>
					<!-- /home content -->
					
				</div>
			</div>
		</div>
		<!-- /home wrapper -->

	</header>
	<!-- /Header -->
	
	<!-- SECTION 1 -->
	<div id="section1" class="section md-padding">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- Section header -->
				 <?php
                    if(isset($_SESSION['username'])){
				        echo '<div class="section-header text-center">
					            <h2 class="title">Inventory Stats</h2>
				            </div>';
                    }
				?>
				<!-- /Section header -->

				<!-- Section 1 -->
				<div id="registered-showcase" style="text-align: center;">
				<?php
                    if(isset($_SESSION['username'])){
				        echo '<p>Display Content Here</p>';
                    }
                    else{
                        echo '<p>Please login to view</p>';
                    }
                ?>
					<?php
						/*$stmt = $conn->query("SELECT username FROM employees");
						$i = 0;
						while($row = $stmt->fetch_array(MYSQLI_ASSOC)) {
							$current_user = $row['username'];
							if($row['username'] != ""){
								if($i%5 == 0){
								    echo '<div class="row">';
									//echo '<tr>';
								}
								
								echo '<div class="col-md-2">';
								//echo '<th style="text-align: center;">';
								echo $row['username'];
								//echo '</th>';
								echo '</div>';
								
								if($i%5 == 4){
									//echo '</tr>';
									echo '</div>';
									//echo '<tr style="height: 25px;"></tr>';
								}
								$i++;
							}
						}
					*/?>
				</div>
				<!-- /Section 1 -->
				
			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /SECTION 1 -->


<!--
---------------------------------------------------------------------------------------------

	Focus ABOVE Here
	
---------------------------------------------------------------------------------------------
-->


	<!-- Footer -->
	<footer id="footer" class="sm-padding bg-dark">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<div class="col-md-12">

					<!-- footer logo -->
					<div class="footer-logo">
						<img src="./img/logo.png" alt="logo"></a>
					</div>
					<!-- /footer logo -->

					<!-- footer copyright -->
					<div class="footer-copyright">
						<p>Copyright © 2018. All Rights Reserved. Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
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
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="js/main.js"></script>

</body>

</html>
