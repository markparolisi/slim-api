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
        // just a placeholder. forgive me.
        var_export($request, $response, $args);

        $fractal = new League\Fractal\Manager();

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

        $resource = new League\Fractal\Resource\Collection($users, \App\User\Transformer);

        return $fractal->createData($resource)->toJson();
    }
}
