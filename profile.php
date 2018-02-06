<?php
include('includes/header.php');
//which post are we trying to view?
$user_id = $_GET['user_id'];

//make sure the post_id is a number
if( ! is_numeric($user_id) ){
  die('Invalid post');
}

?>

    <main class="content">
      <?php
      $query = "SELECT users.*, posts.*
FROM users
LEFT JOIN posts
ON ( users.user_id = posts.user_id )
WHERE users.did_confirm = 1
AND posts.is_published = 1
AND users.user_id = $user_id
ORDER BY username ASC
LIMIT 10";

      //run it
      $result = $db->query($query);
      //check it
    if( $result->num_rows >= 1 ){
      $count = 1;
      ?>

      <article>


<?php while( $row = $result->fetch_assoc() ){
//only show user info if first iteration
if($count == 1){


   ?>
  <?php show_avatar( $row['user_id'], 200); ?>
  <?php echo $row['username']; ?>
<p><?php echo $row['bio']; ?></p>

<?php }//end if first iteration ?>

<a href="single.php?post_id=<?php echo $row['post_id']; ?>">
<img src="<?php echo post_image_url($row['image'], 'thumbnail')  ?>">
</a>




      <?php
      $count ++;
    } //end while
      $result->free();
      ?>

              </article>
      <?php
    }

?>

    </main>
    <?php include('includes/sidebar.php'); ?>
<?php include('includes/footer.php'); ?>
