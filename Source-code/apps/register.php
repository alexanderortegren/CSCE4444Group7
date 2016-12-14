<?php
session_start();

if(isset($_SESSION['usr_id'])) {
    header("Location: ../index.php");
}

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $accountType = 0;
    $artistDesc = '';
    //DEFAULT PLACEHOLDER USER AVATAR
    $avatar = 'https://www.yotcha.com/assets/yotcha/images/profile-placeholder-c3188a5ee2dc23f2610451f6709002d7.jpg';
    $name = $firstName;
    
    if(isset($_POST['artist']))
        {   
            $accountType = 1;
            $artistDesc = mysqli_real_escape_string($con, $_POST['artistDesc']);
            $about = mysqli_escape_string($con, $_POST['about']);
        }

    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
    if (!$error) {
        $result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' OR email = '$email'");
        if($result->num_rows){
            $errormsg = "Sorry, that email or username is already taken";
        }
        elseif(mysqli_query($con, "INSERT INTO users(name,firstName, lastName, username,email,password,avatar,about,accountType,artistDesc) VALUES('" . $name . "','" . $firstName . "','" . $lastName . "','" . $username . "','" . $email . "', '" . md5($password) . "','".$avatar . "','" .$about . "','".$accountType ."','".$artistDesc ."')")) {
            //Create art folder (Tipton_10/10/2016)
            $sql = "SELECT id FROM users WHERE email = '$email'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            mkdir("../img/art/" . $row["id"] , 0755); // want this as 755?
            header("Location: http://cookiecodec.x10host.com/apps/login.php");
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration Script</title>
</head>
<body>

    <!--NAVIGATION-->
    <?php include_once('../lib/header.php');?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                <fieldset>
                    <legend>Sign Up</legend>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="firstName" placeholder="First Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
                        <input type="text" name="lastName" placeholder="Last Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" name="username" placeholder="Enter Desired Username" required value="<?php if($error) echo $username; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($username_error)) echo $username_error; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                    </div>
                    <!--ARTIST SEGMENT-->
                        <input type="checkbox" data-toggle="collapse" data-target="#demo" name="artist">Artist?</br>
                        <div id="demo" class="collapse">
                            <hr>
                            <div class="form-group">
                                <label for ="comment">Describe Your Artwork:</label>
                                <textarea class="form-control" name = "artistDesc" placeholder = "eg. digital art, oil, pencil, etc." rows = "2" id="comment"></textarea>
                            </div>
                            <div class="form-group">
                                <label for ="comment">Tell us about yourself:</label>
                                <textarea class="form-control" name = "about" placeholder = "" rows = "4" id="comment"></textarea>
                            </div>
                            <hr>
                        </div>

                    <!--END ARTIST SEGEMENT-->
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Confirm Password</label>
                        <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        Already Registered? <a href="login.php">Login Here</a>
        </div>
    </div>
</div>

</body>
</html>