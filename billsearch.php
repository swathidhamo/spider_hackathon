<html>
<head>
	<title>Comments</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <?php
      
      $link = mysqli_connect("127.0.0.1", "root", "", "hack");
      session_start();
      if(empty($_SESSION["username"])){
        header("Location: login.php");
      }
      else{
      if(isset($_POST["submit"]) || isset($_POST["sort"])){
         $name = $_POST["search_name"];
         $query = "SELECT id,purpose, costper, quantity, datetime, total, username FROM bill WHERE purpose = '$name'";
         if(isset($_POST["sort"])){
           $query = "SELECT id,purpose, costper, quantity, datetime, total, username FROM bill WHERE username = '$name' 
           ORDER BY datetime ASC";
         }
         $result = mysqli_query($link,$query);
         if($result){
          while($data = mysqli_fetch_assoc($result)){
            echo   "<p class = 'bill'><p class = 'info'>Entry by :  ".$data["username"]."</p><p class = 'info'>   Title: ".
            $data["purpose"]."  At: ".$data["datetime"]. "  "."</p><p id = 'contents'> For Rs.  "
             .$data["costper"]."<p class = 'info'>Quantity".$data["quantity"]."</p></p>";
             
          }
         }
         else{
          echo mysqli_error($link);
         }
      }

}
      ?>

	<style type="text/css">
      .box{
      	border: 2px solid green;
      	padding: 15px 15px 15px 15px;
      	margin:  35px 35px 35px 35px;
      }
     
       .bill{
        border: 2px solid black;
       }
  

       .info{
      border: 2px solid red;
      margin-right: 250px;
      margin-left: 40px;
      padding: 15px 30px 15px 15px;
      background-color: #5e82bc;
      border-radius: 3px 3px 3px 3px;
    }
    #contents{
      border: 2px solid blue;
      margin-right: 250px;
      margin-left: 40px;
      padding: 15px 30px 15px 15px;
      background-color: #5e82bc;
      border-radius: 3px 3px 3px 3px;
    }
     body{
    background:url("https://s-media-cache-ak0.pinimg.com/originals/2b/3b/55/2b3b5518fb00ea775fd8f045dfd0671a.jpg");
  }
     
	</style>
</head>

<body>
<form method = "POST">
  <div id  = "content"></div>
  <input type = "text" name = "search_name" id = "search_name" placeholder = "Enter the title">
  
   
   <input type = "submit" value = "Submit" name = "submit" id = "submit">

   <input type = "submit" value = "Search and Sort by username" name = "sort" >
  
  </div>
   <a href = "bill.php">Back to the billing page</a>

</form>
</body>
</html>