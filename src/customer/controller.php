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
    public static function list($request, $response)
    {
        $params = $request->getParams();
        $config = \App\Utils\Config::getInstance()->config;
        $page   = ! empty($params['page']) ? $params['page'] : $config->get('pagination')['page'];
        $limit  = ! empty($params['limit']) ? $params['limit'] : $config->get('pagination')['limit'];
        $offset = (--$page) * $limit;

        $fractal = new \League\Fractal\Manager();

        $customers = \App\Customer\Model::offset($offset)->take($limit)->get()->toArray();

        $resource = new \League\Fractal\Resource\Collection($customers, new \App\Customer\Transformer);

        $data = $fractal->createData($resource)->toArray();

        return $response->withStatus(200)
                        ->withHeader("Content-Type", "application/json")
                        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
}
