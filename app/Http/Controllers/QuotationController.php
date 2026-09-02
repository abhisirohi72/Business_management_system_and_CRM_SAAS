<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotationRequest;
use App\Http\Requests\UpdateQuotationRequest;
use App\Models\Quotation;
use App\Models\Client;
use App\Models\Project;
use App\Repositories\QuotationRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuotationController extends Controller
{
    use AuthorizesRequests;
    protected QuotationRepository $quotationRepository;

    public function __construct(QuotationRepository $quotationRepository)
    {
        $this->quotationRepository = $quotationRepository;
    }

    /**
     * Display a listing of the quotations.
     */
    public function index()
    {
        $this->authorize('viewAny', Quotation::class);

        $quotations = $this->quotationRepository
            ->getQuotations(Auth::user()->company_id);

        return view('quotations.index', [
            'quotations' => $quotations,
        ]);
    }

    /**
     * Show the form for creating a new quotation.
     */
    public function create()
    {
        $this->authorize('create', Quotation::class);

        $clients = Client::forCompany(Auth::user()->company_id)
            ->latest()
            ->get();

        $projects = Project::forCompany(Auth::user()->company_id)
            ->latest()
            ->get();

        return view('quotations.create', [
            'clients' => $clients,
            'projects' => $projects,
        ]);
    }

    /**
     * Store a newly created quotation.
     */
    public function store(StoreQuotationRequest $request)
    {
        $this->authorize('create', Quotation::class);

        $data = $request->validated();

        $quotation = $this->quotationRepository->createQuotation(
            $data,
            Auth::user()->company_id,
            Auth::id()
        );

        return redirect()
            ->route('quotations.index')
            ->with('success', 'Quotation created successfully.');
    }

    /**
     * Display the specified quotation.
     */
    public function show(Quotation $quotation)
    {
        $this->authorize('view', $quotation);

        $quotation->load([
            'client',
            'project',
            'createdBy',
            'items',
        ]);

        return view('quotations.show', [
            'quotation' => $quotation,
        ]);
    }

    /**
     * Show the form for editing the specified quotation.
     */
    public function edit(Quotation $quotation)
    {
        $this->authorize('update', $quotation);

        $clients = Client::forCompany(Auth::user()->company_id)
            ->latest()
            ->get();

        $projects = Project::forCompany(Auth::user()->company_id)
            ->latest()
            ->get();

        $quotation->load('items');

        return view('quotations.edit', [
            'quotation' => $quotation,
            'clients' => $clients,
            'projects' => $projects,
        ]);
    }

    /**
     * Update the specified quotation.
     */
    public function update(
        UpdateQuotationRequest $request,
        Quotation $quotation
    ) {
        $this->authorize('update', $quotation);

        $data = $request->validated();

        $this->quotationRepository->updateQuotation(
            $quotation,
            $data
        );

        return redirect()
            ->route('quotations.index')
            ->with('success', 'Quotation updated successfully.');
    }

    /**
     * Remove the specified quotation.
     */
    public function destroy(Quotation $quotation)
    {
        $this->authorize('delete', $quotation);

        $quotation->delete();

        return redirect()
            ->route('quotations.index')
            ->with('success', 'Quotation deleted successfully.');
    }

    public function aiSummary(int $id) {
        $quotation = Quotation::with('client')->findOrFail($id);
        $summary = \App\Services\AIService::getQuotationSummary($quotation);
        return response()->json(['summary' => $summary]);
    }
}