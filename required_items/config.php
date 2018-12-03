<?php
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
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	
	// Function to remove Employee from Database
	
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
			echo "Error: " . $sql . "<br>" . $conn->error;
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
			echo "Error: " . $sql . "<br>" . $conn->error;
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
			echo "Error: " . $sql . "<br>" . $conn->error;
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
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	
	// --- ORDER ---
	// Function to add Order Data to Database
	function addOrderData($orderid,$productname,$quantity,$price,$conn){
	    $sql = "INSERT INTO order_details (order_id,product_name,quantity,price)
				VALUES ('$orderid','$productname','$quantity','$price')";
				
		if($conn->query($sql) === true){
			echo "
			<script type='text/javascript'>
			    alert('Order has been registered!');
			</script>
			";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
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
			echo "Error: " . $sql . "<br>" . $conn->error;
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
			echo "Error: " . $sql . "<br>" . $conn->error;
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
			echo "Error: " . $sql . "<br>" . $conn->error;
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
			echo "Error: " . $sql . "<br>" . $conn->error;
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
			echo "Error: " . $sql . "<br>" . $conn->error;
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
			echo "Error: " . $sql . "<br>" . $conn->error;
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
			echo "Error: " . $sql . "<br>" . $conn->error;
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