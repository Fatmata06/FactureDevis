<?php

namespace App\Http\Controllers;

use App\Models\ClientFinal;
use App\Models\EntrepriseClient;
use Illuminate\Http\Request;

class ClientFinalController extends Controller
{
    // Affiche la liste paginée des clients finaux
    public function index()
    {
        $clients = ClientFinal::with('entrepriseClient')->paginate(10);
        return view('clients_finaux.index', compact('clients'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        $entreprises = EntrepriseClient::all();
        return view('clients_finaux.create', compact('entreprises'));
    }

    // Enregistre un nouveau client final
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'entreprise_client_id' => 'required|exists:entreprise_clients,id',
        ]);

        ClientFinal::create($request->all());

        return redirect()->route('clients_finaux.index')->with('success', 'Client final ajouté avec succès.');
    }

    // Affiche le formulaire d'édition
    public function edit(ClientFinal $clientFinal)
    {
        $entreprises = EntrepriseClient::all();
        return view('clients_finaux.edit', compact('clientFinal', 'entreprises'));
    }

    // Met à jour un client final
    public function update(Request $request, ClientFinal $clientFinal)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'entreprise_client_id' => 'required|exists:entreprise_clients,id',
        ]);

        $clientFinal->update($request->all());

        return redirect()->route('clients_finaux.index')->with('success', 'Client final modifié avec succès.');
    }

    // Supprime un client final
    public function destroy(ClientFinal $clientFinal)
    {
        $clientFinal->delete();

        return redirect()->route('clients_finaux.index')->with('success', 'Client final supprimé avec succès.');
    }
}
