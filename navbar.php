<?php 
//Display guest welcome message, Login and Registration links
//when shopper has yet to login,
$content1 = "Welcome Guest<br />";
$content2 = "<li class='nav-item'>
            <button type='button' class='btn btn-outline-danger btn-sm m-1' style=':hover {
                background-color: pink;
              }'>
            <a class='nav-link' href='register.php'>Sign Up</a>
            </button>
            </li>
            <li class='nav-item'>
            <button type='button' class='btn btn-outline-danger btn-sm m-1'>
            <a class='nav-link' href='login.php'>Login</a>
            </button>
            </li>
		     ";
if(isset($_SESSION["ShopperName"])) { 
	//To Do 1 (Practical 2) - 
    //Display a greeting message, Change Password and logout links 
    //after shopper has logged in.
    $content1 = "Welcome <b>$_SESSION[ShopperName]</b>";
    $content2 = "<li class='nav-item'>
    <button type='button' class='btn btn-outline-danger btn-sm m-1'>
    <a class='nav-link' href='updateProfile.php'> Update Profile</a>
    </button>
    </li>
    <li class='nav-item'>
    <button type='button' class='btn btn-outline-danger btn-sm m-1'>
    <a class='nav-link' href='logout.php'>Logout</a>
    </button>
    </li>";

	

	//To Do 2 (Practical 4) - 
    //Display number of item in cart
	if (isset($_SESSION["NumCartItem"])) {
        $content1 .= ", $_SESSION[NumCartItem] item(s) in shopping cart";
    }
}
?>


<!-- To Do 4 (Practical 1) - 
     Define a collapsible navbar -->
     <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top p-0">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php">
    <img src="images/flowerlogo.png" alt="Logo" style="height:40px;">
  </a>
  <a class="navbar-brand" href="index.php">Flamper</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
      <a class="nav-link " href="index.php">Home</a>
      </li>
      <li class="nav-item">
      <a class="nav-link " href="category.php">Categories</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="search.php">Product Search</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="feedback.php">Feedback</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="shoppingCart.php">Cart</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <?php echo $content2; ?>
    </ul>
  </div>
</nav>

