<?php

namespace App\Customer;

/**
 * Class CustomerController
 *
 * @package App\Customer
 */
class Controller
{
    /**
     * @param $request
     * @param $response
     * @param $args
     *
     * @return mixed
     */
    public static function list($request, $response, $args)
    {

        $fractal = new \League\Fractal\Manager();

        $customers = \App\Customer\Model::all()->toArray();

        $resource = new \League\Fractal\Resource\Collection($customers, new \App\User\Transformer);

        $data = $fractal->createData($resource)->toArray();

        return $response->withStatus(200)
                        ->withHeader("Content-Type", "application/json")
                        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
}