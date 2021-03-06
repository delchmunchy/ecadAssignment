﻿<?php 
// Detect the current session
session_start();
// Create a container, 60% width of viewport
$MainContent = "<div style='width:60%; margin:auto;'>";
// Display Page Header.
$MainContent .= "<div class='row' style='padding:5px'>"; // Start header row
$MainContent .= "<div class='col-12'>";
$MainContent .= "<span class='page-title'>Product Categories</span>";
$MainContent .= "<p>Select a category listed below:</p>";
$MainContent .= "</div>";
$MainContent .= "</div>"; // End header row

// Include the PHP file that establishes database connection handle: $conn
include_once("mysql_conn.php");

// To Do:  Starting ....
$qry = "SELECT * FROM Category"; //Form SQL to select all categories
$result = $conn->query($qry); //Execute SQL to get the result

//Display each category in a row
while ($row = $result->fetch_array())
{
    //Start a new row
    $MainContent .= "<div class='row' style='padding:5px'>";

    //Left column - display a text link showing the category's name, category's description in a new paragraph
    $catname = urlencode($row["CatName"]);
    $catproduct = "catProduct.php?cid=$row[CategoryID]&catName=$catname";
    $MainContent .= "<div class='col-8'>"; //67% of row width
    $MainContent .= "<p><a style='color:#f054de' href=$catproduct>$row[CatName]</a></p>";
    $MainContent .= "$row[CatDesc]";
    $MainContent .= "</div>";

    //Right column
    $img = "./Images/category/$row[CatImage]";
    $MainContent .= "<div class='col-4'>"; //33% of row width
    $MainContent .= "<img src='$img' />";
    $MainContent .= "</div>";

    //End of row
    $MainContent .= "</div>";
}

// To Do:  Ending ....

$conn->close(); // Close database connnection
$MainContent .= "</div>"; // End of container
include("MasterTemplate.php"); 
?>
