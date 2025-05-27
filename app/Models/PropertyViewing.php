<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyViewing extends Model
{
    protected $guarded = [];
    protected $table = 'property_viewing';
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
