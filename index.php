<?php include('includes/header.php'); ?>

    <main class="content">
      <?php //get all published post, newest first
      $query = "SELECT posts.title, posts.body, posts.image, posts.date, users.username, categories.name, posts.post_id, users.avatar, users.user_id
                FROM posts, users, categories
                WHERE posts.is_published = 1
                AND posts.user_id = users.user_id
                AND posts.category_id = categories.category_id
                AND users.did_confirm = 1
                ORDER BY posts.date DESC
                LIMIT 20";
      //run it
      $result = $db->query($query);
      //check it - are there rows of data to show?
      if( $result->num_rows >= 1 ){

        while( $row = $result->fetch_assoc() ){

      ?>
      <article>
        <h2>
<a href="profile.php?user_id=<?php echo $row['user_id']; ?>">
<?php show_avatar( $row['user_id'], 50); ?>
</a>
          <?php echo $row['username']; ?>

        </h2>


        <a href="single.php?post_id=<?php echo $row['post_id']; ?>">
        <img src="<?php echo post_image_url( $row['image']); ?>" alt="<?php echo $row['title']; ?>">
      </a>

<?php //if this post was written by the logged in user, show the edit button
if( $row['user_id'] == $logged_in_user['user_id'] ){
  $post_id = $row['post_id'];
  echo "<a href='editpost.php?post_id=$post_id'>Edit</a>";
}
?>

        <div class="postinfo">
          <h3><?php echo $row['title']; ?></h3>
          <div class="likes">
          <?php likeinterface( $row['post_id'], $logged_in_user['user_id']); ?>
        </div>

           <p><?php echo $row['body']; ?></p>
          <span class="date"><?php echo convert_date($row['date']); ?></span>
          <span class="commentcount"><?php count_comments($row['post_id']); ?></span>
      </article>
      <?php
    } //end while
    $result->free();
    }else{
      //no rows found
      echo 'Sorry, no posts to show here';
    } ?>
    </main>
    <?php include('includes/sidebar.php'); ?>



<?php include('includes/footer.php'); ?>
