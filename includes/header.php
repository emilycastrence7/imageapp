<?php
session_start();
//DB connection
require('config.php');
include_once( 'includes/functions.php' );

//get all the info about the possibly logged in user
$logged_in_user = check_login();


?>


<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <title>Image App!</title>
  </head>
  <body>
    <header class="header">
        <h1>Image App Name</h1>

<!-- <pre><?php print_r($logged_in_user); ?></pre> -->


    </header>
    <nav class="mainnavwrapper">
<section class="searchbar">
<form action="search.php" method="get">
<label class="screenreadertext" for="the_phrase">Search:</label>
<input type="search" name="phrase" id="the_phrase">

<input type="submit" value="search">

</form>

</section>

<ul class="menu">
  <?php if( ! $logged_in_user ){ ?>
<li><a href="login.php">Log In</a></li>
<li><a href="register.php">Sign Up</a></li>

<?php }else{ ?>

  <li><a href="addpost.php">Add Post</a></li>
  <li>
    <a href="profile.php?user_id=<?php echo $logged_in_user['user_id']; ?>"></a>
  </li>

<li><a href="profile.php?user_id=<?php echo $logged_in_user['user_id'] ?>">Your Profile</a>
</li>
<li><a href="#">Edit Profile</a></li>
<?php } ?>


</ul>




      </nav>
    <div class="wrapper">
