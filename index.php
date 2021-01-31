<?php 
// Detect the current session
session_start();


$contentHero = "<div class='hero-image'>
<div class='hero-text'>
  <h1>Welcome Guest</h1>
</div>
</div>";

if(isset($_SESSION["ShopperName"])) { 
	
    $contentHero =  "<div class='hero-image'>
    <div class='hero-text'>
      <h1>Welcome <b>$_SESSION[ShopperName]</b></h1>
    </div>
    </div>";
}
	
if (isset($_SESSION["NumCartItem"]) && isset($_SESSION["ShopperName"])) {
    $contentHero = "<div class='hero-image'>
    <div class='hero-text'>
    <h1>Welcome <b>$_SESSION[ShopperName]</b></h1>
    <p>You have $_SESSION[NumCartItem] item(s) in your cart</p>
    </div>
    </div>";
}

$MainContent = "<div style='text-align:center;'>";

$MainContent = $contentHero;
include_once("mysql_conn.php"); 

// To Do:  Starting ....
//Form SQL to retrieve list of products associated to the Category ID
$date = date("Y-m-d");
$qry = "SELECT * FROM Product p WHERE p.OfferedPrice IS NOT NULL AND p.OfferEndDate > $date AND $date < p.OfferStartDate ORDER BY p.ProductTitle ASC";
$stmt = $conn->prepare($qry);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$row = $result->fetch_array();

$MainContent .= "<div class='pb-5 pt-5' style='text-align:center; background-color:pink;'>";
$MainContent .= "<span style='font-weight: bold; color: black; font-size: 30px;'>Products on Offer</span></br>";
$MainContent .= "<span style='color: black; font-size: 15px;'>These are the products that are currently on offer at discounted prices.</span>";
$MainContent .= "</div>";

$MainContent .= "<div class='slider' style='margin-top:25px;'></div>";

//Display each product in a row
while ($row = $result->fetch_array())
{
    
    //Left column - display a text link showing the product's name, display the selling price in red in a new paragraph
    $product = "productDetails.php?pid=$row[ProductID]";
    $productTitle = "$row[ProductTitle]";
    $formattedPrice = number_format($row["OfferedPrice"], 2);
    $img = "./Images/products/$row[ProductImage]";
    
/*
    //67% of row width
    $MainContent .= "<div class='col-8'>"; 
    $MainContent .= "<p><a style='color:#f244a3' href=$product>$row[ProductTitle]</a></p><p>$productId</p>";
    $MainContent .= "Price:<span style='font-weight: bold; color: red;'>
                    S$ $formattedPrice</span>";
    $MainContent .= "</div>";
    
    //Right column - display the product's image
   
    //33% of row width
    $MainContent .= "<div class='col-4'>
    <img src='$img' style='width: 80%'>
    </div>";

    //End of a row
    $MainContent .= "</div>";
*/
    $MainContent .= "<script type='text/javascript'>
        $('<div class=carousel-div><img src=$img></img><div class=carousel-text><a href=$product>$productTitle</a></br>Price:<span class=carousel-text-b>S$ $formattedPrice</span></div></div>').appendTo('.slider');
    </script>";  
}
// To Do:  Ending ....


$conn->close(); // Close database connnection



include("MasterTemplate.php"); 
?>
