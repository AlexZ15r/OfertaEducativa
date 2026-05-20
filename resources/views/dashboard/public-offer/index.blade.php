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
    <main x-data="offer" class="p-2 grid grid-cols-12 gap-2">
        {{-- menu sidebar --}}
        <x-dashboard.menu :action="'public-offer'" :esAdministrador="$esAdministrador"></x-dashboard.menu>
        {{-- menu sidebar --}}

        {{-- dinamic content --}}
        <article class="min-h-150 col-span-9 md:col-span-10 p-3 bg-gray-200 shadow-lg">
            {{-- search --}}
            <nav class="mb-3">
                <div class="relative">
                    <label for="search-offer" class="sr-only">Buscar</label>
                    <input x-model="param" type="text" placeholder="Encontrar licenciaturas, facultades y campus" id="search-offer" class="w-full p-2 pe-14 border border-gray-400">
                    <span class="absolute me-3 ps-3 top-1/2 end-0 -translate-y-1/2 border-s-2 border-gray-300 pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </div>
            </nav>
            {{-- search --}}

            {{-- educational programs list --}}
            <section class="overflow-x-auto">
                <table class="min-w-278.5 w-full">
                    <thead class="bg-gray-500 text-white">
                        <tr class="">
                            <th class="text-left">Unidad Académica</th>
                            <th class="text-left">Campus</th>
                            <th class="text-left">Programa de Estudios</th>
                            <th><i class="fa-solid fa-ellipsis-vertical"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($educationalPrograms as $pe)
                        <tr x-show="filter('{{$pe->academicUnit?->name}}','{{$pe->campus?->name}}','{{$pe->educationalProgram?->key}}{{$pe->educationalProgram?->name}}')" class="border-b border-black hover:bg-gray-100">
                            <td class="pb-4 pt-8">{{ $pe->academicUnit?->name ?? 'No identificado' }}</td>
                            <td class="pb-4 pt-8">{{ $pe->campus?->name ?? 'No identificado' }}</td>
                            <td class="pb-4 pt-8">{{ $pe->educationalProgram?->key ?? 'No identificado' }} - {{ $pe->educationalProgram?->name ?? 'No identificado' }}</td>
                            <td class="text-center pb-4 pt-8">
                                @if ( $canEditDetails )
                                <a href="{{ route('dashboard.details', ['offer' => $pe->id]) }}" class="inline group relative hover:text-(--azul-buap-l)">
                                    <span class="hidden group-hover:inline-block rounded-full py-1 px-3 bg-black text-white absolute bottom-full end-1/2">
                                        modificar
                                    </span>
                                    <span class="cursor-pointer">
                                        <i class="fa-regular fa-pen-to-square text-[23px] {{ $pe->detailsComplete() ? 'text-emerald-500' : '' }}"></i>
                                    </span>
                                </a>
                                @endif
                                <a href="{{ route('dashboard.images', ['offer' => $pe->id]) }}" class="inline group relative hover:text-(--azul-buap-l)">
                                    <span class="hidden group-hover:inline-block rounded-full py-1 px-3 bg-black text-white absolute bottom-full end-1/2">
                                        modificar
                                    </span>
                                    <span class="cursor-pointer {{ $pe->images()->count() ? 'text-emerald-500' : '' }}">
                                        <i class="fa-solid fa-images text-[23px]"></i>
                                    </span>
                                </a>
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
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('offer', () => ({
            param: '',
            searching: false,
            filter( campus, unit, program ) {
                return `${campus}${unit}${program}`.toLowerCase().includes(this.param.toLowerCase())
            },
        }))
    })
</script>
@endsection
