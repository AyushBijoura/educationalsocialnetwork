					<form method="post" action="" id="f" class="ff" enctype="multipart/form-data">
					
				<table>
					<tr align="center">
						<td colspan="6"><h2>Edit Your Profile :</h2>
					</td>
					</tr>
					<tr>
						<td align="right"> <strong>Name:</strong></td>
						<td><input type="text" name="u_name"  value="<?php echo $user_name;?>"/></td>
                    </tr>
					<tr>
						<td align="right"><strong>Password:</strong></td>
						<td><input type="password" name="u_pass" value="<?php echo $user_pass;?>" /></td>
                    </tr>
					<tr>
						<td align="right"><strong>Email:</strong></td>
						<td><input type="email" name="u_email"  value="<?php echo $user_email;?>">
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Country:</strong></td>
						<td>
						<select name="u_country" disabled="disabled">
							<option><?php echo $user_country;?></option>
							<option>India</option>
							<option>Japan</option>
							<option>China</option>
							<option>America</option>
						</select>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Gender:</strong></td>
						<td>
							<select name="u_gender" disabled="disabled">
							<option><?php echo $user_gender;?></option>
							<option>Male</option>
							<option>Female</option>
							</select>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Image:</strong></td>
						<td><input type="file" name="u_image" required="required" /></td>
                    </tr>					
					
					<tr>
						<td align="right"><strong>Birthday:</strong></td>
						<td><input type="date" name="u_birthday" value="<?php echo $user_birthday;?>" /></td>
                    </tr>					
					<tr align ="center">
						<td colspan="6">
								<input type="submit" name="update" value="Update"/>
						</td>
					</tr>
				</table>
			</form>
		<?php
			if(isset($_POST['update']))
			{
				$u_name = $_POST['u_name'];
				$u_pass = $_POST['u_pass'];
				$u_email = $_POST['u_email'];
				$u_birthday = $_POST['u_birthday'];
				$u_image = $_FILES['u_image']['name'];
				$image_tmp = $_FILES['u_image']['tmp_name'];
				
				move_uploaded_file($image_tmp,"user/user_image/$u_image");
				$update = "update users set user_name='$u_name',user_pass='$user_pass',user_email='$user_email',user_image='$u_image', user_birthday='$u_birthday' where user_id='$user_id'";
				
				$run = mysqli_query($con,$update);
				if($run)
				{
					echo "<script>alert('Your profile has been updated')</script>";
					echo "<script>window.open('home.php','_self')</script>";
			
				}
		
			}
		
		
		?>
					
