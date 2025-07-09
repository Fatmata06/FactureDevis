<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Nouveau Document (Devis ou Facture)
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <form action="{{ route('documents.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Type --}}
                <div>
                    <label for="type" class="block font-medium">Type <span class="text-red-500">*</span></label>
                    <select name="type" id="type" required class="w-full border rounded p-2">
                        <option value="">-- Choisir --</option>
                        <option value="devis" {{ old('type') == 'devis' ? 'selected' : '' }}>Devis</option>
                        <option value="facture" {{ old('type') == 'facture' ? 'selected' : '' }}>Facture</option>
                    </select>
                    @error('type')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Référence --}}
                <div>
                    <label for="reference" class="block font-medium">Référence <span class="text-red-500">*</span></label>
                    <input type="text" name="reference" value="{{ old('reference') }}" required class="w-full border rounded p-2">
                    @error('reference')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Date --}}
                <div>
                    <label for="date" class="block font-medium">Date <span class="text-red-500">*</span></label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required class="w-full border rounded p-2">
                    @error('date')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Entreprise Client --}}
                <div>
                    <label for="entreprise_client_id" class="block font-medium">Entreprise Cliente <span class="text-red-500">*</span></label>
                    <select name="entreprise_client_id" required class="w-full border rounded p-2">
                        <option value="">-- Sélectionner --</option>
                        @foreach($entreprises as $entreprise)
                            <option value="{{ $entreprise->id }}" {{ old('entreprise_client_id') == $entreprise->id ? 'selected' : '' }}>
                                {{ $entreprise->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('entreprise_client_id')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Client Final --}}
                <div>
                    <label for="client_final_id" class="block font-medium">Client Final <span class="text-red-500">*</span></label>
                    <select name="client_final_id" required class="w-full border rounded p-2">
                        <option value="">-- Sélectionner --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_final_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->nom }} {{ $client->prenom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_final_id')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Montant total (automatique plus tard) --}}
                <div>
                    <label for="montant_total" class="block font-medium">Montant total</label>
                    <input type="number" step="0.01" name="montant_total" value="{{ old('montant_total') }}" class="w-full border rounded p-2">
                    @error('montant_total')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
    <label for="main_oeuvre">Main d'œuvre (FCFA)</label>
    <input type="number" step="0.01" name="main_oeuvre" class="form-control" value="{{ old('main_oeuvre', $document->main_oeuvre ?? 0) }}">
</div>


                {{-- Statut --}}
                <div>
                    <label for="statut" class="block font-medium">Statut</label>
                    <select name="statut" class="w-full border rounded p-2">
                        <option value="">-- Choisir --</option>
                        <option value="brouillon" {{ old('statut') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                        <option value="envoyé" {{ old('statut') == 'envoyé' ? 'selected' : '' }}>Envoyé</option>
                        <option value="payé" {{ old('statut') == 'payé' ? 'selected' : '' }}>Payé</option>
                    </select>
                    @error('statut')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Boutons --}}
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('documents.index') }}" class="px-4 py-2 bg-gray-300 rounded">Annuler</a>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
