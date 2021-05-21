<?php
namespace CoSt\Controller;
use CoSt\Helper\Response as Response;
use CoSt\Helper\Validator as Validator;
use Symfony\Component\HttpFoundation\Request as Request;


class CalculateValuationController
{

    /**
     * @var int
     */
    private $propertySize;

    /**
     * @var int
     */
    private $parkingAreaQuantity;

    /**
     * @var int
     */
    private $streetType;

    /**
     * @var Response
     */
    private $response;

    /**
     * CalculateValuationController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {

        $this->response = new Response();

        /* in general the validation process would be part of a middleware */

        $headers = $request->headers;
        if (!Validator::isHeaderTypeJson($headers)) {
            echo $this->response->getJsonResponse("wrong Content-Type");
            return;
        }

        $bodyContent = $request->getContent();
        if (!Validator::hasBodyContent($bodyContent)) {
            echo $this->response->getJsonResponse("no content in body");
            return;
        }

        if (!Validator::isContentJson($bodyContent)) {
            echo $this->response->getJsonResponse("no json content");
            return;
        }

        $propertyCheck = Validator::checkProperties($bodyContent);
        if ($propertyCheck[0] == "invalid properties") {
            echo $this->response->getJsonResponse($propertyCheck);
            return;
        }

        $properties = json_decode($bodyContent);

        $this->propertySize = $properties->propertySize;
        $this->parkingAreaQuantity = $properties->parkingAreaQuantity;
        $this->streetType = $properties->streetType;

        $benchmarkValue = $this->calculate();

        /* errorhandling is missing */
        $this->saveToFile(array('benchmarkValue' => $benchmarkValue));

        $this->renderResponse(array('benchmarkValue' => $benchmarkValue));

    }


    /**
     * @param $value
     */
    public function renderResponse($value) {

        echo $this->response->getJsonResponse($value);

    }


    /**
    * @return array
    */
    private function calculate() {

        $propertySize = $this->propertySize*30;
        if ($this->parkingAreaQuantity > 3 ) {
            $this->parkingAreaQuantity = 3;
        }

        $parkingAreaQuantity = $this->parkingAreaQuantity * 100;

        $streetTypeValues = array("dead_end" => 2000,"standard" =>3000);
        $streetTypes = $streetTypeValues[$this->streetType];

        $benchmarkValue = $propertySize + $parkingAreaQuantity + $streetTypes;

        return $benchmarkValue;

    }

    /**
     * @param $value
     */
    private function saveToFile($value) {

        $myfile = fopen(__DIR__."/../../data/localstorage.txt", "w") or die("Unable to open file!");
        $txt = json_encode($value)."\n";
        fwrite($myfile, $txt);
        fclose($myfile);

    }
}