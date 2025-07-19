<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-white leading-tight flex items-center gap-2">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-50 via-white to-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <!-- Résumé des stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-700 rounded-xl shadow p-5 flex flex-col items-center">
                    <div class="bg-indigo-100 p-2 rounded-full mb-2">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 018 0v2M5 10a4 4 0 118 0 4 4 0 01-8 0z"/></svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-700 dark:text-gray-200">Devis en attente</h3>
                    <p class="mt-1 text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $pendingQuotes }}</p>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-xl shadow p-5 flex flex-col items-center">
                    <div class="bg-red-100 p-2 rounded-full mb-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-1.414 1.414M6.343 17.657l-1.414-1.414M5.636 5.636l1.414 1.414M17.657 17.657l1.414-1.414M12 8v4m0 4h.01"/></svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-700 dark:text-gray-200">Factures impayées</h3>
                    <p class="mt-1 text-2xl font-bold text-red-600 dark:text-red-400">{{ $unpaidInvoices }}</p>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-6 flex flex-col items-center hover:scale-105 transition-transform">
                    <div class="bg-green-100 p-3 rounded-full mb-3">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 0V4m0 16v-4"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Chiffre d'affaires (mois)</h3>
                    <p class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">{{ number_format($monthlyRevenue, 0, ',', ' ') }} </p>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-6 flex flex-col items-center hover:scale-105 transition-transform">
                    <div class="bg-blue-100 p-3 rounded-full mb-3">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Clients actifs</h3>
                    <p class="mt-2 text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $activeClients }}</p>
                </div>
            </div>

            <!-- Derniers devis -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8">
                <h3 class="text-xl font-semibold mb-6 text-gray-800 dark:text-gray-200 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 018 0v2M5 10a4 4 0 118 0 4 4 0 01-8 0z"/></svg>
                    Derniers devis
                </h3>
                <div class="overflow-x-auto">
                <table class="w-full text-left text-gray-700 dark:text-gray-300 rounded-lg overflow-hidden">
                    <thead>
                        <tr class="border-b border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700">
                            <th class="py-3 px-4"># Référence</th>
                            <th class="py-3 px-4">Client</th>
                            <th class="py-3 px-4">Montant</th>
                            <th class="py-3 px-4">Statut</th>
                            <th class="py-3 px-4">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestQuotes as $quote)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-900 transition-colors">
                            <td class="py-2 px-4 font-semibold">{{ $quote->reference }}</td>
                            <td class="py-2 px-4">{{ $quote->client->name }}</td>
                            <td class="py-2 px-4">{{ number_format($quote->amount, 2, ',', ' ') }} €</td>
                            <td class="py-2 px-4">
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($quote->status == 'en attente') bg-yellow-200 text-yellow-800
                                    @elseif($quote->status == 'validé') bg-green-200 text-green-800
                                    @else bg-gray-200 text-gray-600 @endif
                                ">
                                    {{ ucfirst($quote->status) }}
                                </span>
                            </td>
                            <td class="py-2 px-4">{{ $quote->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>

            <!-- Dernières factures -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8">
                <h3 class="text-xl font-semibold mb-6 text-gray-800 dark:text-gray-200 flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 0V4m0 16v-4"/></svg>
                    Dernières factures
                </h3>
                <div class="overflow-x-auto">
                <table class="w-full text-left text-gray-700 dark:text-gray-300 rounded-lg overflow-hidden">
                    <thead>
                        <tr class="border-b border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700">
                            <th class="py-3 px-4"># Référence</th>
                            <th class="py-3 px-4">Client</th>
                            <th class="py-3 px-4">Montant</th>
                            <th class="py-3 px-4">Statut</th>
                            <th class="py-3 px-4">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestInvoices as $invoice)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-green-50 dark:hover:bg-gray-900 transition-colors">
                            <td class="py-2 px-4 font-semibold">{{ $invoice->reference }}</td>
                            <td class="py-2 px-4">{{ $invoice->client->name }}</td>
                            <td class="py-2 px-4">{{ number_format($invoice->amount, 2, ',', ' ') }} €</td>
                            <td class="py-2 px-4">
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($invoice->status == 'impayée') bg-red-200 text-red-800
                                    @elseif($invoice->status == 'payée') bg-green-200 text-green-800
                                    @else bg-gray-200 text-gray-600 @endif
                                ">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>
                            <td class="py-2 px-4">{{ $invoice->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
