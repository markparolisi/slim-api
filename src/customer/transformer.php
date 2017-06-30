<?php

namespace App\Customer;

class Transformer extends \League\Fractal\TransformerAbstract {
	private function formatAddress( $customer ) {
		$address = '';

		if ( ! empty( $customer['addressLine1'] ) ) {
			$address_tpl = '%s %s %s, %s - %s';

			$address = sprintf(
				$address_tpl,
				$customer['addressLine1'],
				$customer['addressLine2'],
				$customer['city'],
				$customer['state'],
				$customer['country']
			);
		}

		return $address;
	}

	public function transform( array $customer ) {

		$fractal = new \League\Fractal\Manager();

		$orders     = new \League\Fractal\Resource\Collection( $customer['orders'], new \App\Order\Transformer);

		return [
			'id'          => (int) $customer['customerNumber'],
			'name'        => $customer['customerName'],
			'fullAddress' => $this->formatAddress( $customer ),
			'orders'      => $fractal->createData($orders)->toArray()['data'],
			'links'       => [
				[
					'rel' => 'self',
					'uri' => '/customer/' . $customer['customerNumber'],
				],
			],
		];
	}
}
