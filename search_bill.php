<html>
<head>
	<title></title>
	<?php
    $link = mysqli_connect("127.0.0.1", "root", "", "hack");
    session_start();  
   
    $username= $_SESSION["username"];

    $query = "SELECT  total,datetime FROM bill WHERE username = '$username' ";
    
    $sql = mysqli_query($link,$query);

      if($sql){
        
        $emparray =  array();

        while($result = mysqli_fetch_assoc($sql)){
          
             $emparray[] = $result;
        
         
        }
   
    }
    $ther = json_encode($emparray);
    echo $ther;
    file_put_contents("search_bill.json",$ther);
    
 ?>

</head>
<body>
</body>
</html>