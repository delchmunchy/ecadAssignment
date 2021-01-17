<?php
//Detect the current session
session_start();
//Create a centrally located container
$MainContent = "<div style='width:80%; margin:auto;'>";
//Create a HTML form within the container
$MainContent .= "<form action='checklogin.php' method='post'>";

//1st Row - Header Row 
$MainContent .= "<div class ='form-group row'>";
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<span class='page title'>Member Login</span>";
$MainContent .= "</div>";
$MainContent .= "</div>";

//2nd Row - Entry of Email Address 
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='email'>
                    Email Address:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' type='email' 
                    name='email' id='email' required />";
$MainContent .= "</div>";
$MainContent .= "</div>";

//3rd Row - Entry of Password
$MainContent .= "<div class='form-group row'>";
$MainContent .= "<label class='col-sm-3 col-form-label' for='password'>
                   Password:</label>";
$MainContent .= "<div class='col-sm-9'>";
$MainContent .= "<input class='form-control' type='password' 
                    name='password' id='password' required />";
$MainContent .= "</div>";
$MainContent .= "</div>";

//4th Row - Login Button
$MainContent .= "<div class ='form-group row'>";
$MainContent .= "<div class='col-sm-9 offset-sm-3'>";
$MainContent .= "<button type='submit' class='btn btn-primary' style='background-color:#f59acc; border-color:#f59acc; color:black;'>Login</button>";
$MainContent .= "</br></br><p>Please sign up if you do not have an account.</p>";
$MainContent .= "<p><a href='forgetPassword.php' style='color:#f054de'> Forget Password</a></p>";
$MainContent .= "</div>";
$MainContent .= "</div>";
$MainContent .= "</form>";

$MainContent .= "</div>";
//Include the Page Layout template
include("MasterTemplate.php");


?>