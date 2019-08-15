<?php

namespace App;

use Laravel\Nova\Actions\Actionable;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model 
{
    use Actionable;

    protected $table = 'suppliers';
    public $timestamps = true;

    public function storages()
    {
        return $this->hasMany('App\Storage', 'supplier_id');
    }

}