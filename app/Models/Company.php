<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'logo',
        'website',
        'address',
        'status',
    ];

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }

    public function roles() : HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function leads() : HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
