<?php

namespace App\Customer;

class Model extends \Illuminate\Database\Eloquent\Model
{
    protected $primaryKey = 'customerNumber';
    protected $table = 'customers';

	public function orders()
	{
		return $this->hasMany('\App\Order\Model', 'customerNumber', 'customerNumber');
	}

}
