<?php
require_once __DIR__.'/vendor/autoload.php';
require(__DIR__.'/src/Controller/CalculateValuationController.php');
require(__DIR__.'/src/Controller/EmailController.php');

use Symfony\Component\HttpFoundation\Request as Request;
//use CoSt\Controller\CalculateValuationController as Controller;
use CoSt\Controller\EmailController as EController;

$request = Request::createFromGlobals();
//$controller = new Controller($request);

$mailController = new EController($request);



