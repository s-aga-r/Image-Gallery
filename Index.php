<?php
	//Start session
	session_start();

	//Change directory to "img"
	chdir("img/");

	//On press "Add Image" OR "Delete Image"
	if(isset($_POST["add"]) || isset($_POST["delete"]))
	{

		//If "Add Image" button is pressed
		if(isset($_POST["add"]))
		{

			//When file was selected 
			if(!empty($_FILES["image"]["tmp_name"]))
			{

				//List all the available files in "img" folder
				$all_files = glob("*.*");

				//Count the number of files in "img" folder
				$count = 0;
				if($all_files != false)
					$count = count($all_files);

				//Store the total number of files+1 in session variable "count"		
				$_SESSION["count"] = $count+1;

				//Print total number of files available in "img" folder
				echo "<b>Total images : ".$_SESSION["count"],"</b><br/>";

				//Temporary Name 
				$tmp_name = $_FILES["image"]["tmp_name"];

				//Get the file size
				$image_size = getimagesize($tmp_name);

				//Check whether the uploaded file is a valid image file or not
				$image_type = $image_size[2];

				//If yes 
				if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG , IMAGETYPE_PNG , IMAGETYPE_BMP)))
				{

					//Get the specific image extension 
					$type = preg_split("/[\/]/", $_FILES["image"]["type"]);

					//Move the uploaded image to "img" folder
					if(move_uploaded_file($tmp_name,$_SESSION["count"].".".$type[1]))
					{
						//Print the sucess message
						echo "<b>Image was uploaded sucessfully</b>";
					}
				}

				//If no
				else
					echo "<b>Please select a valid image file!</b>";

			}

			//When file was not selected
			else
				echo "<b>Please select an image file</b>";	
		}

		//If "Delete Image" button is pressed
		elseif(isset($_POST["delete"]))
		{

			//When file was not selected
			if($_POST["select"] == "NULL")
				echo "<b>Please select an image file</b>";	

			//When file was selected 
			else
			{
				if(unlink($_POST["select"]))
							echo "<b>Image was deleted sucessfully</b>";	
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gallery</title>
	<link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body style="background: wheat;">
	<div>
		<center>
			<fieldset>
				<br/>
				<form name="Gallery" method="POST" action="" enctype="multipart/form-data">
					<table border="0px" cellpadding="5" cellspacing="5"> 

						<tr>
							<td>Select image to upload : </td>
							<td><input type="file" name="image" class="file"></td>
						</tr>

						<tr>
							<td>Select image to delete : </td>
							<td>
								<?php
									$files = glob("*.*");
									echo "<select name=select class=file>";
									echo "<option value=NULL> </option>";
									foreach($files as $tmp)
										echo "<option value=$tmp>".$tmp."</option>";
									echo "</option>";
								?>
							</td>
						</tr>

					</table>
					<br/><br/>
					<input type="submit" name="add" value="Add Image" class="round">
					<input type="submit" name="delete" value="Delete Image" class="round">
					<button name="view" class="round">
						<a href="Gallery.php" title="Gallery" class="round">View Gallery</a>
					</button>
					<input type="reset" name="reset" value="Reset" class="round">
				</form>
			</fieldset>
		</center>
	</div>
</body>
</html>