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
	
	// Function to add Employee to Database
	function addEmployee($clearance,$user,$hashpass,$conn){
	    $sql = "INSERT INTO employees (clearance,username,password)
				VALUES ('$clearance','$user','$hashpass')";
				
		if($conn->query($sql) === true){
			echo 'You have been Registered!';
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	
	// Function to add Inventory to Database
	function addInventory($productname,$description,$quantity,$price,$conn){
	    $sql = "INSERT INTO inventory (product_name,description,quantity,price)
				VALUES ('$productname','$description','$quantity','$price')";
				
		if($conn->query($sql) === true){
			echo 'Item "'.$productname.'" has been Registered!';
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	
	// Function to remove Inventory from Database
	function removeInventory($productid,$productname,$conn){
	    $sql = "DELETE FROM inventory
	            WHERE product_id = '".$productid."'";
				
		if($conn->query($sql) === true){
			echo 'Item "'.$productname.'" has been Removed!';
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	
	// Function to add Customer to Database
	function addCustomer($firstname,$lastname,$phone,$email,$conn){
	    $sql = "INSERT INTO customers (first_name,last_name,phone,email)
				VALUES ('$firstname','$lastname','$phone','$email')";
				
		if($conn->query($sql) === true){
			echo 'Customer, "'.$firstname.' '.$lastname.'" has been Registered!';
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	
	// Function to remove Customer from Database
	function removeCustomer($custid,$firstname,$lastname,$conn){
	    $sql = "DELETE FROM customers
	            WHERE cust_id = '".$custid."'";
				
		if($conn->query($sql) === true){
			echo 'Customer, "'.$firstname.' '.$lastname.'" has been Removed!';
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
			echo 'Inventory Updated!';
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
			echo 'Customer Updated!';
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