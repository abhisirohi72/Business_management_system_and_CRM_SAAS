<?php

namespace App\Repositories;

use App\Models\Quotation;
use Illuminate\Support\Facades\DB;

class QuotationRepository
{
    public function getQuotations(int $companyId)
    {
        return Quotation::forCompany($companyId)
            ->with([
                'client',
                'project',
                'createdBy',
                'items',
            ])
            ->latest()
            ->paginate(10);
    }


    public function createQuotation(
        array $data,
        int $companyId,
        int $createdBy
    ) {
        return DB::transaction(function () use (
            $data,
            $companyId,
            $createdBy
        ) {

            /*
            |--------------------------------------------------------------------------
            | Calculate Subtotal
            |--------------------------------------------------------------------------
            */

            $subtotal = 0;

            foreach ($data['items'] as $item) {

                $amount =
                    $item['quantity'] *
                    $item['unit_price'];

                $subtotal += $amount;
            }


            /*
            |--------------------------------------------------------------------------
            | Discount
            |--------------------------------------------------------------------------
            */

            $discount = $data['discount'] ?? 0;

            /*
            |--------------------------------------------------------------------------
            | Tax Rate
            |--------------------------------------------------------------------------
            */

            $taxRate = $data['tax'] ?? 0;


            /*
            |--------------------------------------------------------------------------
            | Taxable Amount
            |--------------------------------------------------------------------------
            */

            $taxableAmount = max(
                $subtotal - $discount,
                0
            );


            /*
            |--------------------------------------------------------------------------
            | Tax Amount
            |--------------------------------------------------------------------------
            */

            $taxAmount =
                ($taxableAmount * $taxRate) / 100;


            /*
            |--------------------------------------------------------------------------
            | Total
            |--------------------------------------------------------------------------
            */

            $total =
                $taxableAmount + $taxAmount;


            /*
            |--------------------------------------------------------------------------
            | Create Quotation
            |--------------------------------------------------------------------------
            */

            $quotation = Quotation::create([

                'company_id' => $companyId,

                'client_id' => $data['client_id'],

                'project_id' =>
                    $data['project_id'] ?? null,

                'quotation_number' =>
                    $this->generateQuotationNumber(
                        $companyId
                    ),

                'quotation_date' =>
                    $data['quotation_date'],

                'valid_until' =>
                    $data['valid_until'],

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

                'notes' =>
                    $data['notes'] ?? null,

                'terms' =>
                    $data['terms'] ?? null,

                'created_by' =>
                    $createdBy,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Create Quotation Items
            |--------------------------------------------------------------------------
            */

            foreach ($data['items'] as $item) {

                $amount =
                    $item['quantity'] *
                    $item['unit_price'];


                $quotation->items()->create([

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


            return $quotation;
        });
    }


    public function updateQuotation(
        Quotation $quotation,
        array $data
    ) {
        return DB::transaction(function () use (
            $quotation,
            $data
        ) {

            /*
            |--------------------------------------------------------------------------
            | Calculate Subtotal
            |--------------------------------------------------------------------------
            */

            $subtotal = 0;

            foreach ($data['items'] as $item) {

                $amount =
                    $item['quantity'] *
                    $item['unit_price'];

                $subtotal += $amount;
            }


            /*
            |--------------------------------------------------------------------------
            | Discount
            |--------------------------------------------------------------------------
            */

            $discount =
                $data['discount'] ?? 0;


            /*
            |--------------------------------------------------------------------------
            | Tax Rate
            |--------------------------------------------------------------------------
            */

            $taxRate =
                $data['tax'] ?? 0;


            /*
            |--------------------------------------------------------------------------
            | Taxable Amount
            |--------------------------------------------------------------------------
            */

            $taxableAmount = max(
                $subtotal - $discount,
                0
            );


            /*
            |--------------------------------------------------------------------------
            | Tax Amount
            |--------------------------------------------------------------------------
            */

            $taxAmount =
                ($taxableAmount * $taxRate) / 100;


            /*
            |--------------------------------------------------------------------------
            | Total
            |--------------------------------------------------------------------------
            */

            $total =
                $taxableAmount + $taxAmount;


            /*
            |--------------------------------------------------------------------------
            | Update Quotation
            |--------------------------------------------------------------------------
            */

            $quotation->update([

                'client_id' =>
                    $data['client_id'],

                'project_id' =>
                    $data['project_id'] ?? null,

                'quotation_date' =>
                    $data['quotation_date'],

                'valid_until' =>
                    $data['valid_until'],

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

                'notes' =>
                    $data['notes'] ?? null,

                'terms' =>
                    $data['terms'] ?? null,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Replace Items
            |--------------------------------------------------------------------------
            */

            $quotation->items()->delete();


            foreach ($data['items'] as $item) {

                $amount =
                    $item['quantity'] *
                    $item['unit_price'];


                $quotation->items()->create([

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


            return $quotation;
        });
    }


    private function generateQuotationNumber(
        int $companyId
    ): string {

        $count =
            Quotation::where(
                'company_id',
                $companyId
            )->count() + 1;


        return 'QT-' .
            str_pad(
                $count,
                4,
                '0',
                STR_PAD_LEFT
            );
    }
}