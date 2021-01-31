<?php 

// Include the code that contains shopping cart's functions
include_once("cartFunctions.php");

// Check if user logged in 
if (! isset($_SESSION["ShopperID"])) {
	// redirect to login page if the session variable shopperid is not set
	header ("Location: login.php");
	exit;
}

$MainContent = "<div id='myShopCart' style='margin:auto'>";

if (isset($_SESSION["Cart"])) {
	include_once("mysql_conn.php");
	// To Do 1 (Practical 4): 
	// Retrieve from database and display shopping cart in a table
	$qry = "SELECT *, (Price*Quantity) AS Total FROM ShopCartItem WHERE ShopCartID=?";
	$stmt = $conn->prepare($qry);
	$stmt->bind_param("i", $_SESSION["Cart"]); // "i" - integer
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	
	if ($result->num_rows > 0) {
		// To Do 2 (Practical 4): Format and display 
		// the page header and header row of shopping cart page
		$MainContent .= "<p class='page-title' style='text-align:center'>Shopping Cart</p>"; 
		$MainContent .= "<div class='table-responsive' >";
		$MainContent .= "<table class='table table-hover'>";
		$MainContent .= "<thead class='cart-header'>";
		$MainContent .= "<tr>";
		$MainContent .= "<th width='250px'>Item</th>";
		$MainContent .= "<th width='90px'>Price (S$)</th>";
		$MainContent .= "<th width='60px'>Quantity</th>";
		$MainContent .= "<th width='120px'>Total (S$)</th>";
		$MainContent .= "<th>&nbsp;</th>";
		$MainContent .= "</tr>";
		$MainContent .= "</thead>";
	
		// To Do 5 (Practical 5):
		// Declare an array to store the shopping cart items in session variable 
		$_SESSION["Items"] = array();
		
		// To Do 3 (Practical 4): 
		// Display the shopping cart content
		$subTotal = 0; // Declare a variable to compute subtotal before tax
		$totalItem = 0; // Declare a variable to compute subtotal before tax
		$MainContent .= "<tbody>";

		while ($row = $result->fetch_array()) {

			// Production Information
			$MainContent .= "<tr>";
			$MainContent .= "<td style='width:50%'>";
			// Obtain image name from DB to display
			$imageQry = "SELECT ProductImage FROM product WHERE ProductID=?";
			$stmt = $conn->prepare($imageQry);
			$stmt->bind_param("i", $row['ProductID']); 
			$stmt->execute();
			$imageResult = $stmt->get_result();
			$stmt->close();
			$imageName = "";
			while ($imageRow = $imageResult->fetch_array()) {
				$imageName = $imageRow['ProductImage'];
			}
			$MainContent .= "<img src='Images/Products/" . $imageName . 
							"' style='max-width:120px; max-height:120px; '/> <br/>";
			// Display remaining product information
			$MainContent .= $row["Name"] ."<br />";
			$MainContent .= "Product ID: " . $row["ProductID"] . "</td>";
			$MainContent .= "<td>" . number_format($row["Price"], 2) . "</td>";
			
			
			// Quantity Management
			$MainContent .= "<td>";		
			$MainContent .= "<form action='cartFunctions.php' method='post'>";
			// Obtain the maximum quantity
			$maxQty = 0;
			$qtyQuery = "SELECT Quantity FROM product WHERE ProductID=?";
			$stmt = $conn->prepare($qtyQuery);
			$stmt->bind_param("i", $row['ProductID']);
			$stmt->execute();
			$qtyQueryResult = $stmt->get_result();
			$stmt->close();
			while ($qtyQueryRow = $qtyQueryResult->fetch_array()) {
				$maxQty = $qtyQueryRow['Quantity'];
			}
			// Textbox with +/- capabilities for quantity (restricted between 1 and quantity available)
			
			$MainContent .= "<input name='quantity' id='sc_quantity_". $row['ProductID']. "' " .
							"value='" . $row['Quantity'] . "' " .
							"onChange='this.value= (Math.max(1, Math.min( " . $maxQty. 
									   ", this.value)) || " . $row['Quantity']. "); this.form.submit();' />";
			$MainContent .= "<button onClick='document.getElementById(\"sc_quantity_" . $row['ProductID']. "\").value = Math.max(1, " . $row['Quantity'] ." - 1)'>-</button>";
			$MainContent .= "<button onClick='document.getElementById(\"sc_quantity_" . $row['ProductID']. "\").value = Math.min(" . $maxQty . ", " . $row['Quantity'] ." + 1)'>+</button>";
			// End of textbox with +/- capabilities
			$deliveryValue = "";
			if (isset($_GET['delivery'])) $deliveryValue = $_GET['delivery'];
			$MainContent .= "<input type='hidden' name='delivery' value='" . $deliveryValue . "' />";
			$MainContent .= "<input type='hidden' name='action' value='update' />";
			$MainContent .= "<input type='hidden' name='product_id' value='$row[ProductID]' />";
			$MainContent .= "</form>";
			
			// Price for this product
			$MainContent .= "</td>";
			$formattedTotal = number_format($row["Total"], 2) ;
			$MainContent .= "<td>$formattedTotal</td>";
			
			// Remove Item
			$MainContent .= "<td>";
			$MainContent .= "<form action='cartFunctions.php' method='post'>";
			$MainContent .= "<input type='hidden' name='action' value='remove' />";
			$MainContent .= "<input type='hidden' name='product_id' value='$row[ProductID]' />";
			$MainContent .= "<input type='image' src='images/trash-can.png' title='Remove Item' />";
			$MainContent .= "</form>";
			$MainContent .= "</td>";
			$MainContent .= "</tr>";
			
			// To Do 6 (Practical 5):
		    // Store the shopping cart items in session variable as an associate array
			$_SESSION["Items"][] = array("productId"=>$row["ProductID"],
										"name"=>$row["Name"],
										"price"=>$row["Price"],
										"quantity"=>$row["Quantity"]);
			// Accumulate the running sub-total
			$subTotal += $row["Total"];
			$totalItem += $row["Quantity"];
		}
		$MainContent .= "</tbody>";
		$MainContent .= "</table>";
		$MainContent .= "</div>";
				
		// Delivery options
		$isNormalDelivery = "";
		$isExpressDelivery = "";
		if (isset($_GET['delivery']) && $_GET['delivery'] == 'normal') $isNormalDelivery = "checked";
		if (isset($_GET['delivery']) && $_GET['delivery'] == 'express') $isExpressDelivery = "checked";

		$MainContent .= "<p style='text-align:Left'>Delivery Mode:</p>";
		$MainContent .= "<form method='post' action='checkoutProcess.php'>";
		$MainContent .= "<input type='radio' name='Delivery' value='5.00' required='required' " .
						$isNormalDelivery . " onClick='window.location.href=\"shoppingCart.php?delivery=normal\"'/>";  
		$MainContent .= "Normal Delivery - $5 delivery fee, deliver within 2 working days.";
		$MainContent .= "<br>";
		$MainContent .= "<input type='radio' name='Delivery' value='10.00' required='required' " .
						$isExpressDelivery . " onClick='window.location.href=\"shoppingCart.php?delivery=express\"'/>";  
		$MainContent .= "Express Delivery - $10  delivery fee, deliver within 24 hours.";
		
		
		//$MainContent .="<input type='submit' name='submit' value='Submit'>";
		//$MainContent .= "<p id='display' style='text-align:Left'>Delivery fee is: </p>";
		//$MainContent .= "<p id='normal' style='text-align:Left; display:none'>Delivery fee is: $5</p>";
		//$MainContent .= "<p id='express' style='text-align:Left; display:none'>Delivery fee is: $10</p>";

		// Update delivery cost and its display value
		$deliveryCost = 0.0;
		if (!isset($_GET['delivery'])) {
			$deliveryCostString = "-"; 		
		} else if ($_GET['delivery'] == 'normal') {
			$deliveryCost = 5.00;
			$deliveryCostString = 'S$5.00';
		} else if ($_GET['delivery'] == 'express') {
			$deliveryCost = 10.00;
			$deliveryCostString = 'S$10.00';
		}
		// Waiving if subTotal of items only hits a certain amount
		if ($deliveryCost > 0.0 && $subTotal >= 200.00) {
			$deliveryCost = 0.0;
			$deliveryCostString .= ' (waived)';
		}
		$subTotal += $deliveryCost;

		// To Do 4 (Practical 4): 
		// Display delivery cost
		$MainContent .= "<p style='text-align:right; font-size:15px'> Delivery Cost: " . 
						$deliveryCostString . "</p>";
		
		// Display the subtotal at the end of the shopping cart
		$MainContent .= "<p style='text-align:right; font-size:15px'>Subtotal (incl. Delivery): S$" . 
					    number_format($subTotal, 2) . "</p>";
		
		$MainContent .= "<p style='text-align:right; font-size:15px'> Total Item(s): " . 
						number_format($totalItem) . "</p>";

		// Update final subtotal and total items for checkout
		$_SESSION["SubTotal"] = round($subTotal, 2);
		$_SESSION["Total Item"] = $totalItem;

		// To Do 7 (Practical 5):
		// Add PayPal Checkout button on the shopping cart page
		$MainContent .= "<br/><br/>";
		$MainContent .= "<input src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' type='image' style='float:right' />";
		$MainContent .= "</form></p>";		
	} 
		
	
	else {
		$MainContent .= "<h3 style='text-align:center; color:blue;'>Your Shopping Cart is Empty!</h3>";
		$MainContent .= "<p style='text-align: center; color:blue; padding-top:50px;'><a href='category.php'>Continue Shopping</a></p>";

	}
	$conn->close(); // Close database connection
}

$MainContent .= "</div>";
include("MasterTemplate.php");	
?>