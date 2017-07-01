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
     *
     * @return mixed
     */
    public static function list(\Slim\Http\Request $request, \Slim\Http\Response $response): \Slim\Http\Response
    {
        $params = $request->getParams();
        $config = \App\Utils\Config::getInstance()->config();

        $page   = ! empty($params['page']) ? $params['page'] : $config->get('pagination')['page'];
        $limit  = ! empty($params['limit']) ? $params['limit'] : $config->get('pagination')['limit'];
        $offset = (--$page) * $limit;
        $fields   = ! empty($params['fields']) ? str_getcsv($params['fields']) : [];


        $fractal = new \League\Fractal\Manager();

        $customers = \App\Customer\Model::with('orders')->offset($offset)->take($limit)->get()->toArray();

        $resource = new \League\Fractal\Resource\Collection($customers, new \App\Customer\Transformer($fields));

        return $response->withStatus(200)
                        ->withHeader("Content-Type", "application/json")
                        ->write($fractal->createData($resource)->toJson());
    }
}
