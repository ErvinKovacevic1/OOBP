<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artikli') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6">Naša ponuda</h1>

                    <!-- Filter za kategorije kao blokovi -->
                    <div class="mb-4">
                        <form method="GET" action="{{ route('artikli.index') }}">
                            <div class="flex space-x-4">
                                <button type="submit" name="kategorija" value="" class="px-4 py-2 rounded mt-4 text-white" style="background-color: #3B82F6;">Sve kategorije</button>
                                @foreach($kategorije as $kategorija)
                                    <button type="submit" name="kategorija" value="{{ $kategorija->id }}" class="px-4 py-2 rounded mt-4 text-white" style="background-color: #3B82F6;" {{ request('kategorija') == $kategorija->id ? 'bg-blue-700' : '' }}">
                                        {{ $kategorija->naziv }}
                                    </button>
                                @endforeach
                            </div>
                        </form>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($artikli as $artikl)
                            <div class="border rounded-lg shadow-sm overflow-hidden">
                                <img src="{{ asset('images/' . $artikl->slika) }}" alt="{{ $artikl->naziv }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-bold">{{ $artikl->naziv }}</h3>
                                    <p class="text-gray-600 text-sm mt-2">{{ $artikl->opis ?? 'Nema opisa' }}</p>
                                    <p class="text-lg font-semibold text-gray-800 mt-4">{{ number_format($artikl->cijena, 2) }} KM</p>
                                    <p class="text-sm text-gray-500 mt-1">Količina: {{ $artikl->kolicina_na_stanju }}</p>

                                    <!-- Forma za dodavanje u košaricu -->
                                    <form method="POST" action="{{ route('kosarica.dodaj') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $artikl->id }}">
                                        <button type="submit" class="px-4 py-2 rounded mt-4 text-white w-full" style="background-color: #3B82F6;">
                                            Dodaj u košaricu
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
