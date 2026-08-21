<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LeadController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $leads = Lead::forCompany(Auth::user()->company_id)->latest()->get();

        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        return view('leads.create');
    }

    public function store(StoreLeadRequest $request)
    {
        $data = $request->validated();

        Lead::create([
            'company_id' => Auth::user()->company_id,
            'created_by' => Auth::id(),

            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'company_name' => $data['company_name'] ?? null,
            'source' => $data['source'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);

        return redirect()
            ->route('leads.index')
            ->with('success', 'Lead created successfully.');
    }

    public function edit(Lead $lead)
    {
        $this->authorize('update', $lead);

        return view('leads.edit', compact('lead'));
    }

    public function update(StoreLeadRequest $request, Lead $lead)
    {

        $this->authorize('update', $lead);

        $lead->update(
            $request->validated()
        );


        return redirect()
            ->route('leads.index')
            ->with('success','Lead updated successfully.');

    }

    public function destroy(Lead $lead)
    {
        $this->authorize('delete', $lead);

        $lead->delete();

        return redirect()
            ->route('leads.index')
            ->with('success', 'Lead deleted successfully.');
    }
}
