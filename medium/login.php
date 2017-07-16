<html>
<head>

	<title>Project-Billing</title>
  <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<?php

     session_start();
     session_destroy();

     require("connect.php");
     require_once "recaptchalib.php";
     session_start();    

      if(isset($_POST["login"])){

      	if(isset($_POST["username"])){

      	  	$username = mysqli_real_escape_string($link,$_POST["username"]);
            $username = stripslashes($username);
            $_SESSION["username"] = $username;
      	 }

      	if(isset($_POST["password"])){

      		  $password = mysqli_real_escape_string($link,$_POST["password"]);
            $password = stripslashes($password);
            
        	}



        $secret = "6Le_iScUAAAAADkT6a-7dPnEBjWKhmMls2tOxJql";
 
      // empty response
          $response = null;
 
      // check secret key
         $reCaptcha = new ReCaptcha($secret);

          if ($_POST["g-recaptcha-response"]) {
          $response = $reCaptcha->verifyResponse(
          $_SERVER["REMOTE_ADDR"],
          $_POST["g-recaptcha-response"]
        );
      }


        $password_hash = hash('md5',$password);
        $query = "SELECT * FROM user_info WHERE username = '".$username."' AND password = '".$password_hash."'";
        $sql = mysqli_query($link,$query);       
        $rows = mysqli_num_rows($sql);
        if($rows==1&&$response != null&&$response->success){
             $_SESSION["username"] = $username;
            echo "  Sucessfully logged in";
          //  echo $_SESSION["username"];
           
            header("Location: bill.php");

        }
        else{
            echo "  Invalid username or password";
        }


      	
      }


     



   




	?>


</head>
<style type="text/css">
   .login{
     border: 2px solid black;
     border-radius: 6px 6px 6px 6px;
     padding: 15px 15px 15px 15px;
     margin right: 550px;
     margin-top: 150px;
     margin-left: 410px;
     width: 450px;
     font-size: 20px;
   }
     body{
    background:url("https://s-media-cache-ak0.pinimg.com/originals/2b/3b/55/2b3b5518fb00ea775fd8f045dfd0671a.jpg");
  }

      input{
   	margin: 20px 20px 20px 20px;
   }
   
  </style>
<body>
  <div class = "login">
  <form method = "POST" >
    <p>Username: <input type = "text" name = "username" placeholder = 'Enter the username'></p>
    <p>Password: <input type = "password" name = "password" placeholder = "Enter the password"></p>
    <input type = "submit" name = "login" value = "Login">
    <div class="g-recaptcha" data-sitekey="6Le_iScUAAAAAD2UsWWJ0fxKT2LtXk-MXNxR6JXS"></div>
  </form>
  <a href = "register.php">Click here to register</a>
</div>


</body>
</html>