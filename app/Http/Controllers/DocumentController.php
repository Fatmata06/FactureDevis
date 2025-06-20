<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\EntrepriseClient;
use App\Models\ClientFinal;
use App\Models\LigneDocument;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type'); // filtre facultatif
        $documents = Document::with(['entreprise', 'client'])
            ->when($type, fn($query) => $query->where('type', $type))
            ->latest()->paginate(10);

        return view('documents.index', compact('documents', 'type'));
    }

    public function create()
    {
        $entreprises = EntrepriseClient::all();
        $clients = ClientFinal::all();
        return view('documents.create', compact('entreprises', 'clients'));
    }

   public function store(Request $request, Document $document)
{
    $request->validate([
        'designation' => 'required|string',
        'quantite' => 'required|integer|min:1',
        'prix_unitaire' => 'required|numeric|min:0',
    ]);

    $total = $request->quantite * $request->prix_unitaire;

    $document->lignes()->create([
        'designation' => $request->designation,
        'quantite' => $request->quantite,
        'prix_unitaire' => $request->prix_unitaire,
        'total' => $total,
    ]);

    // Mettre à jour le montant total du document
    $document->montant_total = $document->lignes()->sum('total');
    $document->save();

    return redirect()->route('documents.show', $document)->with('success', 'Ligne ajoutée avec succès.');
}

    public function show(Document $document)
    {
        $document->load('lignes');
        return view('documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        $entreprises = EntrepriseClient::all();
        $clients = ClientFinal::all();
        return view('documents.edit', compact('document', 'entreprises', 'clients'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'reference' => 'required|string|unique:documents,reference,' . $document->id,
            'date' => 'required|date',
            'statut' => 'required|string',
        ]);

        $document->update($validated);
        return redirect()->route('documents.index')->with('success', 'Document mis à jour.');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return back()->with('success', 'Document supprimé.');
    }

    public function pdf(Document $document)
    {
        $document->load('lignes', 'entreprise', 'client');
        $pdf = Pdf::loadView('documents.pdf', compact('document'));
        return $pdf->download("{$document->type}-{$document->reference}.pdf");
    }
}
