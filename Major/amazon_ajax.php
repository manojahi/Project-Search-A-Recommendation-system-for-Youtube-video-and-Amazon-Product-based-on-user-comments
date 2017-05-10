<?php

$which_tab = $_POST['which_tab'];
$res = shell_exec("python get_product.py $which_tab");

function cmp($a, $b) {
    $a_per = (intval($a['pos'])/intval($a['total']))*100;
	$a_per = sprintf('%0.1f', $a_per);

	$b_per = (intval($b['pos'])/intval($b['total']))*100;
	$b_per = sprintf('%0.1f', $b_per);	

    if ($a_per == $b_per) {
        return 0;
    }
    return $a_per > $b_per ? -1 : 1;
}

$res = substr($res, 0, -5);
$res = str_replace('\'', '"', $res);
//echo $res;
$resArray = json_decode($res, true);
//echo $resArray;
usort($resArray, 'cmp');

foreach ($resArray as $key => $value) { 
	//echo "<br/>hello";
	$image_url = "http://z-ecx.images-amazon.com/images/P/".$value["name"].".jpg";
	
	$pos_per = (intval($value['pos'])/intval($value['total']))*100;
	$pos_per = sprintf('%0.1f', $pos_per);

	echo 
	'<div class="row" style="padding: 25px;">
		<div class="col-md-1"> </div>
		<div class="col-md-3">
			<center>
			<div>
				<img width="200" height="150" src="'.$image_url.'" ></img>
			</div>	
			</center>
		</div>
		<div class="col-md-8" style="text-align: left;">
			<a href="http://www.amazon.com/dp/'.$value['name'].'" target="_blank" style="text-decoration: none;"><p style="font-size: 17px; margin-left: 25px;">'.$value["product"].'</p></a>
			<p style="font-size: 15px; margin-left: 25px;">'.$value["price"].'</p>
			
			<p style="font-size: 15px; margin-left: 25px; color: #669933;">Positive '.$pos_per.'%</p>			
		</div>
	</div>
	<center>
		<hr style="background-color:#555;width:80%;height:1px;">
	</center>';
}

?>