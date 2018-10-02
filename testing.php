<?php
/**
 * Created by PhpStorm.
 * User: krystofkosut
 * Date: 01.10.18
 * Time: 15:42
 */

$array[] = [
    'id'        => 73945,
    'name'      => "sunt",
    "first"     => 43,
    'second'    => 14,
    'third'     => 27,
    'math'      => '-3 + (12 * 2) - 4 = 45', // What would eval do?
    'created'   => '1992-09-18 13:56:58' // format: Y-m-d H:i:s

];
$array[] = [
    'id'        => 73945,
    'name'      => "levaral",
    "first"     => 43,
    'second'    => 14,
    'third'     => 27,
    'math'      => '-3 + (12 * 2) - 4 = 45', // What would eval do?
    'created'   => '2014-09-02 21:30:20' // format: Y-m-d H:i:s

];
$array[] = [
    'id'        => 73945,
    'name'      => "reyovne",
    "first"     => 43,
    'second'    => 14,
    'third'     => 27,
    'math'      => '-3 + (12 * 2) - 4 = 45', // What would eval do?
    'created'   => '2014-02-02 21:30:32' // format: Y-m-d H:i:s

];
header('Content-Type: application/json');
// echo json_encode($array);

$json   = json_decode(json_encode($array));
$equal  = [];

// The first task
$search = ['laravel', 'envoyer'];
foreach($json as $item){
    foreach($search as $string){
        if(strrev($item->name) == $string){
            $equal[] = $item;
        }
    }
}
// echo json_encode($equal);
// The second task
$equal = [];
foreach($json as $item){
    if(
        // toto bude fce
        ($item->first/$item->second) == $item->third &&
        ( ($item->third % 4) == 0) &&
        (( ($item->third % 5) == 0 ) || ( ($item->third % 6) == 0 ))
    ){
        $equal[] = $item;
    }
}
// echo json_encode($equal);
// The third task

function findDate($var){
    $datetime = new DateTime($var->created);
    return $datetime->format('Y-d-H-i') === '2014-02-21-30';

}

$r = array_filter($json,"findDate");
// echo json_encode($r);

// eval();

// The fourth task
include 'math.php';
// vysledek
$string = '-3 + (12 * 2) - 4 = 45';
$string = str_replace(' ', '', $string);
$result = substr($string, strpos($string, '= ')+1);
$result = str_replace(' ', '', $result);
$math   = str_replace('='.$result, '', $string);
$v = new \MyMath\math();
$r = $v->calculateOld($math);

var_dump($r);