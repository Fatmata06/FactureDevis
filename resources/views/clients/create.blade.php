<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Créer un nouveau client
        </h2>
    </x-slot>

    <div class="py-12 max-w-lg mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block mb-1">Nom *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full border border-gray-300 rounded px-3 py-2 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="phone" class="block mb-1">Téléphone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="company" class="block mb-1">Entreprise</label>
                    <input type="text" name="company" id="company" value="{{ old('company') }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 @error('company') border-red-500 @enderror">
                    @error('company')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Créer le client
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
