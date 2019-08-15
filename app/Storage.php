<?php

namespace App;

use Laravel\Nova\Actions\Actionable;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model 
{
    use Actionable;

    protected $table = 'storages';
    public $timestamps = true;

    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'supplier_id');
    }

    public function material()
    {
        return $this->belongsTo('App\Material', 'material_id');
    }

}