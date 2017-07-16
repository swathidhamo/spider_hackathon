<html>
<head>
	<title></title>
	<?php
         require("connect.php");
          session_start();
         $username = $_SESSION["username"];
        $max_total = "SELECT total FROM bill WHERE username = '$username' ORDER BY datetime DESC LIMIT 1";
         $query_max = mysqli_query($link,$max_total);
         $result = mysqli_fetch_assoc($query_max);
         $total = $result["total"];
         echo mysqli_error($link);
         $_SESSION["total"] = $total;





	?>
</head>
<body>

</body>
</html>