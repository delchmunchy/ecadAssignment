<script type="text/javascript">
function validateForm() {
    // Check if password matched
    if (document.changePwd.pwd1.value != document.changePwd.pwd2.value) {
        alert("Passwords not matched!");
        return false; // cancel submission
    }

    if (document.register.phone.value != ""){
        var str = document.register.phone.value;
        if (str.length != 8){
            alert("Please enter a 8-digit phone number.");
            return false; //cancel submission
        }
        else if (str.substr(0,1) != "6" &&
                 str.substr(0,1) != "8" &&
                 str.substr(0,1) != "9") {
            alert("Phone number in Singapore should start with 6,8 or 9.");
            return false; //cancel submission
        }
    }
    return true; // No error found
}
</script>

<?php
// Detect the current session
session_start();

$shopperID = $_SESSION["ShopperID"];

// Retrieve shopper record based on e-mail address
include_once("mysql_conn.php");
$qry = "SELECT * FROM Shopper WHERE ShopperID = ?" ;
$stmt = $conn->prepare($qry);
$stmt->bind_param("s", $shopperID); 	// "s" - string 
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$row = $result->fetch_array();
// End of To Do 1

$MainContent = "<h1 class='page-title' style='text-align:center;'>Update Profile</h1>";
$MainContent .= "<div style='width:80%; margin:auto;'>";
    $MainContent .= "<form name='updateProfile' method='post' onsubmit='return validateForm()'>";
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<div class='col-sm-9 offset-sm-3'>";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    // Name
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='name' style='text-align:right;'>*Name:</label>";
            $MainContent .= "<div class='col-sm-9'>";
                $MainContent .= "<input class='form-control' name='name' id='name' type='text' value='$row[Name]' required />";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    // Birthdate
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='name' style='text-align:right;'>Date of Birth:</label>";
            $MainContent .= "<div class='col-sm-9'>";
                $MainContent .= "<input class='form-control' name='birthdate' id='birthdate' value='$row[BirthDate]' type='date' />";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    // Address
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='address' style='text-align:right;'>Address:</label>";
            $MainContent .= "<div class='col-sm-9'>";
                $MainContent .= "<textarea class='form-control' name='address' id='address' cols='25' rows='4' value='$row[Address]'></textarea>";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    // Country
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='country' style='text-align:right;'>Country:</label>";
            $MainContent .= "<div class='col-sm-9'>";
                $MainContent .= "<input class='form-control' name='country' id='country' type='text' value='$row[Country]' />";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    // Phone
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='phone' style='text-align:right;'>Phone:</label>";
            $MainContent .= "<div class='col-sm-9'>";
                $MainContent .= "<input class='form-control' name='phone' id='phone' type='text' value='$row[Phone]' />";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    // Email
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='email' style='text-align:right;'>*Email Address:</label>";
            $MainContent .= "<div class='col-sm-9'>";
                $MainContent .= "<input class='form-control' name='email' id='email' type='email' value='$row[Email]' required />";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    // NEW PASSWORD
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='pwd1' style='text-align:right;'>*New Password:</label>";
            $MainContent .= "<div class='col-sm-9'>";
                $MainContent .= "<input class='form-control' name='pwd1' id='pwd1' type='password' required />";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    // RE-TYPE PASSWORD
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='pwd2' style='text-align:right;'>*Retype Password:</label>";
            $MainContent .= "<div class='col-sm-9'>";
                $MainContent .= "<input class='form-control' name='pwd2' id='pwd2' type='password' required />";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    // PwdQuestion
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='pwdQn' style='text-align:right;'>*Security Question:</label>";
            $MainContent .= "<div class='col-sm-9'>";
                $MainContent .= "<select class='form-control' name='pwdQn' id='pwdQn' type='text' value='$row[PwdQuestion]' required> 
                                <option>Which polytechnic did you graduate from?</option>
                                <option>How many siblings do you have?</option>
                                <option>What is your middle name?</option>
                                <option>What is your favourite song?</option>
                                </select>";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    // PwdAnswer
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<label class='col-sm-3 col-form-label' for='pwdAns' style='text-align:right;'>*Answer:</label>";
            $MainContent .= "<div class='col-sm-9'>";
                $MainContent .= "<input class='form-control' name='pwdAns' id='pwdAns' type='text' value='$row[PwdAnswer]' required/>";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    // UDPATE BUTTON
        $MainContent .= "<div class='form-group row'>";
            $MainContent .= "<div class='col-sm-9 offset-sm-3'>";
                $MainContent .= "<p>Fields with the * are required.</p>";
            $MainContent .= "</div>";

            $MainContent .= "<div class='col-sm-9 offset-sm-3'>";
                $MainContent .= "<button class='btn btn-primary' style='background-color: #f59acc; border-color:#f59acc; color: rgba(0,0,0,.5);' type='submit'>Update</button>";
            $MainContent .= "</div>";
        $MainContent .= "</div>";

    $MainContent .= "</form>";
$MainContent .= "</div>";

// Check the POST inputs
if (isset($_POST['name']) || isset($_POST['birthdate']) || isset($_POST['address']) || isset($_POST['country']) || isset($_POST['phone']) || isset($_POST['email']) || isset($_POST['pwd1']) || isset($_POST['pwd2']) || isset($_POST['pwdQn']) || isset($_POST['pwdAns'])) {
    $qry = "UPDATE shopper SET Name = ?, BirthDate = ?, Address = ?, Country = ?, Phone = ?, Email = ?, PwdQuestion = ?, PwdAnswer = ? WHERE ShopperID = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("sssssssss", $_POST['name'], $_POST['birthdate'], $_POST['address'], $_POST['country'], $_POST['phone'], $_POST['email'], $_POST['pwdQn'], $_POST['pwdAns'], $_SESSION["ShopperID"]); 	// "s" - string 
    $stmt->execute();
    $stmt->close();
    header('updateProfile.php');
    if ($_POST['pwd1'] == $_POST['pwd2']) {
        $qry = "UPDATE shopper SET Password = ? WHERE ShopperID = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("si", $_POST['pwd1'], $_SESSION["ShopperID"]);
        $stmt->execute();
        $stmt->close();
        $MainContent = "<p style='text-align:center;'>Your profile has been updated!<p/>";
    } else {
        echo '<script>alert("Passwords do not match!")</script>';
        header('updateProfile.php'); 
    }

}

include("MasterTemplate.php"); 
session_reset(); 
?>