<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj novi artikl') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('artikli.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="naziv" class="block text-gray-700 font-bold mb-2">Naziv:</label>
                        <input type="text" name="naziv" id="naziv" class="w-full border rounded-lg px-3 py-2 focus:outline-none" required>
                    </div>
                    <div class="mb-4">
                        <label for="opis" class="block text-gray-700 font-bold mb-2">Opis:</label>
                        <textarea name="opis" id="opis" rows="4" class="w-full border rounded-lg px-3 py-2 focus:outline-none"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="cijena" class="block text-gray-700 font-bold mb-2">Cijena:</label>
                        <input type="number" name="cijena" id="cijena" step="0.01" class="w-full border rounded-lg px-3 py-2 focus:outline-none" required>
                    </div>
                    <div class="mb-4">
                        <label for="slika" class="block text-gray-700 font-bold mb-2">Slika:</label>
                        <input type="file" name="slika" id="slika" class="w-full border rounded-lg px-3 py-2 focus:outline-none">
                    </div>
                    <div class="mb-4">
                        <label for="kolicina_na_stanju" class="block text-gray-700 font-bold mb-2">Količina:</label>
                        <input type="number" name="kolicina_na_stanju" id="kolicina_na_stanju" class="w-full border rounded-lg px-3 py-2 focus:outline-none" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">
                        Sačuvaj
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
