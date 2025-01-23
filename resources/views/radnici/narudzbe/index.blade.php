<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel za Radnike - Narudžbe') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6">Sve Narudžbe</h1>

                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table-auto w-full text-left border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">ID</th>
                                <th class="border border-gray-300 px-4 py-2">Korisnik</th>
                                <th class="border border-gray-300 px-4 py-2">Ukupno</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                                <th class="border border-gray-300 px-4 py-2">Akcije</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($narudzbe as $narudzba)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $narudzba->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $narudzba->user->name ?? 'Nepoznato' }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ number_format($narudzba->ukupno, 2) }} KM
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ ucfirst($narudzba->status) }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <form method="POST" action="{{ route('radnici.narudzbe.promijeniStatus', $narudzba->id) }}">
                                            @csrf
                                            <select name="status" class="border-gray-300 rounded">
                                                @foreach ($statusi as $status)
                                                    <option value="{{ $status }}" {{ $narudzba->status == $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="ml-2 bg-blue-500 text-white px-3 py-1 rounded">
                                                Ažuriraj
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
