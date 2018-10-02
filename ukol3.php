<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 01.10.18
 * Time: 21:12
 */

$json   = file_get_contents('https://fecko.org/php-test');
$json   = json_decode($json);
$equal  = [];

/*
function findDate($var){
    $datetime = new DateTime($var->created);
    return $datetime->format('Y-d-H-s') === '2014-02-21-30';

}
*/

function filterJSON($json){
    $return = [];
    foreach($json as $item){
        if (!is_object($item)){
            continue;
        }
        $return[] = $item;
    }

    return $return;
}

$equal = array_filter(filterJSON($json),function($json){
    $datetime = new DateTime($json->created);
    return $datetime->format('Y-d-H-s') === '2014-02-21-30';
});

if (count($equal) == 0){
    echo "Sorry, no luck this time :-(";
    // echo "<pre>".print_r(filterJSON($json), true)."</pre>";
} else {
    echo "<pre>".print_r($equal, true)."</pre>";
}