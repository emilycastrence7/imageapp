<?php
/*
Stand alone login form. This file does not load the header file
*/


//open or resume the current session
session_start();

require('config.php');
include_once('includes/functions.php');

//grab the feedback from the query string
$feedback = $_GET['feedback'];

//if the user tried to log in, check the credentials
if( $_POST['did_login'] ){

  //sanitize everything
  $username = clean_string($_POST['username']);
  $password = clean_string($_POST['password']);

//make sure length limits are correct
if( strlen($username) < 5 OR strlen($username) > 30 OR strlen($password) < 8 ){
  $feedback = 'Incorrect Username/Password Combo (length)';
}else{
  //looik them up in the DB
  $salted_pass = $password . SALT;
  $query = "SELECT * FROM users
            WHERE username = '$username'
            AND password = SHA1('$salted_pass')
            Limit 1";

            $result = $db->query($query);
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            //if one row found, Log them in!
            if( $result->num_rows == 1 ){
              //SUCCESS
              $feedback = 'You are now logged in';
              //store secret key in database, cookies and session_start
              $secret_key = sha1(microtime() . SALT );

              $query = "UPDATE users
                        SET secret_key = '$secret_key'
                        WHERE username = '$username'";

                    $result = $db->query( $query );

              setcookie('secret_key', $secret_key, time() * 60 * 60 * 24 * 30 );
              $_SESSION['secret_key'] = $secret_key;

              //store the user ID
              setcookie('user_id', $user_id, time() * 60 * 60 * 24 * 30 );
              $_SESSION['user_id'] = $user_id;

              //redirect to the home page
              header('location:index.php');

            }else{
              //error
              $feedback = 'Incorrect Username/Password combo (not in DB)';
            }
}

}//end if did_login

//logout logic. URL will look like ?action=logout
if( $_GET['action'] == 'logout' ){

      if (ini_get("session.use)cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );

      }

      //destroy the session
      session_destroy();
      //unset all session vars
      $_SESSION['loggedin'] = false;
      //unset all cookies
}     setcookie( 'loggedin', false, time() - 999999 );
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login into your account</title>
        <link rel="stylesheet" type="text/css" href="style.css" />


        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto+Slab" rel="stylesheet">
  </head>

  <body>
<h1>Log In</h1>

<?php if( isset($feedback) ){
echo $feedback;
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; //can use login.php in action as well ?>">

  <label for="the_username">Username</label>
  <input type="text" name="username" id="the_username">


  <label for="the_password">Password</label>
  <input type="password" name="password" id="the_password">

  <input type="submit" value="Log In">

  <input type="hidden" name="did_login" value="true">
</form>


  </body>

  </html>
