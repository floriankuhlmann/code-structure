<?php
namespace CoSt\Tests;
require_once __DIR__.'/../vendor/autoload.php';

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

/**
 * Class ControllerTest
 * @package CoSt\Tests
 */
final class ControllerTest extends TestCase
{

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testPostTypeJsonResponse()
    {

        $client = new Client(['base_uri' => 'http://localhost']);
        $data = array();

        $response =  $client->request(
            'POST',
            'http://localhost/code-structure',[
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($data)
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Content-Type'));
        $this->assertEquals($response->getHeader('Content-Type')[0],"application/json");
    }


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testPostTypeNoJsonResponse()
    {

        $client = new Client(['base_uri' => 'http://localhost']);
        $data = array();

        $response =  $client->request(
            'POST',
            'http://localhost/code-structure',[
            'body' => json_encode($data)
        ]);

        $body = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("\"wrong Content-Type\"",$body);
    }


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testPostJsonWithValidValues() {

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
        $this->assertArrayHasKey('benchmarkValue', $responseData);
        $this->assertEquals($responseData['benchmarkValue'], 17300);

    }
}