<?php

namespace App\Models;

use App\Models\Property;
use App\Models\ClientProperty;
use App\Models\Document;
use App\Models\Contract;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'email', 'phone', 'status', 'user_id'];

    public function properties()
    {
        return $this->belongsToMany(Property::class)
            ->using(ClientProperty::class)
            ->withPivot(['status', 'notes'])
            ->withTimestamps();
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
