
<?php
session_start();

include("includes/connection.php");
if(!isset($_SESSION['admin_email']))
{
	header("location:admin_login.php");
}
else
{
?>
<!DOCTYPE HTML>

<html>
<head>
<title>Admin Panel</title>
<link rel="stylesheet" href="admin_style.css" media="all"/>

</head>
<body>


	<div class="container">
		<div id="head">
	<a href="index.php"><img src="images/logo3.png" width="900"/></a>
		</div><!--head ends here-->
			
			<div id="content">
			<h2 style ="color:blue; text-align:center; padding:10px;">
			Welcome Admin:Manage your content!
			</h2> 
			<?php
				if(isset($_GET['view_users']))
				{
					include("includes/view_users.php");
				}
				
			?>
			<?php 
			
			if(isset($_GET['view_posts']))
				{
					include("includes/view_posts.php");
				}
			
			?>
			<?php 
			
			if(isset($_GET['view_comments']))
				{
					include("includes/view_comments.php");
				}
			
			?>
			<?php
					if(isset($_GET['view_topics']))
				{
					include("includes/view_topics.php");
				}
			
			?>
			<?php
					if(isset($_GET['add_topic']))
				{
					include("includes/add_topics.php");
				}
			
			?>
			<?php
					if(isset($_GET['view_feedback']))
				{
					include("includes/view_feedback.php");
				}
			
			?>

			</div><!--content ends here-->
			
			
			<div id="sidebar">
			<h2>Manage content:</h2>
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="index.php?view_users">View Users</a></li>
				<li><a href="index.php?view_posts">View Posts</a></li>
				<li><a href="index.php?view_comments">View Comments</a></li>
				<li><a href="index.php?view_topics">View Topics</a></li>
				<li><a href="index.php?add_topic">Add New Topic</a></li>
				<li><a href="index.php?view_feedback">View Feedback</a></li>
				<li><a href="admin_logout.php">Admin Logout</a></li>
			
			
			</ul>
			</div><!--sidebar ends here-->
			
			
			
			<div id="foot">
			<h2 style="color:white;padding:10px; text-align:center;">All rights reserved</h2>
			</div><!--footer ends here-->
	
	</div><!--container ends here-->
</body>
</html>
<?php } ?>