<?php include 'header.php'; 
	session_start();
	if(!$_SESSION['username']) {
		header("Location:index.php");
	}
?>
	<body style="background:none;">
		<h1 class="comingsoon">Coming soon...</h1>
		<div style="width:500px;height:500px; display:block; margin-left: auto; margin-right:auto;">
		<img width="100%" src="images/AMlogo.png" align="center"/>
		</div>
	</body>
</html>