<?php 
session_start();
$MainContent = "<div style='width:80%; margin:auto;'>";
$MainContent .= "<form action='forgetPassword.php' method='post'>";

$MainContent .= "<div class='form-group row'>";
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<span class='page-title'>Forget Password</span>";
$MainContent .= "</div>";
$MainContent .= "</div>";

$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='email'>Email Address:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='email' id='email'type='email' required />";
$MainContent .= "</div>";
$MainContent .= "</div>";

$MainContent .= "<div class='form-group row'>";       
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<button type='submit'>Submit</button>";
$MainContent .= "</div>";
$MainContent .= "</div>";

$MainContent .= "</form>";
$MainContent .= "</div>";

// Process after user click the submit button
if (isset($_POST['email'])) {
	// Read email address entered by user
	$email = $_POST['email'];
	// Retrieve shopper record based on e-mail address
	include_once("mysql_conn.php");
	$qry = "SELECT * FROM Shopper WHERE Email=?" ;
	$stmt = $conn->prepare($qry);
	$stmt->bind_param("s", $email); 	// "s" - string 
	$stmt->execute();
	$result = $stmt->get_result();
    $stmt->close();
    // If there is a result, answer the question.
    if ($result->num_rows > 0) {
        $row = $result->fetch_array();
        $pwdQn = $row["PwdQuestion"];
        $_SESSION["pwdAns"] = $row["PwdAnswer"];
        $_SESSION["email"] = $row["Email"];
        
        $MainContent  = "<div style='width:80%; margin:auto;'>";
        $MainContent .= "<form action='forgetPassword.php' method='post'>";

        $MainContent .= "<div class='form-group row'>";
        $MainContent .= "<label class='col-sm-3 col-form-label' for='pwdQn'>Security Question: </label>";
        $MainContent .= "<div class='col-sm-9'>";
        $MainContent .= "<label class='col-sm-3 col-form-label' name='pwdQn' id='pwdQn'>$pwdQn</label>";
        $MainContent .= "</div>";
        $MainContent .= "</div>"; 
        
        $MainContent .= "<div class='form-group row'>";
        $MainContent .= "<label class='col-sm-3 col-form-label' for='pwdAns'>Answer:</label>";
        $MainContent .= "<div class='col-sm-9'>";
        $MainContent .= "<input class='form-control' name='pwdAns' id='pwdAns'type='text' required />";
        $MainContent .= "</div>";
        $MainContent .= "</div>";

        $MainContent .= "<div class='form-group row'>";       
        $MainContent .= "<div class='col-sm-9 offset-sm-3'>";
        $MainContent .= "<button type='submit'>Submit</button>";
        $MainContent .= "</div>";
        $MainContent .= "</div>";

        $MainContent .= "</form>";
        $MainContent .= "</div>";
    }
    else {
        $MainContent .= "<p><span style='color:red;'>Wrong E-mail address!</span>";
    }
	$conn->close();
}

if (isset($_POST["pwdAns"])) {
    $pwdAns2 = $_SESSION["pwdAns"];
    $email = $_SESSION["email"];
    $temp = "tempPassword";
	// Retrieve shopper record based on e-mail address
    if ($_POST["pwdAns"] == $pwdAns2) {
        include_once("mysql_conn.php");
        $qry = "UPDATE shopper SET Password = ? WHERE Email = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $temp, $email); 	// "s" - string 
        $stmt->execute();
        $stmt->close();

        $MainContent = "<p>Your new temporary password is <b>tempPassword</b>.<br/> 
        Please use this password to log in and then change it to a new one for security reasons.<p/>";
    } else {
        $MainContent = "<p style='color:red; text-align:center;'>Incorrect answer!</p>";
    }
}

// $MainContent .= "</div>";
include("MasterTemplate.php");
?>