<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue - Facture & Devis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-gray-800 flex flex-col min-h-screen">

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center px-4">
        <div class="max-w-6xl w-full flex flex-col-reverse md:flex-row items-center justify-between gap-10">
            <!-- Left Section -->
            <div class="md:w-1/2 text-center md:text-left">
                <h1 class="text-4xl font-bold text-indigo-700 mb-4">Bienvenue sur <span class="text-gray-900">Facture & Devis</span></h1>
                <p class="text-gray-600 mb-6 text-lg">
                    Créez, gérez et téléchargez facilement vos devis et factures avec notre solution 100% Laravel.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    @guest
                        <a href="{{ route('login') }}" class="bg-gray-100 border border-gray-300 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-200">
                            Se connecter
                        </a>
                    @endguest   
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600">
                                Se déconnecter
                            </button>
                        </form>
                    @endauth


                </div>
            </div>

            <!-- Right Section -->
            <div class="md:w-1/2">
                <img src="https://cdn-icons-png.flaticon.com/512/3192/3192797.png" alt="Illustration" class="w-full max-w-sm mx-auto">
            </div>
        </div>
    </main>

    <!-- Footer collé en bas -->
    <footer class="bg-gray-100 text-center text-sm text-gray-500 py-4 shadow-inner">
        &copy; {{ date('Y') }} - Application Laravel Devis & Factures. Tous droits réservés.
    </footer>

</body>
</html>
