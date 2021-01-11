<?php

//Detect 
session_start();
//Destroy
session_destroy();
//Redirect
header("Location: index.php");
exit;
?>
