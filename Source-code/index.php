<?php
session_start();
include_once 'apps/dbconnect.php';

?>

<!DOCTYPE html>

<html>

<head>

    <title>Home | CookieCodec</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <!--CUSTOM CSS-->

</head>

<body>

    <!--NAVIGATION BAR-->
    <?php include_once('lib/header.php'); ?>

    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('http://studentaffairs.unt.edu/sites/default/files/university-union/images/6W5A0533.jpg');"></div>
                <div class="carousel-caption">
                    <!--<h2>Caption 1</h2>-->
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://studentaffairs.unt.edu/sites/default/files/university-union/images/Welcome%20to%20the%20Union%20make%20your%20mark.jpg');"></div>
                <div class="carousel-caption">

                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://4.bp.blogspot.com/-929wf9JDpJ0/Tn-_LrEyCOI/AAAAAAAAAQA/_0bQBY7qV0g/s1600/P9210185.JPG');"></div>
                <div class="carousel-caption">

                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Icons and Showing -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Big Art at a Small Price
                </h1>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i>Get Connected</h4>
                    </div>
                    <div class="panel-body">
                        <p>Connect with your fellow UNT students and show off your creativity by uploading your profile with drawings, paintings, sculptures, or whatever else you're into! This site also provides a way for students looking to purchase art; a way to buy and support students at the same time.</p>
                        <a href="http://cookiecodec.x10host.com/apps/register.php" class="btn btn-default">Sign Up</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i>Find Local Artists</h4>
                    </div>
                    <div class="panel-body">
                        <p>Our site provides a place for local artist to come together and show off their portfolio. In our gallery, you can search for art created by a specific artist and anything similar to their work. Contacting a local artist is as easy as using our messaging system that all users have access to.</p>
                        <a href="http://cookiecodec.x10host.com/apps/gallery.php" class="btn btn-default">Browse</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i>Find Work</h4>
                    </div>
                    <div class="panel-body">
                        <p>Looking for a specific type of artwork? This is the place for you! Here we provide a wide range of styles you can filter and search for to make things a bit simpler for the common buyer. Make sure you check out the gallery where you can view anything we have available!</p>
                        <a href="http://cookiecodec.x10host.com/apps/gallery.php" class="btn btn-default">Gallery</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Featured Stuff
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Featured Stuff :)</h2>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="https://identityguide.unt.edu/sites/default/files/UNTongreen.png" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="https://identityguide.unt.edu/sites/default/files/UNTongreen.png" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="https://identityguide.unt.edu/sites/default/files/UNTongreen.png" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="https://identityguide.unt.edu/sites/default/files/UNTongreen.png" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="https://identityguide.unt.edu/sites/default/files/UNTongreen.png" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="https://identityguide.unt.edu/sites/default/files/UNTongreen.png" alt="">
                </a>
            </div>
        </div>
        /.row 

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Website Features</h2>
            </div>
            <div class="col-md-6">
                <p>The website includes:</p>
                <ul>
                    <li><strong>Art from UNT students</strong>
                    </li>
                    <li>Link or Text</li>
                    <li>Link or Text</li>
                    <li>Link or Text</li>
                    <li>Link or Text</li>
                    <li>Link or Text</li>
                </ul>
                <p>Text Bottom</p>
            </div>
            <div class="col-md-6">
                <img class="img-responsive" src="https://identityguide.unt.edu/sites/default/files/UNTongreen.png" alt="">
            </div>
        </div>

        <hr>
-->
   

        <hr>

 
        <footer>
        </footer>

    </div>

<script>
    $('.carousel').carousel({
        interval: 3000
    })
</script>


</body>

</html>