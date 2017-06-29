<?php

use PHPUnit\Framework\TestCase;

class UserTransformerTest extends TestCase
{

    private $user;

    protected function setUp()
    {

        $this->user = [
            'id'    => '1',
            'title' => 'Mrs.',
            'name'  => 'Philip',
            'email' => 'philip@example.org',
        ];
    }

    public function testTransfomerLinks()
    {

        $fractal = new League\Fractal\Manager();

        $resource = new League\Fractal\Resource\Item($this->user, new \App\User\Transformer);

        $expected = '/user/1';
        $actual   = $fractal->createData($resource)->toArray()['data']['links'][0]['uri'];

        $this->assertEquals($expected, $actual, 'Should transform the user');
    }
}