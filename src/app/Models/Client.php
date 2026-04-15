<?php

namespace App\Models;

use App\Models\Property;
use App\Models\ClientProperty;
use App\Models\Document;
use App\Models\Contract;
use App\Models\Activity;
use App\Support\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'status', 'user_id', 'company_id',];

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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('company', function ($query) {
            $companyId = Tenant::companyId();

            if ($companyId) {
                $query->where('company_id', $companyId);
            }
        });;

        static::creating(function ($client) {
            $user = Tenant::user();

            if ($user) {
                $client->company_id = $user->company_id;
                $client->user_id = $user->id;
            }
        });
    }
}
