<html>
<head>
	<title>File upload</title>
  
	<?php
     $link = mysqli_connect("127.0.0.1", "root", "", "hack");
    session_start();
    $uploaddir = "C:/wamp64/www/hack/pics/";
  
    chmod($uploaddir,777);


    
 
     

     if(isset($_POST["submit"])){
   
    
       $image = $_FILES['image']['tmp_name'];
       $uploadfile = $uploaddir.$_FILES['image']['name'];
       $name_file = $_FILES['image']['name'];
       $upload = move_uploaded_file($_FILES['image']['tmp_name'],$uploadfile);
      
       if($upload){
       	echo "yes";
       }
       else{
       	echo "no";
        echo mysqli_error($link);
        }
     
            
       $img = $_FILES['image']['name'];
     
        $query_entry = "INSERT INTO slideshow (image) VALUES (?)";
        $entry = mysqli_prepare($link,$query_entry);
        mysqli_stmt_bind_param($entry, "s",$img);
        $result = mysqli_stmt_execute($entry);
    
    

        if($result){
           
           echo "uploaded link too";
        }
        else{

     	     echo mysqli_error($link);
        }

      }
    

	?>
	<style type="text/css">
     img{
     	width: 300px;
     	height: 280px;
      padding-left: 260px;
      padding-top: 130px;


     }
     body{
     background: url('http://content.wallpapers-room.com/resolutions/1280x1024/W/Wallpapers-room_com___Wood_Wallpaper_Pack_2_by_Oliuss_1280x1024.jpg')
      }
     #heading{
      padding-left: 270px;
      padding-top: 30px;
     }
     h1 { 
       
      font-family: "Great Vibes", cursive; 
       font-size: 60px; 
    
     }
     

	</style>
</head>
<body>
	<form method = "POST" enctype="multipart/form-data" >
    <h1 id = "heading">Slideshow</h1>
    <div id = "content"></div> 
    <p><input type="file" name="image" id = "image"/></p>    
    <input name = "submit" type = "submit" value = "submit">  
   </form>
   <script type="text/javascript">


    var array = [];
    var index  =0;
  
      function image(){
      
   	      console.log("worked!!");

         var xmlhttps = new XMLHttpRequest();
         xmlhttps.open("POST", "search.php", true);
         var parameter = "id=0";
         xmlhttps.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         xmlhttps.send(parameter);
         xmlhttps.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            req();     
        
            
            }


        }

}

       function req(){
          var request = new XMLHttpRequest();
          console.log("ascess");
          document.getElementById("content").innerHTML = " ";
     
         request.open('GET', 'image.json', true);
      
         request.onload = function () {
         
          console.log("json");
       // begin accessing JSON data here
       array = [];
         var json = JSON.parse(this.responseText);
      
         for(var i = 0;i<json.length;i++){
              
              source  = "pics/"+json[i];
              array.push(json[i]);          
           }
         console.log(array);    
      }
         request.send();
        display_slide();
  

 
   }



    function renderImage(){
        var image_show = new Image();
        if(index!=array.length){
       image_show.scr  = "pics/"+array[index];
        document.getElementById("content").innerHTML = "<img src = 'pics/"+array[index]+"' class = 'picture'>";
      }
      else{
        index = 0;
      }


   }


     function display_slide(){
      console.log("entered");

      
      var timer = setInterval(function(){
       renderImage();
       index++;
      },
      4000);
    }

    window.onload = function(){
      image();
     }



   </script>


</body>
</html>