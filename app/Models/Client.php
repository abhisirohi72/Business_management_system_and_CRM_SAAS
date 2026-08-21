<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Company;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'created_by',
        'name',
        'email',
        'phone',
        'company_name',
        'address',
        'status',
        'notes',
    ];

    public function scopeForCompany(Builder $query, int $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
