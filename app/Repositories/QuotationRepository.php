<?php

namespace App\Repositories;

use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Support\Facades\DB;

class QuotationRepository
{
    public function getQuotations(int $companyId)
    {
        return Quotation::forCompany($companyId)
            ->with(['client', 'project', 'createdBy', 'items'])
            ->latest()
            ->paginate(10);
    }

    public function createQuotation(
        array $data,
        int $companyId,
        int $createdBy
    ) {
        return DB::transaction(function () use ($data, $companyId, $createdBy) {

            $subtotal = 0;

            foreach ($data['items'] as $item) {

                $amount = $item['quantity'] * $item['unit_price'];

                $subtotal += $amount;
            }

            $discount = $data['discount'] ?? 0;

            $taxPercentage = $data['tax'] ?? 0;

            $taxableAmount = $subtotal - $discount;

            $taxAmount = ($taxableAmount * $taxPercentage) / 100;

            $total = $taxableAmount + $taxAmount;

            $quotation = Quotation::create([
                'company_id' => $companyId,
                'client_id' => $data['client_id'],
                'project_id' => $data['project_id'] ?? null,

                'quotation_number' => $this->generateQuotationNumber($companyId),

                'quotation_date' => $data['quotation_date'],
                'valid_until' => $data['valid_until'],
                'status' => $data['status'],

                'sub_total' => $subtotal,
                'discount' => $discount,
                'tax' => $taxAmount,
                'total' => $total,

                'notes' => $data['notes'] ?? null,
                'terms' => $data['terms'] ?? null,

                'created_by' => $createdBy,
            ]);

            foreach ($data['items'] as $item) {

                $amount = $item['quantity'] * $item['unit_price'];

                QuotationItem::create([
                    'quotation_id' => $quotation->id,

                    'item_name' => $item['item_name'],

                    'item_description' =>
                        $item['item_description'] ?? null,

                    'quantity' => $item['quantity'],

                    'unit_price' => $item['unit_price'],

                    'amount' => $amount,
                ]);
            }

            return $quotation;
        });
    }

    private function generateQuotationNumber(int $companyId): string
    {
        $count = Quotation::where('company_id', $companyId)->count() + 1;

        return 'QT-' . str_pad(
            $count,
            4,
            '0',
            STR_PAD_LEFT
        );
    }

    public function updateQuotation(
        Quotation $quotation,
        array $data
    ) {
        return DB::transaction(function () use ($quotation, $data) {

            $subtotal = 0;

            foreach ($data['items'] as $item) {

                $amount = $item['quantity'] * $item['unit_price'];

                $subtotal += $amount;
            }

            $discount = $data['discount'] ?? 0;

            $taxPercentage = $data['tax'] ?? 0;

            $taxableAmount = $subtotal - $discount;

            $taxAmount = ($taxableAmount * $taxPercentage) / 100;

            $total = $taxableAmount + $taxAmount;

            $quotation->update([
                'client_id' => $data['client_id'],
                'project_id' => $data['project_id'] ?? null,

                'quotation_date' => $data['quotation_date'],
                'valid_until' => $data['valid_until'],
                'status' => $data['status'],

                'sub_total' => $subtotal,
                'discount' => $discount,
                'tax' => $taxAmount,
                'total' => $total,

                'notes' => $data['notes'] ?? null,
                'terms' => $data['terms'] ?? null,
            ]);

            // Remove old items
            $quotation->items()->delete();

            // Create updated items
            foreach ($data['items'] as $item) {

                $amount = $item['quantity'] * $item['unit_price'];

                $quotation->items()->create([
                    'item_name' => $item['item_name'],

                    'item_description' =>
                        $item['item_description'] ?? null,

                    'quantity' => $item['quantity'],

                    'unit_price' => $item['unit_price'],

                    'tax' => $item['tax'] ?? 0,

                    'amount' => $amount,
                ]);
            }

            return $quotation;
        });
    }
}