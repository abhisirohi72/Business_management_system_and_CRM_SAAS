<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Quotation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'client_id',
        'project_id',
        'quotation_number',
        'quotation_date',
        'valid_until',
        'status',
        'subtotal',
        'discount',
        'tax',
        'total',
        'notes',
        'terms',
        'created_by',
    ];

    public function scopeForCompany(Builder $query, int $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }
}