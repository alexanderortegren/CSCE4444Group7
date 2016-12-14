<?php
session_start();

if(isset($_SESSION['usr_id'])) {

  echo "Your session is running " . $_SESSION['usr_id'];

}
print_r($_SESSION);
?>


<!-- taken from website: -->

<!-- http://www.w3schools.com/php/php_file_upload.asp -->

<!-- edited by Alexander Ortegren, 10/11/2016 -->


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Form Upload images</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css"/>
    <link href="../../css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/cookie.css" rel="stylesheet" type="text/css"/

    <!-- Custom CSS -->
    <link href="../../css/thumbnail-gallery.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<!--NAVIGATION BAR-->
<?php include_once("../../lib/header.php"); ?>

<div class="container">

    <div class="row">

        <div class="col-md-4 col-md-offset-4 well">

            <form role="form" action="upload.php" method="post" name="uploadform" enctype="multipart/form-data">

                <fieldset>

                    <legend>Upload Image</legend>

                    

                    <div class="form-group">

                        <label for="name">Image</label>

                        <input type="file" name="fileToUpload" placeholder="Image" id="fileToUpload" />

                    </div>

                    <div class="form-group">

                        <input type="submit" name="submit" value="Upload Image" class="btn btn-primary" />

                    </div>

                </fieldset>

            </form>

            <!-- <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span> -->

        </div>

    </div>

</div>



<script src="../../lib/bootstrap/js/jquery-1.10.2.js"></script>

<script src="../../lib/bootstrap/js/bootstrap.min.js"></script>



</body>
</html>
