<x-guest-layout>
                 <div class=" flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-blue-100 dark:from-gray-900 dark:to-gray-800 py-2 px-2">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 overflow-hidden flex flex-col justify-center">

            <!-- Logo ou Titre -->
            <div class="flex flex-col items-center mb-6">
                <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-indigo-100 mb-2">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-3-3.87M12 3a4 4 0 110 8 4 4 0 010-8z"/>
                    </svg>
                </span>
                <h2 class="text-2xl font-extrabold text-indigo-700 mb-1">Connexion</h2>
                <p class="text-gray-500 dark:text-gray-300 text-center text-sm">Accédez à votre espace professionnel</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <!-- Formulaire -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email *')" />
                    <x-text-input id="email" class="block mt-1 w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 transition text-sm dark:bg-gray-900 dark:text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Mot de passe -->
                <div>
                    <x-input-label for="password" :value="__('Mot de passe *')" />
                    <x-text-input id="password" class="block mt-1 w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 transition text-sm dark:bg-gray-900 dark:text-white" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Se souvenir de moi + mot de passe oublié -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-xs text-gray-600 dark:text-gray-400">Se souvenir de moi</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="underline text-xs text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 font-medium" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <!-- Bouton connexion -->
                <div>
                    <button type="submit" class="w-full flex justify-center items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow transition text-base">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                        Connexion
                    </button>
                </div>
            </form>

            <!-- Lien inscription -->
            @if (Route::has('register'))
                <p class="text-xs text-center text-gray-500 mt-6">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Créer un compte</a>
                </p>
            @endif
        </div>
    </div>
</x-guest-layout>
