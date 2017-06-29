<?php

namespace App\User;

class Transformer extends \League\Fractal\TransformerAbstract
{
    public function transform(array $user)
    {
        return [
            'id'    => (int)$user['id'],
            'title' => $user['title'],
            'user'  => [
                'name'  => $user['name'],
                'email' => $user['email'],
            ],
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/user/' . $user['id'],
                ]
            ]
        ];
    }
}