<?php

namespace App;

use Laravel\Nova\Actions\Actionable;
use Illuminate\Database\Eloquent\Model;

class Material extends Model 
{
    use Actionable;

    protected $table = 'materials';
    public $timestamps = true;

    public function orders()
    {
        return $this->hasMany('App\Order', 'id', 'material_id');
    }

    public function storages()
    {
        return $this->hasMany('App\Storage', 'id', 'material_id');
    }

}