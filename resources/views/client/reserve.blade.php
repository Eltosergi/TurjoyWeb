@extends('layouts.app')

@section('title')
    Reservar
@endsection

@section('content')

    @if ($countTravels > 0)

    <!--Formulario de reserva (alinear boxes (selects e inputs) - Flowbite)-->

    <input id="basePrice" name="total" value=" " hidden>

    <div class="flex flex-col w-1/2 mx-auto justify-center items-center mt-24" style="margin-bottom: 5%" >
        <h1 class="mb-4 text-4xl font-semibold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl text-black">Reserva ya!</h1>

    </div>
    <form id="form" method="POST" action="{{route('ticket.store')}}"  class="border border-gray-200 rounded-lg" style=" margin-top:200px; " >
        @csrf
        <div style="width: 550px; height: 600px">
            <div id="select" class="flex flex-col items-start" style=" margin-top:20px; ">
                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 text-white">Día</label>
                <input type="date" id="date" name="date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>


                <p id="dateErrorSelect" class="bg-red-custom text-white my-2 rounded-lg text-lg text-center" style="display:none">debe seleccionar la
                    fecha del viaje antes de realizar la reserva</p>

                <p id="dateError" class="bg-red-custom text-white my-2 rounded-lg text-lg text-center -p-2" style="display:none">La fecha seleccionada
                    no puede ser menor a la actual</p>

            </div>
            <div id="select" class="flex flex-col items-start" >
                <label for="origins" class="block mb-2 text-sm font-medium text-gray-900 text-white">Origen</label>
                <select id="origins" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required >
                    <option selected value="">Seleccione un origen</option>
                </select>


                <p id="originError" class="bg-red-custom text-white my-2 rounded-lg text-lg text-center" style="display:none">debe seleccionar
                    el origen antes de realizar la reserva</p>


            </div>
            <div id="select" class="flex flex-col items-start">
                <label for="destinations" class="block mb-2 text-sm font-medium text-gray-900 text-white">Destino</label>
                <select id="destinations"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                    <option value="">Seleccione un destino</option>
                </select>

                <p id="destinationError" class="bg-red-custom text-white my-2 rounded-lg text-lg text-center -p-2"style="display:none">debe seleccionar
                    el destino antes de realizar la reserva</p>


            </div>

            <div id="select" class="flex flex-col items-start">
                <label for="seats" class="block mb-2 text-sm font-medium text-gray-900 text-white">Cantidad de asientos</label>
                <select id="seats"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                    <option value="">Seleccione una cantidad de asientos</option>
                </select>
                <p id="seatsError" class="bg-red-custom text-white my-2 rounded-lg text-lg text-center -p-2" style="display:none ">debe seleccionar
                    la cantidad de asientos antes de realizar la reserva              </p>

            </div>
            <br/>


            <button id="acceptButton" type="button" class="bg-blue-500 hover:bg-blue-800 transition-all rounded-lg  font-semibold p-2 my-2 text-white">Reservar</button>


        </div>
    </form>




    @else


    <div class="mt-20 flex items-center p-4 mb-4 text-sm text-white border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" style="background: #FF6B6B; width:40%;" role="alert">
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




@endsection
