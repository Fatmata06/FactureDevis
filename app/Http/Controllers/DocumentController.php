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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:devis,facture',
            'reference' => 'required|string|max:255',
            'date' => 'required|date',
            'entreprise_client_id' => 'required|exists:entreprise_clients,id',
            'client_final_id' => 'required|exists:client_finals,id',
            'montant_total' => 'nullable|numeric',
            'statut' => 'nullable|string',
        ]);

        $document = Document::create($validated);

        return redirect()->route('lignes.create', $document)->with('success', 'Document créé. Ajoutez les lignes.');
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
