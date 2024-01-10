<?php


include_once("config.php");

session_start();

?>



<html>
<head>
</head>

<body>
<form action="login.php" method="post"> 
<label> Email:</lable>
<input type="email" name="email" required ><br><br>


<label> Password:</lable>
<input type="password" name="password" required ><br><br>
<br>

<input type="submit" value="sign in" name="submit">

</form>
</body>
</html>
<?php 





if(isset($_POST['submit']))
{
	
	$email=$_POST['email'];
	$password=$_POST['password'];

	if(empty('$email') ||('$email'==" ") )
	{

		echo '<script>alert("please enter Email")</script>';
		echo "<script>window.location.href='login.php';</script>";
		return false;
	}	
	else
	{

$res=mysqli_query($conn,"select * from tblemployee where email='$email' and password='$password' " );



    $result=mysqli_fetch_array($res);
			if($result["email"]==$email )
			{
				//echo $email;

				$_SESSION["email"]=$email;
				$eml=$_SESSION["email"];
				
				header("Location:Addlead.php");

			}
		else
			{
	echo "<script> alert('Enter valid Email and Password') </script>";
	echo "<script>window.location.href='login.php';</script>";

			}

	}		
}

?>
