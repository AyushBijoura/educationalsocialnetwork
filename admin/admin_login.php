<?php

session_start();
include("includes/connection.php");

?>
<!DOCTYPE HTML>

<html>
<head><title>Admin Login</title>
<style>
#f input
{
		padding:7px;
		border:1 px solid black;
		border-radius:5px;
		font-weight:bolder;
		
}
#f textarea
{
		padding:8px;
		border:1 px solid black;
		border-radius:5px;
		font-weight:bolder;
		
}
#f select
{
		padding:8px;
		border:1 px solid black;
		border-radius:5px;
		font-weight:bolder;
		
}
#f select:hover,#f input:hover,#f textarea:hover
{
	background-color:#FFF8DC;
}



</style>

</head>
<body>
	<form action="admin_login.php" method="post" id="f" class="ff">
		<table align="center">
		<tr align="center">
			<td colspan="3">
			<h2>Admin Login Here</h2>
			</td>
		
		</tr>
		<tr>
		
			<td align="right"><strong>Admin Email</strong></td>
			<td><input type ="email" placeholder="Enter email" name="email" required="required"/></td>
		</tr>
	<tr>
		<td align="right"><strong>Admin Password</strong></td>
		<td><input type ="password" placeholder="Enter password" name="pass" required="required"/></td>
	</tr>
	<tr align="center">
	
		<td colspan="3">
		<input type="submit" name="admin_login" value="Login">
		</td>
	</tr>
	</table>
	
	</form>
	
	<?php 
		if(isset($_POST['admin_login']))
		{
			$email = mysqli_real_escape_string($con,$_POST['email']);
			$pass = mysqli_real_escape_string ($con,$_POST['pass']);
			
			$get_admin = "select * from admins where admin_email='$email' AND admin_pass='$pass'";
			$run_admin = mysqli_query($con,$get_admin);
			$check_admin = mysqli_num_rows($run_admin);
			
			if($check_admin==0)
			{
				echo "<script>alert('Email or password not correct')</script>";
			}
			else
			{
				$_SESSION['admin_email']=$email;
				echo "<script>window.open('index.php','_self')</script>";
			}
		}
			
	?>
</body>
</html>