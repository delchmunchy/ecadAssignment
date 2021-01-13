<?php 
// Detect the current session
session_start();

// Create a container, 60% width of viewport
$MainContent = "<div style='width:60%; margin:auto;'>";
// Display Page Header - 
// Category's name is read from query string passed from previous page.
$MainContent .= "<div class='row' style='padding:5px'>";
$MainContent .= "<div class='col-12'>";
$MainContent .= "</div>";
$MainContent .= "</div>";

// Include the PHP file that establishes database connection handle: $conn
include_once("mysql_conn.php"); 

// To Do:  Starting ....
//Form SQL to retrieve list of products associated to the Category ID
$date = date("Y-m-d");
$qry = "SELECT *
        FROM Product p WHERE p.OfferedPrice IS NOT NULL AND p.OfferEndDate > $date AND $date < p.OfferStartDate ORDER BY p.ProductTitle ASC";
$stmt = $conn->prepare($qry);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$row = $result->fetch_array();

//Display each product in a row
while ($row = $result->fetch_array())
{
    //Start a new row
    $MainContent .= "<div class='row' style='padding:5x'>";

    //Left column - display a text link showing the product's name, display the selling price in red in a new paragraph
    $product = "productDetails.php?pid=$row[ProductID]";
    $formattedPrice = number_format($row["OfferedPrice"], 2);
    $MainContent .= "<div class='col-8'>"; //67% of row width
    $MainContent .= "<p><a href=$product>$row[ProductTitle]</a></p>";
    $MainContent .= "Price:<span style='font-weight: bold; color: red;'>
                    S$ $formattedPrice</span>";
    $MainContent .= "</div>";
    
    //Right column - display the product's image
    $img = "./Images/products/$row[ProductImage]";
    $MainContent .= "<div class='col-4'>"; //33% of row width
    $MainContent .= "<img src='$img' />";
    $MainContent .= "</div>";

    //End of a row
    $MainContent .= "</div>";
}
// To Do:  Ending ....

$conn->close(); // Close database connnection
$MainContent .= "</div>"; // End of container










include("MasterTemplate.php"); 
?>
