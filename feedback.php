<?php 
session_start();

$MainContent = "<div class='container'>";
    $MainContent .= "<div class='row'>";
        $MainContent .= "<div class='col'></div>";
        $MainContent .= "<div class='col'>";
            $MainContent .= "<h1 class='page-title' style='text-align:center'>Feedback</h1> <br/>";
        $MainContent .= "</div>";
        $MainContent .= "<div class='col'>";
        $MainContent .= "</div>";
    $MainContent .= "</div>";
$MainContent .= "</div>";

// GET SHOPPER NAME
include_once("mysql_conn.php");
$qry = "SELECT * FROM shopper AS s JOIN feedback AS f ON s.ShopperID = f.ShopperID";
$stmt = $conn->prepare($qry);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
// $row = $result->fetch_array();
$resultset = array();
while ($row = $result->fetch_array()) {
    $resultset[] = $row;
}

// CODE FOR DISPLAYING ALL FEEDBACK FROM DB
$MainContent .= "<div style='width:80%; margin:auto;'>";
$MainContent .= "<div>";

$MainContent .= "<table class='table table-striped table-hover'>
                    <tr>
                        <th scope='col'>Name</th>
                        <th scope='col'>Subject</th>
                        <th scope='col'>Feedback</th>
                        <th scope='col'>Rating</th>
                    </tr>";
foreach ($resultset as $result){
$MainContent .=     "<tr>
                        <td scope='row'>$result[Name]</td>
                        <td scope='row'>$result[Subject]</td>
                        <td scope='row'>$result[Content]</td>
                        <td scope='row'>$result[Rank]</td>
                    </tr>";
                }
$MainContent .= "</table>";
$MainContent .= "</div>";


// CODE FOR FORM WHEN "ADD FEEDBACK" OPTION IS CLICKED 
//      THIS PORTION SHOULD INCLUDE THE SUCCESS MESSAGE AND REDIRECT BUTTON 

if (isset($_SESSION["ShopperID"])) {
    $MainContent .= "<form name='feedback' action='feedback.php' method='post'>";

        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<div class='col-12'>";
                $MainContent .= "<h1 class='page-title' style='text-align:center;'>Submit Feedback</h1>";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='subject' style='text-align:right;'>Subject:</label>";
            $MainContent .= "<div class='col-sm-6'>";
                $MainContent .= "<input class='form-control' name='subject' id='subject' type='text'  required />";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='feedback' style='text-align:right;'>Feedback:</label>";
            $MainContent .= "<div class='col-sm-6'>";
                $MainContent .= "<textarea class='form-control' name='feedback' id='feedback' type='text' required> </textarea>";
            $MainContent .= "</div>";
        $MainContent .= "</div>";
        
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='rating' style='text-align:right;'>Rating:</label>";
            $MainContent .= "<div class='col-auto'>";
                $MainContent .= "<select class='form-control' name='rating' id='rating' required>
                                 <option>1</option>
                                 <option>2</option>
                                 <option>3</option>
                                 <option>4</option>
                                 <option>5</option>
                                 </select>";
            $MainContent .= "</div>";
     
            $MainContent .= "<div class='col-auto'>";
                $MainContent .= "<button class='btn btn-primary' type='submit' style='background-color: #f59acc; border-color:#f59acc; color: rgba(0,0,0,.5);'>Submit</button>";
            $MainContent .= "</div>";

        $MainContent .= "</div>";
    $MainContent .= "</form>";
}

if (isset($_POST['subject']) || isset($_POST['feedback']) || isset($_POST['rating'])) {
    $qry = "INSERT INTO feedback SET ShopperID = ?, Subject = ?, Content = ?, Rank = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("isss", $_SESSION['ShopperID'], $_POST['subject'], $_POST['feedback'], $_POST['rating']); 	// "s" - string 
    $stmt->execute();
    $stmt->close();
    
    $MainContent = "<p>Thank you for giving us feedback!</p><br />";
    $MainContent .= "<a href='feedback.php' class='btn btn-primary' style='background-color: #f59acc; border-color:#f59acc; color: rgba(0,0,0,.5);'>Go back</a></br></br>";
}

// $MainContent .= "</div>";
include("MasterTemplate.php"); 
?>
