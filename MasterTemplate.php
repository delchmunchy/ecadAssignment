<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Team 2</title>
        <!-- Latest complied and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <!-- jQuery library -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="js/function.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <!-- Site specific Cascading Stylesheet -->
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <!-- 1st Row -->
            <div class="row">
                <div class="col-sm-12">
                    <a href="index.php">
                        <img src ="Images/flower.jpg" alt="Logo" class="img-fluid" style="width: 5%">
                    </a>
                    Team 2
                </div>
            </div>
            <!-- 2nd Row -->
            <div class="row">
                <div class="col-sm-12">
                    <?php include("navbar.php"); ?>
                </div>
            </div>
            <!-- 3rd Row -->
            <div class="row">
                <div class="col-sm-12" style="padding:15px; ">
                    <?php echo $MainContent; ?>
                </div>
            </div>
            <!-- 4th Row -->
            <div class="row">
                <div class="col-sm-12" style="text-align: right; ">
                    </hr>
                    Do you need help? Please email to:
                    <a href="mailto:mamaya@np.edu.sg">Team 2</a>
                    <p style="font-size:12px">&copy;Team 2</p>
                </div>
            </div>
        </div>
    </body>
</html>