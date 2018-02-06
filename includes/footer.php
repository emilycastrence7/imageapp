</div> <!-- closes .wrapper -->
  <footer class="footer">This is the footer</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php if($logged_in_user){ ?>
  //only run the "likes" logic if user is logged in

  <script type="text/javascript">
//like/unlike
//when the user clicks like, send data to the ajax handler file
// use "on" to bind the event because the heart button is dynamically added to the page
$('.likes').on( 'click', '.heartbutton', function(){
  //which post? which user?
  var post_id = $(this).data('postid');
  var user_id = <?php echo $logged_in_user['user_id']; ?>;

  //console.log(post_id, user_id);

//grab the parent so we can update the display later
var likes_container = $(this).parents('.likes');


$.ajax({
  type: 'GET',
  url: 'ajaxhandlers/like.php',
  data: {
    'user_id' : user_id,
    'post_id' : post_id
  },
  datatype: 'html',
  success: function(response){
    //update the like interface in the parent div of this heart button
    likes_container.html(response);
  }
});

}  );

  </script>
<?php } ?>

</body>
</html>
