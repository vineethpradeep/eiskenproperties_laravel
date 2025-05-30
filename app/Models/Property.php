<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    protected $casts = [
        'rent' => 'integer',
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'ptype_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
