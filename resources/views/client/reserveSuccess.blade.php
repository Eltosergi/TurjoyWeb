@extends('layouts.app')

@section('title')
 Compra realizada
@endsection

@section('content')


    {{-- Detalle de la compra --}}
    <div class="flex flex-col items-center" style="margin-top: 150px; margin-bottom:50px">
        <div class="w-1/3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" >
            <div class="bg-blue-custom-50 p-10 rounded-t-lg" >
                <p class="text-xl text-black text-center text-white">Tu viaje ha sido <br> <span class="font-bold text-2xl text-white">Reservado con
                        éxito</span></p>
            </div>
            <div class="flex flex-col p-5">

                {{-- Empieza el contenido de la tabla --}}
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr
                                class="bg-gray-custom-150 border-b border-blue-custom-50 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Código de reserva
                                </th>
                                <td class="px-6 py-4">
                                    {{ $ticket->code }}
                                </td>
                            </tr>
                            <tr
                                class="bg-gray-custom-150 border-b border-blue-custom-50 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Ciudad de origen
                                </th>
                                <td class="px-6 py-4">
                                    {{ $trip->origin }}
                                </td>
                            </tr>
                            <tr class="bg-gray-custom-150 border-b border-blue-custom-50">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Ciudad de destino
                                </th>
                                <td class="px-6 py-4">
                                    {{ $trip->destination }}
                                </td>
                            </tr>
                            <tr class="bg-gray-custom-150 border-b border-blue-custom-50">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Día de la reserva
                                </th>
                                <td class="px-6 py-4">
                                    {{ date('d/m/Y', strtotime($ticket->date)) }}
                                </td>
                            </tr>

                            <tr class="bg-gray-custom-150 border-b border-blue-custom-50">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Cantidad de asientos
                                </th>
                                <td class="px-6 py-4">
                                    {{ $ticket->seat }}
                                </td>
                            </tr>

                            <tr class="bg-gray-custom-150 border-b border-blue-custom-50">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Fecha de la compra
                                </th>
                                <td class="px-6 py-4">
                                    {{  date('d/m/Y h:i:s', strtotime($voucher->created_at)) }}
                                </td>
                            </tr>

                            <tr class="bg-gray-custom-150 border-b">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Total pagado
                                </th>
                                <td class="px-6 py-4">
                                    {{ $ticket->total }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('pdf.download', ['id' => $voucher->id]) }}" style="background-color:#2ECC71"
                    class="inline-flex items-center mx-auto my-4 px-3 py-2 text-sm font-medium text-center text-white bg-cyan-700 rounded-lg hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Generar PDF
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
            <div class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600" style="background-color:#0A74DA">

                <a href="{{ route('welcome') }}" type="button" hidden
                    class="text-white w-4 bg-red-custom hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-lm py-3 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ">
                    Finalizar
                </a>
            </div>
        </div>
    </div>


@endsection
