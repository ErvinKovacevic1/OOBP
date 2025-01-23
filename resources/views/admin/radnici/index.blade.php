<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upravljanje radnicima') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6">Lista svih radnika</h1>

                    @if(session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('admin.radnici.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Dodaj novog radnika</a>

                    @if($radnici->count() > 0)
                        <table class="table-auto w-full text-left border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Ime</th>
                                    <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Email</th>
                                    <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Status</th>
                                    <th class="border border-gray-300 px-4 py-2 text-gray-800 font-semibold">Akcija</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($radnici as $radnik)
                                    <tr class="hover:bg-gray-50">
                                        <!-- Ispisivanje imena iz tabele users -->
                                        <td class="border border-gray-300 px-4 py-2">{{ $radnik->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $radnik->email }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $radnik->status ?? 'Aktivan' }}</td> <!-- Ako imate status -->
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                        <a href="{{ route('admin.radnici.edit', $radnik->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Uredi</a>
                                            <form action="{{ route('radnici.destroy', $radnik->id) }}" method="POST" class="inline-block ml-2">
    @csrf
    @method('DELETE')
    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Obriši</button>
</form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500 text-center">Nema radnika u bazi.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
