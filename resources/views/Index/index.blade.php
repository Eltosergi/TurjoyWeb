@extends('layouts.app')

@section('title')
    Ingresar Viajes
@endsection

@section('content')
    {{--
    {{ count($validRows) }}
    {{ count($invalidRows) }}
    {{ count($duplicatedRows) }} --}}

    @if (isset($validRows) || isset($invalidRows) || isset($duplicatedRows))
        <div class="flex flex-1 flex-col gap-2">
            <div class="my-8 mx-auto">
                <a class="px-6 py-3 bg-green-500 hover:bg-green-700 transition-all text-white font-semibold rounded-lg"
                    href="{{ route('welcome') }}">Volver al menu de administrador</a> 
            

                <h1>
                    <style>
                        .info-box {
                            display: fixed;
                            justify-content: center;
                            align-items: center;
                            height: 10vh;
                            margin: 1vh;
                            background-color: #f0f0f0;
                        }

                        .info-message {
                            color: #333;
                            padding: 20px;
                            text-align: center;
                            border-radius: 5px;
                        }

                        .correctly-box{
                            background-color: #a8e6cf;
                        }

                       .error-box {
                            background-color: #ff8a80;
                        }

                       .warning-box {
                            background-color: #e4e6a8;
                        }
                    </style>
                </h1>

                <body>
                   <div class="info-message">
                        <h2>Simbología de colores y errores</h2>
                   <div class="info-box">
                        <p class="correctly-box">se cargaron correctamente</p>
                        <p class="error-box">No se pudieron cargar correctamente</p>
                        <p class="warning-box">Rutas repetidas</p>
                    </div>
                </body>
            </div>

            @if (count($validRows) > 0)
                <h3 class="text-2xl text-gray-custom-50 font-semibold uppercase text-center">Listado de viajes
                </h3>
                <div class="relative overflow-x-auto sm:rounded-lg mb-2">
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-custom-50 uppercase bg-green-600 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-f-gray-custom-100 font-bold">
                                    Origen
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Destino
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Cantidad de asientos
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Tarifa base
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($validRows as $validRow)
                                <tr class="bg-green-custom border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                        {{ $validRow['origen'] }}
                                    </th>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $validRow['destino'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $validRow['cantidad_de_asientos'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $validRow['tarifa_base'] }}
                                    </td>
                                </tr>
                            @endforeach 
            @endif
            @if (count($invalidRows))
                            @foreach ($invalidRows as $invalidRow)
                                <tr class="bg-red-custom border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                        {{ $invalidRow['origen'] ? $invalidRow['origen'] : '---' }}
                                    </th>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $invalidRow['destino'] ? $invalidRow['destino'] : '---' }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $invalidRow['cantidad_de_asientos'] ? $invalidRow['cantidad_de_asientos'] : '---' }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $invalidRow['tarifa_base'] ? $invalidRow['tarifa_base'] : '---' }}
                                    </td>
                                </tr>
                            @endforeach
            @endif
                @if (count($duplicatedRows))
                <div class="relative overflow-x-auto sm:rounded-lg">
                            @foreach ($duplicatedRows as $duplicatedRow)
                                <tr class="bg-brown-custom border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                        {{ $duplicatedRow['origen'] }}
                                    </th>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $duplicatedRow['destino'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $duplicatedRow['cantidad_de_asientos'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $duplicatedRow['tarifa_base'] }}
                                    </td>
                                </tr>
                            @endforeach
                @endif
        </div>
    </div>
    @else
        <div class="flex flex-col flex-1 justify-center items-center my-6">
            <div class="mb-12 mx-auto">
                <a class="px-6 py-3 bg-green-custom hover:bg-red-700 transition-all text-black font-semibold rounded-lg"
                    href="{{ route('welcome') }}">Volver a menú administrador</a>
            </div>
            <form class="flex flex-col items-center w-1/2" action="{{route('travel.check')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="document" class="cursor-pointer">
                        <span class="bg-green-custom hover:bg-blue-700 transition-all text-white font-semibold rounded-lg px-4 py-2">
                            Subir archivo 
                        </span>
                        <input type="file" name="document" id="document" class="hidden">
                        <span class="ml-2" style="opacity: 0.4">Subir archivos solo que pese 5MB</span>
                    </label>
                    @error('document')
                        <p class="bg-red-custom font-semibold my-4 text-lg text-center text-red-800 px-4 py-3 rounded-lg">
                            {{ $message }}</p>
                    @enderror
                </div>

                <button class="lg:w-1/4 my-4 p-2 bg-green-custom rounded-sm text-black font-semibold" type="submit">
                    Importar viajes
                </button>
            </form>
        </div>
    @endif

@endsection