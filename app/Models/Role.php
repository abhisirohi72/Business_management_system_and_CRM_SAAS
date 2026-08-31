<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Role extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'slug',
    ];

    public function scopeWithoutSuperAdmin(Builder $query)
    {
        return $query->where("slug", "!=", "super_admin");
    }

    public function scopeForCompany(Builder $query, int $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }
}
