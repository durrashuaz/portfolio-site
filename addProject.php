<?php 
	require 'components/_head-header.php';
	if( !( isset($_SESSION['status']) &&  $_SESSION['status'] === "admin") ) { ?>
		<div class="section">
			<div class="container"> <?php
				echo "Non-admins do not have posting priveledges.";
	}
	else { ?>
		<h1 class="h1 h1--mb">Add Project Entry</h1>
		<form class="project-form" id="addPostForm" method="POST" enctype="multipart/form-data" action="add-project/_processProjectEntry.php">
			<label for="project-title">Title</label>
			<input class="a6-12 e10-12 g6-6" id="project-title" name="title" type="text">
			<label for="project-link">Link</label>
			<input class="a6-12 e10-12 g6-6" id="project-link" name="link" type="text">
			<label for="project-subtitle">Sub Title</label>
			<input class="a6-12 e10-12 g6-6" id="project-subtitle" name="subtitle" type="text">
			<label for="project-content">Organisation</label>
			<input class="a6-12 e10-12 g6-6" id="project-organisation" name="organisation" type="text">
			<label for="project-company">Content</label>
			<textarea class="a10-12 g6-6" id="project-content" name="projectText" rows=500></textarea>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<div class="project-form__buttons">
				<button class="button" type='submit' name='preview' value='preview' formaction='/webroot/finalWebMini/viewproject.php' autocomplete="on">Preview</button>
				<button class="button" type='submit' value='Post' id='post'>Submit</button>
				<button class="button" type='button' id="clear" onclick='clearFunction(this)'>Clear</button>
			</div>
        </form>
		</form>
		<script type="text/javascript"> // FORM INPUT VALIDATION
			window.onload=function(){ //make sure DOM is loaded before getting its properties
				var form = document.getElementById( 'addPostForm' );
				form.addEventListener( 'submit', addPostHandler );

				function addPostHandler( element ){
					var title = document.getElementById( "project-title" );
					var projectText = document.getElementById( "project-content" );

					if( title.value === "" || title.value === null ){
						window.alert( "Title: Text required" );
						title.style.background = "#FCE3E0";
						element.preventDefault(); //prevent default action of submitting post
					}
					else if( title.value !== "" || title.value !== null ){
						title.style.background = "white";
					}
					if( projectText.value === "" || projectText.value === null ){
						window.alert( "Project Content: Text required" );
						projectText.style.background = "#FCE3E0";
						element.preventDefault();
					}
					else if( projectText.value !== "" || title.value !== null ){
						projectText.style.background = "white";
					}
				}
			}
			function clearFunction( element ){
				var confirmPress = window.confirm( "Are you sure you want to clear your post?" );
				if( confirmPress ){
					document.getElementById( "addPostForm" ).reset(); //different way to reset instead of preventDefault
				}
			}
		</script>
	</div>
</div>
	<?php
	}
?>
<?php require 'components/_footer.php' ?>
</body>
</html>

