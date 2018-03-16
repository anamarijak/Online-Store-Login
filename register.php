<?php
	include 'header.php';
	$letter_err = $username_exi = $pwd_err = $empty_err = $success = $username_exi = $pwd_err = '';
		
	if(isset($_POST['register'])){
		include_once 'include/connection.inc.php';
		
		//mysqli_real_escape_string pomaze pri sprijecavanju SQL injection-a
		$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $streetaddress = mysqli_real_escape_string($conn, $_POST['streetaddress']);
        $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
		
		if(empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password) || empty($mobile) || empty($country) || empty($city) || empty($streetaddress) || empty($zipcode)){
			$empty_err = "All fields are required";	
		}
		elseif(strlen($password) <= 3){	
			$pwd_err = "Password must be higher than 3 characters";
		}
		elseif(!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)){
			$letter_err = "Firstname or lastname only have to contain letters!";
		}
		else{
			$sql = "SELECT * FROM customer WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
			
            $resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0){	
				$username_exi = "Username already exists";
			}
			else{
				$hashedPwd = password_hash($password, PASSWORD_DEFAULT); //Hashing the password
		
				//Insert User into the db
				$sql = "INSERT INTO customer (firstname, lastname, email, username, password, mobile, country, city, streetaddress, zipcode) VALUES ('$firstname', '$lastname', '$email', '$username', '$hashedPwd', '$mobile', '$country', '$city', '$streetaddress', '$zipcode')";

				$result = mysqli_query($conn, $sql);
				$success = "Account successfully created";
				header("Location:index.php");
			}
		}
	}
?>

	<p style="text-align:center;color:#ff0066; font-size:20px;"><?php echo $empty_err .'<br>'. $pwd_err .'<br>'.$letter_err .'<br>'. $username_exi; ?></p>
	<p><?php echo $success; ?></p>
    <div class="container">
        <h2 class="regi">Register</h2>
		<form method="POST">		
			<input type="text" class="reg" name="firstname" placeholder="Firstname" required="">
			<input type="text" class="reg" name="lastname" placeholder="Lastname" required="">
			<input type="text" class="reg" name="username" placeholder="Username" required="">
			<input type="password" class="reg" name="password" placeholder="Password" required="">
			<input type="email" class="reg" name="email" placeholder="Email" required="">
			<input type="text" class="reg" name="mobile" placeholder="Mobile" required="">
			<input type="text" class="reg" name="country" placeholder="Conutry" required="">
			<input type="text" class="reg" name="city" placeholder="City" required="">
			<input type="text" class="reg" name="streetaddress" placeholder="Street Address" required="">
			<input type="number" class="reg" name="zipcode" placeholder="Zip Code" required="">
		<!--<ul>
			<li>
				<input type="checkbox" id="brand1" value="">
				<label for="brand1"><span></span>Remember me</label>
			</li>
		</ul>
		<a href="#">Forgot Password?</a><br>
		<div class="clear"></div>-->
			<input class="register" type="submit" value="Register" name ="register">
			<p><a href="index.php">Log in</a></p>
		</form>
	</div>
	<div class="footer">
		
		<p> &copy; AM Sign In Form. All Rights Reserved</p>
	</div>
</body>
</html>