<?php 
// Detect the current session
session_start();


// Create a container, 60% width of viewport



$MainContent = "<div style='width:60%; margin:auto;'>";
// Display Page Header - 




$MainContent = "<img src='Images/banner2.jpg'  
                     style='display:block; margin:auto; width:100%; height: 20%;'/>"; 

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
$MainContent .= "<p><a style='color:#f244a3'>Gifts for all ages.</a></p>";
$MainContent .= "<span style='font-weight: bold; color: black; font-size: 25px;'>Products on Offer</span></br>";
$MainContent .= "<span style='color: black; font-size: 15px;'>These are the products that are currently on offer at discounted prices.</span>";

//Display each product in a row
while ($row = $result->fetch_array())
{
    //Start a new row
    $MainContent .= "<div class='row' style='padding:5x'>"; 

    //Left column - display a text link showing the product's name, display the selling price in red in a new paragraph
    $product = "productDetails.php?pid=$row[ProductID]";
    $formattedPrice = number_format($row["OfferedPrice"], 2);
    $MainContent .= "<div class='col-8'>"; //67% of row width
    $MainContent .= "<p><a style='color:#f244a3' href=$product>$row[ProductTitle]</a></p>";
    $MainContent .= "Price:<span style='font-weight: bold; color: red;'>
                    S$ $formattedPrice</span>";
    $MainContent .= "</div>";
    
    //Right column - display the product's image
    $img = "./Images/products/$row[ProductImage]";
    $MainContent .= "<div class='col-4'>"; //33% of row width
    $MainContent .= "<img src='$img' style='width: 80%'>";
    $MainContent .= "</div>";

    //End of a row
    $MainContent .= "</div>";
}
// To Do:  Ending ....

$conn->close(); // Close database connnection


include("MasterTemplate.php"); 

?>
