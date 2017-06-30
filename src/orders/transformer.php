<?php

namespace App\Order;

class Transformer extends \League\Fractal\TransformerAbstract {

	public function transform( array $order ) {

		// Hide the relationship FK
		unset( $order['customerNumber'] );

		return $order;
	}
}
