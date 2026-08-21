<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Company;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'client_id',
        'name',
        'description',
        'status',
        'priority',
        'start_date',
        'due_date',
        'budget',
        'created_by'
    ];

    public function scopeForCompany(Builder $query, int $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function client() : BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
