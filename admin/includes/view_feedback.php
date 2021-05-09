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
	<th>Name</th>
	<th>Email</th>
	<th>Message</th>
	<th>Delete</th>
</tr>
<?php 
$sel_feedback = "select * from feedback ORDER by 1 DESC";
$run_feedback = mysqli_query($con,$sel_feedback);
$i = 0;
while ($row_comments = mysqli_fetch_array($run_feedback))
{
	$feedback_id = $row_comments['f_id'];
	//$com_user_id = $row_comments['user_id'];
	$feedback_name = $row_comments['f_name'];
	$feedback_email = $row_comments['f_email'];
	$feedback_message = $row_comments['f_message'];
	//$comment_date = $row_comments['date'];
	$i++;
	
	/*$sel_user_com = "select * from users where user_id='$com_user_id'";
	$run_user_com = mysqli_query($con,$sel_user_com);
	while ($row_users_com=mysqli_fetch_array($run_user_com))
	{
		$user_name = $row_users_com['user_name'];
	
	*/
	
?>
<tr align="center">
	<td><?php echo $i;?></td>
	<td><?php echo $feedback_name;?></td>
	<td><?php echo $feedback_email;?></td>
	<td><?php echo $feedback_message;?></td>
	<td><a href="index.php?view_feedback&delete=<?php echo $feedback_id;?>">Delete</a></td>
	
</tr>
<?php } ?>
</table>
	
<?php
if(isset($_GET['delete']))
		{
			$delete =$_GET['delete'];
			
			$delete_feedback = "delete from feedback where f_id='$delete'";
			
			$run_del_fed = mysqli_query($con,$delete_feedback);
			if($run_del_fed){
					echo "<script>alert('Feedback has been deleted')</script>";
					echo "<script>window.open('index.php?view_feedback','_self')</script>";
			}
		}
		?>
	
			
	
	