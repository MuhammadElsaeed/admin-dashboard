<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model {

    protected $fillable = ['type_id'];

    public function serviceType() {
        return $this->belongsTo('App\ServiceType', 'type_id');
    }

}
