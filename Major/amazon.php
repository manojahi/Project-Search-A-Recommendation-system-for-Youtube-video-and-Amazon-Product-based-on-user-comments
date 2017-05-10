<?php
	//$res = shell_exec("python3 test.py");
	//echo $res;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/amazon_css.css">
	<link rel="stylesheet" type="text/css" href="css/opensans.css" />
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php" style="color: #ffffff; font-size: 20px; margin-left: 15px;">Amazon Search</a>
    </div>
</nav>

<!--<center>
<div id="search-container" style="padding: 25px;">
	<input type="text" id="amazon-search" name="amazon-search" placeholder="Seach Amazon">
</div>
</center>-->

<center>
<div class="row" style="padding: 10px;">
	<div class="col-md-1">
		
	</div>
    <div class="col-md-10">
      <div class="tabs-left">
        <ul class="nav nav-tabs" id="tabs">
          <li id="laptop-tab"><a href="#laptop" data-toggle="tab" align="center">Laptop</a></li>
          <li id="power-tab"><a href="#powerbank" data-toggle="tab">Power Bank</a></li>
          <li id="hard-tab"><a href="#harddrive" data-toggle="tab">Hard Drive</a></li>
          <li id="pen-tab"><a href="#pendrive" data-toggle="tab">Pen Drive</a></li>
          <li id="sdcard-tab"><a href="#sdcard" data-toggle="tab">SD Card</a></li>
          <li id="headset-tab"><a href="#headset" data-toggle="tab">Headset</a></li>
          <li id="mouse-tab"><a href="#mouse" data-toggle="tab">Mouse Keyboard</a></li>
          <li id="speaker-tab"><a href="#speaker" data-toggle="tab">Speaker</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
		  <div class="tab-pane active" id="default">
		    <img src="images/amazon.png" style="width: 100%;height: 100%;" />
		  </div>
		  <div class="tab-pane" id="laptop">
		    <p>Laptop result goes here</p>
		  </div>
		  <div class="tab-pane" id="powerbank">
		    <p>Power bank result goes here</p>
		  </div>
		  <div class="tab-pane" id="harddrive">
		    <p>Hard Drive result goes here</p>
		  </div>
		  <div class="tab-pane" id="pendrive">
		    <p>Pen Drive result goes here</p>
		  </div>
		  <div class="tab-pane" id="sdcard">
		    <p>SD Cards result goes here</p>
		  </div>
		  <div class="tab-pane" id="headset">
		    <p>Headset result goes here</p>
		  </div>
		  <div class="tab-pane" id="mouse">
		    <p>Mouse result goes here</p>
		  </div>
		  <div class="tab-pane" id="speaker">
		    <p>Speaker result goes here</p>
		  </div>

		</div><!-- /tab-content -->
      </div><!-- /tabbable -->
    </div><!-- /col -->

    <div class="col-md-1">
		
	</div>
  </div>
</center>  

</body>

<script>
var tabsFn = (function() {
  
  function init() {
    setHeight();
  }
  
  function setHeight() {
    var $tabPane = $('.tab-pane'),
        tabsHeight = $('.nav-tabs').height();
    
    $tabPane.css({
      height: tabsHeight
    });
  }
    
  $(init);
})();

function GetResult(which_tab){
	//alert(which_tab+" ok");
	$('#'+which_tab).html("<img src='load.gif' id='load'>");
	$.ajax({
        url: "amazon_ajax.php",
        type: "post",
        data: { which_tab: which_tab } ,
        success: function (response) {
           // you will get response from your php page (what you echo or print)                 
           //alert("ok");
           $('#'+which_tab).html('');
           $('#'+which_tab).html(response);
           //showResult();
           //alert(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           //console.log(textStatus, errorThrown);
           $('#'+which_tab).html('');
           alert("error");
        }
    });
}

var which_tab = "";

$('#laptop-tab').click(function(){
	which_tab = "laptop";
	GetResult(which_tab);
});

$('#power-tab').click(function(){
	which_tab = "powerbank";
	GetResult(which_tab);
});

$('#hard-tab').click(function(){
	which_tab = "harddrive";
	GetResult(which_tab);
});

$('#pen-tab').click(function(){
	which_tab = "pendrive";
	GetResult(which_tab);
});

$('#sdcard-tab').click(function(){
	which_tab = "sdcard";
	GetResult(which_tab);
});

$('#headset-tab').click(function(){
	which_tab = "headset";
	GetResult(which_tab);
});

$('#mouse-tab').click(function(){
	which_tab = "mouse";
	GetResult(which_tab);
});

$('#speaker-tab').click(function(){
	which_tab = "speaker";
	GetResult(which_tab);
});


</script>

</html>