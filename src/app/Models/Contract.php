<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'property_id',
        'title',
        'expires_at',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function property()
    {
        return $this->belongsTo(\App\Models\Property::class);
    }
}
