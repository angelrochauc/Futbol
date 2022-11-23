<?php

$players = array('A','B','C','D');
$matches = array();

foreach($players as $k){
	foreach($players as $j){
		if($k == $j){
			continue;
		}
		$z = array($k,$j);
		sort($z);
		if(!in_array($z,$matches)){
			$matches[] = $z;
		}
	}
}

echo '<pre>';
print_r($matches);
echo '</pre>';