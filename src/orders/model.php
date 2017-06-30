<?php

namespace App\Order;

class Model extends \Illuminate\Database\Eloquent\Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'orderNumber';

    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('\App\Customer\Model');
    }
}
