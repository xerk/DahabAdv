<?php

namespace App;

use Laravel\Nova\Actions\Actionable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model 
{
    use Notifiable, Actionable, SoftDeletes;

    protected $table = 'clients';
    public $timestamps = true;

    public function orders()
    {
        return $this->hasMany('App\Order', 'client_id', 'id');
    }

    public function payments()
    {
        return $this->hasManyThrough('App\Payment', 'App\Order', 'client_id', 'order_id', 'id', 'id');
    }

}