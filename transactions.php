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
	    $trans_id = htmlspecialchars($_POST['trans_id']);
	    $cust_id = htmlspecialchars($_POST['cust_id']);
	    $date_paid = htmlspecialchars($_POST['date_paid']);
	    
	    if($trans_id == "Add"){
	        addTransaction($cust_id,$date_paid,$conn);
	        $failed_form = true;
	    }
	    
	    if(!$failed_form){
			updateTransaction($trans_id,$date_paid,$conn);
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
						<h2 class="title">Transactions</h2>
					</div>
					<!-- /Section header -->

					<!-- Section 2 -->
					<div id="registered-showcase" style="text-align: center;">	
					<?php
    					$dbc = new DatabaseCommands;
    					$result = $dbc->callDB("transactions",$conn);
    					
    					// Create Table
            	        if ($result->num_rows > 0) {
                            echo '
                            <table class="fixed_header" style="margin: auto;border: solid black 2px;>';
                            
                            if($_SESSION['clearance'] != ""){
                                echo '
                                <tr style="text-align: center;">
                                    <form method="post" action="transactions">
                                        <td style="border: solid black 2px;padding: 5px;">
                                        <input type="text" value="Add" name="trans_id" readonly/>
                                        </td>
                                        <td style="border: solid black 2px;padding: 5px;">
                                        <input size="30" type="text" name="cust_id"/>
                                        </td>
                                        <td style="border: solid black 2px;padding: 5px;">
                                        <input size="45" type="text" name="date_paid"/>
                                        </td>
                                        <td style="padding: 5px;border: solid black 2px;">
                                        <input class="btn" type="submit" value ="Add Trans."></input>
                                        </td>
                                    </form>
                                </tr>';
                            }
                            
                            echo '
                            <tr style="text-align: center;border: solid black 2px;">
                            <th width="150px" style="background-color: lightgrey;border: solid black 2px;padding: 5px;text-align: center;">Transaction ID</th>
                            <th style="background-color: lightgrey;border: solid black 2px;padding: 5px;text-align: center;">Customer ID</th>
                            <th style="background-color: lightgrey;border: solid black 2px;padding: 5px;text-align: center;">Date Paid</th>
                            </tr>
                            ';
                            
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo '
                                <tr style="text-align: center;border: solid black 2px;">
                                    <form method="post" action="transactions">
                                        <td style="border: solid black 2px;padding: 5px;">
                                         <input size="3" type="text" value="'.$row["trans_id"].'" name="trans_id" readonly/>
                                        </td>
                                        <td style="border: solid black 2px;padding: 5px;">
                                        <input size="30" type="text" value="'.$row["cust_id"].'" name="cust_id" readonly/>
                                        </td>
                                        <td style="border: solid black 2px;padding: 5px;">
                                        <input size="45" type="text" value="'.$row["date_paid"].'" name="date_paid"/>
                                        </td>
                                        <td style="padding: 5px;border: solid black 2px;">
                                        <input class="btn" type="submit" value ="Update" name="optionbtn"></input>
                                        </td>';
                                    echo '
                                    </form>
                                </tr>';
                            }
                            echo '</table>';
                        } else {
                            echo $result;
                        }
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
