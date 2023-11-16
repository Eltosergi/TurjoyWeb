@extends('layouts.app')

@section('title')
Buscar reserva
@endsection

@section('content')


<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="{{route('welcome')}}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-12 h-12 mr-2 rounded-full" src="img/turjoy.webp" alt="logo">
            Turjoy
        </a>

        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Buscar reservas
                </h1>
                <form Method = 'POST' class="space-y-4 md:space-y-6" action="{{route('search.result')}}">
                    @csrf
                    <div>
                        <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrerse su reserva</label>
                        <input type = 'text' name="code" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Codigo">
                        @error('code')
                            <p class = "text-white my-2 rounded-lg text-lg text-center p-2" style="background-color: #ff8a80">{{ $message }} </p>
                        @enderror
                        @if (session('error'))
                        <p class = "text-white my-2 rounded-lg text-lg text-center p-2" style="background-color: #ff8a80">{{ session('error') }} </p>
                        @endif
                    </div>

                    <button type="submit" class="w-full text-white bg-gradient-to-br to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2" style="background-color:#2ECC71 ">Buscar</button>

                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        ¿No ha reservado? <a href="{{route('reserve')}}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Reserve</a>
                    </p>

                </form>
            </div>
        </div>
    </div>
</section>

  @endsection

