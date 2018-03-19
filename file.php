<?php
//cehck session
    session_start();
    if(!isset($_SESSION['user_name'])) { //If not loged in, 
        //redirect to login page
        header('location: index.php');
        exit;
    } else { //if session saved(user verifyed) ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Files</title>
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <?php

        echo "<h2> Hi, " .$_SESSION['company_name'] .' ! ' ."</h2>";
        echo "<h2> " .$_SESSION['user_name'] .' , Loged In. Welcome to Team Venus! ' ."</h2>";
    } //close else tag

    $config = file_get_contents("cfg.txt");
    $contents = explode(',', $config);  
    //Trimming space from directory
    $dir = ltrim($contents[1]);
    $dir= str_replace("/",'' , $dir);


    $filePath = getcwd(). DIRECTORY_SEPARATOR .$dir. DIRECTORY_SEPARATOR ;//  this line will get the working path from the cfg file
  
    $fileError='';

    if (!file_exists($filePath)) {
        mkdir($filePath, 0700);// makes a directory  and it assigns  a full rwe to everyone within this directory.
        echo 'directory has been created';
        //this is returing an error as i don not have permission to create the file with xamp, will troubleshoot with the professor on class
    }
    chdir($filePath);//changes to the directory that has been specified
    $files = scandir($filePath,1); // gets all the elementes in the directory and store them into an array

    $displayItems='';
    $displayOptions='';
    if(isset($files)) {
        $counter = 0;
        $arrayLen= count($files)-2;// count how many  elements are in the array , substracting 2 is to eliminate the two elements from the array when looping thru it the . and  .. element

        while($counter < $arrayLen){
            //createsoption 
            $displayItems.= '<li>'.$files[$counter].'</li>';// create items for the list to be concatenated with all the variables
            $displayOptions.= '<option>'.$files[$counter].'</option>';
			//planing to change this into an option or multilisting to make it easier for the delete file
            $counter++;
        }
    } else {
        $fileError='There are no items in the current directory';//if there are no files this message will be prompt}
    }
?>
    <!-- We don't need this part <h2>Currently working on: <br></h2> echo $filePath; ?>-->
    <h3>Your current files in the directory</h3>
        <?php 
            if (empty($fileError)){
                // if the variable is empty the list will be displayed
                echo '<ol>';
                echo $displayItems;
                echo '</ol>';
            }else{ // empty directory message.
                echo $fileError;
            }
        
        ?>
        
    <form action="fileUpload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="uFile"/><br />
      <input type="submit" class="green button" value="Upload"/>
    </form>
	
	<h3>Select the files to be deleted</h3>
    <form action="fileDelete.php" method="POST">
        <?php
            echo '<label for="fDelete">Delete Option</label>';
            echo '<select id="fDelete" name="fDelete">';
            echo '<option  value="">Choose File</option>';
            echo $displayOptions;
            echo '</select>';
        ?>
	<br />
	
		<input class="button red" type="submit" value="delete"/>
	</form>
    
    <!--display logout option-->
    <a class="button blue" id="logout" href="logout.php">Log Out</a>
    
    </body>
</html>