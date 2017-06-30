<?php

namespace App\Order;

class Model extends \Illuminate\Database\Eloquent\Model
{
    protected $primaryKey = 'orderNumber';
    protected $table = 'orders';

	public function customer()
	{
		return $this->belongsTo('\App\Customer\Model');
	}
}
