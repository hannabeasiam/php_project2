## Algorithm For User Authentication 
- index.php file check if user have session ID(veryfied Loged In) if there are none it will redirect the user to the login page.
```
If user have seesion id, 
    display welcome message, 
    user can upload&delete files, call file.php
    display logout option
If not loged in, 
    redirect to login page 
```
- login.php file is going to prompt user name & password validate user input with cfg file membername & password  
```
once user click login, store user input and save as variable

read config file & store membername and memberpassword in multi demensianal associative array - confirmName & confirmPw pair
    
compare NameInput & confirmName
  if not matched (use in_array() return boolean value)
    - redirect login page, 
    - set NameError, 'There is No existing user please input Valid User Name' 
        --(In HTML <span error, if isset(NameError), echo Name Error)
    - set authorized = false;

  if name matched, compare pw
    if pw matched, set session id
    if pw not matched
        -pwError
        -authorized = false;

```


- file.php file is going to pull the path from the config file and display all of the files that are on that path

- fileUpload.php file is going to allow user to upload files into the current directory, there will be some functions added to prevent some cross side scripting.

- fileDelete will allow the user to select one of the current files and delete them from the server, if there are no files, this will return that there are no files to be deleted.

- logout.php will be closing the session and redirecting the user to the log in page.



