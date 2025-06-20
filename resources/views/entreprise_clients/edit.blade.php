<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Modifier l’entreprise : {{ $entrepriseClient->nom }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <form action="{{ route('entreprise_clients.update', $entrepriseClient) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom <span class="text-red-500">*</span></label>
                    <input type="text" name="nom" value="{{ old('nom', $entrepriseClient->nom) }}" required
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200">
                    @error('nom')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" value="{{ old('email', $entrepriseClient->email) }}"
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200">
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone', $entrepriseClient->telephone) }}"
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200">
                    @error('telephone')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse</label>
                    <input type="text" name="adresse" value="{{ old('adresse', $entrepriseClient->adresse) }}"
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200">
                    @error('adresse')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('entreprise_clients.index') }}" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded mr-2">Annuler</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
