<script type="text/javascript">
function validateForm()
{
    // Check if password matched
	if (document.changePwd.pwd1.value != document.changePwd.pwd2.value) {
 	    alert("Passwords not matched!");
        return false;   // cancel submission
    }
    return true;  // No error found
}
</script>

<?php
// Detect the current session
session_start();
// To Do 1: Check if user logged in 

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
$MainContent .= "<input class='form-control' name='name' id='name' 
                  type='text' required /> (required)";
$MainContent .= "</div>";
$MainContent .= "</div>";

// Birthdate
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='name' style='text-align:right;'>Date of Birth:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='birthdate' id='birthdate' type='date' />";
$MainContent .= "</div>";
$MainContent .= "</div>";

// Address
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='address' style='text-align:right;'>Address:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<textarea class='form-control' name='address' id='address' cols='25' rows='4'></textarea>";
$MainContent .= "</div>";
$MainContent .= "</div>";

// Country
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='country' style='text-align:right;'>Country:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='country' id='country' type='text' />";
$MainContent .= "</div>";
$MainContent .= "</div>";

// Phone
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='phone' style='text-align:right;'>Phone:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='phone' id='phone' type='text' />";
$MainContent .= "</div>";
$MainContent .= "</div>";

// Email
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='email' style='text-align:right;'>*Email Address:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='email' id='email' type='email' required /> (required)";
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
$MainContent .= "<select class='form-control' name='pwdQn' id='pwdQn' type='text' required> 
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
$MainContent .= "<input class='form-control' name='pwdAns' id='pwdAns' type='text' required/>";
$MainContent .= "</div>";
$MainContent .= "</div>";

// UDPATE BUTTON
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<p>Fields with the * are required.</p>";
$MainContent .= "</div>";       
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<button type='submit'>Update</button>";
$MainContent .= "</div>";
$MainContent .= "</div>";

$MainContent .= "</form>";

// Process after user click the submit button
if (isset($_POST['pwd1'])) {
	// To Do 2: Read new password entered by user
	
	
	// To Do 3: Hash the default password
	
	
	// To Do 4: Update the new password hash
	
}

$MainContent .= "</div>";
include("MasterTemplate.php"); 
?>