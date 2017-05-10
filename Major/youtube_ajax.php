<?php

$search = $_POST['search'];
//$search = "linkin";
$search = str_replace(" ", "+", $search);
$res = shell_exec("python youtube_search.py --q $search");

function get_youtube($url){
	$youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";

	$curl = curl_init($youtube);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$return = curl_exec($curl);
	curl_close($curl);
	return json_decode($return, true);
}

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


$res = str_replace('\'', '"', $res);
//echo $res;
$resArray = json_decode($res, true);

usort($resArray, 'cmp');
foreach ($resArray as $key => $value) { 
	$url = "https://www.youtube.com/watch?v=".$value["name"];
	$youtube_json = get_youtube($url);

	$pos_per = (intval($value['pos'])/intval($value['total']))*100;
	$pos_per = sprintf('%0.1f', $pos_per);

	echo 
	'<div class="row" style="padding: 25px;">
		<div class="col-md-2"> </div>
		<div class="col-md-3">
			<center>
			<div>
				<iframe width="320" height="180" src="//www.youtube.com/embed/'.$value["name"].'?rel=0&amp;hd=1" frameborder="0" allowfullscreen></iframe>
			</div>	
			</center>
		</div>
		<div class="col-md-7">
			<a href="https://youtube.com/watch?v='.$value["name"].'" target="_blank" style="text-decoration: none;"><p style="font-size: 20px; margin-left: 25px;">'.$youtube_json["title"].'</p></a>
			<p style="font-size: 15px; margin-left: 25px;">'.$youtube_json["author_name"].'</p>
			
			<p style="font-size: 15px; margin-left: 25px; color: #669933;">Positive '.$pos_per.'%</p>			
		</div>
	</div>
	<center>
		<hr>
	</center>';
}

?>