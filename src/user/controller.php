<?php

namespace App\User;

/**
 * Class UserController
 *
 * @package App\User
 */
class UserController
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

        $users = [
            [
                'id'    => '1',
                'title' => 'Mrs.',
                'name'  => 'Philip',
                'email' => 'philip@example.org',
            ],
            [
                'id'    => '2',
                'title' => 'Mr.',
                'name'  => 'George',
                'email' => 'george@example.org',
            ]
        ];

        $resource = new \League\Fractal\Resource\Collection($users, new \App\User\Transformer);

        $data = $fractal->createData($resource)->toArray();

        return $response->withStatus(200)
                        ->withHeader("Content-Type", "application/json")
                        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
}