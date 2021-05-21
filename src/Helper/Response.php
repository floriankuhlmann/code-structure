<?php

namespace CoSt\Helper;

/**
 * Class Response
 * @package CoSt\Helper
 */
class Response
{
    /**
     * @param Array $data
     * @return false|string
     */
    public function getJsonResponse(array $data) {

        header('Content-Type: application/json');
        return json_encode($data);

    }
}