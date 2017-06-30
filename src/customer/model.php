<?php

namespace App\Customer;

class Model extends \Illuminate\Database\Eloquent\Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'customerNumber';

    /**
     * @var string
     */
    protected $table = 'customers';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('\App\Order\Model', 'customerNumber', 'customerNumber');
    }
}
