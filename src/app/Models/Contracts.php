<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Property;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = ['client_id', 'property_id', 'title', 'expires_at', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
