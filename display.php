<html>
<head>
  <title>Editing page</title>
  <?php

    $link = mysqli_connect("127.0.0.1", "root", "", "hack");
    session_start();

    
    if(!empty($_SESSION["username"])){
      $username = $_SESSION["username"]; 
     $query_fetch = "SELECT purpose,id,image FROM bill WHERE image IS NOT NULL AND username = '$username'  ";
     $sql_fetch = mysqli_query($link,$query_fetch);
     if($sql_fetch){
       while($result=mysqli_fetch_assoc($sql_fetch)){
        $image_encoded = base64_encode($result["image"]);
        echo $result["id"]."  Image for ".$result["purpose"]."  is"."<p><img src='data:image/jpeg;base64,$image_encoded'/></p>";
       }
     


   }


}


else{
  header("Location: login.php");
}






  ?>

  <style type="text/css">
  
    body{
    background:url("https://s-media-cache-ak0.pinimg.com/originals/2b/3b/55/2b3b5518fb00ea775fd8f045dfd0671a.jpg");
  }
   img{
    width: 50px;
    height: 50px;
   }


  </style>
</head>
<body>

</body>
</html>