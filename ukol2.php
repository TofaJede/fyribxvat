<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 01.10.18
 * Time: 21:08
 */

$json = file_get_contents('https://fecko.org/php-test');
$json = json_decode($json);

function checkNumbers($item){
    return ($item->first/$item->second) == $item->third &&
        ( ($item->third % 4) == 0) &&
        (( ($item->third % 5) == 0 ) || ( ($item->third % 6) == 0 ));
}


$equal = [];
foreach($json as $item){
    if (!is_object($item)){
        continue;
    }
    if(checkNumbers($item)){
        $equal[] = $item;
    }
}
if (count($equal) == 0){
    echo "Sorry, no luck this time :-(";
} else {
    echo "<pre>".print_r($equal, true)."</pre>";
}