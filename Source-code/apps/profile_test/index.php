<?php
session_start();
include_once '../dbconnect.php';

if(isset($_GET['id']))
{
  $id = intval($_GET['id']);
  //We check if the user exists
  $dn = mysqli_query($con,'SELECT * FROM users WHERE id="'.$id.'"');
  if(mysqli_num_rows($dn)>0)
  {
    $dnn = mysqli_fetch_array($dn);
    //We display the user datas
  }
  if($dnn['accountType'] == '1')
  {
    $account = 'Artist';
  }
  else{
    $account = 'User';
  }
}
  $username = $dnn['username'];
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Profile</title>
     <!-- FONT AWESOME ICONS STYLE SHEET -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES -->
    <link href="assets/css/profile-css.css" rel="stylesheet" />
</head>
<body >
    <!--NAVIGATION-->
    <?php include_once('../../lib/header.php'); ?>
    <!-- NAVBAR CODE END -->
    <div class="container" style="background-color: #F9F9F9; border:1px solid #7C7C7C;">
        <div class="row">
                <div class="col-md-12 text-center">
                    <br />
                    <br />
                </div>
            </div>
         <!-- USER PROFILE ROW STARTS-->
            <div class="row">
                <div class="col-md-4 col-sm-4" style="border:1px solid #D3D3D3;">
                                       
                    <div class="user-wrapper">
                        <img src="<?php echo htmlentities($dnn['avatar']);?>" class="img-responsive" /> 
                    <div class="description">
                       <h4> <?php echo htmlentities($dnn['name']);?></h4>
                        <h5> <strong> <?php echo $account; ?> </strong></h5>
                          <table class="table">
                          <tbody>
                            <tr>
                              <td style="white-space:nowrap;">Username:</td>
                              <td style="white-space:nowrap;"><?php echo htmlentities($dnn['username']); ?></td>
                            </tr>
                            <tr>
                              <td style="white-space:nowrap;">Location</td>
                              <td style="white-space:nowrap;">Denton, TX</td>
                            </tr>
                            <tr>
                              <td style="white-space:nowrap;">Contact Email</td>
                              <td style="white-space:nowrap;"><a href="mailto:info@support.com"><?php echo $dnn['email']; ?></a></td>
                            </tr>
                           
                          </tbody>
                      </table>
                      <?php if($_GET['id'] == $_SESSION['usr_id']){
                        echo('
                        <form method="get" action="../edit-profile.php">
                            <button type="submit">Edit Profile</button>
                        </form>');
                      } ?>
                        <hr />
                        <?php if($_SESSION['usr_id'] != $_GET['id']) 
                        {
                        echo '<a href="../pm/new_pm.php?recip='.$username.'"class="btn btn-danger btn-sm"> <i class="fa fa-user-plus" ></i> &nbsp;Send Message </a>';
                        } 
                        ?>
                    </div> <!--END DESCRIPTION BOX-->
                     </div>
                </div>
                
                <div class="col-md-8 col-sm-8  user-wrapper">
                    <div class="description">
                         <h3>About Me: </h3>
                         <hr />
                    <p>
                      <?php echo $dnn['about'];?>
                    </p>              
                    <?php 
                    //IF ACCOUNT IS ARTIST
                    if($dnn['accountType'] == '1')
                    {
                      echo "<h3>".htmlentities($dnn['name'])."'s Work</h3>";
                      echo "<hr/>";
                      $target_dir = "../../img/art/" . $dnn['id'] . "/";
                      $images = glob($target_dir . '*.{jpg,jpeg,png,gif,JPG,PNG}', GLOB_BRACE);//only images
                      foreach ($images as $image){
          							$img = substr($image, 6);
          							$result = mysqli_query($con, "SELECT id FROM images WHERE imgPath = '$img'");
          							$row = mysqli_fetch_assoc($result);
                        $imageId = $row['id'];
          							$imgid = "../img-edit.php?id=".$row['id'];
          							?>
          								<div class="col-lg-3 col-md-4 col-xs-6 thumb"> 
          									<a class="thumbnail" data-toggle="modal" href="#myModal1"> 
          										<img class="getSrc" src='<?php echo $image; ?>' href='<?php echo $imgid; ?>' alt="" style="width:140px;height:93px"> 
          									</a> 
                          </div>
          							<?php } } ?>
                    </div>
            </div>

            </div>
           <!-- USER PROFILE ROW END-->
    </div>
    <!-- CONATINER END -->
    <!-- REQUIRED SCRIPTS FILES -->
    <!-- CORE JQUERY FILE -->
<div id="myModal1" class="modal fade" tabindex="-1">

	<div class="modal-content-box">
		<div class="modal-body">
			<img src="" class="showPic" id="modalpic" width="100%">
		</div>
		<div class="modal-footer">
		<?php
		if($_GET['id'] == $_SESSION['usr_id'])
		{	?>
			<a role="button" class="btn btn-default" id="imgedit" href="">Edit image</a>			
		<?php
		}
		?>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
</body>
<script>

	// function to make it display current modal on top and not greyed out
	$(document).on('show.bs.modal', '.modal', function () {
	var zIndex = 1040 + (10 * $('.modal:visible').length);
		$(this).css('z-index', zIndex);
		setTimeout(function() {
			$('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
		}, 0);
	});
     $('.getSrc').click(function() {
        var src =$(this).attr('src');
		var imgid =$(this).attr('href');
		var imguser =$(this).attr('id');

        $('.showPic').attr('src', src);
        $('#imgedit').attr('href', imgid);
		
     });
	 
	var modal1 = document.getElementById('myModal1');

	//Get the <span> element that closes the modal-->
	var span1 = document.getElementByClass('close1')[0];
	 var modalimg = document.getElementByClass('showPic');


	modalimg.onclick = function() {
		modal1.style.display = "none";
	}
	
	//When the user clicks on <span> (x), close the modal-->
	span1.onclick = function() {
		modal1.style.display = "none";
	}

	//When the user clicks anywhere outside of the modal, close it-->
	window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</html>
