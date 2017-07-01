<?php

namespace App\Token;

class Controller
{


    /**
     * @param $request
     * @param $response
     *
     * @return mixed
     */
    public function generate(\Slim\Http\Request $request, \Slim\Http\Response $response): \Slim\Http\Response
    {
        $customer_name = $request->getParsedBody()['customer_name'];

        $customer = \App\Customer\Model::where('customerName', $customer_name)->firstOrFail();

        if (! empty($customer)) {
            $key   = \App\Utils\Config::getInstance()->config()['authTokenKey'];
            $token = [
                "iss" => "http://localhost:8080",
                "aud" => "http://localhost:8080",
                "iat" => time(),
                "exp" => time() + strtotime("+30 days"),
                "sub" => $customer->customerNumber,
                "role" => "customer"
            ];

            $jwt = \Firebase\JWT\JWT::encode($token, $key);

            $response->withStatus(200)
                     ->withHeader("Content-Type", "application/json")
                     ->write(json_encode(['token' => $jwt]));
        }

        return $response;
    }
}
