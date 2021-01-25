<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Flamper</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/site.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <a href="index.php">
            <img src="Images/flower.jpg" alt="Logo"
                    class="img-fluid" style="width: 5%"/></a>
            Flamper
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <?php include("navbar.php"); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12" style="padding:15px; ">
                <?php echo $MainContent; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12" style="text-align: right; ">
            <hr />
            Do you need help? Please email to:
            <a href="mailto:flamper@np.edu.sg">Flamper</a>
            <p style="font-size:12px">&copy;Copyright by Flamper</p>
            </div>
        </div>

    </div>
</body>