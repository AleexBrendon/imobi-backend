<?php

namespace App\Models;

use App\Models\Client;
use App\Models\ClientProperty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'created_by',
        'title',
        'description',
        'price',
        'address'
    ];

    public function clients()
    {
        return $this->belongsToMany(Client::class)
            ->using(ClientProperty::class)
            ->withPivot(['status', 'notes'])
            ->withTimestamps();
    }
}
