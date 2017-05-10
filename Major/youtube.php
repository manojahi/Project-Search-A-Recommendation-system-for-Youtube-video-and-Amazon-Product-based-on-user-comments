<?php

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
      <a class="navbar-brand" href="index.php" style="color: #ffffff; font-size: 20px; margin-left: 15px;">Youtube Search</a>
    </div>
</nav>

<center>
<div id="search-container" style="padding: 25px;">
	<input type="text" id="youtube-search" name="youtube-search" placeholder="Seach Youtube">
</div>
</center>

<script type="text/javascript">
	$("#youtube-search").on('keyup', function (e) {
	    if (e.keyCode == 13) {
	        GetVideo();
	    }
	});

	function GetVideo(){
		var search_term = $('#youtube-search').val();
		//alert(search_term);
		//alert("length = "+search_term.length);			
		if(search_term.length > 0){
			$('#stat').html("<img src='load.gif' id='load'>");
			$.ajax({
		        url: "youtube_ajax.php",
		        type: "post",
		        data: { search: search_term } ,
		        success: function (response) {
		           // you will get response from your php page (what you echo or print)                 
		           //alert("ok");
		           $('#stat').html('');
		           $('#youtube-result').html(response);
		           //showResult();
		           //alert(response);
		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           //console.log(textStatus, errorThrown);
		           $('#stat').html('');
		           alert("error");
		        }
		    });
		}
	}

</script>


<div id="stat" align="center" style="margin-top: 50px;">
		
</div>

<div id="youtube-result" style="padding: 30px; ">

	

</div>

</body>

<!--<footer class="footer">
  <div class="container">
  <center>
    <p class="text-muted">&copy; Major Project Search</p>
  </center>  
  </div>
</footer>-->



</html>