<?php
include("../functions/functions.php");
?>
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

<form method="post" action="" id="f" class="ff" enctype="multipart/form-data">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


			<input type="text" name="topic_title" placeholder="Add a new topic.." size="42""/>
					<input type="submit" name="insert_topic" value="Add Topic"/>
					</form>
				</form>


<?php


if(isset($_POST['insert_topic']))
{
$topic_title = $_POST['topic_title'];

$insert_topic = "insert into topics(topic_title) values ('$topic_title')";

$run_topic = mysqli_query($con,$insert_topic);

if($run_topic)
{
	echo "<script>alert('New topic has been added')</script>";
	echo "<script>window.open('index.php?view_topics','_self')</script>";
}
}
?>