<?php
session_start();
include("include/connection.php");
include("functions/functions.php");

if(!isset($_SESSION['user_email']))
{
	header("location:index.php");
	
}
else
{
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Welcome User!</title>
		<link rel="stylesheet" href="styles/home_style.css" media="all"/>
	
<style>
	.content
{
	width:1000px;
	margin: 0 auto;
	 
}
#user_timeline
{
	background:#AFEEEE;
	width:250px;
	float:left;
	height:600px;
	border-right:1px solid black;	
}
#user_details
{
	padding:23px;
	
}
#user_details img 
{
	border:2px solid black; 
	border-radius:2px;
	text-align:center;
}
#user_details p
{
	margin-bottom:10px;
	padding:5px;
	
}
#user_details a
{
	color:brown;
	font-size:17px;
	text-decoration:none;
}
#user_details a:hover
{
	color:black;
	font-size:17px;
	font-weight:bolder;
	text-decoration:underline;

}

#mention
{
	background:#E6E6FA;
	border:2px solid black; 
	border-radius:2px;
	padding:3px;

}
#content_timeline
{
	float:right;
	width:700px;
	padding:10px;
	
}
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
#f h2
{
	color:gray;
	font-family:Sansational;
}
#pagination
{
	margin-top:50px;
}
#pagination a
{
	color:blue;
	text-decoration:none;
	font-size:15px;
	margin:5px;
}
#pagination a:hover
{
	color:brown;
	font-weight:bold;
}
#posts
{
	width:600px;
	background:#AFEEEE;
	padding:10px;
	line-height:20px;
	border:1px solid black;
	text-align:justify;
}
#posts img
{
	float:left;
	padding-top:5px;
	padding-right:10px;
}
#posts h3
{
	color:brown;
}
#posts button
{
	padding:5px;
	
}
#posts button:hover
{
	background:black;
	color:white;
}
.ff input
{
	margin-bottom:5px;
}
.ff select
{
	margin:5px;
}
</style>


	</head>
<body>
	<!--container starts-->
	<div class="container">
		<!--header wrapper starts here-->
		<div id="header_wrapper">
			<!--header  starts here-->
			<div id="header">
				<ul id="menu">
					<li><a href="home.php">Home</a></li>
					<li><a href="members.php">Members</a></li>
					<strong>Topics:</strong>
					<?php
					$get_topics = "select * from topics";
					$run_topics = mysqli_query($con,$get_topics);
					
					while($row=mysqli_fetch_array($run_topics))
					{
						$topic_id = $row['topic_id'];
						$topic_title = $row['topic_title'];
						echo "<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";
					}
					?>
				</ul>
				<form method="get" action="results.php" id="form1">
					<input type="text" name="user_query" placeholder="Search a topic"/>
					<input type="submit" name="search" value="Search"/> 
				
				</form>
			</div>
			<!--header ends here-->
			</div><!--header wrapper ends here-->
		
			<!--content starts-->
			<div class="content">
				<div id="user_timeline">
					<div id="user_details">
						<?php 
							$user = $_SESSION['user_email'];
							$get_user = "select * from users where user_email='$user'";
							$run_user = mysqli_query($con,$get_user);
							$row = mysqli_fetch_array($run_user);
							$user_id = $row['user_id'];
							$user_name = $row['user_name'];
							$user_pass = $row['user_pass'];
							$user_email = $row['user_email'];
							$user_gender = $row['user_gender'];
							$user_birthday = $row['user_birthday'];
							$user_country = $row['user_country'];
							$user_image =$row['user_image'];
							$register_date = $row['register_date'];
							$last_login = $row['last_login'];
							
							
							$user_posts = "select * from posts where user_id='$user_id'";
							$run_posts = mysqli_query($con,$user_posts);
							$posts = mysqli_num_rows($run_posts);
							
							//getting the no of messages							
							$sel_msg = "select * from messages where receiver ='$user_id' AND status='unread' ORDER BY 1 DESC";
						
							$run_msg = mysqli_query($con,$sel_msg);
						
							$count_msg = mysqli_num_rows($run_msg);
							
							
							echo "
								<img src ='user/user_image/$user_image' width='200' height='200'></img>
								<div id='mention'>
								<p><strong>Name:</strong> $user_name</p>
								<p><strong>Country:</strong> $user_country</p>
								<p><strong>Last Login:</strong> $last_login</p>
								<p><strong>Member Since:</strong> $register_date</p>
								
								<p><a href='my_messages.php?u_id=$user_id'>Messages($count_msg)</a></p>
								<p><a href='my_posts.php?u_id=$user_id'>My Posts($posts)</a></p>
								<p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
								<p><a href='logout.php'>Logout</a></p></div>
								";
								
						
						?>
					</div>
				</div>
				<div id="content_timeline">
					
					<form method="post" action="" id="f" class="ff" enctype="multipart/form-data">
					
				<table>
					<tr align="center">
						<td colspan="6"><h2>Build Your Resume :</h2>
					</td>
					</tr>
					<tr align="left">
						<td colspan="6"><h2>Personal Details :</h2>
					</td>
					</tr>
					
					<tr>
						<td align="right"> <strong>Name:</strong></td>
						<td><input type="text" name="u_name"  value="<?php echo $user_name;?>"/></td>
                    </tr>
					<tr>
						<td align="right"> <strong>Address</strong></td>
						<td><textarea name="u_address" rows="5" cols="30"></textarea></td>
                    </tr>
					
					<tr>
						<td align="right"><strong>Email:</strong></td>
						<td><input type="email" name="u_email"  value="<?php echo $user_email;?>">
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Country:</strong></td>
						<td>
						<select name="u_country">
							<option><?php echo $user_country;?></option>
							<option>India</option>
							<option>Japan</option>
							<option>China</option>
							<option>America</option>
						</select>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Gender:</strong></td>
						<td>
							<select name="u_gender" disabled="disabled">
							<option><?php echo $user_gender;?></option>
							<option>Male</option>
							<option>Female</option>
							</select>
						</td>
                    </tr>
					
					<tr>
						<td align="right"><strong>Date Of Birth:</strong></td>
						<td><input type="date" name="u_birthday" value="<?php echo $user_birthday;?>" /></td>
                    </tr>
					<tr align="left">
						<td colspan="6"><h2>Academic Qualification :</h2>
					</td>
					</tr>
					<tr>
						<td align="right"><strong>Course:</strong></td>
						<td><input type="text" name="u_course" placeholder="Enter course name like B.E/B.Tech MBA"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Course:</strong></td>
						<td><input type="text" name="u_class12" placeholder="Enter class 12"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Course:</strong></td>
						<td><input type="text" name="u_class10" placeholder="Enter class 10"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Enter Institution Details:</strong></td>
						<td><input type="text" name="u_institute_name" placeholder="Enter Institution Name"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Enter Institution University/Board Details:</strong></td>
						<td><input type="text" name="u_institute_board" placeholder="Enter University/Board Name"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Enter year of completion:</strong></td>
						<td><input type="text" name="u_completion" placeholder="Enter year of completion"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Enter Aggregate Percentage:</strong></td>
						<td><input type="text" name="u_aggregate" placeholder="Enter aggregate percentage"/>
						</td>
                    </tr>
					
					<tr>
						<td align="right"><strong>Enter School Details:</strong></td>
						<td><input type="text" name="u_institute_name1" placeholder="Enter School Name"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Enter School Board Details:</strong></td>
						<td><input type="text" name="u_institute_board1" placeholder="Enter School Board Name"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Enter year of completion:</strong></td>
						<td><input type="text" name="u_completionschool" placeholder="Enter year of completion"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Enter Aggregate Percentage:</strong></td>
						<td><input type="text" name="u_aggregateschool" placeholder="Enter aggregate percentage"/>
						</td>
                    </tr>
					
					<tr>
						<td align="right"><strong>Enter School Details:</strong></td>
						<td><input type="text" name="u_institute_name2" placeholder="Enter School Name"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Enter School Board Details:</strong></td>
						<td><input type="text" name="u_institute_board2" placeholder="Enter School Board Name"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Enter year of completion:</strong></td>
						<td><input type="text" name="u_completionschool1" placeholder="Enter year of completion"/>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Enter Aggregate Percentage:</strong></td>
						<td><input type="text" name="u_aggregateschool1" placeholder="Enter aggregate percentage"/>
						</td>
                    </tr>
					
					<tr align="left">
						<td colspan="6"><h2>Area Of Intrest :</h2>
					</td>
					</tr>
					<tr>
						<td align="right"><strong>Enter Area Of Intrest:</strong></td>
						<td><input type="text" name="u_areaofintrest" placeholder="Enter Area Of Intrest"/>
						</td>
                    </tr>
					<tr align="left">
						<td colspan="6"><h2>Achievements & Extra Curricular:</h2>
					</td>
					</tr>
					<tr>
						<td align="right"> <strong>Achivements and Extra Curricular</strong></td>
						<td><textarea name="u_achievements" rows="5" cols="30"></textarea></td>
                    </tr>
					<tr align="left">
						<td colspan="6"><h2>Hobbies:</h2>
					</td>
					</tr>
					<tr>
						<td align="right"> <strong>Hobbies</strong></td>
						<td><textarea name="u_hobbies" rows="5" cols="30"></textarea></td>
                    </tr>
					
						
					<tr align ="center">
						<td colspan="6">
								<input type="submit" name="update" value="submit"/>
						</td>
					</tr>
				</table>
			</form>
		<?php
			/*if(isset($_POST['update']))
			{
				$u_name = $_POST['u_name'];
				$u_pass = $_POST['u_pass'];
				$u_email = $_POST['u_email'];
				$u_birthday = $_POST['u_birthday'];
				$u_image = $_FILES['u_image']['name'];
				$image_tmp = $_FILES['u_image']['tmp_name'];
				
				move_uploaded_file($image_tmp,"user/user_image/$u_image");
				$update = "update users set user_name='$u_name',user_pass='$user_pass',user_email='$user_email',user_image='$u_image', user_birthday='$u_birthday' where user_id='$user_id'";
				
				$run = mysqli_query($con,$update);
				if($run)
				{
					echo "<script>alert('Your profile has been updated')</script>";
					echo "<script>window.open('home.php','_self')</script>";
			
				}
		
			}*/
		
		
		?>
					
				</div><!--content-timeline ends here-->
					
			</div><!--content ends here-->
	
	
	
	
	</div><!--container ends-->
</body>
</html>
<?php } ?>