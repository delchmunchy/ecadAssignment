<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Flamper</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/slick.min.js">
<script src="js/bootstrap.min.js"></script>
<script src="js/checkbox.js"></script>
<link rel="stylesheet" href="css/site.css">
</head>


<div class="d-flex flex-column">

    <?php include("navbar.php"); ?>
    <br />
    <br />
    <div class="col-sm-12" style="margin-bottom: 50px; padding-left:50px; padding-right:50px;">
        <?php echo $MainContent; ?>
    </div>
    
    <br />
    <div class="col-sm-12" style="text-align: right; padding-left:50px; padding-right:50px;">
    <hr/>
    Do you need help? Please email to:
    <a style='color:#f244a3' href="mailto:flamper@flamper.com.sg">Flamper</a>
    <p style="font-size:12px">&copy;Copyright by Flamper</p>
    </div>

</div>
<script type="text/javascript">
        $(".slider").slick({
            centerMode: true,
            slidesToShow: 3,
            dots: true,
            autoplay: true,
            autoplaySpeed:3000,
        })



</script>


