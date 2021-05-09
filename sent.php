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
#msg
{
	padding:10px;
	line-height:20px;
	background:white;
	margin:0 auto;
}
#msg th
{
	border:3px solid black;
	background:
}
#msg table,td
{
	padding:10px;
	
}
#msg a
{
	text-decoration:none;
	font-size:18px;
	color:black;
}
#msg a:hover
{
	color:brown;
	text-decoration:none;
}
</style>
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
								
								<p><a href='my_messages.php?inbox&u_id=$user_id'>Messages($count_msg)</a></p>
								<p><a href='my_posts.php?u_id=$user_id'>My Posts($posts)</a></p>
								<p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
								<p><a href='feedback.php'>Feedback</a></p>
								<p><a href='logout.php'>Logout</a></p></div>
								";
								
						
						?>
					</div>
				</div>
				<div id="msg">
						<p align="center"><a href="my_messages.php?inbox">My Inbox</a> ||
						<a href="sent.php">Sent Items</a>
						
						</p>


	</head>

<table width="700">
						<tr>
							<th>Receiver</th>
							<th>Subject</th>
							<th>Topic</th>
							<th>Date</th>
							
							
						</tr>
						
						<?php
						$sel_msg = "select * from messages where sender ='$user_id' ORDER BY 1 DESC";
						
						$run_msg = mysqli_query($con,$sel_msg);
						
						$count_msg = mysqli_num_rows($run_msg);

						while($row_msg=mysqli_fetch_array($run_msg))
						{
							$msg_id = $row_msg['msg_id'];
							
							$msg_receiver = $row_msg['receiver'];
							
							$msg_sender = $row_msg['sender'];
							
							$msg_sub = $row_msg['msg_sub'];
							
							$msg_topic = $row_msg['msg_topic'];
							
							$msg_date = $row_msg['msg_date'];
							
						$get_receiver = "select * from users where user_id='$msg_receiver'";
				
						$run_receiver = mysqli_query($con,$get_receiver);
						
						$row = mysqli_fetch_array($run_receiver);
					
						$receiver_name = $row['user_name'];
						
						
						
						?>
						<tr align="center">
							<td><a href="user_profile.php?u_id=<?php echo $msg_receiver;?>"><?php echo $receiver_name;?></a></td>
							<td><a href="my_messages.php?msg_id=<?php echo $msg_id;?>"><?php echo $msg_sub;?></a></td>
							<td><?php echo $msg_topic;?></td>
							<td><?php echo $msg_date;?></td>
							
							<!--<td><a href="my_messages.php?msg_id=<//?php echo $msg_id;?>"> View Reply</a></td>-->
							
							<?php } ?>
						
						</tr>
						
						</table>			
									
							<?php
								if(isset($_GET['msg_id']))
								{
								$get_id = $_GET['msg_id'];

								$sel_message = "select * from messages where msg_id='$get_id'";
								$run_message = mysqli_query($con,$sel_message);
								
								$row_message = mysqli_fetch_array($run_message);

								$msg_subject = $row_message['msg_sub'];
								$msg_topic = $row_message['msg_topic'];
								$reply_content = $row_message['reply'];
								
								echo	"<center></br><hr>
								<h2>$msg_subject</h2>
								<p><b>Message:</b>$msg_topic</p>
								<p><b>My Reply:</b>$reply_content</p>
								</center>
								"; 								
									
								}
								if(isset($_POST['msg_reply']))
								{
									$user_reply = $_POST['reply'];
									
									if($reply_content!='no_reply')
									{
											echo "<h2 align='center'>This message was already replied</h2>";
											exit();
									}
									else{
									$update_msg = "update messages set reply='$user_reply' where msg_id ='$get_id'";
									
									$run_update = mysqli_query($con,$update_msg);
									
									echo  "<h2 align='center'>Message was relied</h2>";
									}
								}

							?>
								</div><!--msg ends here-->
					
			</div><!--content ends here-->
	
	
	
	
	</div><!--container ends-->
</body>
</html>
<?php } ?>