@extends('layouts.app')

@section('content')

    <div class="flex justify-center items-center">
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-4" method="POST" action="{{ route('login.store') }}" novalidate>
                @csrf
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Login</h5>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="name@company.com" required>
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center -p-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center -p-2">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color:#0A74DA">Enviar
                </button>

                    @if (session('message'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center -p-2">{{ session('message') }}</p>
                    @endif
            </form>
        </div>
    </div>
  @endsection
