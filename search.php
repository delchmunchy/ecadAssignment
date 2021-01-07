<?php 
// Detect the current session
session_start();

// HTML Form to collect search keyword and submit it to the same page 
// in server
$MainContent = "<div style='width:80%; margin:auto;'>"; // Container
$MainContent .= "<form name='frmSearch' method='get' action=''>";
$MainContent .= "<div class='form-group row'>"; // 1st row
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<span class='page-title'>Product Search</span>";
$MainContent .= "</div>";
$MainContent .= "</div>"; // End of 1st row
$MainContent .= "<div class='form-group row'>"; // 2nd row
$MainContent .= "<label for='keywords' 
                  class='col-sm-3 col-form-label'>Product Title:</label>";
$MainContent .= "<div class='col-sm-6'>";
$MainContent .= "<input class='form-control' name='keywords' id='keywords' 
                  type='search' />";
$MainContent .= "</div>";
$MainContent .= "<div class='col-sm-3'>";
$MainContent .= "<button type='submit' class=' btn btn-primary'>Search</button>";
$MainContent .= "</div>";
$MainContent .= "</div>";  // End of 2nd row
$MainContent .= "</form>";

// Include the PHP file that establishes database connection handle: $conn
include_once("mysql_conn.php");

// The search keyword is sent to server
if (isset($_GET['keywords'])) {
	$SearchText=$_GET["keywords"];

    // To Do (DIY): Retrieve list of product records with "ProductTitle" 
    // contains the keyword entered by shopper, and display them in a table.
    $qry = "SELECT ProductID, ProductTitle FROM product WHERE ProductTitle LIKE '%$SearchText%' OR ProductDesc LIKE '%$SearchText%' ORDER BY ProductTitle"; //Form SQL to select all categories
    $result = $conn->query($qry); //Execute SQL to get the result

    if ($result->num_rows > 0) { // If found, display records
       //Display each category in a row
        $MainContent .= "<b>Search results for $SearchText:</b></br>"; //creates search results header
        while ($row = $result->fetch_array())
        {

            $product = "productDetails.php?pid=$row[ProductID]"; //Gets variable of Book
            $MainContent .= "<a href=$product>$row[ProductTitle]</a></br>"; //Displays title of book
        }
          
    }
    else {
        $MainContent .= "<h3 style='color:red'>No records found</h3>";
    }


	// To Do (DIY): End of Code
}

$MainContent .= "</div>"; // End of Container
include("MasterTemplate.php");
?>