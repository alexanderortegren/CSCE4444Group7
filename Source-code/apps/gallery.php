<?php
session_start();
include_once 'dbconnect.php';

//LETS GET ALL IMAGE FILTERS FROM DB
$fetchTags = mysqli_query($con,"SELECT imgTags FROM images");
//This stores who the image owner is
$filters = array();
    while($row = mysqli_fetch_assoc($fetchTags)) {
        if(!empty($row)){
            $filters[] = $row["imgTags"];
        }
    }
//TURN ARRAY INTO STRING
$comma_separated = implode(",",$filters);
//REMOVE DUPLICATE TAGS FROM THAT STRING
$tags = implode(',',array_unique(explode(',', $comma_separated)));
//PUT TAGS BACK INTO ARRAY
$tagsArray = explode("," , $tags);
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

    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
    <!--CUSTOM CSS-->
    <link href="/css/cookie.css" rel="stylesheet" type="text/css">
    <!--FILTERIZR-->
    <link rel="stylesheet" href="/css/filter.css">
   
</head>

<body>

	    <!-- Navigation -->
	    <?php include_once('../lib/header.php');?>

	    <!-- Main Content -->
<div class="container">
	<div class="container-fluid">
	    <div class="row">
	    	<div class="filtr-container">
		        <div class="col-lg-12">
		            <p align="right"><font size="10">GALLERY</font></p>
					<div class="col-lg-12" style="padding-bottom: 10px; border-top: 1px solid #000000"></div>
		        </div>
		        <br>
		        <div class="row">
			        <ul class="simplefilter">
			            <li class="active" data-filter="all">All</li>
			            <li data-filter="1">Drawing</li>
			            <li data-filter="2">Pencil</li>
			            <li data-filter="3">Colored Pencil</li>
			            <li data-filter="4">Ink</li>
			            <li data-filter="5">Markers</li>
			            <li data-filter="6">Pastels</li>
			            <li data-filter="7">Chalk</li>
			            <li data-filter="8">Painting</li>
			            <li data-filter="9">Watercolor</li>
			            <li data-filter="10">Acrylic</li>
			            <li data-filter="11">Oil</li>
			            <li data-filter="12">Photography</li>
			        </ul>
		    	</div>
		    	
	        	<!-- Shuffle & Sort Controls -->
		        <div class="row">
		            <ul class="sortandshuffle">
		                <!-- Basic shuffle control -->
		                <li class="shuffle-btn" data-shuffle>Shuffle</li>
		                <!-- Basic sort controls consisting of asc/desc button and a select -->
		                <li class="sort-btn active" data-sortAsc>Asc</li>
		                <li class="sort-btn" data-sortDesc>Desc</li>
		            </ul>
		        </div>

				<?php
				session_start();
				include_once 'dbconnect.php';
				$username = $_SESSION['usr_username'];
				$sql = "SELECT id FROM users WHERE username = '$username'";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_assoc($result);
		        $path = "../img/art/*/";
				$target_dir = "../img/art/" . $row['id'] . "/";

		        //STORE ALL IMAGES IN $IMAGES
				$images = glob("" . $path .'*.{jpg,jpeg,png,gif,JPG,PNG}', GLOB_BRACE);//only images
		        $directories = glob($path . '/*' , GLOB_ONLYDIR);
		        $i = 2;
		    		foreach ($images as $image){
		                //REMOVE THE ../ FOR IMGPATH
		                $img = substr($image, 3);
		                $fetchOwner = mysqli_query($con,"SELECT imgOwner, intTags FROM images WHERE imgPath = '$img'");
		                //This stores who the image owner is
		                $ownerUsername = mysqli_fetch_assoc($fetchOwner);
		                $ownerUser = $ownerUsername['imgOwner'];
		                //echo $ownerUser;
		                //Now lets get that owners ID
		                $fetchID = mysqli_query($con, "SELECT id FROM users WHERE username = '$ownerUser'");
		                //This stores the id of the owner
		                $ownerID = mysqli_fetch_assoc($fetchID);
		                //WAS JUST SEEING WHAT WAS BEING STORED IN OWNERID VARIABLE
						
						// get image id and set into $imgID
						$fetchimgID = mysqli_query($con, "SELECT id FROM images WHERE imgPath = '$img'");
						$imgID = mysqli_fetch_assoc($fetchimgID);
						$imageID = $imgID['id'];
						$imgTagInt = $ownerUsername['intTags'];
						$imgTagInt = "$imgTagInt";
						$userid = $_SESSION['usr_id'];
		    			?>
		    	
						<div class="col-lg-3 col-md-4 col-xs-6 thumb filtr-item" data-category=<?php if($imgTagInt == ""){ echo '"1"';} else{echo '"' . $imgTagInt . '"';}?> data-sort=""> 
		    					<a class="thumbnail" data-toggle="modal" href="#myModal1">
									<!--href="/apps/profile_test/index.php?id=<?php// echo $ownerID['id'];?>"-->
									<img class="getSrc" data-ownerid='<?php echo $ownerID['id']; ?>' data-imgid='<?php echo $imgID['id']; ?>' data-imgfav="'<?php echo $favorited; ?>'" 
									src='<?php echo $image; ?>' alt="" style="width:252.5px;height:189.38px" href='/apps/profile_test/index.php?id=<?php echo $ownerID['id'];?>'>
								</a> 
		    			</div>

						
						<?php 	} ?>

			</div>
		</div>
	</div>
</div>


	<div id="myModal1" class="modal fade">

		<div class="modal-content-box">
			<div class="modal-body">
				<img src="" class="modal-content" id="modalpic" width="100%">
			</div>
			<div class="modal-footer">
				<a role="button" class="btn btn-default" id="imginfo" href="">Go to Artist</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>



<script>

	// function to make it display current modal on top and not greyed out
	$(document).on('show.bs.modal', '.modal', function () {
	var zIndex = 1040 + (10 * $('.modal:visible').length);
		$(this).css('z-index', zIndex);
		setTimeout(function() {
			$('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
		}, 0);
	});
	
	//var favorite;
	
     $('.getSrc').click(function() {
        var src =$(this).attr('src');
		var imglink =$(this).attr('href');
		var user_id =$(this).attr('data-ownerid');
		var img_id =$(this).attr('data-imgid');
		var img_fav =$(this).attr('data-imgfav');
		
        $('#modalpic').attr('src', src);
        $('#imginfo').attr('href', imglink);
		$('#favorite').attr('data-userid', user_id);			// id of owner of picture
		$('#favorite').attr('data-picid', img_id);				// id of picture
		//$('#favorite').attr('value', "Favorite");



		if(img_fav == "'1'")
		{
			$('#favorite').attr('value', "Un-Favorite");
		}
		else
		{
			$('#favorite').attr('value', "Favorite");			
		}


     });
	 
	function change()
	{
		var elem = document.getElementById("favorite");
		var img_id = elem.getAttribute("data-picid");

		if (elem.value=="Favorite") 
		{
			elem.value = "Un-Favorite";
		}
		else
		{
			elem.value = "Favorite";
		}
			
		// update user_id through ajax and jQuery if 
			
		$.ajax({
			url: '/apps/update_favorite.php',
			type: 'POST',
			data: {'imgid': img_id},
			success: function()
						{
							//alert("ok");
							location.reload();
							
						}	
		});

	}
	 
	var modal1 = document.getElementById('myModal1');

	//Get the <span> element that closes the modal-->
	var span1 = document.getElementByClass('close1')[0];
	 var modalpic = document.getElementById('modalpic');


	modalpic.onclick = function() {
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
	<!-- Include jQuery & Filterizr -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="Filterizr/src/jquery.filterizr.js"></script>
	<script src="Filterizr/src/controls.js"></script>

	<!-- Kick off Filterizr -->
	<script type="text/javascript">
	    $(function() {
	        //Initialize filterizr with default options
	        $('.filtr-container').filterizr();
	    });
	</script>
</body>

</html>