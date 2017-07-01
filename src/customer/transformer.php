<?php

namespace App\Customer;

class Transformer extends \League\Fractal\TransformerAbstract
{

    /**
     * List of all available parameters
     *
     * @var array
     */
    private $validParams = [
        "id",
        "name",
        "fullAddress",
        "orders",
        "links",
    ];


    public function __construct($params = [])
    {
        if (! empty($params)) {
            $this->validParams = (array) $params;
        }
    }

    /**
     * @param array $customer
     *
     * @return string
     */
    private static function formatAddress(array $customer): string
    {
        $address = "";

        if (! empty($customer["addressLine1"])) {
            $address_tpl = "%s %s %s, %s - %s";

            $address = sprintf(
                $address_tpl,
                $customer["addressLine1"],
                $customer["addressLine2"],
                $customer["city"],
                $customer["state"],
                $customer["country"]
            );
        }

        return $address;
    }

    /**
     * @param array $customer
     *
     * @return array
     */
    private static function formatOrders(array $customer): array
    {
        $orders = [];

        if (! empty($customer["orders"])) {
            $fractal = new \League\Fractal\Manager();
            $orders  = new \League\Fractal\Resource\Collection($customer["orders"], new \App\Order\Transformer);
            $orders  = $fractal->createData($orders)->toArray()["data"];
        }


        return $orders;
    }


    /**
     * @param array $customer
     *
     * @return array
     */
    public function transform(array $customer): array
    {
        $model = [
            "id"          => (int) $customer["customerNumber"],
            "name"        => $customer["customerName"],
            "fullAddress" => self::formatAddress($customer),
            "orders"      => self::formatOrders($customer),
            "links"       => [
                [
                    "rel" => "self",
                    "uri" => "/customer/" . $customer["customerNumber"],
                ],
            ],
        ];

        $model = array_intersect_key($model, array_flip($this->validParams));

        return $model;
    }
}
