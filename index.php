<?php
session_start(); //start new session or resumes a previous session, must be called before the page send any HTML output

//If user have seesion id, 
    //display welcome message, 
    //user can upload&delete files call fileUpload.php
    //display logout option
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Team Venus Fisrt Page</title>
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <?php
      //first php file check if user have session ID(veryfied Loged In)
      if(!isset($_SESSION['user_name'])) { //If not loged in, 
        //redirect to login page
        header('location: login.php');
        exit;
      }else { //else tag opened
      //If user have seesion id,   
    ?>
    <!-- display welcome message,-->
    <?php       
      header('location: file.php');
      //move log out button to file page
      } //else statement end!
      
    ?>
    </div>
  </body>
</html>