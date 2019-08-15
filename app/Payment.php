<?php

namespace App;

use Laravel\Nova\Actions\Actionable;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model 
{
    use Actionable;

    protected $table = 'payments';
    public $timestamps = true;

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }

}