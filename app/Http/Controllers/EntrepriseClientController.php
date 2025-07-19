<?php

namespace App\Http\Controllers;

use App\Models\EntrepriseClient;
use Illuminate\Http\Request;

class EntrepriseClientController extends Controller
{
    // Afficher la liste de tous les EntrepriseClient
    public function index(Request $request)
    {
        $query = EntrepriseClient::where('agence_id', auth()->user()->agence_id);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%$search%")
                  ->orWhere('domaine', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('adresse', 'like', "%$search%")
                  ->orWhere('telephone', 'like', "%$search%");
            });
        }

        if ($request->filled('domaine')) {
            $query->where('domaine', $request->domaine);
        }

        $entreprises = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());

        return view('entreprise_clients.index', compact('entreprises'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('entreprise_clients.create');
    }

    // Enregistrer une nouvelle entreprise client
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'domaine' => 'required|string|max:255',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            // ajoute les champs nécessaires ici
        ]);

        EntrepriseClient::create([
            'nom' => $request->nom,
            'domaine' => $request->domaine,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'agence_id' => auth()->user()->agence_id,
        ]);


        return redirect()->route('entreprise_clients.index')->with('success', 'Entreprise ajoutée avec succès');
    }

    // Afficher un détail d'entreprise client (optionnel)
    public function show(EntrepriseClient $entrepriseClient)
    {
        return view('entreprise_clients.show', compact('entrepriseClient'));
    }

    // Afficher le formulaire d'édition
    public function edit(EntrepriseClient $entrepriseClient)
    {
        return view('entreprise_clients.edit', compact('entrepriseClient'));
    }

    // Mettre à jour l'entreprise client
    public function update(Request $request, EntrepriseClient $entrepriseClient)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            // ajoute les champs nécessaires ici
        ]);

        $entrepriseClient->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            // Pas de mise à jour de l’agence ici
        ]);

        return redirect()->route('entreprise_clients.index')->with('success', 'Entreprise modifiée avec succès');
    }

    // Supprimer une entreprise client
    public function destroy(EntrepriseClient $entrepriseClient)
    {
        $entrepriseClient->delete();

        return redirect()->route('entreprise_clients.index')->with('success', 'Entreprise supprimée avec succès');
    }
}
