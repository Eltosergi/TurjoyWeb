@extends('layouts.app')
@section('title')
Reporte de reservas
@endsection

@section('content')

    @if ($tickets ->count() > 0)
        <div style="margin-top: 5%; text-align: center;">
            <div style="display: inline-block;">
                <a href="{{ route('report') }}"
                    class="bg-blue-custom-50 hover:bg-red-custom transition-all flex items-center justify-center my-auto w-9 h-10 text-white rounded-lg -ml-12 -mb-10"
                    data-tooltip-target="tooltip-light" data-tooltip-placement="bottom">
                    <svg class="w-5 h-5 mr-1 hover:animate-spin text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 1v5h-5M2 19v-5h5m10-4a8 8 0 0 1-14.947 3.97M1 10a8 8 0 0 1 14.947-3.97" />
                    </svg>
                    <div style="background-color: #EAEAEA " id="tooltip-light" role="tooltip"  class="absolute z-30 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                            Refresca el buscador
                            <div class="tooltip-arrow" data-popper-arrow></div> 
                    </div>               
                </a>
                
                    
            <form action="{{ route('searchToDate') }}" method="GET">
                    @csrf
                    <div date-rangepicker class="flex items-center justify-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input name="start" type="text" value="{{ old('start') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input name="end" type="text" value="{{ old('end') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                        </div>

                        <button type="submit"
                            class="bg-green-custom hover:bg-green-700 transition-all py-2 px-4 text-white rounded-lg">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="max-w-sm mx-auto">
            @error('start')
                <p class="bg-red-custom text-white my-2 rounded-xl text-sm text-center p-2">{{ $message }}</p>
            @enderror

            @if (session('message'))
                <p class="bg-red-custom text-white my-2 rounded-xl text-sm text-center p-2">
                    {{ session('message') }}</p>
            @endif
            @error('end')
                <p class="bg-red-custom text-white my-2 rounded-xl text-sm text-center p-2">{{ $message }}</p>
            @enderror
        </div>
  
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg"style="margin-top: 1%">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Código
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de la reserva
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Día de la reserva
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ciudad de origen
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ciudad de destino
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad de asientos
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticketRow)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $ticketRow->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $ticketRow->created_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticketRow->date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticketRow->trip->origin }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticketRow->trip->destination }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticketRow->seat }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticketRow->total }}
                            </td>
                            
                        
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/datepicker.min.js"></script>

    </div>
    @else
        <div class="mt-20 flex items-center p-4 mb-4 text-sm text-white border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" style="background: #ff8a80 ; width:40%;" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">no hay reservas en sistema</span>
            </div>
        </div>
    @endif

    



@endsection