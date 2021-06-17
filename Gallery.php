<?php
	//Change directory to "img"
	chdir("img/");

	//Checking the status of available images
	if(glob("*.*"))
	{

		//List all the available image's in "img" folder
		$all_files = glob("*.*");

		//Get images one by one	
		foreach ($all_files as $temp) 
		{
			?>
				<!-- Add hyperlink to open the image in full size -->
				<a href="<?php echo "img/".$temp; ?>" target="_self">
					<img src="<?php echo "img/".$temp; ?>" name="<?php echo "img/".$temp; ?>" class="images" id="images"/>
				</a>
			<?php
		}
	}

	//If there is no image in "img" folder
	else
	{

		//Print the error message
		echo "<b class=white>There is no image!</b> ";

		//Give a button option to add images
		echo "<button class=round><a href=Index.php>Upload Image</a></button>";

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gallery</title>
	<link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body>

</body>
</html>