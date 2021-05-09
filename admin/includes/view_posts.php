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
	<th>Title</th>
	<th>Author</th>
	<th>Date</th>
	<th>Delete</th>
	<th>Edit</th>
</tr>
<?php 
$sel_posts = "select * from posts ORDER by 1 DESC";
$run_posts = mysqli_query($con,$sel_posts);
$i = 0;
while ($row_posts = mysqli_fetch_array($run_posts))
{
	$post_id = $row_posts['post_id'];
	$user_id = $row_posts['user_id'];
	$post_title = $row_posts['post_title'];
	$post_date = $row_posts['post_date'];
	$i++;
	
	$sel_user = "select * from users where user_id='$user_id'";
	$run_user = mysqli_query($con,$sel_user);
	while ($row_users=mysqli_fetch_array($run_user))
	{
		$user_name = $row_users['user_name'];
	
	
	
?>
<tr align="center">
	<td><?php echo $i;?></td>
	<td><?php echo $post_title;?></td>
	<td><?php echo $user_name;?></td>
	<td><?php echo $post_date;?></td>
	<td><a href="index.php?view_posts&delete=<?php echo $post_id;?>">Delete</a></td>
	<td><a href="index.php?view_posts&edit=<?php echo $post_id;?>">Edit</a></td>

</tr>
<?php } }?>
</table>
	
<?php

if(isset($_GET['edit'])){
	$edit_id = $_GET['edit'];
	$sel_posts = "select * from posts where post_id='$edit_id'";
	$run_posts = mysqli_query($con,$sel_posts);
	$row_posts = mysqli_fetch_array($run_posts);
	
	$post_new_id = $row_posts['post_id'];
	$post_title = $row_posts['post_title'];
	$post_content = $row_posts['post_content'];
	
?>
	<form method="post" action="" id="f" class="ff" enctype="multipart/form-data">

			<input type="text" name="title"  size="82" value="<?php echo $post_title;?>"/><br/>
					<textarea cols="83" rows="4" name="content" ><?php echo $post_content;?></textarea><br/>
					<select name="topic">
						<option>Select a topic</option>
					<?php getTopics();?>
					</select>
					<input type="submit" name="update" value="Update Post"/>
					</form>
					<?php insertPost();?>		
				</form>
<?php } ?>
	<?php
			if(isset($_POST['update']))
			{
				$title = $_POST['title'];
				$content = $_POST['content'];
				$topic = $_POST['topic'];
				
				$update = "update posts set post_title='$title',post_content='$content',topic_id='$topic',post_date=NOW() where post_id='$post_new_id'";
				
				$run = mysqli_query($con,$update);
				if($run)
				{
					echo "<script>alert('Post has been updated')</script>";
					echo "<script>window.open('index.php?view_posts','_self')</script>";
			
				}
		
			}
		if(isset($_GET['delete']))
		{
			$delete_id =$_GET['delete'];
			
			$delete = "delete from posts where post_id='$delete_id'";
			
			$run_del = mysqli_query($con,$delete);
			if($run_del){
					echo "<script>alert('Post has been deleted')</script>";
					echo "<script>window.open('index.php?view_posts','_self')</script>";
			}
		}
		
		?>
	
	