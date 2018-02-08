<!DOCTYPE HTML>  
<html>
<head>
<style>
</style>
</head>
<body>  
	
	<?php
		$username='fall16';
		$password='Cs495IeI42';
		$database='IEIScheduler';

		$conn=mysqli_connect("localhost",$username,$password,$database);
        if(!$conn){
            echo "Failed to connect";
        }else {
            echo "Connected to Database";
        }
		mysqli_close($conn);
	?>


</body>
</html>
