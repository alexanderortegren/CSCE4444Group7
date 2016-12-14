<?php
session_start();
include_once 'dbconnect.php';

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Thumbnail Gallery - Start Bootstrap Template</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css"/>
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <!--CUSTOM CSS-->
    <link href="/css/cookie.css" rel="stylesheet" type="text/css"/>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<script src="bootstrap/jquery/jquery-3.1.1.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>

</head>

<body>

    <!-- Navigation -->
    <?php include_once('../lib/header.php');?>


<div class="row">






<!-- Menu -->
    <div class="side-menu">
    
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">
            <!-- Hamburger -->
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand -->
            <div class="brand-name-wrapper">
                <a class="navbar-brand" href="#">
                    Gallery Search
                </a>
            </div>

            <!-- Search -->
            <a data-toggle="collapse" href="#search" class="btn btn-default" id="search-trigger">
                <img src="http://www.sucampo.com/wp-content/themes/sucampo/images/search-icon.png" style="width:20px;height:20px;">
            </a>

            <!-- Search body -->
            <div id="search" class="panel-collapse collapse">
                <div class="panel-body">
                    <form class="navbar-form" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default "><img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-arrow-right-b-128.png" style="width:20px;height:20px;"></button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">
            <!-- Dropdown-->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                    Sub Level <span class="caret"></span>
                </a>
                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>

                            <!-- Dropdown level 2 -->
                            <li class="panel panel-default" id="dropdown">
                                <a data-toggle="collapse" href="#dropdown-lvl2">
                                    Sub Level <span class="caret"></span>
                                </a>
                                <div id="dropdown-lvl2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="#">Link</a></li>
                                            <li><a href="#">Link</a></li>
                                            <li><a href="#">Link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
	    <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl3">
                    Sub Level <span class="caret"></span>
                </a>
                <!-- Dropdown level 3 -->
                <div id="dropdown-lvl3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>

                            <!-- Dropdown level 4 -->
                            <li class="panel panel-default" id="dropdown">
                                <a data-toggle="collapse" href="#dropdown-lvl4">
                                    Sub Level <span class="caret"></span>
                                </a>
                                <div id="dropdown-lvl4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="#">Link</a></li>
                                            <li><a href="#">Link</a></li>
                                            <li><a href="#">Link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
           <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p align="right"><font size="10">GALLERY</font></p>
		<div class="col-lg-12" style="border-top: 1px solid #000000"></div>
            </div>
		<p>
		<div class="collapse navbar-collapse" id="navbar1">
		<ul class="nav navbar-nav navbar-left">
		<li class="dropdown" id="filtertext">

                        <a class="dropdown-toggle " data-toggle="dropdown" role="button" aria-expanded="false" href="#">Sort By</a>

                        <ul class="dropdown-menu" role="menu">

                            <li id="filtertext"><a href="#">Relevance</a></li>

                            <li id="filtertext"><a href="#">Popularity</a></li>

                            <li id="filtertext"><a href="#">Newest</a></li>

                        </ul>

                </li>
		</ul>
		</div>
		</p>

		<?php
		session_start();
		include_once 'dbconnect.php';

		$username = $_SESSION['usr_username'];
		$sql = "SELECT id FROM users WHERE username = '$username'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($result);
        $path = "../img/art/*/";
		$target_dir = "../img/art/" . $row['id'] . "/";

        //WAS gloc($target_dir . ...);
		$images = glob("" . $path .'*.{jpg,jpeg,png,gif,JPG,PNG}', GLOB_BRACE);//only images
        $directories = glob($path . '/*' , GLOB_ONLYDIR);
    		foreach ($images as $image)
    		{
    			//echo "<img src='$image' />";
    			echo  "<div class=\"col-lg-3 col-md-4 col-xs-6 thumb\"> 
    					<a class=\"thumbnail\" href=\"#\"> 
    					<img class=\"img-responsive\" src='{$image}' alt=\"\" style=\"width:252.5px;height:189.38px\"> 
    					</a> 
    				</div>";
    			//<!-- style="width:252.5px;height:189.38px; --> 
                //echo $_SESSION['usr_id'];
    		}

		?>



        </div>


           
         
        </div>
    </div>
</div>

</body>

</html>