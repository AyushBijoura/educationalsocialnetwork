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

#reply textarea 
{
	padding:8px;
	border:1px solid black;
	border-radius:5px;
	font-weight:bolder;
}
#reply input 
{
	padding:8px;
	border:1px solid black;
	border-radius:5px;
	font-weight:bolder;
}
#comments
{
	background:#5F9EA0;
	padding:5px;
	width:611px;
	border-bottom:2px solid #F0FFF0;
}
#comments span
{
	color:#FFF8DC;
}
#commen
{
	color:#FFD700;
}
#comments p 
{
	line-height:50px;
	font-size:16px;
	padding:5px;
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
							$user_country = $row['user_country'];
							$user_image =$row['user_image'];
							$register_date = $row['register_date'];
							$last_login = $row['last_login'];
							
							$user_posts = "select * from posts where user_id='$user_id'";
							$run_posts = mysqli_query($con,$user_posts);
							$posts = mysqli_num_rows($run_posts);

							//getting no of unred messages
							$sel_msg = "select * from messages where receiver ='$user_id' AND status='unread' ORDER BY 1 DESC";
						
							$run_msg = mysqli_query($con,$sel_msg);
						
							$count_msg = mysqli_num_rows($run_msg);
							
							
							echo "
								<img src ='user/user_image/$user_image' width='200' height='200'></img>
								<div id='mention'>
								<p><strong>Name:</strong> $user_name</p>
								<p><strong>Country:</strong> $user_country</p>
								<!--<p><strong>Last Login:</strong> $last_login</p>-->
								<p><strong>Member Since:</strong> $register_date</p>
								
								<p><a href='my_messages.php'>Messages($count_msg)</a></p>
								<p><a href='my_posts.php'>My Posts($posts)</a></p>
								<p><a href='edit_profile.php'>Edit My Account</a></p>
								<p><a href='feedback.php'>Feedback</a>
								<p><a href='logout.php'>Logout</a></p></div>
								";
								
						
						?>
					</div>
				</div>
				<div id="content_timeline">
						
							<?php single_post();?>
					
				</div><!--content-timeline ends here-->
					
			</div><!--content ends here-->
	
	
	
	
	</div><!--container ends-->
</body>
</html>
<?php } ?>