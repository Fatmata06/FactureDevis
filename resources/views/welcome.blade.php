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
<body class="bg-gradient-to-br from-indigo-50 via-white to-blue-100 text-gray-800 flex flex-col min-h-screen">

    <!-- Contenu principal -->
    <main class="flex-grow flex items-center justify-center px-4">
        <div class="max-w-6xl w-full flex flex-col-reverse md:flex-row items-center justify-between gap-10">
            <!-- Section gauche -->
            <div class="md:w-1/2 text-center md:text-left">
                <h1 class="text-5xl font-extrabold text-indigo-700 mb-4 leading-tight">Bienvenue sur <span class="text-gray-900">UNIGES</span></h1>
                <blockquote class="text-gray-600 italic">
                    {{ __('"Une solution, deux actions."') }}
                </blockquote>


                <p class="text-gray-600 mb-8 text-lg max-w-md mx-auto md:mx-0">
                   Créez, gérez et téléchargez facilement vos devis et factures avec notre solution UNIGES,pensée pour simplifier la géstion de votre activité professionnelle
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    @guest
                        <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg shadow hover:bg-indigo-700 transition font-semibold text-lg flex items-center gap-2 justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/></svg>
                            Se connecter
                        </a>
                    @endguest   
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-8 py-3 rounded-lg shadow hover:bg-red-600 transition font-semibold text-lg flex items-center gap-2 justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                                Se déconnecter
                            </button>
                        </form>
                    @endauth
                </div>
            </div>

            <!-- Section droite avec image plein format -->
            <div class="md:w-1/2 h-full flex items-center justify-center">
                <div class="relative group w-full h-full max-w-xl max-h-[520px] md:max-w-2xl md:max-h-[600px]">
                    <img src="https://img.freepik.com/photos-gratuite/plan-moyen-femme-montrant-contrat_23-2149314081.jpg?w=826&t=st=1720526800~exp=1720527400~hmac=0e4d05fa024a178279e4dc893225db31e43db5de614ce53e95a9f26a32b2167f" 
                         alt="Illustration facturation" 
                         class="w-full h-full min-h-[320px] min-w-[320px] object-cover rounded-2xl shadow-2xl group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-t from-indigo-900/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Pied de page -->
    <footer class="bg-white/80 backdrop-blur text-center text-sm text-gray-500 py-4 shadow-inner mt-auto border-t border-gray-200">
        <span class="inline-flex items-center gap-2">
            &copy; {{ date('Y') }} - FatmataDev - Devis & Factures. Tous droits réservés.
        </span>
    </footer>

</body>
</html>
