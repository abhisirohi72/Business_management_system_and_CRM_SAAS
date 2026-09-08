<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Client;
use App\Models\Project;
use App\Models\Quotation;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Invoice::class);
    }

    public function rules(): array
    {
        $companyId = $this->user()->company_id;

        return [
            'client_id' => [
                'required',
                Rule::exists('clients', 'id')
                    ->where('company_id', $companyId),
            ],

            'project_id' => [
                'nullable',
                Rule::exists('projects', 'id')
                    ->where('company_id', $companyId),
            ],

            'quotation_id' => [
                'nullable',
                Rule::exists('quotations', 'id')
                    ->where('company_id', $companyId)
                    ->where('status', 'accepted'),
            ],

            'invoice_date' => [
                'required',
                'date',
            ],

            'due_date' => [
                'required',
                'date',
                'after_or_equal:invoice_date',
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'sent',
                    'partially_paid',
                    'paid',
                    'overdue',
                    'cancelled',
                ]),
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'tax_rate' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'terms' => [
                'nullable',
                'string',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.item_name' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.item_description' => [
                'nullable',
                'string',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }
}