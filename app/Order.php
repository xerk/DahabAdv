<?php

namespace App;

use Laravel\Nova\Actions\Actionable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{
    use Actionable;

    protected $table = 'orders';
    public $timestamps = true;

    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function material()
    {
        return $this->belongsTo('App\Material', 'material_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}