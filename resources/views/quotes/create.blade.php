<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Créer un nouveau devis
        </h2>
    </x-slot>

    <div class="py-12 max-w-lg mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <form method="POST" action="{{ route('quotes.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="reference" class="block mb-1">Référence</label>
                    <input type="text" name="reference" id="reference" value="{{ old('reference') }}" required
                           class="w-full border border-gray-300 rounded px-3 py-2 @error('reference') border-red-500 @enderror">
                    @error('reference')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="client_id" class="block mb-1">Client</label>
                    <select name="client_id" id="client_id" required
                            class="w-full border border-gray-300 rounded px-3 py-2 @error('client_id') border-red-500 @enderror">
                        <option value="">-- Choisir un client --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="amount" class="block mb-1">Montant (FCFA)</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}" min="0" step="0.01" required
                           class="w-full border border-gray-300 rounded px-3 py-2 @error('amount') border-red-500 @enderror">
                    @error('amount')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block mb-1">Statut</label>
                    <select name="status" id="status" required
                            class="w-full border border-gray-300 rounded px-3 py-2 @error('status') border-red-500 @enderror">
                        <option value="en attente" {{ old('status') == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="validé" {{ old('status') == 'validé' ? 'selected' : '' }}>Validé</option>
                        <option value="refusé" {{ old('status') == 'refusé' ? 'selected' : '' }}>Refusé</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Créer le devis
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
