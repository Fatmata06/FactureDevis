<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Résumé des stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-5">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Devis en attente</h3>
                    <p class="mt-2 text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $pendingQuotes }}</p>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-5">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Factures impayées</h3>
                    <p class="mt-2 text-3xl font-bold text-red-600 dark:text-red-400">{{ $unpaidInvoices }}</p>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-5">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Chiffre d'affaires (mois)</h3>
                    <p class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">{{ number_format($monthlyRevenue, 2, ',', ' ') }} €</p>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-5">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Clients actifs</h3>
                    <p class="mt-2 text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $activeClients }}</p>
                </div>
            </div>

            <!-- Derniers devis -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Derniers devis</h3>
                <table class="w-full text-left text-gray-700 dark:text-gray-300">
                    <thead>
                        <tr class="border-b border-gray-300 dark:border-gray-600">
                            <th class="py-2"># Référence</th>
                            <th class="py-2">Client</th>
                            <th class="py-2">Montant</th>
                            <th class="py-2">Statut</th>
                            <th class="py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestQuotes as $quote)
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-2">{{ $quote->reference }}</td>
                            <td class="py-2">{{ $quote->client->name }}</td>
                            <td class="py-2">{{ number_format($quote->amount, 2, ',', ' ') }} €</td>
                            <td class="py-2">
                                <span class="px-2 py-1 rounded text-sm
                                    @if($quote->status == 'en attente') bg-yellow-200 text-yellow-800
                                    @elseif($quote->status == 'validé') bg-green-200 text-green-800
                                    @else bg-gray-200 text-gray-600 @endif
                                ">
                                    {{ ucfirst($quote->status) }}
                                </span>
                            </td>
                            <td class="py-2">{{ $quote->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Dernières factures -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Dernières factures</h3>
                <table class="w-full text-left text-gray-700 dark:text-gray-300">
                    <thead>
                        <tr class="border-b border-gray-300 dark:border-gray-600">
                            <th class="py-2"># Référence</th>
                            <th class="py-2">Client</th>
                            <th class="py-2">Montant</th>
                            <th class="py-2">Statut</th>
                            <th class="py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestInvoices as $invoice)
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-2">{{ $invoice->reference }}</td>
                            <td class="py-2">{{ $invoice->client->name }}</td>
                            <td class="py-2">{{ number_format($invoice->amount, 2, ',', ' ') }} €</td>
                            <td class="py-2">
                                <span class="px-2 py-1 rounded text-sm
                                    @if($invoice->status == 'impayée') bg-red-200 text-red-800
                                    @elseif($invoice->status == 'payée') bg-green-200 text-green-800
                                    @else bg-gray-200 text-gray-600 @endif
                                ">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>
                            <td class="py-2">{{ $invoice->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
