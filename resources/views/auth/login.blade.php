@extends('layouts.app')
@section('title')
Iniciar Sesión
@endsection
@section('content')

    <div class="flex justify-center items-center" style="margin-top: 10%">
        <div class="w-full max-w-md h-[400px] p-8 bg-white h-auto border border-gray-custom-100 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
             <a href="{{route('welcome')}}" class="block py-2 pl-3 pr-4 text-gray-custom-50 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                <span style="font-size: 17px;">Volver</span></a>
                <form class="space-y-4" method="POST" action="{{ route('login.store') }}" novalidate>
                @csrf
                <h5 class="text-xl font-medium text-gray-custom-50 dark:text-white text-center">Iniciar Sesión</h5>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Correo electrónico</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-custom-150 border border-gray-custom-100 text-gray-custom-50 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="ejemplo@compañia.com" required>
                    @error('email')
                        <p class="bg-red-custom text-white my-2 rounded-lg text-lg text-center -p-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Contraseña"
                        class="bg-gray-custom-150 border border-gray-custom-100 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                    @error('password')
                        <p class="bg-red-custom text-white my-2 rounded-lg text-lg text-center -p-2">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color:#2ECC71">Aceptar
                </button>

                    @if (session('message'))
                        <p class="bg-red-custom text-white my-2 rounded-lg text-lg text-center -p-2" >{{ session('message') }}</p>
                    @endif

            </form>


    </div>
        </div>
    </div>


  @endsection
