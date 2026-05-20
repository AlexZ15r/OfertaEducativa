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
        <x-dashboard.menu :action="''" :esAdministrador="$esAdministrador"></x-dashboard.menu>
        {{-- menu sidebar --}}

        {{-- dinamic content --}}
        <article class="col-span-9 md:col-span-10 p-3 bg-gray-200 shadow-lg flex justify-center items-start md:items-center">
            <img src="{{ asset('images/logos-buap/logo_b_t.png') }}" alt="LOGO BUAP" class="w-1/4 mx-auto">
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
