<?php  
session_start(); // Detect the current session
// Create a container, 90% width of viewport
$MainContent = "<div style='width:90%; margin:auto;'>";

$pid=$_GET["pid"]; // Read Product ID from query string

// Include the PHP file that establishes database connection handle: $conn
include_once("mysql_conn.php"); 
$qry = "SELECT * from product where ProductID=?";
$stmt = $conn->prepare($qry);
$stmt->bind_param("i", $pid); 	// "i" - integer 
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

// To Do 1:  Display Product information. Starting ....
while ($row = $result->fetch_array())
{
    //Display page header - product's name is read from "ProductTitle" column of "product" table
    $MainContent .= "<div class='row' >";
    $MainContent .= "<div class='col-sm-12' style='padding:5px'>"; //67% of row width
    $MainContent .= "<span style='color:#f054de' class='page-title'>$row[ProductTitle]</span>";
    $MainContent .= "</div>";
    $MainContent .= "</div>";

    //Start a new row
    $MainContent .= "<div class='row'>";

    //Left column - display the product's description
    $MainContent .= "<div class='col-sm-9' style='padding:5px'>"; 
    $MainContent .= "<p>$row[ProductDesc]</p>";

    //Left column - display the product's specification
    $qry = "SELECT s.SpecName, ps.SpecVal from productspec ps INNER JOIN specification s
        ON ps.SpecID=s.SpecID WHERE ps.ProductID=? ORDER BY ps.Priority";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("i", $pid); //i - integer
    $stmt->execute();
    $result2 = $stmt->get_result();
    $stmt->close();
    while ($row2 = $result2->fetch_array()) {
        $MainContent .= $row2["SpecName"].": ".$row2["SpecVal"]."<br /><br />";
    }

    if($row["Offered"] == 1)
    {
    $MainContent .= "<button type='button' disabled class='btn btn-primary' style='background-color:#f59acc; border-color:#f59acc; width: 20%; color:black;'>On Sale</button></br></br>";
    }
    //End of a row
    $MainContent .= "</div>";

    //Right column - display the product's image
    $img = "./Images/products/$row[ProductImage]";
    $MainContent .= "<div class='col-sm-3' style='vertical-align:top; padding:5px'>"; 
    $MainContent .= "<p><img src=$img style='width: 80%'/></p>";

    if($row["Offered"] == 0)
    {
    //Right column - display the product's price
    $formattedPrice = number_format($row["Price"], 2);
    $MainContent .= "Price:<span style='font-weight: bold; color: black;'>
                    S$ $formattedPrice</span><br><br>";
    }
    else {
    $formattedPrice = number_format($row["OfferedPrice"], 2);
    $oldPrice = number_format($row["Price"], 2);
    $MainContent .= "Price:<span style='font-weight: bold; color: black;'>
                    <del>S$ $oldPrice</del></span>";
    $MainContent .= "<span style='font-weight: bold; color: red;'>
                    S$ $formattedPrice</span><br><br>";
    }
// To Do 2:  Create a Form for adding the product to shopping cart. Starting ....
    if($row["Quantity"] > 0) {
    $MainContent .= "<form action='cartFunctions.php' method='post'>";
    $MainContent .= "<input type='hidden' name='action' value='add' />";
    $MainContent .= "<input type='hidden' name='product_id' value='$pid' />";
    $MainContent .= "Quantity: <input type='number' name='quantity' value='1'
                      min='1' max='500' style='width:40px' required /><br><br>";
    $MainContent .= "<button type='submit'>Add to cart</button>";
    $MainContent .= "</form>";
    }
    else {

    $MainContent .= "Quantity: <input type='number' name='quantity' value='0'
                       style='width:40px' disabled />";

    $MainContent .= "<br><br><button type='submit' disabled>Add to cart</button>";
    
    $MainContent .= "<br><br><span style='font-weight: bold; color: red;'>Product is out of stock!☹</span>";
    }

    $MainContent .= "</div>"; //End of right column 
    $MainContent .= "</div>"; //End of row
}
// To Do 2:  Ending ....

$conn->close(); // Close database connnection
$MainContent .= "</div>"; // End of container
include("MasterTemplate.php");  
?>
