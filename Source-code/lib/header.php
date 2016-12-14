<?php 
//Defines root directory address to use with hrefs and src, to accurately point to our script and style files regardless of where .php pages are located. 
define('BASE_URL' , 'http://'.$_SERVER['HTTP_HOST'].'/');
//include_once "BASE_URLapps/upload/upload.php";
?>



<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <!--DOES THIS DO ANYTHING??? -GEORGE-->
            <a class="navbar-brand" href="/index.php">CookieCodec</a>

        </div>

        <div class="collapse navbar-collapse" id="navbar1">

            <ul class="nav navbar-nav navbar-right">

                <?php if (isset($_SESSION['usr_id'])) {
                  //Used for displaying number of unread messages
                  $req1 = mysqli_query($con,'SELECT m1.id, m1.title, m1.timestamp, count(m2.id) AS reps, users.id AS userid, users.name FROM pm AS m1, pm AS m2,users WHERE ((m1.user1="'.$_SESSION['usr_id'].'" AND m1.user1read="no" AND users.id=m1.user2) OR (m1.user2="'.$_SESSION['usr_id'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
                 ?>
                <li><a href="/apps/gallery.php#">Gallery</a></li>
                <!--FIRST DROPDOWN-->
                <li class="dropdown">
                        <a class="dropdown-toggle " data-toggle="dropdown" role="button" aria-expanded="false" href="#"><?php echo $_SESSION['usr_name']; ?> </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/apps/profile_test/index.php?id=<?php echo $_SESSION[usr_id];?>">My Profile</a></li>
                            <!--<li><a href="/apps/users.php">User List</a></li>-->
                            <li><a href="/apps/pm/list_pm.php">Inbox(<?php echo intval(mysqli_num_rows($req1)); ?>)</a></li>
                            <!--<li><a href="/apps/pm/new_pm.php">New Message</a></li>-->
                            <!--<li><a href="/apps/upload/upload_form.php">Upload</a></li>-->
                            <?php 
                            //IF USER LOGGED IN IS AN ARTIST, SHOW UPLOAD IMAGE BUTTON
                            if($_SESSION['usr_type'] == '1'){
                             echo '<li><a><button id="upload_btn">Upload Image</button></a></li>';
                            }
                            ?>
           		<!-- <span class="text-danger"><?php// if (isset($errormsg)) { echo $errormsg; } ?></span> -->

                        </ul>
                </li>
                <li><a href="/apps/about.php">About</a></li>
                <li><a href="/apps/logout.php"> Logout</a></li>

                <?php } else { ?>

                <li><a href="/apps/login.php">Login</a></li>

                <li><a href="/apps/register.php">Register</a></li>

                <?php } ?>

            </ul>

        </div>

    </div>

</nav>

<div id="myModal" class="modal">

	<div class="modal-content-box">
		<span class="close">x</span>
		<form id="upload_form" role="form"  action="<?php echo BASE_URL;?>apps/upload/upload.php" 
		method="POST" name="uploadform" enctype="multipart/form-data">
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
	</div>
</div>

<!-- <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span> -->

<!--BOOTSTRAP CSS-->
<meta content="width=device-width, initial-scale=1.0" name="viewport" >
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/css/bootstrap.css" rel="stylesheet" type="text/css"/>

<!--CUSTOM CSS-->
<link href="/css/pm.css" rel="stylesheet" title="Style" />
<link href="/css/cookie.css" rel="stylesheet" type="text/css"/>

<!--REQUIRED SCRIPTS-->
<script src="<?php echo BASE_URL;?>apps/bootstrap/jquery/jquery-3.1.1.min.js"></script>
<script src="<?php echo BASE_URL;?>apps/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo BASE_URL;?>lib/imgTags.js"></script>



<script>
//Get the modal
var modal = document.getElementById('myModal');

//Get the button that opens the modal-->
var btn = document.getElementById("upload_btn");

//Get the <span> element that closes the modal-->
var span = document.getElementsByClassName("close")[0];

//When the user clicks on the button, open the modal-->
btn.onclick = function() {
    modal.style.display = "block";
}


//When the user clicks on <span> (x), close the modal-->
span.onclick = function() {
    modal.style.display = "none";
}

//When the user clicks anywhere outside of the modal, close it-->
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/*function upload_file()
{

 $.ajax({
  type: 'POST',
  url: '<?php echo BASE_URL;?>apps/upload/upload.php',
  data: formData,
  processData: false,
  contentType: false,
  success: function (data) {
	alert(data);
   //$('#success__para').html("You data will be saved");
  }
 });
	
 return false;
}*/



</script>


