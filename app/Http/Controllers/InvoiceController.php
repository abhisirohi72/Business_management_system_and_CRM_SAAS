<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use App\Repositories\InvoiceRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Quotation;

class InvoiceController extends Controller
{
    use AuthorizesRequests;

    protected InvoiceRepository $invoiceRepository;

    public function __construct(
        InvoiceRepository $invoiceRepository
    ) {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', Invoice::class);

        $invoices = $this->invoiceRepository
            ->getInvoices(Auth::user()->company_id);

        return view('invoices.index', [
            'invoices' => $invoices,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Invoice::class);

        $clients = Client::forCompany(
            Auth::user()->company_id
        )
            ->latest()
            ->get();

        $projects = Project::forCompany(
            Auth::user()->company_id
        )
            ->latest()
            ->get();

        $quotations = Quotation::forCompany(
            Auth::user()->company_id
        )
            ->where('status', 'accepted')
            ->with('client')
            ->latest()
            ->get();
            
        return view('invoices.create', [
            'clients' => $clients,
            'projects' => $projects,
            'quotations' => $quotations,
        ]);
    }

    public function store(StoreInvoiceRequest $request)
    {
        $this->authorize('create', Invoice::class);

        $data = $request->validated();

        $this->invoiceRepository->createInvoice(
            $data,
            Auth::user()->company_id,
            Auth::id()
        );

        return redirect()
            ->route('invoices.index')
            ->with(
                'success',
                'Invoice created successfully.'
            );
    }

    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        $invoice->load([
            'client',
            'project',
            'quotation',
            'createdBy',
            'items',
        ]);

        return view('invoices.show', [
            'invoice' => $invoice,
        ]);
    }

    public function edit(Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $clients = Client::forCompany(
            Auth::user()->company_id
        )
            ->latest()
            ->get();

        $projects = Project::forCompany(
            Auth::user()->company_id
        )
            ->latest()
            ->get();

        $invoice->load('items');

        return view('invoices.edit', [
            'invoice' => $invoice,
            'clients' => $clients,
            'projects' => $projects,
        ]);
    }

    public function update(
        UpdateInvoiceRequest $request,
        Invoice $invoice
    ) {
        $this->authorize('update', $invoice);

        $data = $request->validated();

        $this->invoiceRepository->updateInvoice(
            $invoice,
            $data
        );

        return redirect()
            ->route('invoices.index')
            ->with(
                'success',
                'Invoice updated successfully.'
            );
    }

    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);

        $invoice->delete();

        return redirect()
            ->route('invoices.index')
            ->with(
                'success',
                'Invoice deleted successfully.'
            );
    }

    public function quotationData(Quotation $quotation)
    {
        $this->authorize('view', $quotation);

        if ($quotation->status !== 'accepted') {
            abort(422, 'Only accepted quotations can be used for invoices.');
        }

        $quotation->load([
            'client',
            'project',
            'items',
        ]);

        return response()->json([
            'id' => $quotation->id,
            'client_id' => $quotation->client_id,
            'project_id' => $quotation->project_id,
            'discount' => $quotation->discount,
            'tax_rate' => $quotation->tax_rate,
            'notes' => $quotation->notes,
            'terms' => $quotation->terms,

            'items' => $quotation->items->map(function ($item) {
                return [
                    'item_name' => $item->item_name,
                    'item_description' => $item->item_description,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                ];
            }),
        ]);
    }
}