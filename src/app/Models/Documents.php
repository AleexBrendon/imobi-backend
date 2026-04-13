<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['client_id', 'file_path', 'type', 'status', 'expires_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
