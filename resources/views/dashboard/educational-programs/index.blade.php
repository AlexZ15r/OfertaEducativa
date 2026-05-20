@extends('layouts.app')

@section('css')
@endsection

@section('header')
@endsection

@section('content')
<section class="container mx-auto">
    {{-- navbar --}}
    @if ( $esAdministrador )
    {{-- <x-dashboard.filters :academicManagers="$academicManagers"></x-dashboard.filters>
    <hr class="border-2 border-(--azul-buap-l)"> --}}
    @endif
    {{-- navbar --}}


    {{-- main content --}}
    <main class="p-2 grid grid-cols-12 gap-2">
        {{-- menu sidebar --}}
        <x-dashboard.menu :action="'public-offer'" :esAdministrador="$esAdministrador"></x-dashboard.menu>
        {{-- menu sidebar --}}

        {{-- dinamic content --}}
        <article class="min-h-150 col-span-9 md:col-span-10 p-3 bg-gray-200 shadow-lg">
            {{-- actions bar --}}
            <nav class="flex justify-between items-center mb-3">
                <button type="button" class="px-1 md:px-3 md:py-1 rounded bg-green-500 text-white cursor-pointer">
                    Nueva Oferta
                    <i class="fa-solid fa-plus"></i>
                </button>
                <button type="button" class="px-1 md:px-3 md:py-1 rounded bg-green-600 text-white cursor-pointer">
                    Exportar
                    <i class="fa-solid fa-file-excel"></i>
                </button>
            </nav>
            {{-- actions bar --}}

            {{-- educational programs list --}}
            <section class="overflow-x-auto">
                <table class="min-w-278.5 w-full">
                    <thead class="bg-gray-500 text-white">
                        <tr class="">
                            <th class="text-left">Unidad Académica</th>
                            <th class="text-left">Campus</th>
                            <th class="text-left">Programa de Estudios</th>
                            <th>Público</th>
                            <th><i class="fa-solid fa-ellipsis-vertical"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($educationalPrograms as $pe)
                        <tr class="border-b border-black hover:bg-gray-100">
                            <td class="pb-4 pt-8">{{ $pe->academicUnit?->name ?? 'No identificado' }}</td>
                            <td class="pb-4 pt-8">{{ $pe->campus?->name ?? 'No identificado' }}</td>
                            <td class="pb-4 pt-8">{{ $pe->educationalProgram?->key ?? 'No identificado' }} - {{ $pe->educationalProgram?->name ?? 'No identificado' }}</td>
                            <td class="pb-4 pt-8 text-center">
                                @if ( $pe->active )
                                <span class="p-1 rounded-full bg-gray-400 text-white font-semibold px-2 cursor-pointer">
                                    Público
                                    <i class="fa-solid fa-circle text-green-500"></i>
                                </span>
                                @else
                                <span class="p-1 rounded-full bg-gray-400 text-white font-semibold px-2 cursor-pointer">
                                    Privado
                                    <i class="fa-solid fa-circle text-rose-400"></i>
                                </span>
                                @endif
                            </td>
                            <td class="text-center pb-4 pt-8">
                                <div class="inline group relative">
                                    <span class="hidden group-hover:inline rounded-full py-1 px-3 bg-black text-white absolute bottom-full end-full translate-x-2/5">
                                        editar
                                    </span>
                                    <span class="cursor-pointer">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
            {{-- educational programs list --}}
        </article>
        {{-- dinamic content --}}
    </main>
    {{-- main content --}}
</section>
@endsection

@section('footer')
@endsection

@section('js')
@endsection
