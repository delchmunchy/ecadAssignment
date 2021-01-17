<?php
// Detect the current session
session_start();

// Reading inputs entered in previous page
$email = $_POST["email"];
$pwd = $_POST["password"];

//Include the PHP file that establishes database connection handle: $conn
include_once("mysql_conn.php");

$qry = "SELECT * FROM shopper WHERE Email LIKE '$email' && Password LIKE '$pwd'"; //query to search if the details match the one in the database

$result1 = $conn->query($qry); //starting the query
$MainContent.= "memem";
//echo '<pre>'; print_r($result1); echo '</pre>';
// To Do 1 (Practical 2): Validate login credentials with database
if ($result1->num_rows > 0) { // If found, display records
	$row1 = $result1->fetch_array();
	//Get the hashed password from database
	$hashed_pw = $row1["Password"];
echo "elele";
	//Verifies that a password matches a hash
    if (password_verify($pwd, $hashed_pw) == true)  {
		//Saves the Name and ShopperID from the user with the matching email&password from the DB into the session
		$_SESSION["ShopperName"] = $row["Name"];
		$_SESSION["ShopperID"] = $row["ShopperID"];
		
		// To Do 2 (Practical 4): Get active shopping cart
		$qry = "SELECT sc.ShopCartID FROM Shopcart sc
				INNER JOIN ShopCartItem sci ON sc.ShopCartID=sci.ShopCartID
				WHERE sc.ShopperID=$_SESSION[ShopperID] AND sc.OrderPlaced=0";
		$stmt= $conn->prepare($qry);
		$stmt->bind_param("i",$_SESSION["ShopperID"]); //"i" - integer
		$stmt->execute();
		$result2 = $stmt->get_result();
		$stmt->close();
		if ($result2->num_rows > 0) {
			$row2 = $result2->fetch_array();
			$_SESSION["Cart"] = $row2["ShopCartID"];
			$_SESSION["NumCartItem"] = $result2->num_rows;
		}
		// Redirect to home page
		echo "lala";
		header("Location: index.php");
		exit;
	} else {
		$MainContent = "<h3 style='color:red'>You have entered a wrong password!</h3>";
  	}	
}
else {
	$MainContent = "<h3 style='color:red'>Invalid Login Credentials - <br /> password is incorrect!</h3>";
}
// Close database connection
 $conn->close();
include("MasterTemplate.php");
?>