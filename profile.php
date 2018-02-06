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
      $query = "SELECT username, avatar, bio, user_id
                FROM users
                LIMIT 1";
      //run it
      $result = $db->query($query);
      //check it
    if( $result->num_rows >= 1 ){
      ?>

      <article>

<?php while( $row = $result->fetch_assoc() ){ ?>
  <?php show_avatar( $row['user_id'], 200); ?>
  <?php echo $row['username']; ?>
<p><?php echo $row['bio']; ?></p>

      <?php } //end while
      $result->free();
      ?>

              </article>
      <?php
    }

?>

    </main>
    <?php include('includes/sidebar.php'); ?>
<?php include('includes/footer.php'); ?>
