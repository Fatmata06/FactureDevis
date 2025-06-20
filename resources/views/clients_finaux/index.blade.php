<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liste des Clients Finaux
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <a href="{{ route('clients_finaux.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter un Client Final</a>

            @if(session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Nom</th>
                        <th class="border p-2">Prénom</th>
                        <th class="border p-2">Entreprise Cliente</th>
                        <th class="border p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td class="border p-2">{{ $client->id }}</td>
                            <td class="border p-2">{{ $client->nom }}</td>
                            <td class="border p-2">{{ $client->prenom }}</td>
                            <td class="border p-2">{{ $client->entrepriseClient->nom ?? '—' }}</td>
                            <td class="border p-2">
                                <a href="{{ route('clients_finaux.edit', $client) }}" class="text-blue-600 hover:underline mr-2">Modifier</a>

                                <form action="{{ route('clients_finaux.destroy', $client) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce client ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center p-4">Aucun client trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
