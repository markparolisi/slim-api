<?php

namespace App\Order;

class Transformer extends \League\Fractal\TransformerAbstract
{
    /**
     * @param array $order
     *
     * @return array
     */
    public function transform(array $order)
    {

        // Hide the relationship FK
        unset($order['customerNumber']);

        return $order;
    }
}
