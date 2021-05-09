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
#user_profile
{
	background:white;
	width:800px;
	height:250px;
	border:2px solid black; 
}
#imag
{
	padding:2px;
}
#user_profile img 
{
	margin-top:10px;
	margin-right:5px;
	float:right;
	border:1px solid black;
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
							//getting the message
							$sel_msg = "select * from messages where receiver ='$user_id' AND status='unread' ORDER BY 1 DESC";
						
							$run_msg = mysqli_query($con,$sel_msg);
						
							$count_msg = mysqli_num_rows($run_msg);

							
							echo "
								<img src ='user/user_image/$user_image' width='200' height='200'></img>
								<div id='mention'>
								<p><strong>Name:</strong> $user_name</p>
								<p><strong>Country:</strong> $user_country</p>
<!--								<p><strong>Last Login:</strong> $last_login</p>-->
								<p><strong>Member Since:</strong> $register_date</p>
								
								<p><a href='my_messages.php?u_id=$user_id'>Messages($count_msg)</a></p>
								<p><a href='my_posts.php?u_id=$user_id'>My Posts($posts)</a></p>
								<p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
								<p><a href='feedback.php'>Feedback</a></p>
								<p><a href='logout.php'>Logout</a></p></div>
								";
								
						
						?>
					</div>
				</div>
				<div id="content_timeline">
					<?php
					if(isset($_GET['u_id']))
					{
						$u_id = $_GET['u_id'];
						$sel = "select * from users where user_id='$u_id'";
						$run = mysqli_query($con,$sel);
						$row = mysqli_fetch_array($run);
						$user_name = $row['user_name'];
						$user_image = $row['user_image'];
						$reg_date = $row['register_date'];
						
					}
					?>
					<h2>Send a message to <span style='color:red;'><?php echo $user_name;?></span></h2>
					
					<form action="messages.php?u_id=<?php echo $u_id;?>" method="post" id="f">
						<input type="text" name="msg_title" placeholder="Message subject..." size="49"/>
						<textarea name="msg" cols="50" rows="5" placeholder="Message topic...."></textarea><br/>
						<input type ="submit" name="message" value="Send Message"/>
					</form><br/>
					<img style ="border:2px solid black; border-radius:2px;" src="user/user_image/<?php echo $user_image; ?>" width="100"   height="100"/>
					<p><strong><?php echo $user_name; ?></strong> is a member of this site since: <?php echo $reg_date;?>
					
					</form>
				</div><!--content-timeline ends here-->
					<?php
					
						if(isset($_POST['message']))
						{
							$msg_title = $_POST['msg_title'];
							$msg = $_POST['msg'];
							
							$inserts = "insert into messages(sender,receiver,msg_sub,msg_topic,reply,status,msg_date) values ('$user_id','$u_id','$msg_title','$msg','no_reply','unread',NOW())";
							
							$run_insert = mysqli_query($con,$inserts);
							if($run_insert)
							{
								echo "<center><h2>Message sent to" .$user_name. "successfully</h2></center>";
							}
							else
							{
								echo "not sent";
							}
						}
					?>
			</div><!--content ends here-->
	
	
	
	
	</div><!--container ends-->
</body>
</html>
<?php } ?>