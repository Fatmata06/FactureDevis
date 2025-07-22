<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-tachometer-alt text-white text-lg"></i>
                </div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    Tableau de bord
                </h2>
            </div>
           
        </div>
    </x-slot>

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .stat-card { background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%); }
        .stat-card-dark { background: linear-gradient(135deg, #1e293b 0%, #312e81 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); }
        .table-row { transition: all 0.2s ease; }
        .table-row:hover { background: linear-gradient(90deg, rgba(102,126,234,0.05) 0%, rgba(118,75,162,0.05) 100%); }
    </style>

    <div class="py-8 bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <!-- Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-file-invoice-dollar text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $pendingQuotes }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Devis en attente</div>
                    </div>
                </div>
                <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-red-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-file-invoice text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $unpaidInvoices }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Factures impayées</div>
                    </div>
                </div>
                <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-coins text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ number_format($monthlyRevenue, 0, ',', ' ') }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Chiffre d'affaires (mois)</div>
                    </div>
                </div>
                <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $activeClients }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Clients actifs</div>
                    </div>
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
