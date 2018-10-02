<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 02.10.18
 * Time: 22:44
 */

$json = file_get_contents('https://fecko.org/php-test');
$json = json_decode($json);
$equal  = [];

include 'math.php';
$m = new \MyMath\math();

foreach($json as $item){
    if (!is_object($item)){
        continue;
    }
    $string = str_replace(' ', '', $string);
    $result = substr($string, strpos($string, '= ')+1);
    $result = str_replace(' ', '', $result);
    $math   = str_replace('='.$result, '', $string);
    $r      = $m->calculateOld($math);
    if ($r == $result){
        $equal[] = $item;
    }
}

if (count($equal) == 0){
    echo "Sorry, no luck this time :-(";
} else {
    echo "<pre>".print_r($equal, true)."</pre>";
}