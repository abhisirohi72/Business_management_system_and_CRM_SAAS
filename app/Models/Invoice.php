<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'client_id',
        'project_id',
        'quotation_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'status',
        'sub_total',
        'discount',
        'tax_rate',
        'tax',
        'total',
        'amount_paid',
        'amount_due',
        'notes',
        'terms',
        'created_by',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'sub_total' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'amount_due' => 'decimal:2',
    ];

    public function scopeForCompany(
        Builder $query,
        int $companyId
    ) {
        return $query->where('company_id', $companyId);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}