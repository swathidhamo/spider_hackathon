<html>
<head>
 
  <title>The forum</title>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  
  
  
  <?php

    require("connect.php");
    require("total.php");

     
      if(!empty($_SESSION["username"])){
        echo "Welcome   ".$_SESSION["username"]."!!";
        
      if(isset($_POST["submit"])){
       
        if(isset($_POST["purpose"])){
            $purpose = $_POST["purpose"];
        }
        if(isset($_POST["quantity"])){
          $quantity = $_POST["quantity"];
        }
        if(isset($_POST["cost"])){
          $cost = $_POST["cost"];
        }

        if(!empty($_FILES["image"]['tmp_name'])){
              
             $image = $_FILES['image']['tmp_name'];
             $img = file_get_contents($image);
           }


        if(isset($_POST["type"])){
          $type = $_POST["type"];
        }

        $value = $cost*$quantity;
        $username = $_SESSION["username"];
         $total = $_SESSION["total"];
        
        if($type=='1'){
          $total = $total-$value;   
        }  
        else{
          $total = $total+$value;
        }
        echo $total;
        $_SESSION["total"] = $total;
      
        
                 
       date_default_timezone_set("Asia/Kolkata");
       $createdate= date('Y-m-d H:i:s');
       echo "Yes";
      $sql = "INSERT INTO bill (purpose,quantity,costper,total,type,image,datetime,username) VALUES (?,?,?,?,?,?,'$createdate',?)";
      $query = mysqli_prepare($link,$sql);
      mysqli_stmt_bind_param($query, "siiisss",$purpose,$quantity,$cost,$total,$type,$img,$username);
      $result = mysqli_stmt_execute($query);
      if($result){
        echo "yes";
      }

      else{
        echo "no";
        echo mysqli_error($link);

      }
      

}



     echo "<p>Standing total is : ".$_SESSION["total"]."</p>";



       }


       else{
        header("Location:login.php");
       }
         
  ?>

</table>

<style type="text/css">
  .class{
    padding-left: 250px;
    border: 2px solid black;
  
  }
  body{
    background:url("https://s-media-cache-ak0.pinimg.com/originals/2b/3b/55/2b3b5518fb00ea775fd8f045dfd0671a.jpg");
  }
  .billing{
    margin-left: 200px;
    margin-top: 100px;
    margin-right: 250px;
    padding: 10px 10px 10px 10px ;
    border: 2px solid red;
  }
  input{
    margin: 10px 10px 10px 10px;
  }
  h1{
    text-align: center;
  }


</style>

</head>
<body>
  <h1>Billing systems</h1>
   <form method = "POST" enctype="multipart/form-data" >
    <div class = "billing">
   <p class = "values">Purpose:<input type = "text" name = "purpose"></p>
   <p class = "values">Quantity<input type = "number" name = "quantity"> </p>
   <p class = "values">Cost: <input type = "number" name = "cost"></p>
   <p class = "values">Image:<input type = "file" name = "image"/></p>
   <p class = "values">Submit:<input type = "submit" name = "submit"></p>
   <p class = "values"><select name = "type">
    <option value = "0">Inflow</option>
    <option value = "1">Outflow</option>
    <input type = "text" id = "text" placeholder = "Type anything to see the graph">


   </select> </p>
   </div>

   </form>
    
    </canvas><canvas id = "myChart"></canvas>
      <div id="chartContainer"style="height: 200px; width: 80%;">

   <a href = 'billsearch.php'>Bill search</a>
   <p><a href = "display.php">Click here to view your bill pictures</a></p>
   <script type="text/javascript">
  



     var date = [];
     var total = [];
     var array = [];
     function graph(){
      
          console.log("worked!!");

         var xmlhttps = new XMLHttpRequest();
         xmlhttps.open("POST", "search_bill.php", true);
         var parameter = "id=0";
         xmlhttps.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         xmlhttps.send(parameter);
         xmlhttps.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            request();     
        
             }


         }

    }

       function request(){
          var request = new XMLHttpRequest();
          console.log("ascess");
        
     
         request.open('GET', 'search_bill.json', true);
      
         request.onload = function () {
         
          console.log("json");
          array = [];
          var json = JSON.parse(this.responseText);
      
          for(var i = 0;i<json.length;i++){

              object = {};
              object.label = json[i]["datetime"];
              object.y = parseInt(json[i]["total"]);
              array.push(object);

              //json[i]["total"]
              //total.push(json[i]["total"]);
              //date.push(json[i]["datetime"]);          
           }
             console.log(array);    
         }
         request.send();
          var chart = new CanvasJS.Chart("chartContainer",
     {
      title:{
        text: "Daily spendings"    
      },
      animationEnabled: true,
      axisY: {
        title: "spendings"
      },
      legend: {
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },
      theme: "theme2",
      data: [

      {        
        type: "column",  
        showInLegend: true, 
        legendMarkerColor: "grey",
        dataPoints: array
      }   
      ]
    });

    chart.render();
         
  

 
   }

   

    window.onload = function(){

        function drawGraph(){
       var chart = new CanvasJS.Chart("chartContainer",
     {
      title:{
        text: "Top Oil Reserves"    
      },
      animationEnabled: true,
      axisY: {
        title: "Reserves(MMbbl)"
      },
      legend: {
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },
      theme: "theme2",
      data: [

      {        
        type: "column",  
        showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: "MMbbl = one million barrels",
        dataPoints: array
      }   
      ]
    });

    chart.render();
         }
      document.getElementById("text").addEventListener("keyup",graph);
    }



   </script>


 

 


</body>
</html>