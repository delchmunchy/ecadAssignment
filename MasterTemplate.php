<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Flamper</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/slick.min.js">
<script src="js/bootstrap.min.js"></script>
<script src="js/checkbox.js"></script>
<link rel="stylesheet" href="css/site.css">
</head>


<div class="container">

    <div class="row">
        <?php include("navbar.php"); ?>
    </div>

    <div class="row">
        <div class="col-sm-12" style="padding:15px; margin-bottom: 50px;">
            <?php echo $MainContent; ?>
        </div>
    </div>

        
    <div class="row">
        <div class="col-sm-12" style="text-align: right;">
        <hr/>
        Do you need help? Please email to:
        <a style='color:#f244a3' href="mailto:flamper@flamper.com.sg">Flamper</a>
        <p style="font-size:12px">&copy;Copyright by Flamper</p>
        </div>
    </div>

</div>
<script type="text/javascript">
        $(".slider").slick({
            centerMode: true,
            slidesToShow: 3,
            dots: true,
            autoplay: true,
            autoplaySpeed:3000
        })
</script>
