<?php

namespace App\Repositories;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceRepository
{
    public function getInvoices(int $companyId)
    {
        return Invoice::forCompany($companyId)
            ->with([
                'client',
                'project',
                'quotation',
                'createdBy',
                'items',
            ])
            ->latest()
            ->paginate(10);
    }

    public function createInvoice(
        array $data,
        int $companyId,
        int $createdBy
    ) {
        return DB::transaction(function () use (
            $data,
            $companyId,
            $createdBy
        ) {
            $subtotal = 0;

            foreach ($data['items'] as $item) {
                $amount = $item['quantity'] * $item['unit_price'];

                $subtotal += $amount;
            }

            $discount = $data['discount'] ?? 0;

            $taxRate = $data['tax_rate'] ?? 0;

            $taxableAmount = max(
                $subtotal - $discount,
                0
            );

            $taxAmount = (
                $taxableAmount * $taxRate
            ) / 100;

            $total = $taxableAmount + $taxAmount;

            $amountPaid = 0;

            $amountDue = $total - $amountPaid;

            $invoice = Invoice::create([
                'company_id' => $companyId,

                'client_id' => $data['client_id'],

                'project_id' => $data['project_id'] ?? null,

                'quotation_id' => $data['quotation_id'] ?? null,

                'invoice_number' => $this->generateInvoiceNumber(
                    $companyId
                ),

                'invoice_date' => $data['invoice_date'],

                'due_date' => $data['due_date'],

                'status' => $data['status'],

                'sub_total' => $subtotal,

                'discount' => $discount,

                'tax_rate' => $taxRate,

                'tax' => $taxAmount,

                'total' => $total,

                'amount_paid' => $amountPaid,

                'amount_due' => $amountDue,

                'notes' => $data['notes'] ?? null,

                'terms' => $data['terms'] ?? null,

                'created_by' => $createdBy,
            ]);

            foreach ($data['items'] as $item) {

                $amount =
                    $item['quantity'] *
                    $item['unit_price'];

                $invoice->items()->create([
                    'item_name' =>
                        $item['item_name'],

                    'item_description' =>
                        $item['item_description'] ?? null,

                    'quantity' =>
                        $item['quantity'],

                    'unit_price' =>
                        $item['unit_price'],

                    'amount' =>
                        $amount,
                ]);
            }

            return $invoice;
        });
    }

    public function updateInvoice(
        Invoice $invoice,
        array $data
    ) {
        return DB::transaction(function () use (
            $invoice,
            $data
        ) {

            $subtotal = 0;

            foreach ($data['items'] as $item) {

                $amount =
                    $item['quantity'] *
                    $item['unit_price'];

                $subtotal += $amount;
            }

            $discount = $data['discount'] ?? 0;

            $taxRate = $data['tax_rate'] ?? 0;

            $taxableAmount = max(
                $subtotal - $discount,
                0
            );

            $taxAmount = (
                $taxableAmount * $taxRate
            ) / 100;

            $total =
                $taxableAmount +
                $taxAmount;

            /*
             * Existing payments should not be lost
             * when invoice is edited.
             */
            $amountPaid = $invoice->amount_paid;

            $amountDue = max(
                $total - $amountPaid,
                0
            );

            $invoice->update([
                'client_id' =>
                    $data['client_id'],

                'project_id' =>
                    $data['project_id'] ?? null,

                'quotation_id' =>
                    $data['quotation_id'] ?? null,

                'invoice_date' =>
                    $data['invoice_date'],

                'due_date' =>
                    $data['due_date'],

                'status' =>
                    $data['status'],

                'sub_total' =>
                    $subtotal,

                'discount' =>
                    $discount,

                'tax_rate' =>
                    $taxRate,

                'tax' =>
                    $taxAmount,

                'total' =>
                    $total,

                'amount_due' =>
                    $amountDue,

                'notes' =>
                    $data['notes'] ?? null,

                'terms' =>
                    $data['terms'] ?? null,
            ]);

            /*
             * Replace existing items.
             */
            $invoice->items()->delete();

            foreach ($data['items'] as $item) {

                $amount =
                    $item['quantity'] *
                    $item['unit_price'];

                $invoice->items()->create([
                    'item_name' =>
                        $item['item_name'],

                    'item_description' =>
                        $item['item_description'] ?? null,

                    'quantity' =>
                        $item['quantity'],

                    'unit_price' =>
                        $item['unit_price'],

                    'amount' =>
                        $amount,
                ]);
            }

            return $invoice;
        });
    }

    private function generateInvoiceNumber(
        int $companyId
    ): string {
        $count = Invoice::where(
            'company_id',
            $companyId
        )->count() + 1;

        return 'INV-' .
            str_pad(
                $count,
                4,
                '0',
                STR_PAD_LEFT
            );
    }
}