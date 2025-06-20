<?php

namespace App\Http\Controllers;

use App\Models\LigneDocument;
use App\Models\Document;
use Illuminate\Http\Request;

class LigneDocumentController extends Controller
{
    // Affiche la liste des lignes pour un document donné
    public function index(Document $document)
    {
        $lignes = $document->lignes()->paginate(10);
        return view('ligne_documents.index', compact('document', 'lignes'));
    }

    // Formulaire de création d'une nouvelle ligne pour un document
    public function create(Document $document)
    {
        return view('ligne_documents.create', compact('document'));
    }

    // Enregistre une nouvelle ligne liée au document
    public function store(Request $request, Document $document)
    {
        $validated = $request->validate([
            'designation' => 'required|string|max:255',
            'quantite' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        $validated['document_id'] = $document->id;
        $validated['total'] = $validated['quantite'] * $validated['prix_unitaire'];

        LigneDocument::create($validated);

        return redirect()->route('documents.show', $document)->with('success', 'Ligne ajoutée avec succès');
    }

    // Formulaire d'édition d'une ligne
    public function edit(Document $document, LigneDocument $ligneDocument)
    {
        // S'assurer que la ligne appartient bien au document
        if ($ligneDocument->document_id != $document->id) {
            abort(404);
        }

        return view('ligne_documents.edit', compact('document', 'ligneDocument'));
    }

    // Mise à jour de la ligne
    public function update(Request $request, Document $document, LigneDocument $ligneDocument)
    {
        if ($ligneDocument->document_id != $document->id) {
            abort(404);
        }

        $validated = $request->validate([
            'designation' => 'required|string|max:255',
            'quantite' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        $validated['total'] = $validated['quantite'] * $validated['prix_unitaire'];

        $ligneDocument->update($validated);

        return redirect()->route('documents.show', $document)->with('success', 'Ligne modifiée avec succès');
    }

    // Suppression d'une ligne
    public function destroy(Document $document, LigneDocument $ligneDocument)
    {
        if ($ligneDocument->document_id != $document->id) {
            abort(404);
        }

        $ligneDocument->delete();

        return redirect()->route('documents.show', $document)->with('success', 'Ligne supprimée avec succès');
    }
}
