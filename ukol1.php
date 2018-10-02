<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 01.10.18
 * Time: 20:54
 */

$json   = file_get_contents('https://fecko.org/php-test');
$json   = json_decode($json);
$equal  = [];
$search = ['laravel', 'envoyer'];

foreach($json as $item){
    if (!is_object($item)){
        continue;
    }
    $name = $item->name;
    foreach($search as $string){
        if(strrev($name) == $string){
            $equal[] = $item;
        }
    }
}


if (count($equal) == 0){
    echo "Sorry, no luck this time :-(";
} else {
    echo "<pre>".print_r($equal, true)."</pre>";
}