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
	    
	    if(!isset($_SESSION['username'])){
	        header("Location: login");
	    }
	    
	    $failed_form = false;
	    $orderid = htmlspecialchars($_POST['orderid']);
	    $productname = htmlspecialchars($_POST['productname']);
	    $quantity = htmlspecialchars($_POST['quantity']);
	    $price = htmlspecialchars($_POST['price']);

	    $option = $_POST['optionbtn'];
	    
	    if($price == "Total Price"){
	        addOrderData($orderid,$productname,$quantity,$conn);
	        $failed_form = true;
	    }
	    
	    if($option == "Remove"){
	        removeOrderData($orderid,$productname,$quantity,$price,$conn);
	        $failed_form = true;
	    }
	    
	    if(!$failed_form && $productname != ""){
			updateOrderData($orderid,$productname,$quantity,$price,$conn);
		}
	?>
	<!-- Header -->
	<header id="home_showtables">
	
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
						<a href="index">
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
                    				<li><a href="logout" style="color: darkgrey;">Logout</a></li>
                    				<li><a href="index#home">Home</a></li>
                    				<li class="has-dropdown"><a href="#">Database</a>
                            			<ul class="dropdown">
                            				<li><a href="inventory">Inventory</a></li>
                    				        <li><a href="customers">Customers</a></li>
                    				        <li><a href="transactions">Transactions</a></li>
                    				        <li><a href="order_details">Orders</a></li>
                            			</ul>
                    			    </li>
                    				<li class="has-dropdown"><a href="admin/cpanel">Admin cPanel</a>
                            			<ul class="dropdown">
                            				<li><a href="admin/new-register">Add User</a></li>
                            				<li><a href="admin/remove-user">Remove User</a></li>
                            			</ul>
                    			    </li>
                		    	</ul>';
    				}
    				else if(isset($_SESSION['username']) && $_SESSION['clearance'] == "employee"){
    				    echo '<ul class="main-nav nav navbar-nav navbar-right">
                				    <li><a href="logout" style="color: darkgrey;">Logout</a></li>
                    				<li><a href="index#home">Home</a></li>
                    				<li class="has-dropdown"><a href="#">Database</a>
                            			<ul class="dropdown">
                            				<li><a href="inventory">Inventory</a></li>
                    				        <li><a href="customers">Customers</a></li>
                    				        <li><a href="transactions">Transactions</a></li>
                    				        <li><a href="order_details">Orders</a></li>
                            			</ul>
                    			    </li>
                				</ul>';
    				}
    				else{
    				    echo '<ul class="main-nav nav navbar-nav navbar-right">
                				    <li><a href="login">Login</a></li>
                				    <li><a href="index#home">Home</a></li>
                				</ul>';
    				}
					?>
				<!-- /Main navigation -->
			</div>
		</nav>
		<!-- /Nav -->

	</header>
	<!-- /Header -->
	
	<!-- SECTION 2 -->
		<div id="section1" class="section md-padding">
			
			<!-- Container -->
			<div class="container" style="background-color: white;">

				<!-- Row -->
				<div class="row">

					<!-- Section header -->
					<div class="section-header text-center">
						<h2 class="title">Orders</h2>
					</div>
					<!-- /Section header -->

					<!-- Section 2 -->
					<div id="registered-showcase" style="text-align: center;">	
					<?php
    					$dbc = new DatabaseCommands;
    					$result = $dbc->callDBWhere("order_details",$orderid,$conn);
    					
    					// Create Table
    					echo '
                            <table class="fixed_header" style="margin: auto;border: solid black 2px;>';
                            
                            if($_SESSION['clearance'] != ""){
                                echo '
                                <tr style="text-align: center;">
                                    <form method="post" action="order_details_depth">
                                        <td style="border: solid black 2px;padding: 5px;">
                                        <input type="text" size="35" value="'.$orderid.'" name="orderid" readonly/>
                                        </td>
                                        <td style="border: solid black 2px;padding: 5px;">
                                        <input size="35" type="text" placeholder="ProductID" name="productname"/>
                                        </td>
                                        <td style="border: solid black 2px;padding: 5px;">
                                        <input size="15" type="text" placeholder="Quantity" name="quantity"/>
                                        </td>
                                        <td style="border: solid black 2px;padding: 5px;">
                                        <input style="color: black;font-weight: bold;" size="50" type="text" value="Total Price" name="price" readonly/>
                                        </td>
                                        <td style="padding: 5px;border: solid black 2px;">
                                        <input class="btn" type="submit" value ="Add"></input>
                                        </td>
                                    </form>
                                </tr>';
                            }
                            
                            echo '
                            <tr style="text-align: center;border: solid black 2px;">
                            <th width="150px" style="background-color: lightgrey;border: solid black 2px;padding: 5px;text-align: center;">Order ID</th>
                            <th style="background-color: lightgrey;border: solid black 2px;padding: 5px;text-align: center;">Product Name</th>
                            <th style="background-color: lightgrey;border: solid black 2px;padding: 5px;text-align: center;">Quantity</th>
                            <th style="background-color: lightgrey;border: solid black 2px;padding: 5px;text-align: center;">Price</th>

                            <td style="padding: 5px"></td>
                            </tr>
                            ';
                            
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo '
                                <tr style="text-align: center;border: solid black 2px;">
                                    <form method="post" action="order_details_depth">
                                        <td style="border: solid black 2px;padding: 5px;">
                                            <input size="3" type="text" value="'.$row["order_id"].'" name="orderid" readonly/>
                                        </td>
                                        <td style="border: solid black 2px;padding: 5px;">
                                            <input size="50" type="text" value="'.$row["product_name"].'" name="productname" readonly/>
                                        </td>
                                        <td style="border: solid black 2px;padding: 5px;">
                                            <input size="15" type="text" value="'.$row["quantity"].'" name="quantity"/>
                                        </td>
                                        <td style="border: solid black 2px;padding: 5px;">
                                            <input size="20" type="text" value="'.$row["price"].'" name="price" readonly/>
                                        </td>
                                        <td style="padding: 5px;border: solid black 2px;">
                                            <input class="btn" type="submit" value ="Update" name="optionbtn"></input>
                                        </td>';
                                        if($_SESSION['clearance'] == "admin"){
                                            echo '
                                            <td style="padding: 5px;border: solid black 2px;">
                                                <input class="btn" type="submit" value ="Remove" name="optionbtn"></input>
                                            </td>
                                            ';
                                        }
                                    echo '
                                    </form>
                                </tr>';
                            }
                            echo '</table>';
    				?>
	                <!-- /Section 2 -->
	                
				</div>
				<!-- /Row -->

			</div>

		</div>
		<!-- /SECTION 2 -->


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
