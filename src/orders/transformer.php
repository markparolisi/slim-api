<?php

namespace App\Order;

/**
 * Class Transformer
 * @package App\Order
 */
class Transformer extends \League\Fractal\TransformerAbstract
{
    /**
     * @param array $order
     *
     * @return array
     */
    public function transform(array $order): array
    {

        // Hide the relationship FK
        unset($order['customerNumber']);

        return $order;
    }
}
