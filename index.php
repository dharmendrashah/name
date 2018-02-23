<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Login Form</h2></center>
			<div class="imgcontainer">
				<img src="imgs/taxicab.png" alt="Avatar" class="avatar">
			</div>
		<form action="index.php" method="post">
		
			<div class="inner_container">
				<label><b>Phone</b></label>
				<input type="text" placeholder="Enter Phone" name="phone" required>
				<label><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>
				<button class="login_button" name="login" type="submit">Login</button>
				<a href="register.php"><button type="button" class="register_btn">Register</button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['login']))
			{
				@$phone=$_POST['phone'];
				@$password=$_POST['password'];
				$query = "select * from driver where phone='$phone' and password='$password' ";
				//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
					//$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
					$row = mysqli_fetch_assoc($query_run);
					$_SESSION['phone'] = $row['phone'];
					$_SESSION['imglink'] = $row['imglink'];
					//$_SESSION['password'] = $row['password'];
					
					header( "Location: homepage.php");
					}
					else
					{
						echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Database Error")</script>';
				}
			}
			else
			{
			}
		?>
		
	</div>
</body>
</html>