<?php
error_reporting( E_ALL & ~E_NOTICE );
//connect to the DB

$database_name ='emily_image_app';
$username = 'emily_imageapp';
$password ='Q8eC9MzdVLHd4Vbw';
$host = 'localhost';

$db = new mysqli( $host, $username, $password, $database_name );

//check for errors
if( $db->connect_errno > 0 ){
  die('Error connecting to Database');
}

//define the absolute url. user for links, like <a> and <img>

define( 'SITE_URL', 'http://localhost/emily-php/imageapp' );

//define the file root. user for include and file upload stuff

define( 'FILE_PATH', 'C:\xampp\htdocs\emily-php\imageapp' );


//Security! Random salt for our passwords and cookies

define( 'SALT', 'woajfoawru9o33owiehq'  );



//don't close it
