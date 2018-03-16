<?php
	$err = '';
	session_start();
	include 'header.php';

    if (isset($_POST['login'])){
		
        include_once 'include/connection.inc.php';

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
		
		if(empty($username) || empty($password)){
			$err = "Username or password can't be empty";
		}
		else{
			$sql = "SELECT * FROM customer WHERE username='$username'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$hashedPwdCheck = password_verify($password, $row['password']); //Dehashing password
			
			if($hashedPwdCheck){
				$_SESSION['username'] = $row['username'];
				$_SESSION['firstname'] = $row['firstname'];
				$_SESSION['lastname'] = $row['lastname'];
				header("Location: firstpage.php");
			}
			else{				
				$err = "Username or password incorrect!";
			}
		}	
	}
?>


   <h1>AM online store</h1>
    <div class="container">
        <h2>Sign In</h2>
		<form method="POST">
			<input type="text" class="name" name="username" placeholder="Username" required="">
			<input type="password" class="password" name="password" placeholder="Password" required="">
			<!--<ul>
				<li>
					<input type="checkbox" id="brand1" value="">
					<label for="brand1"><span></span>Remember me</label>
				</li>
			</ul>
            <a href="#">Forgot Password?</a><br>
			<div class="clear"></div>-->
			<p class="error" style="color:#ff0066; font-size:20px; background-color:black;"><?php echo $err; ?></p>
			<input type="submit" value="SIGN IN" name ="login">
			<p><a href="register.php">Register now</a></p>
		</form>
	</div>
	<div class="footer">
		<p> &copy; AM Sign In Form. All Rights Reserved</p>
	</div>
</body>
</html>