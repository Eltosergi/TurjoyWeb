@extends('layouts.app')

@section('title')
    Reservar
@endsection

@section('content')

    @if ($countTravels > 0)


    <section id="section" class="bg-gray-50 dark:bg-gray-900">
        <div id="principal" class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">

            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700" style="margin-bottom: 20px">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

      <div class="w-full bg-blue-500 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 text-white text-center p-4">
          <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl">
              Reserva de Pasajes Turjoy
          </h1>

      </div>

                    <form id="form" class="space-y-4 md:space-y-6" action="{{ route('ticket.store') }}" method="POST" >
                        @csrf
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha del viaje:</label>
                            <input type="date" id="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                            <p id="dateErrorSelect" class="bg-red-custom text-white my-2 rounded-lg text-lg text-center" style="display:none">debe seleccionar la
                                fecha del viaje antes de realizar la reserva</p>

                            <p id="dateError" class="bg-red-custom text-white my-2 rounded-lg text-lg text-center -p-2" style="display:none">La fecha seleccionada
                                no puede ser menor a la actual</p>
                        </div>
                        <div>
                            <label for="origen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origen:</label>
                            <select id="origins" name="origin" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                          <option value="" disabled selected>Seleccione un origen</option>

                            </select>
                            <p id="originError" class="bg-red-custom text-white my-2 rounded-lg text-lg text-center" style="display:none">debe seleccionar
                                el origen antes de realizar la reserva</p>

                      </div>
                        <div>
                            <label for="destino" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destino:</label>
                            <select id="destinations" name="destination" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                <option value="" disabled selected>Seleccione un destino</option>


                            </select>
                            <p id="destinationError" class="bg-red-custom text-white my-2 rounded-lg text-lg text-center -p-2"style="display:none">debe seleccionar
                                el destino antes de realizar la reserva</p>
                      </div>
                        <div>
                            <label for="asientos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cantidad de asientos:</label>
                            <select id="seats" name="seat" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required="">
                                <option value="" disabled selected>Seleccione cantidad de asientos</option>
                            </select>
                            <p id="seatsError" class="bg-red-custom text-white my-2 rounded-lg text-lg text-center -p-2" style="display:none ">debe seleccionar la cantidad de asientos antes de realizar la reserva</p>
                            <p id="noSeatsError" class="bg-red-custom text-white my-2 rounded-lg text-lg text-center -p-2" style="display:none ">no hay servicios disponibles para la ruta seleccionada</p>
                        </div>

                        <input type="number" id="total" name="total" value=" " hidden>
                        <div class="center">
                            <button id="acceptButton" type="button" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800" >Reservar</button>
                        </div>

                    </form>
                    <input type="number" id="basePrice" value=" " hidden>

                </div>
            </div>
        </div>
      </section>


    @else


    <div class="mt-20 flex items-center p-4 mb-4 text-sm text-white border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" style="background: #FF6B6B; width:40%;" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Por el momento no es posible realizar reservas, intente más tarde</span>
        </div>
    </div>


    @endif
@endsection


@section('js')
    <script src="{{asset('assets/js/index.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




@endsection
