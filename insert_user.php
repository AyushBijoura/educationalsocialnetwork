<?php

include("include/connection.php");

	if(isset($_POST['sign_up']))
	{
	    $name = mysqli_real_escape_string($con,$_POST['u_name']);
		$pass = mysqli_real_escape_string($con,$_POST['u_pass']);
		$email = mysqli_real_escape_string($con,$_POST['u_email']);
		$country = mysqli_real_escape_string($con,$_POST['u_country']);
		$gender = mysqli_real_escape_string($con,$_POST['u_gender']);
		$birthday = mysqli_real_escape_string($con,$_POST['u_birthday']);
		$status = "unverified";
		$posts = "no";
		$ver_codes = mt_rand();
		
		if(strlen($pass)<8)
		{
			echo"<script>alert('password should me min of 8 characters')</script>";
			exit();
			
		}
		$check_email = "select * from users where user_email='$email'";
		$run_email = mysqli_query($con,$check_email);
		$check = mysqli_num_rows($run_email);
		if($check==1)
		{
			echo"<script>alert('Email already exists')</script>";
			exit();
		}
		$inse = "insert into users (user_name,user_pass,user_email,user_country,user_gender,user_birthday,status,ver_code,posts,user_image,register_date,last_login) values ('$name','$pass','$email','$country','$gender','$birthday','$status','$ver_codes','$posts','default.jpg',NOW(),NOW())";
		$query = mysqli_query($con,$inse);
		if($query)
		{
			$_SESSION['user_email']=$email;
			//echo "<h3 style='width:400px;'>Hi,$name congraltulations registration is almost complete.Please check your mail</h3>";
			echo "<script>alert('Registration Successfull')</script>";
		    echo "<script>window.open('home.php','_self')</script>";
		}
		else
		{
			echo "Registration failed try again";
	
		}
	}

?>