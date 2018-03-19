<?php
  $user_name = '';
  $user_pw = '';
  $first_time = ($_SERVER["REQUEST_METHOD"] != 'POST');

  //read config file, save under array   
    $config = file_get_contents("cfg.txt");
    $contents = explode(',', $config);
    //use array slice, devide contents array to contents & member
    $member_part = array_slice($contents,2);
    $company_name = $contents[0];  
    $directory_name = $contents[1];
    //user names: 0, 2, 4 | passwords: 1, 3, 7
    foreach ($member_part as $key => $value) {
      //echo 'key : '.$key.' value: '.$value .'<br/>';
      if($key % 2 == 0) {
        $member_key[] = $value;
      } else {
        $member_value[] = $value;
      }
    }
    //want to modify this hard code array part
    $members = array(
      trim($member_key[0])=>array('pw'=>trim($member_value[0])),
      trim($member_key[1])=>array('pw'=>trim($member_value[1])),
      trim($member_key[2])=>array('pw'=>trim($member_value[2]))
    );

  if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $user_name = trim(filter_input(INPUT_POST, "user_name"));
    $user_pw = trim(filter_input(INPUT_POST, "user_pw"));
  }
  //require input message
  if(!$first_time) {
    //check if user name is empty
    if(empty($user_name)) {
      $user_name_error = 'User name is required';
      $authorized = false;
    }
    if(empty($user_pw)) {
      $user_pw_error = 'Password is required';
      $authorized = false;
    }
    //now check if user name exist
    if(!empty($user_name) && !empty($user_pw)) { //once user input
      if(!isset($members[$user_name])) {
        $user_name_error = 'There is No existing user please input Valid User Name';
        $authorized = false;
      } elseif ($members[$user_name]['pw'] != $user_pw) {
        $user_pw_error = 'Wrong Password please input Valid Password';
        $authorized = false;
      } else { //if user name and pw validated, creat session and redirect to index.php
        session_start(); 
        $_SESSION['company_name'] = $company_name;
        $_SESSION['user_name'] = $user_name;
        
        
        //$_SESSION['user_pw'] = $members[$user_name]['pw'];
        header('location: index.php');
      }
    }
  }
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <form method="post" action="login.php">
      <label for="user_name">Username</label>
      <input type="text" id="user_name" name="user_name" value="<?php if (isset($user_name)) echo $user_name;//i wonder if this part is neccessary ?>"/>
      <span class="error"><?php if (isset($user_name_error)) echo $user_name_error; ?></span>
      <br />
      <br />
      <label for="user_pw">Password</label>
      <input type="password" id="user_pw" name="user_pw" value="<?php if (isset($user_pw)) echo $user_pw; ?>"/>
      <span class="error"><?php if (isset($user_pw_error)) echo $user_pw_error; ?></span>
      <br />
      <br />
      <input type="submit" class="button blue" value="Log In"/>
    </form>
  </body>
</html>