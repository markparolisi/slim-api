<?php

namespace App\Order;

/**
 * Class Controller
 *
 * @package App\Order
 */
class Controller
{
    /**
     * @param $request
     * @param $response
     *
     * @return mixed
     */
    public static function single(\Slim\Http\Request $request, \Slim\Http\Response $response): \Slim\Http\Response
    {
        $params = $request->getParams();
        $config = \App\Utils\Config::getInstance()->config();

        $page   = ! empty($params['page']) ? $params['page'] : $config->get('pagination')['page'];
        $limit  = ! empty($params['limit']) ? $params['limit'] : $config->get('pagination')['limit'];
        $offset = (--$page) * $limit;

        $fractal = new \League\Fractal\Manager();

        $customers = \App\Customer\Model::offset($offset)->take($limit)->get()->toArray();

        $resource = new \League\Fractal\Resource\Collection($customers, new \App\Customer\Transformer);

        return $response->withStatus(200)
                        ->withHeader("Content-Type", "application/json")
                        ->write($fractal->createData($resource)->toJson());
    }
}
