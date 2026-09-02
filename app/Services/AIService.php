<?php
namespace App\Services;

use App\Models\Quotation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class AIService {
    public static function getQuotationSummary(Quotation $quotation) {
        $payload = [
            'client_name' => $quotation->client->name ?? 'Unknown Client',
            'total' => $quotation->total_amount ?? 0,
            'items' => $quotation->items ?? [],
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
}