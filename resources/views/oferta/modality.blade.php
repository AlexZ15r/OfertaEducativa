@extends('layouts.app')

@section('css')
@endsection

@section('header')
@endsection

@section('content')
<main class="container mx-auto">
    <h1 class="text-2xl">Modalidad {{ $modalityName }}</h1>

    <hr class="border border-gray-400 mb-5">

    <ul class="list-disc ms-5">
        @foreach ( $offer as $campus => $eps )
        <li>
            {{ $campus }}

            @if ( $eps->count() )
            <ul class="list-disc ms-5">
                @foreach ($eps as $ep)
                <li>
                    <a href="{{ route('educational-program', ['educationalProgram' => $ep->id]) }}">
                        {{ $ep->educationalProgram }}
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
</main>
@endsection

@section('footer')
@endsection

@section('js')
@endsection
