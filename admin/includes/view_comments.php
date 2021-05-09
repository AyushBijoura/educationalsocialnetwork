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
<table align="center" width="700px" >

	<tr bgcolor="orange" border="1">

	<th>S.No.</th>
	<th>Comment</th>
	<th>CommentAuthor</th>
	<th>Date</th>
	<th>Delete</th>
</tr>
<?php 
$sel_comments = "select * from comments ORDER by 1 DESC";
$run_comments = mysqli_query($con,$sel_comments);
$i = 0;
while ($row_comments = mysqli_fetch_array($run_comments))
{
	$comment_id = $row_comments['comment_id'];
	$com_user_id = $row_comments['user_id'];
	$comment = $row_comments['comment'];
	$comment_author = $row_comments['comment_author'];
	$comment_date = $row_comments['date'];
	$i++;
	
	$sel_user_com = "select * from users where user_id='$com_user_id'";
	$run_user_com = mysqli_query($con,$sel_user_com);
	while ($row_users_com=mysqli_fetch_array($run_user_com))
	{
		$user_name = $row_users_com['user_name'];
	
	
	
?>
<tr align="center">
	<td><?php echo $i;?></td>
	<td><?php echo $comment;?></td>
	<td><?php echo $comment_author;?></td>
	<td><?php echo $comment_date;?></td>
	<td><a href="index.php?view_comments&delete=<?php echo $comment_id;?>">Delete</a></td>
	
</tr>
<?php } }?>
</table>
	
<?php
if(isset($_GET['delete']))
		{
			$delete =$_GET['delete'];
			
			$delete_comment = "delete from comments where comment_id='$delete'";
			
			$run_del_com = mysqli_query($con,$delete_comment);
			if($run_del_com){
					echo "<script>alert('Comment has been deleted')</script>";
					echo "<script>window.open('index.php?view_comments','_self')</script>";
			}
		}
		?>
	
			
	
	