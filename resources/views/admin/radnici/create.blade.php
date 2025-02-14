<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj Radnika') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6">Dodajte novog radnika</h1>

                    <form method="POST" action="{{ route('radnici.store') }}">
                        @csrf

                        <!-- Prikaz grešaka -->
                        @if ($errors->any())
                            <div class="mb-4">
                                <ul class="list-disc pl-5 text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Ime</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full p-2 border border-gray-300 rounded @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">Uloga</label>
                            <select name="role" id="role" class="mt-1 block w-full p-2 border border-gray-300 rounded @error('role') border-red-500 @enderror" required>
                                <option value="radnik" selected>Radnik</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Lozinka</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full p-2 border border-gray-300 rounded @error('password') border-red-500 @enderror" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Potvrdi lozinku</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full p-2 border border-gray-300 rounded @error('password_confirmation') border-red-500 @enderror" required>
                        </div>

                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Spremi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
