<script type="text/javascript">
function validateForm()
{
    // To Do 1 - Check if password matched
	if (document.register.password.value != document.register.password2.value) {
        alert("Passwords not matched!");
        return false; //cancel submission
    }

	// To Do 2 - Check if telephone number entered correctly
	//           Singapore telephone number consists of 8 digits, start with 6, 8 or 9
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
    return true;  // No error found
}
</script>

<?php
// Detect the current session
session_start();
$MainContent = "<h1 class='page-title' style='text-align:center;'>Membership Registration</h1>";
$MainContent .= "<div style='width:80%; margin:auto;'>";
$MainContent .= "<form name='register' action='registration.php' method='post' onsubmit='return validateForm()'>";
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "</div>";
$MainContent .= "</div>";

// Name
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='name' style='text-align:right;'>*Name:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='name' id='name' type='text' required /> (required)";
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

// Password
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='password' style='text-align:right;'>*Password:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='password' id='password' type='password' required /> (required)";
$MainContent .= "</div>";
$MainContent .= "</div>";

// RE-TYPE PASSWORD
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='password2' style='text-align:right;'>*Retype Password:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' name='password2' id='password2' type='password' required /> (required)";
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

// SUBMIT BUTTON
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<p>Fields with the * are required.</p>";
$MainContent .= "</div>";            
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<button type='submit'>Register</button>";
$MainContent .= "</div>";
$MainContent .= "</div>";

$MainContent .= "</form>";
$MainContent .= "</div>";
include("MasterTemplate.php"); 
?>