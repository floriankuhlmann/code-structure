<?php
require_once __DIR__.'/vendor/autoload.php';


$data = array(
    "propertySize" => 500,
    "parkingAreaQuantity" => 5,
    "streetType" => "dead_end"
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => json_encode($data)
    )
);
$context  = stream_context_create($opts);
$result = file_get_contents('http://localhost/code-structure/', false, $context);
$responseData = json_decode($result , true);
var_dump($responseData);