<?php 
//Display guest welcome message, Login and Registration links
//when shopper has yet to login,
$content1 = "Welcome Guest<br />";
$content2 = "<li class='nav-item'>
		     <a class='nav-link' href='register.php'>Sign Up</a></li>
			 <li class='nav-item'>
		     <a class='nav-link' href='login.php'>Login</a></li>";

if(isset($_SESSION["ShopperName"])) { 
	//To Do 1 (Practical 2) - 
    //Display a greeting message, Change Password and logout links 
    //after shopper has logged in.
    $content1 = "Welcome <b>$_SESSION[ShopperName]</b>";
    $content2 = "<li class='nav-item'>
                 <a class='nav-link' href='updateProfile.php'>Update Profile</a></li>
                 <li class='nav-item'>
                 <a class='nav-link' href='logout.php'>Logout</a></li>";
	
	//To Do 2 (Practical 4) - 
    //Display number of item in cart
	if (isset($_SESSION["NumCartItem"])) {
        $content1 .= ", $_SESSION[NumCartItem] item(s) in shopping cart";
    }
}
?>


<!-- To Do 4 (Practical 1) - 
     Define a collapsible navbar -->
     <nav class="navbar navbar-expand-md navbar-light" style="margin:auto; padding-bottom:0px" >

     <ul class="nav-item">
            <a href="index.php">
            <img src="Images/flowerlogo.png" alt="Logo" style="height:150px;"/></a>
            <p style="text-align:center; margin-top:-15px; margin: auto 0px; font-size:25px; font-family: Lucida Handwriting
                        ; font-weight: bold; color:#ff3399">Flamper</p>
    </ul>
    </nav>
    <nav class="navbar navbar-expand-md navbar-light" style="padding-left: 50px; padding-right: 50px; padding-top:0px; padding-bottom:0px" >

    <!--Collapsible part of navbar-->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <!--Left-justified menu items-->
    <ul class="navbar-nav" style="align-items: center; width:100%; font-weight: bold; font-family:
                Lucida Handwriting; background-color: pink; height: 60px; justify-content: center; font-size: 15px; ">

        <li class="nav-item">
            <a class="nav-link" href="index.php" style="margin-right: 30px;"><i class="fa fa-home"></i> Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="category.php" style="margin-right: 30px;"><i class="fa fa-money"></i> Product Categories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="search.php" style="margin-right: 30px;"><i class="fa fa-search"></i> Product Search</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="feedback.php" style="margin-right: 30px;"><i class="fa fa-comments"></i> Feedback</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="shoppingCart.php"><i class="fa fa-shopping-cart"></i> Shopping Cart</a>
        </li>
        <?php echo $content2; ?>
    </ul>
</div>
</nav>

<!-- To Do 3 (Practical 1) - 
     Display a navbar which is visible before or after collapsing -->

     <nav class="navbar navbar-expand-md navbar-dark" style="height:200px;padding-left:50px; padding-right:50px; padding-top:0px; height:300px;">
    <!--Dynamic Text Display-->
    <span class="navbar-text"
            style="background:url(Images/background.jpg) no-repeat; text-align:center; display:flex; flex-flow:column; margin:0px; height:100%; background-size: cover; width:100%;">
            <p style="color:black; font-size:35px; font-weight: bold; margin: auto 0px; font-family: Lucida Console
"><?php echo $content1; ?></p>
    </span>

    <!--Collapsible Button-->
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>


