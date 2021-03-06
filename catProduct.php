﻿<?php 
// Detect the current session
session_start();
// Create a container, 60% width of viewport
$MainContent = "<div style='width:60%; margin:auto;'>";
// Display Page Header - 
// Category's name is read from query string passed from previous page.
$MainContent .= "<div class='row' style='padding:5px'>";
$MainContent .= "<div class='col-12'>";
$MainContent .= "<span class='page-title'>$_GET[catName]</span>";
$MainContent .= "</div>";
$MainContent .= "</div>";

// Include the PHP file that establishes database connection handle: $conn
include_once("mysql_conn.php"); 

// To Do:  Starting ....
$cid=$_GET["cid"]; //Read Category ID from query string
//Form SQL to retrieve list of products associated to the Category ID
$qry = "SELECT p.ProductID, p.ProductTitle, p.ProductImage, p.Price, p.Quantity, p.OfferedPrice, p.Offered 
        FROM CatProduct cp INNER JOIN product p ON cp.ProductID=p.ProductID
        WHERE cp.CategoryID=? ORDER BY p.ProductTitle ASC" ;
$stmt = $conn->prepare($qry);
$stmt->bind_param("i", $cid); //i - integer
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

//Display each product in a row
while ($row = $result->fetch_array())
{
    //Start a new row
    $MainContent .= "<div class='row' style='padding:5x'>";

    if($row["Offered"] == 0)
    {
    //Right column - display the product's price
    $product = "productDetails.php?pid=$row[ProductID]";
    $formattedPrice = number_format($row["Price"], 2);
    $MainContent .= "<div class='col-8'>"; //67% of row width
    $MainContent .= "<p><a style='color:#f054de' href=$product>$row[ProductTitle]</a></p>";
    $MainContent .= "Price:<span style='font-weight: bold; color: black;'>
                    S$ $formattedPrice</span>";
    $MainContent .= "</div>";
    }
    else {
    $product = "productDetails.php?pid=$row[ProductID]";
    $formattedPrice = number_format($row["OfferedPrice"], 2);
    $oldPrice = number_format($row["Price"], 2);
    $MainContent .= "<div class='col-8'>"; //67% of row width
    $MainContent .= "<p><a style='color:#f054de' href=$product>$row[ProductTitle]</a></p>";
    $MainContent .= "Price:<span style='font-weight: bold; color: black;'>
                    <del>S$ $oldPrice</del></span>";
    $MainContent .= "<span style='font-weight: bold; color: red; font-size:20px'>
                    S$ $formattedPrice</span><br><br>";
                    $MainContent .= "<button type='button' disabled class='btn btn-primary' style='background-color:#f59acc; border-color:#f59acc; width: 20%; color:black;'>On Sale</button></br></br>";
    $MainContent .= "</div>";
    }
    
    //Right column - display the product's image
    $img = "./Images/products/$row[ProductImage]";
    $MainContent .= "<div class='col-4'>"; //33% of row width
    $MainContent .= "<img src='$img' style='width: 80%'/>";
    $MainContent .= "</div>";

    //End of a row
    $MainContent .= "</div>";
}
// To Do:  Ending ....

$conn->close(); // Close database connnection
$MainContent .= "</div>"; // End of container
include("MasterTemplate.php");  
?>
