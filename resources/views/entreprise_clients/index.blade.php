<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                Liste des entreprises clientes
            </h2>
            <a href="{{ route('entreprise_clients.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Ajouter une entreprise
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 overflow-x-auto">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full text-sm">
                <thead class="text-left border-b">
                    <tr>
                        <th class="py-2">Nom</th>
                        <th class="py-2">Domaine</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Téléphone</th>
                        <th class="py-2">Adresse</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($entreprises as $entreprise)
                        <tr class="border-b">
                            <td class="py-2">{{ $entreprise->nom }}</td>
                            <td class="py-2">{{ $entreprise->domaine }}</td>
                            <td class="py-2">{{ $entreprise->email ?? '-' }}</td>
                            <td class="py-2">{{ $entreprise->telephone ?? '-' }}</td>
                            <td class="py-2">{{ $entreprise->adresse ?? '-' }}</td>
                            <td class="py-2">
                                <a href="{{ route('entreprise_clients.edit', $entreprise) }}" class="text-blue-600 hover:underline">Modifier</a>
                                <form action="{{ route('entreprise_clients.destroy', $entreprise) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-500">Aucune entreprise enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $entreprises->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
