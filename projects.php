<!DOCTYPE html>
<html>
<?php
	require 'components/_head-header.php';
	include 'connect.php';
?>
listing page!!
<div class="section section--about">
    <div class="container">
		<?php
			if( isset( $_POST['preview']) ) { //if preview button is clicked
				//get blog post input from user
				echo "<article>
				<div class = 'previewBorder'>
				<div class = 'previewSection'>";
				session_start();
				$_SESSION['previewTitle'] = $_POST["title"];
				$_SESSION['previewBlog'] = $_POST["blogText"];
				//get time
				$format = 'jS F Y, G:i e';
				date_default_timezone_set('UTC');
				$_SESSION['time'] = date($format);
				//print post details
				echo "<h2>Preview</h3>";
				echo "<a href='addPost.php'>Upload Entry</a>";
				echo "<a href='javascript:history.back()'>Edit Entry</a>";
				echo "<p id = 'blogTime'>". $_SESSION['time']. "" . "</p>";
				echo "<h3 id = 'blogTitle'>" .$_SESSION['previewTitle']. "</h3>";
				echo "<p id = 'blogText'>" . $_SESSION['previewBlog'] . "</p>" . "";
				echo "</div> <!end preview>
				</div>
				</article> <!end previewBorder>";
			}

			$sql = mysqli_query( $conn,"SELECT * FROM POSTS ORDER BY dateTime DESC" ) //sort by most recent
				or die("Query unsuccessful " . mysqli_error($conn));

			if( $sql-> num_rows > 0 ){ //if database table is filled
				while( $rows = mysqli_fetch_assoc( $sql ) ){
			$postID = $rows['postID'];
		?>

		<div class = "blog">
			<?php
				if(!isset($_SESSION)) {
					session_start();
				}
				if(isset($_SESSION["status"])){
					if($_SESSION["status"] === "admin"){
					echo "<form method='POST' action='delete.php' id = 'postForm'>
					<input type='hidden' name='postID' value='$postID'/>
					<input type = 'submit' class='deleteButton' value= 'Delete post'>
					</form>";
					}
				}
				//print post details
				echo "<p id = 'blogTime'>". $rows['dateTime'] . "" . "</p>";
				echo "<h3 id = 'blogTitle'>" . $rows['title'] . "</h3>";
				echo "<p id = 'blogText'>" . $rows['postContent']. "</p>" . "";
			?>
		</div>

		<div class = "commentPosts">
			<?php
				//comment section
				//get comment data from database
				$commentSql = mysqli_query($conn,"SELECT* FROM comments ORDER BY dateTime DESC")
				or die("Query unsuccessful " . mysqli_error($conn));
				echo "<p id ='commentTitle'>Comments</p>";

				if($commentSql-> num_rows > 0){
					while($commentRows = mysqli_fetch_assoc($commentSql)){
						if($rows['postID'] === $commentRows['postID']){//post ID on comment and post matches

							$commentID= $commentRows['ID']; //to use in form as hidden value
							//only admins can delete posts and comments
								//delete comment button for admin
							if(!isset($_SESSION)) {
								session_start();
							}
							if(isset($_SESSION["status"])){
								if($_SESSION["status"] === "admin"){
									echo "<form method='POST' action='delete.php' class = 'deleteCommentForm'>
									<input type='hidden' name='commentID' value='$commentID'/>
									<input type='submit'  class = 'deleteButton' value= 'Delete comment'> </form>";
								}
							}
						//print comments
							echo "<p id = 'commentTime'>". $commentRows['dateTime'] . "</p>";
							echo "<p id = 'commentUser'>".$commentRows['name']." @". $commentRows['username']." says</p>";
							echo "<p>". $commentRows['comment'] . "</p>";
						}
					}
				}
				$signedIn = "no";
				if(!isset($_SESSION)) {
					session_start();
				}
				if(isset($_SESSION['status'])){ //store username in session variable to allow easier usage in comment form
					$usernameComment = $_SESSION["username"];
					$nameComment = $_SESSION["name"];
					$signedIn = "yes";
				}
			?>
		</div>

		<div class = "commentSection">
			<form method="POST" action="addComment.php" class = 'commentForm'id = 'commentForm'>
				<input type='hidden' name='postID' value='<?php echo "$postID";?>'/>
				<input type='hidden' name='username' value='<?php echo "$usernameComment";?>'/>
				<input type='hidden' name='name' value='<?php echo "$nameComment";?>'/>
				<p><textarea rows = 3 class = 'comment' id = 'commentTextArea' name = 'commentText' placeholder = 'Leave a comment...'></textarea></p>
				<input class='button' id = 'commentButton' value= 'Comment' type='submit'>
			</form>
		</div>

		<script type="text/javascript">
			window.onload=function(){ //make sure DOM is loaded before getting its properties
				var signedIn = "<?php echo $signedIn ?>";
				var form = document.getElementsByClassName('commentForm');
				for (var i = 0; i < form.length; i++) { //apply an event listener to all commentForms
					form[i].addEventListener('submit', commentHandler);
				}

				function commentHandler(event){
					if (signedIn === "no"){
						var confirm = window.confirm("You are not signed in. Do you wish to login?");
						event.preventDefault();
							if(confirm){
								window.location = '/webroot/finalWebMini/login.html';
							}
					}
				}
			}
		</script>
		<?php
				} //end while loop
			} //end if statement
			$conn->close();
		?>
	</div>
</div>

<?php require 'components/_footer.html' ?>
</body>
</html>
