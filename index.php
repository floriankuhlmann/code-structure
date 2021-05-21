<?php
require_once __DIR__.'/vendor/autoload.php';
require(__DIR__.'/src/Controller/CalculateValuationController.php');

use Symfony\Component\HttpFoundation\Request as Request;
use CoSt\Controller\CalculateValuationController as Controller;

$request = Request::createFromGlobals();
$controller = new Controller($request);

