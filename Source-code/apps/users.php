<?php
session_start();
include('dbconnect.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>List of users</title>
    </head>
    <body>

        <?php

        ?>

        <?php include_once('../lib/header.php');?>

        <div class="content">
        This is the list of members:
        <table>
            <tr>
            	<th>Id</th>
            	<th>Username</th>
            	<th>Email</th>
                <th></th>
            </tr>
        <?php
        //We get the IDs, usernames and emails of users
        $req = mysqli_query($con,'SELECT id, username, email FROM users');

        while($dnn = mysqli_fetch_assoc($req))
        {
        ?>
        	<tr>
            	<td class="left"><?php echo $dnn['id']; ?></td>
            	<td class="left"><a href="profile_test/index.php?id=<?php echo $dnn['id']; ?>"><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
            	<td class="left"><?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td class="left"><form><?php echo '<a href="user-del.php?id='.$dnn['id'].'">Delete ' . $dnn['username'] . '</a>';?></form></td>
            </tr>
        <?php
        }
        ?>
        </table>
        </div>
        
	</body>
</html>