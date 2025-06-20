<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                Liste des Clients
            </h2>
            <a href="{{ route('clients.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Créer un nouveau client
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 overflow-x-auto">

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr>
                        <th class="border-b py-2">Nom</th>
                        <th class="border-b py-2">Email</th>
                        <th class="border-b py-2">Téléphone</th>
                        <th class="border-b py-2">Entreprise</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        @if ($client)
                            <tr>
                                <td class="py-2">{{ $client->name ?? '-' }}</td>
                                <td class="py-2">{{ $client->email ?? '-' }}</td>
                                <td class="py-2">{{ $client->phone ?? '-' }}</td>
                                <td class="py-2">{{ $client->company ?? '-' }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="4" class="text-red-600 py-2">Client non défini</td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>

            <div class="mt-4">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
