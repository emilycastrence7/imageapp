<?php

/*
This file handles the like/un-like logic and updates the like UI
*/
require('../config.php');
require_once('../includes/functions.php');

//incoming data
$post_id = $_REQUEST['post_id'];
$user_id = $_REQUEST['user_id'];

//check to see if this user already likes this post
$query = "SELECT * FROM likes
          WHERE post_id = $post_id
          AND user_id = $user_id
          LIMIT 1";

$result = $db->query($query);
//if so, REMOVE the like
if( $result->num_rows == 1 ){

$query = "DELETE FROM likes
          WHERE post_id = $post_id
          AND user_id = $user_id
          LIMIT 1";

//if not, ADD the like
}else{

$query = "INSERT INTO likes
          (post_id, user_id, date)
          VALUES
          ($post_id, $user_id, now())";

}

//Run the query
$result = $db->query($query);
//check to see if it worked (one row will be deleted or added)
if( $db->affected_rows == 1 ){
//update the UI
likeinterface($post_id, $user_id);

}else{
  //TO DO REMOVE AFTER TESTING
  echo 'like failed';

}
