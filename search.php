<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/function.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <!-- Site specific Cascading Stylesheet -->
        <link rel="stylesheet" href="css/style.css">
    </head>
</html>
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
                  type='search' required/>";
$MainContent .= "</div>";

$MainContent .= "<div class='col-sm-3'>";
$MainContent .= "<button type='submit' class=' btn btn-primary' style='background-color: #f59acc; border-color:#f59acc; color: black;'>Search</button>";
$MainContent .= "</div>";

$MainContent .= "<input type='checkbox' id='myCheck' name='myCheck' value='Yes'></br> ";
$MainContent .= "<label for='myCheck'>On Offer</label><br>";

$MainContent .= "<div class='price-slider'><span>Price Range:</br>";
$MainContent .= "<input type='number' label for='num1' name='num1' placeholder='1' min='0' max='200' required/>     to  ";
$MainContent .= "<input type='number' label for='num2' name='num2' placeholder='160' min='0' max='200' required/></span></br>";
$MainContent .= "</div>";
$MainContent .= "</div>";  // End of 2nd row


$MainContent .= "</form>";
// Include the PHP file that establishes database connection handle: $conn
include_once("mysql_conn.php");


// The search keyword is sent to server
if(isset($_GET['num1']) && isset($_GET['num2']) && (isset($_GET['keywords']))) {
    $SearchText=$_GET["keywords"];
    $num1 = $_GET["num1"];
    $num2 = $_GET["num2"];
    $msg = "Search results for '$SearchText' with a price range of $num1 to $num2";

    $qry = "SELECT ProductID, ProductTitle FROM product WHERE $num2 >= Price AND Price >= $num1 "; //Form SQL to select all categories
    if (isset($_GET['myCheck'])) {
        $qry .= "AND Offered = 1  ";
        $msg .= " and on offer:";
    }
    else {
        $qry .= "AND Offered = 0 ";
        $msg .= ":";
    }
    $qry .= "AND ProductID IN (SELECT ProductID from product WHERE ProductTitle LIKE '%$SearchText%' OR ProductDesc LIKE '%$SearchText%') ORDER BY ProductTitle ASC ";
    
    $result = $conn->query($qry); //Execute SQL to get the result

    if ($result->num_rows > 0) { // If found, display records
        //Display each category in a row
        
         $MainContent .= "<b>$msg</b></br>"; //creates search results header
         while ($row = $result->fetch_array())
         {
             $product = "productDetails.php?pid=$row[ProductID]"; 
             $MainContent .= "<a style='color:#f054de' href=$product>$row[ProductTitle]</a></br>"; 
         } 
     }
     else {
         $MainContent .= "<h3 style='color:#f774bc'>No results found, please try again.</h3>";
     }
}


$MainContent .= "</div>"; // End of Container
include("MasterTemplate.php");
?>