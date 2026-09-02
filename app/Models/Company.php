<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtolower($value) === 'webfintech' ? 'VayuShek' : $value,
        );
    }

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

    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }
}
