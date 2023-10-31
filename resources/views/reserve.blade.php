@extends('layouts.app')

@section('title')
    Reservar
@endsection

@section('content')


    @if ($countTravels > 0)
    <!--Formulario de reserva (alinear boxes (selects e inputs) - Flowbite)-->
    <div class="flex flex-col w-1/2 mx-auto justify-center items-center mt-24" style="">

        <form  action="{{route('travel.check')}}" method="POST" class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600" style="width: 90%; background-color: #0A74DA">

            <h1 class="mb-4 text-4xl font-semibold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl text-white">Reserva ya!</h1>
            <div class="mb-2 mt-10 flexbox-align" style="width: 40%;">
                <label class="block mb-2 text-sm font-medium text-gray-900 text-white">Día</label>
                <input type="date" name="date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@flowbite.com" required>
            </div>
            <div class="flex flex-col items-start" style="width: 40%">
                <label for="origins" class="block mb-2 text-sm font-medium text-gray-900 text-white">Origen</label>
                <select id="origins" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                    <option selected value="">Seleccione un origen</option>
                </select>
            </div>
            <div class="">
                <label for="destinations" class="block mb-2 text-sm font-medium text-gray-900 text-white">Destino</label>
                <select id="destinations" style="width: 40%" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                    <option value="">Seleccione un destino</option>
                </select>
            </div>
            <!--Cambiar para cantidad, actualmente com formato password-->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 text-white">Cantidad de asientos</label>
                <input type="seats" id="repeat-password" style="width: 40%" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
            </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" style="background-color: #2ecc71">Reservar</button>
        </form>

    </div>
    @else

    <!--Alerta (cambiar color deacuerdo a la ERS - Plantilla de flowbite(https://flowbite.com/docs/components/alerts/)-->
    <div class=" mt-20 flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">No existen rutas disponibles!</span> Contacte con administrador para cargar rutas.
        </div>
      </div>
    @endif
@endsection


@section('js')
    <script src="{{asset('assets/js/index.js')}}"></script>




@endsection
