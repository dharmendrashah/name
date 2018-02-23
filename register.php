<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>
<!DOCTYPE html>
<html>
<head>
<title>Sign Up Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Sign Up Form</h2></center>
		<form action="register.php" method="post" enctype="multipart/form-data">
			<div class="imgcontainer">
				<img src="imgs/taxicab.png" alt="Avatar" class="avatar" id="output"/>
				<input type="file" accept="image/*" id="output" onchange="loadFile(event)">
						<!--<img id="output"/>-->
							<script>
  							var loadFile = function(event) {
   							 var reader = new FileReader();
    							reader.onload = function(){
      								var output = document.getElementById('output');
      								output.src = reader.result;
   									 };
   									reader.readAsDataURL(event.target.files[0]);
 							     };
							   </script>
			</div>
			<div class="inner_container">
			<input name="fullname" type="text" class="inputvalues" placeholder="Type your Full Name" required/><br>
			<input name="phone" type="number" class="inputvalues" placeholder="Type your phone no." required/><br/>
			<input name="mail" type="mailto" class="inputvalues" placeholder="Type your Email-id" /><br/>
			<label><b>Date Of Birth</b></label><br/>
			<input name="birth" type="date" class="inputvalues" placeholder="Type your Email-id" /><br/>
			<label><b>Address</b></label><br/>
			<input type="text" class="inputvalues" name="home" value="" required/><br/>
			<label><b>district</b></label><br/>
			<select class="inputvalues" name="district">
			  <option value="bikaner">bikaner</option>
			  <option value="jaisalmer">jaisalmer</option>
			  <option value="jodhpur">jaisalmer</option>
			  <option value="kota">kota</option>
			</select><br/>
			<label><b>State</b></label><br/>
			<select class="inputvalues" name="state">
			  <option value="rajasthan">rajasthan</option>
			  <option value="bihar">bihar</option>
			  <option value="delhi">delhi</option>
			  <option value="maharastra">maharastra</option>
			</select><br/>
			<label><b>Country</b></label><br/>
			<select class="inputvalues" name="country">
			  <option value="india">india</option>
			  <option value="USA">USA</option>
			  <option value="china">china</option>
			  <option value="britain">britain</option>
			</select><br/>
			<label><b>Pin</b></label><br/>
			<input type="number" class="inputvalues" name="Pin" value="" required/> <br>
				<label><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>
				<label><b>Confirm Password</b></label>
				<input type="password" placeholder="Enter Password" name="cpassword" required>
				<button name="register" class="sign_up_btn" type="submit">Sign Up</button>
				
				<a href="index.php"><button type="button" class="back_btn"><< Back to Login</button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['register']))
			{
				
				@$fullname = $_POST['fullname'];
				@$phone = $_POST['phone'];
				@$mail = $_POST['mail'];
				@$birth = $_POST['birth'];
				@$home = $_POST['home'];
				@$district = $_post['district'];
				@$state = $_post['state'];
				@$country = $_POST['country'];
				@$pin = $_POST['pin'];
				@$password = $_POST['password'];
				@$cpassword = $_POST['cpassword'];

				
				$img_name = $_FILES['imglink']['name'];
				$img_size = $_FILES['imglink']['size'];
				$img_tmp = $_FILES['imglink']['tmp_name'];

				$directory = "upload/";
				$target_file = $directory.$img_name;
				
				if($password==$cpassword)
				{
					$query = "select * from driver where phone ='$phone'";
					//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if(mysqli_mum_rows($query_run)>0)
					{
					echo "<script type=text/javascript>alert('user already exists')</script>";
				}
				else if(file_exists($target_file))
						{
					echo "<script type=text/javascript>alert('image file already exists')</script>";
						}
				else if($img_size>2097152)
						{
				  echo "<script type=text/javascript>alert('image file is larger than 2MB')</script>";
				}
				else{
					move_uploaded_file($img_tmp.$target_file);
					$query = $query= "INSERT INTO driver values('0',
					'$imglink',
							'$fullname',
							'$phone',
							'$mail',
							'$birth',
							'$home',
							'$district',
							'$state',
							'$country',
							'$pin',
							'$password')";
							$query_run = mysqli_query($con,$query);
					if($query_run){
								$_SESSION['phone'] = $phone;
								$_SESSION['password'] = $password;
								header ("Location: homepage.php");
						
						echo "<script type=text/javascript>alert('user registered')</script>";
					}
					else{
						echo "<script type=text/javascript>alert('error')</script>";
					}
				};
			};
		};
		?>
	