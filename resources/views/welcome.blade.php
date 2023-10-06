@extends('layouts.app')

@section('title')
Home Page
@endsection
@section('content')
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          @auth
              <!-Dentro de esta etiqueta solo lo ve el usuario autenticado->
            <div class="bg-gray-custom text-white w-1/4 h-100 p-5">
            <li>
            <a href="{{route('welcome')}}" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Inicio</a>
            </li>
            <li>
            <a href="{{route('logout')}}" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Logout</a>
            </li>
            <li>
            <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Proximamente</a>
            </li>
        </div>
          @endauth
          @guest
            <!-Dentro de esta etiqueta solo lo ve el usuario invitado->
            <div class="bg-color: #F4F4F4 text-white h-3/4 w-1/4 p-6">
            <li>
            <a href="{{route('welcome')}}" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Inicio</a>
              </li>
              <li>
                <a href="{{route('login')}}" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Iniciar Sesión</a>
              </li>
              <li>
                <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Proximamente</a>
              </li>
            </div>
          @endguest
        </ul>


        <nav class="navbar fixed-bottom navbar-light h-100" style="background-color:#0A74DA">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Fono Ayuda: +56939309938</a>
        </div>
    </body>
</html>
