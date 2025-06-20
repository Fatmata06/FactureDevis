<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Client;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::with('client')->latest()->paginate(10);
        return view('quotes.index', compact('quotes'));
    }

    public function create()
    {
        $clients = Client::all(); // Pour le select dans le formulaire
        return view('quotes.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|unique:quotes,reference',
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:en attente,validé,refusé',
        ]);

        Quote::create($request->all());

        return redirect()->route('quotes.index')->with('success', 'Devis créé avec succès.');
    }
}
