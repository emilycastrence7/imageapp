<?php
include('includes/header.php');
//which post are we trying to view?
$post_id = $_GET['post_id'];

//make sure the post_id is a number
if( ! is_numeric($post_id) ){
  die('Invalid post');
}

?>

    <main class="content">
      <?php //get the one published post
      $query = "SELECT posts.title, posts.body, posts.image, posts.date, users.username, categories.name, posts.post_id, users.avatar, users.user_id
                FROM posts, users, categories
                WHERE is_published = 1
                AND posts.user_id = users.user_id
                AND posts.category_id = categories.category_id
                AND posts.post_id = $post_id
                LIMIT 1";
      //run it
      $result = $db->query($query);
      //check it - are there rows of data to show?
      if( $result->num_rows >= 1 ){

        while( $row = $result->fetch_assoc() ){

      ?>
      <article>
        <h2>

<?php show_avatar( $row['user_id'], 50); ?>
          <?php echo $row['username']; ?>

        </h2>
        <a href="single.php?post_id=<?php echo $row['post_id']; ?>">
        <img src="<?php echo post_image_url( $row['image'], 'large' ); ?>">
      </a>
        <div class="postinfo">
          <h3><?php echo $row['title']; ?></h3>
           <p><?php echo $row['body']; ?></p>
          <span class="date"><?php echo convert_date($row['date']); ?></span>
          <span class="commentcount"><?php count_comments($row['post_id']); ?></span>
      </article>
      <?php
    } //end while
?>
WHEREROIWERO
<section class="comments">
<?php
//get all the approved comments about this post, Oldest first


echo $query = "SELECT users.username, users.user_id, comments.body, comments.date
          FROM comments, users
          WHERE comments.user_id = users.user_id
          AND comments.is_approved = 1
          AND comments.post_id = $post_id
          ORDER BY date ASC
          LIMIT 30";

//run it
$result = $db->query($query);

//check it
if( $result->num_rows >= 1){
?>
<h3>Comments</h3>
<ol class="commentlist">
  <?php while( $row = $result->fetch_assoc() ){  ?>
  <li>
    <h4>
      <?php show_avatar( $row['user_id'], 50 ); ?>
      <?php echo $row['username']; ?>
    </h4>
    <p><?php echo $row['body']; ?></p>
    <span class="date"><?php echo convert_date( $row['date'] ); ?></span>
  </li>
<?php } //end while ?>
</ol>

<?php
}else{
  echo ' There are no comments yet on this post.';
}

?>

</section>



<?php
 //free it
    $result->free();
    }else{
      //no rows found
      echo 'Sorry, no posts to show here';
    } ?>
    </main>
    <?php include('includes/sidebar.php'); ?>
<?php include('includes/footer.php'); ?>
