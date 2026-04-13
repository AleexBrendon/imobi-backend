<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClientProperty extends Pivot
{
    protected $table = 'client_property';

    protected $fillable = [
        'client_id',
        'property_id',
        'status',
        'notes'
    ];

    public $timestamps = true;
}