<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Moje Narudžbe') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6">Moje Narudžbe</h1>

                    <table class="table-auto w-full text-left border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">ID</th>
                                <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Korisnik</th>
                                <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Artikli</th>
                                <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Ukupno</th>
                                <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($narudzbe as $narudzba)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $narudzba->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $narudzba->user ? $narudzba->user->name : 'Nepoznato' }}
                                    </td>

                                    <td class="border border-gray-300 px-4 py-2">
                                        <ul>
                                        @foreach(json_decode($narudzba->artikli) as $artikl)
                                            <li>
                                                {{ $artikl->naziv }} - {{ $artikl->kolicina }} x {{ number_format($artikl->cijena, 2) }} KM
                                            </li>
                                        @endforeach

                                        </ul>
                                    </td>

                                    <td class="border border-gray-300 px-4 py-2">{{ number_format($narudzba->ukupno, 2) }} KM</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if(Auth::user()->is_admin) <!-- Pretpostavljam da koristite neku logiku za radnika/admina -->
                                            <form method="POST" action="{{ route('narudzbe.promijeniStatus', $narudzba->id) }}">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()">
                                                    @foreach(\App\Models\Narudzba::$statuses as $status)
                                                        <option value="{{ $status }}" {{ $narudzba->status == $status ? 'selected' : '' }}>
                                                            {{ ucfirst($status) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @else
                                            <span>{{ ucfirst($narudzba->status) }}</span>
                                        @endif
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
