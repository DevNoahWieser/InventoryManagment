<?php
    // In Case of Emergency
    // echo "Error: " . $sql . "<br>" . $conn->error;
    
    // Setup Database Connection
	$servername = "localhost";
	$username = "u481159385_yvej";
	$password = "wordpass321";
	$database = "u481159385_yvej";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);
	
	// Function to get number of query rows
	function getRows($user,$conn){
	    $stmt = $conn->query("SELECT username FROM employees WHERE username='".strtolower($user)."'");
	    $x = $stmt->num_rows;
	    return $x;
	}
	
	// Function to get User info by username
	function getUserInfo($user,$conn){
	    $stmt = $conn->query("SELECT clearance,username,password FROM employees WHERE username='".$user."'");
	    $row = $stmt->fetch_array(MYSQLI_ASSOC);
	    return $row;
	}
	
	/*
	*   ADMIN-ONLY FUNCTIONS
	*/
	
	// --- EMPLOYEES ---
	// Function to add Employee to Database
	function addEmployee($clearance,$user,$hashpass,$conn){
	    $sql = "INSERT INTO employees (clearance,username,password)
				VALUES ('$clearance','$user','$hashpass')";
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert(".$user."' has been registered!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Something went wrong!');
			</script>
			";
		}
	}
	
	// Function to remove Employee from Database
	function removeEmployee($employid,$user,$conn){
	    $sql = "DELETE FROM employees
				WHERE employ_id = ".$employid."";
				
				echo "
			    <script type='text/javascript'>
			        alert(".$employid.$user.");
			    </script>
			";
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert(".$user."' has been removed!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Something went wrong!');
			</script>
			";
		}
	}
	
	// --- INVENTORY ---
	// Function to add Inventory to Database
	function addInventory($productname,$description,$quantity,$price,$conn){
	    $sql = "INSERT INTO inventory (product_name,description,quantity,price)
				VALUES ('$productname','$description','$quantity','$price')";
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Item ".$productname." has been registered!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Failed to add customer\nPlease check your inputs!');
			</script>
			";
		}
	}
	
	// Function to remove Inventory from Database
	function removeInventory($productid,$productname,$conn){
	    $sql = "DELETE FROM inventory
	            WHERE product_id = '".$productid."'";
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Item ".$productname." has been removed!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Tried to remove item that does not exist!');
			</script>
			";
		}
	}
	
	// --- CUSTOMER ---
	// Function to add Customer to Database
	function addCustomer($firstname,$lastname,$phone,$email,$conn){
	    $sql = "INSERT INTO customers (first_name,last_name,phone,email)
				VALUES ('$firstname','$lastname','$phone','$email')";
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Customer ".$firstname." ".$lastname." has been registered!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Failed to add customer\nPlease check your inputs!');
			</script>
			";
		}
	}
	
	// Function to remove Customer from Database
	function removeCustomer($custid,$firstname,$lastname,$conn){
	    $sql = "DELETE FROM customers
	            WHERE cust_id = '".$custid."'";
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Customer ".$firstname." ".$lastname." has been removed!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Tried to remove customer that does not exist');
			</script>
			";
		}
	}
	
	// --- ORDER ---
	// Function to add Order Data to Database
	function addOrderData($orderid,$productname,$quantity,$conn){
	    $sqlcheck = "SELECT * FROM inventory
	                WHERE product_id = '".$productname."'"; // Product name is still productID
	                
	    if($conn->query($sqlcheck) != false){
	            $result = $conn->query($sqlcheck);
	            $row = $result->fetch_assoc();
	        
	            $productname = $row['product_name']; // ProductID is now Product Name
	            $price = $row['price'] * $quantity;
            			
            	// Get item quantity
            	$stockquantitysql = 'SELECT quantity FROM inventory WHERE product_name = "'.$productname.'"';
            	$stockquantityresult = $conn->query($stockquantitysql);
            	$stockquantity = $stockquantityresult->fetch_assoc();
	            
	            // Remove stock quantity
	            $quantitypass = true;
	            $newquantity = $stockquantity['quantity'] - $quantity;
	            
	            if($newquantity < 0){ // Reset and fail order if stock runs out
	                $newquantity = $stockquantity['quantity'];
	                $quantitypass = false;
	            }
	            
	            $updatestock = 'UPDATE inventory
	                            SET quantity = "'.$newquantity.'"
	                            WHERE product_name = "'.$productname.'"';
	            
	            if($conn->query($updatestock) === true && $quantitypass){
    	            $sql = "INSERT INTO order_details (order_id,product_name,quantity,price)
    				VALUES ('$orderid','$productname','$quantity','$price')";
    				
            		if($conn->query($sql) === true){
            			echo "
            			<script type='text/javascript'>
            			    alert('Order has been registered!');
            			</script>
            			";
            		} else {
            		    echo "
            			<script type='text/javascript'>
            			    alert('Failed to add order\nPlease check your inputs!');
            			</script>
            			";
            		}
	            } else {
	                echo '
            			<script type="text/javascript">
            			    alert("Failed to add order\nNot enough Stock!");
            			</script>
            			';
	            }
	   } else {
	       echo "
		   <script type='text/javascript'>
		       alert('Product doesn't exist\nCheck your Product ID, then try again.');
		   </script>
		   ";
	   }
	}
	
	// Function to remove Order Data from Database
	function removeOrderData($orderid,$productname,$quantity,$price,$conn){
	    $sql = "DELETE FROM order_details
	            WHERE order_id = '".$orderid."'
	            and product_name = '".$productname."'
	            and quantity = '".$quantity."'
	            and price = '".$price."'";
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Item(s) from Order #".$orderid." has been removed!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Tried to remove order data that doesn't exist);
			</script>
			";
		}
	}
	
	// --- TRANSACTIONS ---
	// Function to add Transaction to Database
	function addTransaction($custid,$datepaid,$conn){
	    $sql = "INSERT INTO transactions (cust_id,date_paid)
				VALUES ('$custid','$datepaid')";
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Transaction has been registered!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Failed to add Transaction\nPlease check your inputs!');
			</script>
			";
		}
	}
	
	// Function to remove Transaction from Database
	function removeTransaction($transid,$conn){
	    $sql = "DELETE FROM transactions
	            WHERE trans_id = '".$transid."'";
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Transaction #".$transid." has been removed!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Tried to remove transaction that does not exist');
			</script>
			";
		}
	}
	
	/*
	*   ALL-USE FUNCTIONS
	*/
	
	// Updates inventory
	function updateInventory($productid,$productname,$description,$quantity,$price,$conn){
	    if($productid == ""){
	        return null;
	    }
	    
	    $sql = 'UPDATE inventory SET
	    product_name = "'.$productname.'",
	    description = "'.$description.'",
	    quantity = "'.$quantity.'",
	    price = "'.$price.'"
	    WHERE product_id = "'.$productid.'"';
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Inventory Updated!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Failed to update\nPlease check your inputs!');
			</script>
			";
		}
	}
	
	function updateCustomer($custid,$firstname,$lastname,$phone,$email,$conn){
	    if($custid == ""){
	        return null;
	    }
	    
	    $sql = 'UPDATE customers SET
	    first_name = "'.$firstname.'",
	    last_name = "'.$lastname.'",
	    phone = "'.$phone.'",
	    email = "'.$email.'"
	    WHERE cust_id = "'.$custid.'"';
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Customer Updated!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Failed to update\nPlease check your inputs!');
			</script>
			";
		}
	}
	
	function updateTransaction($transid,$datepaid,$conn){
	    if($transid == ""){
	        return null;
	    }
	    
	    $sql = 'UPDATE transactions SET
	    date_paid = "'.$datepaid.'"
	    WHERE trans_id = "'.$transid.'"';
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Transaction Updated!');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Failed to update\nPlease check your inputs!');
			</script>
			";
		}
	}
	
	function updateOrderData($orderid,$productname,$quantity,$price,$conn){
	    if($orderid == ""){
	        return null;
	    }
	    
	    $sql = 'UPDATE order_details SET
	    quantity = "'.$quantity.'",
	    price = "'.$price.'"
	    WHERE order_id = "'.$orderid.'"
	    and product_name = "'.$productname.'"';
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Order Data Updated');
			</script>
			";
		} else {
			echo "
			<script type='text/javascript'>
			    alert('Failed to update\nPlease check your inputs!');
			</script>
			";
		}
	}
	function updateOrderStatus($orderid,$status,$conn){
	    if($status == "COMPLETE"){
	        $status = "INCOMPLETE";
	    }
	    else{
	        $status = "COMPLETE";
	    }
	    
	    $sql = 'UPDATE orders SET
	    status = "'.$status.'"
	    WHERE order_id = "'.$orderid.'"';
				
		if($conn->query($sql) === true){
		    //Do Nothing
		}
	}    
	class DatabaseCommands{
	    function callDB($call,$conn){
	        $sql = "SELECT * FROM ".$call;
	        $result = $conn->query($sql);
	        
	        return $result;
	    }
	}
?>