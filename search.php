<html>
<head>
	<title>Luncatic</title>
	<?php
    $link = mysqli_connect("127.0.0.1", "root", "", "hack");
    session_start();  
   
    $id= $_POST["id"];

    $query = "SELECT image FROM slideshow  ";
    
    $sql = mysqli_query($link,$query);

      if($sql){
        
        $emparray =  array();

        while($result = mysqli_fetch_assoc($sql)){
            echo $result['image'];
        
              $emparray[] = $result['image'];
            
        
         
        }
   
    }
    $ther = json_encode($emparray);
    echo $ther;
    file_put_contents("image.json",$ther);
    
 ?>

</head>
<body>
</body>
</html>