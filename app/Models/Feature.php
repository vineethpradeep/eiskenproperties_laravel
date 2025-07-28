<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $guarded = [];

    protected $fillable = ['feature_name'];

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
}
