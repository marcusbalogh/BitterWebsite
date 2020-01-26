<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bitter - Contact us for more bitterness and darkness you might require..">
    <meta name="author" content="Marcus B. balogh.marcu@gmail.com">
    <link rel="icon" href="favicon.ico">
    <title>Contact Us - Bitter</title>
    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
            integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous">
    </script>
    <script src="includes/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</head>
<body>

<!--Sprint 1 .80-->
<?php
if (isset($_SESSION['SESS_USER']))
{
	include("header.php");
}
else
{
echo "<nav class=\"navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top\">
    <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\"
            data-target=\"#navbarsExampleDefault\" aria-controls=\"navbarsExampleDefault\" aria-expanded=\"false\"
            aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>


    <div class=\"collapse navbar-collapse\" id=\"navbarsExampleDefault\">
        <a class=\"navbar-brand\" href=\"index.php\"><img src=\"images/logo.jpg\" class=\"logo\"></a>

        <a class=\"nav-link\" href=\"http://localhost/contactus\">
            <img class=\"bannericons\" src=\"images/phone-book.png\">Contact Us</a>


    </div>
</nav>";
}


?>

<section class="Material-contact-section section-padding section-dark">
    <div class="container" style="top: 10em">
        <div class="row">
            <!-- Section Titile -->
            <div class="col-md-12 wow animated fadeInLeft" data-wow-delay=".2s">
                <h1 class="section-title">We Would Love to Hear Your Bitterness</h1>
            </div>
        </div>
        <div class="row">
            <!-- Section Titile -->
            <div class="col-md-6 mt-3 contact-widget-section2 wow animated fadeInLeft" data-wow-delay=".2s">
                <p>You are bitter, we know it. How about sharing it with us?</p>

                <div class="find-widget">
                    Company: <a href="localhost">Bitter</a>
                </div>
                <div class="find-widget">
                    Address: <a href="https://goo.gl/maps/JL7jzFddTAor1XdC6">26 Duffie Dr, Fredericton, NB E3B 2X9</a>
                </div>
                <div class="find-widget">
                    Phone: <a href="tel:+ 5064606222">+ 506-460-6222</a>
                </div>

                <div class="find-widget">
                    Email: <a href="mailto:balogh.marcu@gmail.com">balogh.marcu@gmail.com</a>
                </div>

            </div>
            <!-- contact form -->
            <div class="col-md-6 wow animated fadeInRight">
                <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2774.426654927889!2d-66.6464845842046!3d45.942757909403646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ca42210ac3687bd%3A0x125526a7da03e7ab!2sNBCC%20Fredericton%20Campus!5e0!3m2!1sen!2sca!4v1569001212342!5m2!1sen!2sca"
                        width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
</section>

</body>