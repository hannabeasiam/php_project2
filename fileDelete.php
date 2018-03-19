<?php
	include 'file.php';

	$fileToDelete =$_POST["fDelete"];//gets the value from the post and passes to a local value

	/****************************************************
	 * if (empty($fileToDelete)) { // checks if the value is empty and displays a message
	 * this condition has been modifed as below
	 ****************************************************/
	if (!file_exists($fileToDelete)) {  //chcek if deletable file exist in the directory
		echo '<p class="warning">There are no files to be deleted</p>';
	}else{ /*****file only delete when file exist, so there is no longer unlink error***/
		$fileTemp=$fileToDelete; // saves the name of the file to show the user that is has been deleted
		$fileDeletePath=$filePath.$fileToDelete; // concatenates the file path from the file.php with the value selected
		$fileDeleted= unlink($fileDeletePath); // Assigns to variable to get true if its sucessufll
		if ($fileDeleted){
			echo '<p class="warning">File '. $fileTemp.'has been deteled</p>';
		}
	}
	  header("file.php"); /* Redirect to main page */
    exit();   
?>