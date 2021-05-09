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
	<th>Topic Title</th>
	<th>Delete</th>
	<th>Edit</th>
</tr>
<?php 
$sel_topics = "select * from topics ORDER by 1 DESC";
$run_topics = mysqli_query($con,$sel_topics);
$i = 0;
while ($row_posts = mysqli_fetch_array($run_topics))
{
	$topic_id = $row_posts['topic_id'];
	$topic_title = $row_posts['topic_title'];
	$i++;
	
	
	
	
?>
<tr align="center">
	<td><?php echo $i;?></td>
	<td><?php echo $topic_title;?></td>
	<td><a href="index.php?view_topics&delete=<?php echo $topic_id;?>">Delete</a></td>
	<td><a href="index.php?view_topics&edit=<?php echo $topic_id;?>">Edit</a></td>

</tr>
<?php } ?>
</table>
	
<?php
if(isset($_GET['edit'])){
	$edit_topic_id = $_GET['edit'];
	$sel_topics = "select * from topics where topic_id='$edit_topic_id'";
	$run_topics = mysqli_query($con,$sel_topics);
	$row_topics = mysqli_fetch_array($run_topics);
	
	$topic_new_id = $row_topics['topic_id'];
	$topic_title = $row_topics['topic_title'];
	




?>	
<form method="post" action="" id="f" class="ff" enctype="multipart/form-data">

			<input type="text" name="topic_title"  size="82" value="<?php echo $topic_title;?>"/><br/>
					<input type="submit" name="update" value="Update Topic"/>
					</form>
				</form>
<?php } ?>
<?php			
		if(isset($_POST['update']))
			{
				
				$topic_title = $_POST['topic_title'];
				
				$update_topic = "update topics set topic_title='$topic_title' where topic_id='$topic_new_id'";
				
				$run = mysqli_query($con,$update_topic);
				if($run)
				{
					echo "<script>alert('Topic has been updated')</script>";
					echo "<script>window.open('index.php?view_topics','_self')</script>";
			
				}
		
			}


			if(isset($_GET['delete']))
			{
			$delete_id =$_GET['delete'];
			
			$delete = "delete from topics where topic_id='$delete_id'";
			
			$run_del = mysqli_query($con,$delete);
			if($run_del){
					echo "<script>alert('Topic has been deleted')</script>";
					echo "<script>window.open('index.php?view_topics','_self')</script>";
			}
		}
		
		?>
	
	