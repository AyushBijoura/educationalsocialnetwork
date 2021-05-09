<div id="content">
			<div>
			    <!--<p align="center"><h3>Join The Largest Education Network!!</h3></p>-->
				<img src ="images/image5.png" style="float:left; margin-right:-10px" height="500" width="600">
			</div> 
			<div id="form2">
			<form method="post" action="">
				<h2>Sign Up Today!</h2>
				
				<table>
					<tr>
						<td align="right"> <strong>Name:</strong></td>
						<td><input type="text" name="u_name" required="required" placeholder="Enter your name"/></td>
                    </tr>
					<tr>
						<td align="right"><strong>Password:</strong></td>
						<td><input type="password" name="u_pass" required="required" placeholder="Enter your password"/></td>
                    </tr>
					<tr>
						<td align="right"><strong>Email:</strong></td>
						<td><input type="email" name="u_email" required="required" placeholder="Enter your email"/></td>
                    </tr>
					<tr>
						<td align="right"><strong>Country:</strong></td>
						<td>
						<select name="u_country">
							<option>Select a country</option>
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
							<select name="u_gender">
							<option>Select a gender</option>
							<option>Male</option>
							<option>Female</option>
							</select>
						</td>
                    </tr>
					<tr>
						<td align="right"><strong>Birthday:</strong></td>
						<td><input type="date" name="u_birthday" required="required" /></td>
                    </tr>					
					<tr>
					<td colspan="6">
						<button name="sign_up">Sign Up</button>
					</td>
					</tr>
				</table>
			</form>
			<?php include("insert_user.php"); ?>
			</div>
			
		</div><!--content ends here-->