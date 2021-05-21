<?php
namespace CoSt\Helper;

use Symfony\Component\HttpFoundation\HeaderBag as Header;

/**
 * Class Validator
 * @package CoSt\Helper
 */
class Validator
{

    /**
     * @param String $bodyContent
     * @return bool
     */
    public static function hasBodyContent(String $bodyContent) {

        if ($bodyContent === "") {
           return false;
        }
        return true;

    }


    /**
     * @param Header $headers
     * @return bool
     */
    public static function isHeaderTypeJson(Header $headers) {

        if($headers->get('content-type') === "application/json") {
            return true;
        }
        return false;

    }


    /**
     * @param String $string
     * @return bool
     */
    public static function isContentJson(String $string) {

        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);

    }


    /**
     * @param String $jsonData
     * @return array
     */
    public static function checkProperties(String $jsonData) {

        $propertyCheck = array("valid properties");
        $data = json_decode($jsonData);

        foreach ($data as $propertyKey => $propertyValue) {

            if (!in_array($propertyKey, array("propertySize","parkingAreaQuantity","streetType"))) {
                $propertyCheck[] = "property key is not valid: ".$propertyKey;
            }

            switch ($propertyKey) {
                case "propertySize":
                    if (!is_int($propertyValue)) {
                        $propertyCheck[] = $propertyKey." no valid value: ".$propertyValue;
                    }
                    break;

                case "parkingAreaQuantity":
                    if (!is_int($propertyValue)) {
                        $propertyCheck[] = $propertyKey." no valid value: ".$propertyValue;
                    }
                    break;

                case "streetType":
                    if (!in_array($propertyValue, array("dead_end","standard"))) {
                        $propertyCheck[] = $propertyKey." no valid value: ".$propertyValue;
                    }
                    break;
            }
        }

        if (sizeof($propertyCheck) > 1) {
            $propertyCheck[0] = "invalid properties";
        }

        return $propertyCheck;

    }
}