<?php
	//$res = shell_exec("python3 test.py");
	//echo $res;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/opensans.css" />
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php" style="color: #ffffff; font-size: 24px; margin-left: 15px;">Search</a>
    </div>
</nav>

<div class="main">
	<div class="row">
		<div class="col-md-4"></div>

		<div class="col-md-4">
			<div id="youtube-video">
			<center>
				Video Search
			</center>
			</div>
		</div>

		<div class="col-md-4"></div>
		
	</div>
	<br/>
	<div class="row">
		<div class="col-md-4"></div>

		<div class="col-md-4">
			<div id="amazon-product">
			<center>
				Product Search
			</center>	
			</div>
		</div>

		<div class="col-md-4"></div>
	</div>
	<br/>
</div>

</body>

<footer class="footer">
  <div class="container">
  <center>
    <p class="text-muted">&copy; Major Project Search</p>
  </center>  
  </div>
</footer>

<script type="text/javascript">
	$("#youtube-video").click(function(){
		window.location.href = "youtube.php";
	});

	$("#amazon-product").click(function(){
		window.location.href = "amazon.php";
	});

</script>

</html>