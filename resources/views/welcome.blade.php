@extends('layouts.app')

@section('title')
Página principal
@endsection
@section('content')
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          @auth
              <!-Dentro de esta etiqueta solo lo ve el usuario autenticado->
            <div class="bg-gray-custom-150  w-1/4 h-100 p-5">
            <li>
            <a href="{{route('welcome')}}" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Inicio</a>
            </li>
            <li>
            <a href="{{route('logout')}}" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Salir de la sesión</a>
            </li>
            <li>
            <li>
            <a href="{{route('index')}}" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Cargar rutas de viaje</a>
            </li>
        </div>
          @endauth
          @guest
            <!-Dentro de esta etiqueta solo lo ve el usuario invitado->
            <div class="bg-gray-custom-100  text-white h-4/4 w-[300px] p-6">
            <li>
            <a href="{{route('login')}}" class="block mt-20 ml-[-24px] bg-gray-custom-150 w-[300px] h-[50px] py-2 pl-3 pr-4 text-gray-900 text-4xl font-normal hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Iniciar Sesión</a>
              </li>
            </div>
            <div class= "h-screen relative">
              <a href="#" class=" bg-green-custom text-8xl p-8 font-normal absolute left-[550px] top-[40%]">Próximamente</a>
              <a class=" text-6xl p-8 inline absolute left-[630px] top-[29%]">Reservar</a>
              <a class=" text-6xl p-8 inline absolute left-[880px] top-[29%]">pasajes</a>
            </div>
          @endguest
        </ul>
        <footer class="bg-blue-custom-50 text-white p-4">
          <nav class="flex justify-between">
            <a href="#" class="hover:text-gray-300">Fono ayuda: +552 546735</a>
            <a class="hover:text-gray-300 text-center ">2023 - {{ now()->year }} | Todos los derechos de Turjoy estan resevados</a>
            <a href="#" class="hover:text-gray-300"></a>
          </nav>
        </footer>
      </div>
@endsection