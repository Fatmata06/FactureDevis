<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                Liste des Devis
            </h2>
            <a href="{{ route('quotes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Créer un nouveau devis
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
                        <th class="border-b py-2">Référence</th>
                        <th class="border-b py-2">Client</th>
                        <th class="border-b py-2">Montant</th>
                        <th class="border-b py-2">Statut</th>
                        <th class="border-b py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quotes as $quote)
                        <tr>
                            <td class="py-2">{{ $quote->reference }}</td>
                            <td class="py-2">{{ $quote->client->name ?? 'Non défini' }}</td>
                            <td class="py-2">{{ number_format($quote->amount, 2) }} FCFA</td>
                            <td class="py-2">{{ ucfirst($quote->status) }}</td>
                            <td class="py-2">{{ $quote->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $quotes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
