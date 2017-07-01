<?php

class CustomerTransformerTest extends PHPUnit\Framework\TestCase
{

    private $customer;

    protected function setUp()
    {

        $this->customer = [
            'customerNumber' => '34',
            'customerName'   => 'Jane Doe',
        ];
    }

    public function testTransfomerLinks()
    {

        $fractal = new League\Fractal\Manager();

        $resource = new League\Fractal\Resource\Item($this->customer, new \App\Customer\Transformer);

        $expected = '/customer/34';
        $actual   = $fractal->createData($resource)->toArray()['data']['links'][0]['uri'];

        $this->assertEquals($expected, $actual, 'Should transform the customer');
    }
}
