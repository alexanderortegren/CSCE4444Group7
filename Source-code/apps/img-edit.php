<?php
session_start();
include_once 'dbconnect.php';
?>

<!DOCTYPE html>

<html>

<head>
    <script language= "JavaScript" type="text/javascript" src="bootstrap/jquery/jquery-3.1.1.min.js"></script>
    <script src="../lib/imgTags.js"></script>
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

    <!--TAG TABLE CSS-->
    <style>
    .tagButton{
        width: 25px;
    }

    SELECT, INPUT[type="text"] {
    width: 160px;
    box-sizing: border-box;
    }
    SECTION {
        padding: 8px;
        background-color: #f0f0f0;
        overflow: auto;
    }
    SECTION > DIV {
        float: left;
        padding: 4px;
    }
    SECTION > DIV + DIV {
        width: 40px;
        text-align: center;
    }
    </style>

    <script type="text/javascript">
    document.getElementById("deleteImage").onclick = function () {
        location.href = "www.cookiecodec.x10host.com";
    };
    </script>

</head>

<body>

<!-- Navigation-->
<?php include_once('../lib/header.php');?>

<div class="row">

<?php
        $imgID = $_GET['id'];
        //GET IMAGE INFORMATION FROM DB
        $query = mysqli_query($con,'SELECT timestamp, imgName, imgFileName, imgPath, imgOwner FROM images WHERE id="'.$imgID.'"');
        //QUERY FOR GETTING EXISTING TAGS
        $getTags = mysqli_query($con,'SELECT imgTags FROM images WHERE id="'.$imgID.'"');
        //STORE TAGS IN VARIABLE
        $existingTags = mysqli_fetch_array($getTags);
        $existingTags = $existingTags['imgTags'];
        //SPLIT OUR TAGS INTO AN ARRAY
        $existingTags = explode(",", $existingTags);
        //STORE IMG INFO IN $img VARIABLE
        $img = mysqli_fetch_array($query);
        //GET IMAGE PATH, NAME, AND OWNER
        $imgPath = "../" . $img['imgPath'];
        $imgName = $img['imgName'];
        $imgOwner = $img['imgOwner'];
        //SET TAGS AVAILABLE FOR USE BY USER
        $availableTags = array("Drawing","Pencil","Colored pencil","Ink","Markers","Pastels","Chalk","Painting","Watercolor","Acrylic","Oil","Photography");
        //LETS REMOVE ALL OF THE TAGS FROM AVAILABLETAGS THAT EXIST IN EXISTINGTAGS
        $tags = array_diff($availableTags, $existingTags);

        //IF USER IS LOGGED IN
        if(isset($_SESSION['usr_username']))
        {
            if(get_magic_quotes_gpc())
            {
                $_POST['imgName'] = stripslashes($_POST['imgName']);
                $_POST['tags'] = stripslashes($_POST['tags']);  
            }
            if (isset($_POST['deleteImage'])){
                echo '<script>window.location = "img-del.php?id='; echo $imgID . '";</script>';
            }

            if (isset($_POST['submitForm'])) {
            //IF THE Image Name FIELD IS FILLED IN
             if(isset($_POST['imgName']))
                {
                    //PULL ALL TEXT FROM <OPTION> TAGS IN RIGHT COLUMN
                    //AND STORE ALL OF OUR TAGS IN VARIABLE $allvalues
                    $count = count($_POST['rightValues']); //NUMBER OF TAGS
                    for($i=0;$i<$count;$i++)
                    {
                        $allvalues .= $_POST['rightValues'][$i];
                        $minus = $count-1;
                        if($i<$minus)
                            {
                                $allvalues .= ',';
                            }
                    }
                    //LETS CONVERT VALUES IN $ALLVALUES INTO INTEGERS FOR OUR FILTERING
                    //CONVERT $allvalues to array
                    $allvaluesint = explode(',',$allvalues);
                    //iterate through each filter, and convert to integer
                    foreach ($allvaluesint as &$valueint)
                    {   
                        echo $valueint;
                        //DRAWING
                        if ($valueint == "Drawing"){
                            $valueint = "1";
                        }
                        elseif ($valueint == 'Pencil'){
                            $valueint = '2';
                        }
                        elseif ($valueint == 'Colored pencil'){
                            $valueint = "3";
                        }
                        elseif ($valueint == "Ink"){
                            $valueint = "4";
                        }
                        elseif ($valueint == "Markers"){
                            $valueint = "5";
                        }
                        elseif ($valueint == "Pastels"){
                            $valueint = "6";
                        }
                        elseif ($valueint == "Chalk"){
                            $valueint = "7";
                        }
                        elseif ($valueint == "Painting"){
                            $valueint = "8";
                        }
                        elseif ($valueint == "Watercolor"){
                            $valueint = "9";
                        }
                        elseif ($valueint == "Acrylic"){
                            $valueint = "10";
                        }
                        elseif ($valueint == "Oil"){
                            $valueint = "11";    
                        }
                        elseif ($valueint == "Photography"){
                            $valueint = "12";
                        }

                    }//END FOR EACH
                    //CONVERT OUR ARRAY BACK TO STRING OF INTS
                    $arrayint = implode(", ",$allvaluesint);
                    $tagsInt = mysqli_real_escape_string($con, $arrayint);
                    $tags = mysqli_real_escape_string($con,$allvalues);
                    //UPDATE DATABASE WITH TAGS AND IMAGE NAME
                    mysqli_query($con, 'UPDATE images SET imgTags="'.$tags.'", imgName = "'.$_POST['imgName'].'" , intTags = "'.$tagsInt.'" WHERE id ="'.mysqli_real_escape_string($con,$imgID).'"');
                    //REDIRECT TO GALLERY PAGE
                    echo '<script>window.location = "http://www.cookiecodec.x10host.com/apps/profile_test/index.php?id='.$_SESSION['usr_id'].'"</script>';
                }//END TAGS
            }
        }
?>

    <div class="container">
        <div class="row">
                <div class="col-md-12 text-center">
                    <br />
                    <br />
                </div>
            </div>
         <!-- USER PROFILE ROW STARTS-->
            <div class="row">

                <div class="col-md-9 col-sm-9  user-wrapper">
                    <div class="description">
                         <p align="left"><font size="10"><?php echo $imgName; ?></font></p>
                    <hr />
                <?php
                    echo  "<div class=\"col-lg-3 col-md-4 col-xs-6\"> 
                            <a class=\"\" > 
                            <img class=\"img-responsive\" src='{$imgPath}' alt=\"\" style=\"width:auto;\"> 
                            </a> 
                        </div>";
                ?>
                <div class="content">
                <form method="post">
                    <br />
                    <div class="center">
                        <label for="imgOwner">Owner:</label><?php echo $imgOwner; ?>
                        <br />
                        <label for="timestamp">Upload Date:</label><?php echo date('m/d/y',$img['timestamp']); ?>
                        <br />
                        <label for="imgName">Name:</label><input type="text" name="imgName" id="imgName" value="<?php echo $imgName; ?>" />
                        <br />        
                        <label for="tags">Tags:</label>
                        <br />
                    <section class="center">
                    <div>
                        <select name="leftValues[]" id="leftValues" size="5" multiple>
                                <?php  foreach($tags as $tag) {echo "<option>$tag</option>}";} ?>
                        </select>
                    </div>
                    <div>
                        <input type="button" class = "tagButton" id="btnLeft" value="&lt;&lt;" />
                        <input type="button" class = "tagButton" id="btnRight" value="&gt;&gt;" />
                    </div>
                    <div>
                        <select name="rightValues[]" id="rightValues" size="4" multiple>
                            <?php  foreach($existingTags as $existingTag) {echo "<option>$existingTag</option>";} ?>
                        </select>
                        <div>
                            <input type="text" id="txtRight" />
                        </div>
                    </div>
                </section>
                    </div>
                    <input name="submitForm" type="submit" value="Send" />
                    <button name="deleteImage" value="Delete Image"> Delete Image </button>
                </form>
                    <br/>
                </div>              
                        <hr/>

                    </div>
                </div>

            </div>
           <!-- USER PROFILE ROW END-->
    </div>
    <!-- Main Content -->


</div>

</body>

</html>