<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Košarica') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6">Vaša košarica</h1>

                    @if(session('kosarica') && count(session('kosarica')) > 0)
                        <table class="table-auto w-full text-left border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Naziv</th>
                                    <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Količina</th>
                                    <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Cijena</th>
                                    <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session('kosarica', []) as $id => $artikl)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2">
                                            <div class="flex items-center">
                                                <img src="{{ asset('images/' . $artikl['slika']) }}" alt="{{ $artikl['naziv'] }}" class="w-12 h-12 mr-4 rounded">
                                                <span>{{ $artikl['naziv'] }}</span>
                                            </div>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <div class="flex justify-center items-center space-x-2">
                                                <!-- Forma za smanjivanje količine -->
                                                <form method="POST" action="{{ route('kosarica.azuriraj') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="hidden" name="akcija" value="smanji">
                                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                                        -
                                                    </button>
                                                </form>
                                                <span class="font-semibold">{{ $artikl['kolicina'] }}</span>
                                                <!-- Forma za povećavanje količine -->
                                                <form method="POST" action="{{ route('kosarica.azuriraj') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="hidden" name="akcija" value="povecaj">
                                                    <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                                        +
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            {{ number_format($artikl['cijena'] * $artikl['kolicina'], 2) }} KM
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <!-- Forma za uklanjanje artikla -->
                                            <form method="POST" action="{{ route('kosarica.ukloni', $id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                    Ukloni
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6 flex justify-between items-center">
                            <h3 class="text-xl font-bold">Ukupno: {{ number_format($ukupno, 2) }} KM</h3>
                            <!-- Forma za čišćenje košarice -->
                            <form method="POST" action="{{ route('kosarica.ocisti') }}">
                                @csrf
                                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                    Očisti košaricu
                                </button>
                            </form>
                        </div>

                        <!-- Odabir načina preuzimanja -->
                        <form method="POST" action="{{ route('kosarica.zavrsi') }}" class="mt-6">
                            @csrf
                            <div class="flex flex-col space-y-4">
                                <label for="nacin_preuzimanja" class="text-lg font-semibold">Način preuzimanja:</label>
                                <select id="nacin_preuzimanja" name="nacin_preuzimanja" class="p-3 border border-gray-300 rounded-md">
                                    <option value="preuzmi" {{ old('nacin_preuzimanja') == 'preuzmi' ? 'selected' : '' }}>Preuzmi u restoranu</option>
                                </select>
                            </div>

                            <div class="mt-4 flex justify-center">
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Završite narudžbu
                                </button>
                            </div>
                        </form>
                    @else
                        <p class="text-gray-500 text-center">Vaša košarica je prazna.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
