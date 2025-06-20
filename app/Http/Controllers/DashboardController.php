<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Invoice;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingQuotes = Quote::where('status', 'en attente')->count();
        $unpaidInvoices = Invoice::where('status', 'impayée')->count();
        $monthlyRevenue = Invoice::where('status', 'payée')
                                 ->whereMonth('created_at', now()->month)
                                 ->sum('amount');
        $activeClients = Client::count();

        $latestQuotes = Quote::with('client')->latest()->take(5)->get();
        $latestInvoices = Invoice::with('client')->latest()->take(5)->get();

        return view('dashboard', compact(
            'pendingQuotes',
            'unpaidInvoices',
            'monthlyRevenue',
            'activeClients',
            'latestQuotes',
            'latestInvoices'
        ));
    }
}
