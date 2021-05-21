<?php

namespace CoSt\Helper;

/**
 * Class Response
 * @package CoSt\Helper
 */
class Response
{
    /**
     * @param String $data
     * @return false|string
     */
    public function getJsonResponse(String $data) {

        header('Content-Type: application/json');
        return json_encode($data);

    }
}