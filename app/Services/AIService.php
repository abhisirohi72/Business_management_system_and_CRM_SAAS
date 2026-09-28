<?php
namespace App\Services;

use App\Models\Invoice;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class AIService {
    public static function getQuotationSummary(Quotation $quotation) {
        $itemNames = [];
        foreach($quotation->items as $it) {
            $itemNames[] = $it['item_name'] ?? $it->item_name ?? 'Item';
        }

        $payload = [
            'client_name' => $quotation->client->name ?? 'Unknown Client',
            'total' => $quotation->total ?? 0,
            'items' => $itemNames,
            'due_date' => $quotation->valid_until ?? 'Not set',
            'status' => $quotation->status ?? 'draft'
        ];

        try {
            // Use getenv as a fallback for environments where Laravel's env helper
            // does not expose the variable (for example, after config caching).
            $baseUrl = env('AI_SERVICE_URL') ?: getenv('AI_SERVICE_URL') ?: 'http://localhost:8001';
            $baseUrl = rtrim($baseUrl, '/');

            $response = Http::timeout(60)->post($baseUrl . '/summarize-quotation', $payload);
            return $response->json()['summary'] ?? 'AI summary not available';
        } catch (\Exception $e) {
            \Log::info('AI Service Error: '.$e->getMessage());
            return 'AI Service Error: ' . $e->getMessage();
        }
    }

    public static function generatePaymentReminder(Invoice $invoice_details)
    {
        $itemName=[];
        foreach($invoice_details->items as $details){
            $itemName[] = $details['item_name'];
        }

        $payload= [
            'invoice_number' => $invoice_details->invoice_number,
            'client_name'=> $invoice_details->client->email,
            'invoice_total'=>$invoice_details->total,
            'amount_paid'=> '₹'.number_format($invoice_details->amount_paid, 2),
            'outstanding_amount'=>'₹'.number_format($invoice_details->amount_due, 2),
            'due_date'=>Carbon::parse($invoice_details->due_date)->format('d M Y'),
        ];

        try{
            $base_url = env('AI_SERVICE_URL') ?: getenv('AI_SERVICE_URL') ?: 'http://localhost:8001';
            $base_url = rtrim($base_url, '/');
            $response= Http::timeout(60)->post($base_url.'/payment_remainder', $payload);
            return $response->json()['summary'] ?? "AI Summary Not Avaliable";
        }catch(\Exception $e){
             \Log::info('AI Service Error: '.$e->getMessage());
            return 'AI Service Error: ' . $e->getMessage();
        }
    }
}
