<?php
	  include 'file.php';
 
    $tempFile = $_FILES['uFile']['tmp_name'];

      //calling filePath variable that already contains the path from the cfg file
      $fileName = $_FILES['uFile']['name']; // gets the name of the file and attaches it to the variable
      $filePathLocation=$filePath.$fileName;
      $fileErrorMessage='';// message that will be echo if any error is encountered
      $fileControl=1; // control variable to check if the file should be uploaded  
      //checks if the filenName exists if not an error will be shown..
      if (empty($fileName)) {//move upload file function moves the file from the temp file into a permanent file
        $fileControl=0;
        $fileErrorMessage='Please select a file to upload';

      }
      if (file_exists($fileName)){
        $fileControl=0;
        $fileErrorMessage='The file already exist on the server';
      }

      if ($fileControl===1){
        //temp file will be uploaded to the web server if it passes the two tests.
        echo
        move_uploaded_file($tempFile, $filePathLocation);

        echo 'Your file has been uploaded '.$fileName;        
    }else{
        echo $fileErrorMessage;
    }
    echo 'Please refresh the page to view the new content';
    header('location: file.php'); //redirect to current page, so user don't need to refresh the page to view new contents
    exit();
?>