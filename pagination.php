<?php
$query = "select * from posts";
$result = mysqli_query($con,$query);
//count total records
$total_records = mysqli_num_rows($result);
//using ceil function to divide the total records per page
$total_page = ceil($total_records / $per_page);
//going to first page
echo "
	<center>
	<div id ='pagination'>
	<a href='home.php?page=1'>First Page</a>
	";
	for($i=1; $i<=$total_page; $i++)
	{
			echo "<a href='home.php?page=$i'>$i</a>";
	}
	//going to last page
	echo "<a href='home.php?page=$total_page'>Last Page</a></center></div>";

?>