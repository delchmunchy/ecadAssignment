<?php
// Detect the current session
session_start();

// Include the PHP file that establishes database connection handle: $conn
include_once("mysql_conn.php");

// Reading inputs entered in previous page
$email = $_POST["email"];
$pwd = $_POST["password"];

// To Do 1 (Practical 2): Validate login credentials with database
$qry = "SELECT * FROM Shopper WHERE Email = '$email'";
$result = $conn->query($qry); // Execute the SQL and get the returned result

if ($result->num_rows > 0) { // SQL statement executed successfully	
	while ($row = $result->fetch_array()) {
	  if($row["Password"] == $pwd){
		$_SESSION['ShopperName'] = $row["Name"];
		$_SESSION["ShopperID"] = $row["ShopperID"];
		//Practical 4: Get Active Shopping Cart
		$shopCartqry = "SELECT ShopCartID FROM ShopCart WHERE ShopperID=? AND OrderPlaced=0";
		$stmt = $conn->prepare($shopCartqry);
		$stmt->bind_param("i", $_SESSION["ShopperID"]); // "i" - integer
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		$row = $result->fetch_array();
		$_SESSION["Cart"] = $row["ShopCartID"];
		$getShopCartItemCountqry = "SELECT COUNT(*) AS total FROM ShopCartItem WHERE ShopCartID=?";
		$fetchqry = $conn->prepare($getShopCartItemCountqry);
		$fetchqry->bind_param("i", $_SESSION["Cart"]); // "i" - integer
		$fetchqry->execute();
		$result = $fetchqry->get_result();
		$fetchqry->close();
		$row = $result->fetch_array();
		$_SESSION["NumCartItem"] = $row['total'];
		// Redirect to home page
		header("Location: index.php");
		exit;
	  } else {
		$MainContent = "<h3 style='color:red'>You have entered a wrong password!</h3>";
	  }
	}
} else {
	$MainContent = "<h3 style='color:red'>You have entered a wrong email credentials!</h3>";
}

 // Close database connection
 $conn->close();
 // Include the master template file for this page
 include("MasterTemplate.php");

?>