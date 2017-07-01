<?php


class CustomerControllerTest extends PHPUnit\Framework\TestCase
{

    private $domain = "http://localhost:8080";

    private $client;


    protected function setUp()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function testPingEndpoint()
    {

        $this->markTestSkipped("Skipping this test until HTTP testing is finalized");
        $response = $this->client->request("GET", "{$this->domain}/ping");

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("pong", $response->getBody());
    }

}
