<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->company_id !== null;
    }

    public function view(User $user, Invoice $invoice): bool
    {
        if ($user->role?->slug === 'super_admin') {
            return true;
        }

        return $user->company_id === $invoice->company_id;
    }

    public function create(User $user): bool
    {
        return $user->company_id !== null;
    }

    public function update(User $user, Invoice $invoice): bool
    {
        if ($user->role?->slug === 'super_admin') {
            return true;
        }

        return $user->company_id === $invoice->company_id;
    }

    public function delete(User $user, Invoice $invoice): bool
    {
        if ($user->role?->slug === 'super_admin') {
            return true;
        }

        return $user->company_id === $invoice->company_id;
    }

    public function restore(User $user, Invoice $invoice): bool
    {
        if ($user->role?->slug === 'super_admin') {
            return true;
        }

        return $user->company_id === $invoice->company_id;
    }

    public function forceDelete(User $user, Invoice $invoice): bool
    {
        if ($user->role?->slug === 'super_admin') {
            return true;
        }

        return $user->company_id === $invoice->company_id;
    }
}