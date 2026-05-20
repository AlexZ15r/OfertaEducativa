@extends('layouts.app')

@section('css')
<style>
    .text-area
    {
        color: {{ $area?->color ?? "gray" }};
    }
    .bg-area
    {
        background-color: {{ $area?->color ?? "gray" }};
        border-color: {{ $area?->color ?? "gray" }};
    }
    .bg-area-hover:hover
    {
        background-color: {{ $area?->color ?? "gray" }}90;
        border-color: {{ $area?->color ?? "gray" }};
    }
    .select-area
    {
        background-color: {{ $area?->color ?? "gray" }};
        border-color: {{ $area?->color ?? "gray" }};
        color: white;
    }
    .semester.active
    {
        background-color: {{ $area?->color ?? "gray" }}90;
        border-color: {{ $area?->color ?? "gray" }};
    }
    .semester-number
    {
        width: 50px;
        height: 50px;
        margin-right: 15px;
    }
    .area-button
    {
        background-color: {{ $area?->color ?? "gray" }};
        border-color: {{ $area?->color ?? "gray" }};
    }
    .area-button:hover
    {
        background-color: {{ $area?->color ?? "gray" }}C0;
        box-shadow: 1px 1px 5px black;
        transform: scale(1.01);
    }
    /* .shadow-left {
        box-shadow: inset -8px 0 20px -4px rgba(0,0,0,0.3);
    }

    .shadow-right {
        box-shadow: inset 8px 0 20px -4px rgba(0,0,0,0.3);
    }
    .both-shadows {
        box-shadow:
            inset -8px 0 20px -4px rgba(0,0,0,0.3),
            inset  8px 0 20px -4px rgba(0,0,0,0.3);
    } */
</style>
@endsection

@section('header')
@endsection

@section('content')
{{-- home button --}}
<a href="{{ route('index') }}" class="fixed top-5 start-5 w-12 h-12 rounded-full bg-buap-l text-white flex justify-center items-center z-50">
    <i class="fa-solid fa-house"></i>
</a>
{{-- home button --}}

{{-- browser --}}
<section x-data="search" class="container mx-auto my-10">
    {{-- input --}}
    <article>
        <div class="relative">
            <input x-model="searchParam" @click="open = true" @input="search($el.value); open = true" placeholder="Encuentra Licenciaturas" type="text" id="search" class="w-full p-3 rounded-full bg-white border border-gray-100 shadow"
                autocomplete="off"
                autocorrect="off"
                autocapitalize="off"
                spellcheck="false"
            >
            <span class="absolute top-0 end-3 translate-y-1/2">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
        </div>
        <div x-show="open" @click.away="open = false" class="mt-3 max-h-100 overflow-auto bg-white rounded-2xl shadow-lg">
            <template x-for="(item, index) in results" :key="item.key">
            <a x-text="item.name" :href="to(item.key)" class="block p-3 hover:bg-gray-100 border-b last:border-b-0"></a>
            </template>
        </div>
    </article>
    {{-- input --}}
</section>
{{-- browser --}}

{{-- multimedia banner --}}
<section class="relative">
    <article class="relative h-fit md:h-96 rounded-2xl overflow-hidden flex justify-center items-center">
        <img src="{{ asset("/storage/$banner") }}" alt="{{ $educationalProgramName }}" class="w-full">
        <div class="absolute inset-0 bg-linear-to-r from-(--azul-buap-h) to-transparent"></div>
    </article>
    <article class="absolute bottom-0 start-0 p-5 text-white">
        <h1 class="mb-2 color-white text-shadow-md text-shadow-black text-3xl">{{ $educationalProgramName }}</h1>
        <span class="px-3 py-1 rounded-md text-sm bg-area">{{ $area?->nombre ?? 'Sin área' }}</span>
    </article>
</section>
{{-- multimedia banner --}}

{{-- demand --}}
<section class="container mx-auto mt-10">
    <h2 class="text-lg font-bold text-center">Demanda de la Carrera{{ $modalities->count() > 1 ? ' por Modalidad' : '' }}:</h2>
    <div class="flex justify-center">
        @forelse ($modalities as $modality)
        <x-widgets.demand :cpp="$modality->pivot->demand?->cpp" :modalidad="$modality->nombre" :campus="$campus"></x-widgets.demand>
        @empty
        <span class="bg-gray-400 px-3 py-1">
            <i class="fa-solid fa-box-open"></i>
            Sin modalidades
        </span>
        @endforelse
    </div>
</section>
{{-- demand --}}

{{-- why study --}}
<section class="container mx-auto mt-20">
    <article class="flex justify-center items-center">
        <h2 class="text-3xl text-center">
            ¿Por qué estudiar <span class="text-area">esta carrera?</span>
        </h2>
        <img src="{{ asset('images/carrera/iconos/porque-estudiar.png') }}" alt="Ícono ¿Por qué estudidiar?" class="w-28 ms-3">
    </article>
    <article class="text-justify">
        {!! $whyStudy ?? 'Sin información' !!}
    </article>
</section>
{{-- why study --}}

{{-- employment area --}}
<section class="container mx-auto mt-20">
    <article class="flex justify-center items-center">
        <img src="{{ asset('images/carrera/iconos/campo-laboral.png') }}" alt="Ícono campo laboral" class="w-28 me-3">
        <h2 class="text-3xl text-center">
            ¿Dónde podrías <span class="text-area">trabajar?</span>
        </h2>
    </article>
    <article class="text-justify">
        {!! $employmentArea ?? 'Sin información' !!}
    </article>

    {{-- <div class="grid grid-cols-4 gap-3">
        @foreach ($workPlaces as $place)
        <article class="rounded-lg p-3 bg-gray-400">
            {{ $place->sitio }}
        </article>
        @endforeach
    </div> --}}
</section>
{{-- employment area --}}

{{-- educational program --}}
<section x-data="subjects" class="container relative mx-auto mt-20">
    <article class="flex justify-center items-center">
        <h2 class="text-3xl text-center">
            Plan de <span class="text-area">estudios</span>
        </h2>
        <div class="inline-block relative">
            <img src="{{ asset('images/carrera/iconos/plan-de-estudios.png') }}" alt="Ícono plan de estudios" class="w-28 ms-3">
            @if ($showDualEducationMessage)
            <img class="absolute top-0 end-0 w-30 -mx-10 -my-5 rotate-35" src="{{ asset('images/carrera/iconos/stamp-formacion-dual.png') }}" alt="Indicador formación dual" title="Esta licecnciatura permite realizar formación dual">
            @endif
        </div>
    </article>

    {{-- <h3 class="text-end text-xl">Mínimo y máximo de créditos: <span class="text-area font-black">{{ $creditos ?? 'Sin información' }}</span></h3> --}}

    @if ($showDualEducationMessage)
    <h2 class="text-center color-buap-h mt-10">
        *Para cursar el Área de Especialización Disciplinar Dual debe cumplir con los lineamientos de la Convocatoria de Formación Dual de la Facultad de Ingeniería
    </h2>
    @endif

    @if ( $withTerminals )
    {{-- selector de terminales --}}
    <section class="text-center mt-10">
        Seleccione un Área de Especialidad:
        <div class="inline-block relative w-fit">
            <select @change="setTerminalSubjects($event.target.value)" class="select-area appearance-none w-full p-2 pe-7 rounded-xl" id="input-terminal-area">
                @foreach ($terminals as $terminal => $_subjects)
                <option value="{{ $terminal }}">{{ $terminal }}</option>
                @endforeach
            </select>
            <span class="absolute end-0 top-1/2 -translate-y-1/2 me-2 text-white">
                <i class="fa-solid fa-chevron-down"></i>
            </span>
        </div>
    </section>
    {{-- selector de terminales --}}

    {{-- colorimetría --}}
    <x-offer.simbologia.derecho :terminals="$terminals"></x-offer.simbologia.derecho>
    {{-- colorimetría --}}
    @endif

    @if ( $showUPAMessage )
    <h2 class="text-center color-buap-l mt-10"><b>Este plan de estudios se imparte en la Universidad Para Adultos (UpA)</b></h2>
    @endif

    @if ( $haveANote )
    <section class="mt-10">
        @if ( $educationalProgramId == 194 )
        <x-offer.notes.contaduria-publica></x-offer.notes.contaduria-publica>
        @endif
    </section>
    @endif

    <h2 class="text-center color-buap-h mt-10">
        *En caso de cursar <b>todas tus asignaturas en tiempo y forma por semestre</b>
    </h2>

    @if ( !$showOld )
    {{-- controls --}}
    <button @click="previousSemester" type="button" class="absolute z-10 top-1/2 start-0 size-10 rounded-md -translate-y-1/2 bg-(--azul-buap-h) hover:bg-(--azul-buap-l) text-white hover:shadow-md">
        <i class="fa-solid fa-arrow-left"></i>
    </button>
    <button @click="nextSemester" type="button" class="absolute z-10 top-1/2 end-0 size-10 rounded-md -translate-y-1/2 bg-(--azul-buap-h) hover:bg-(--azul-buap-l) text-white hover:shadow-md">
        <i class="fa-solid fa-arrow-right"></i>
    </button>
    {{-- controls --}}

    {{-- regular subjects & terminals --}}
    <section {{-- @scroll="shadowIndicators($el)" --}} id="semesters" class="eahf-light-scroll overflow-x-auto mt-10 p-2">
        <div class="inline-flex">
            @foreach ($subjects as $semester => $areas)
            <article @click="activeSemester = '{{ $semester }}'" :class="activeSemester == '{{ $semester }}' ? 'active' : ''" id="semesterContainer{{ $semester }}" class="semester bg-area-hover group inline-block w-96 rounded-xl me-3 px-3 py-10 border-2 border-gray-500 overflow-hidden relative">
                {{-- banda --}}
                <div id="areaBand{{ $semester }}" :style="`background-color: ${terminalColor};`" class="areaBand absolute top-5 -right-20 w-60 h-5 text-white rotate-45 text-center hidden">
                    Terminales
                </div>
                {{-- banda --}}

                {{-- # semester --}}
                <header class="flex justify-center items-center font-black group-hover:text-shadow-sm text-shadow-black">
                    <div class="flex justify-center items-center">
                        {!! $semesters[ $semester ]['icon'] !!}
                    </div>
                    <h2 class="text-2xl">
                        <span class="color-buap-l">
                            {{ $semesters[ $semester ]['text'] }}
                        </span>
                        <br>
                        <span class="group-hover:text-white">
                            @if ( $semester === "2.5" || $semester === "4.5" || $semester === "6.5" || $semester === "8.5" || $semester === "10.5" )
                            Interperiodo
                            @else
                            Semestre
                            @endif
                        </span>
                    </h2>
                </header>
                {{-- # semester --}}

                {{-- subjects --}}
                <ul id="semester{{ $semester }}" class="list-disc ms-5">
                    @foreach ($areas as $_area => $_subjects)
                    @if($_area === "Área Falsa")
                        @break
                    @endif
                    <li class="list-none mt-3 font-bold group-hover:text-white group-hover:text-shadow-sm text-shadow-black">{{ $_area }}</li>
                    @foreach ($_subjects as $subject)
                    <li>{{ $subject['subject']['title'] }}</li>
                    @endforeach
                    @endforeach
                </ul>
                {{-- subjects --}}
            </article>
            @endforeach
        </div>
    </section>
    {{-- regular subjects & terminals --}}

    {{-- optative subjects --}}
    @if ( sizeof($optativeComplementarySubjects) > 0 )
    <section>
        <article class="eahf-light-scroll overflow-x-auto bg-area-hover group rounded-xl me-3 px-3 py-3 border-2 border-gray-500">
            {{-- area --}}
            <header class="flex justify-center items-center font-black group-hover:text-shadow-sm text-shadow-black">
                <h2 class="w-full text-2xl text-start">
                    <span class="group-hover:text-white">
                        Área de Optativas - Complementarias
                    </span>
                </h2>
            </header>
            {{-- area --}}

            <div class="flex justify-start items-start">
            @foreach ($optativeComplementarySubjects as $semester => $areas)
            {{-- subjects --}}
            <div class="ms-5">
                @foreach ($areas as $_area => $_subjects)
                <ul class="list-disc inline-block w-fit min-w-60 my-5 me-10">
                    <li class="list-none flex justify-start items-center mt-3 font-bold group-hover:text-white group-hover:text-shadow-sm text-shadow-black">
                        {!! $semesters[$semester]['icon'] !!}
                        <h3 class="text-lg">
                            {{ $semesters[$semester]['text'] }}
                            <br>
                            Semestre
                        </h3>
                    </li>
                    @foreach ($_subjects as $subject)
                    <li>{{ $subject['subject']['title'] }}</li>
                    @endforeach
                </ul>
                @endforeach
            </div>
            {{-- subjects --}}
            @endforeach
            </div>
        </article>
    </section>
    @endif
    {{-- optative subjects --}}
    @else
    <iframe src="{{ $showOld->url }}" frameborder="0" class="w-full min-h-225 rounded-2xl"></iframe>
    @endif
</section>
{{-- educational program --}}

{{-- admission profile --}}
<section class="container mx-auto mt-20">
    <div class="grid grid-cols-3">
        {{-- card --}}
        <article class="col-span-3 order-2 md:order-1 md:col-span-2 pt-16">
            <div class="relative w-fit mx-auto">
                <img src="{{ asset('images/carrera/iconos/perfil-ingreso.png') }}" alt="Icono perfil de ingreso" class="absolute top-0 end-0 w-28 me-10 -translate-y-1/2">
                <div class="bg-area rounded-3xl p-10 max-w-175 max-h-105 overflow-y-auto eahf-light-scroll mx-auto">
                    <header>
                        <h2 class="text-3xl text-start font-black">
                            Perfil de
                            <br>
                            <span class="color-buap-h">ingreso</span>
                        </h2>
                    </header>

                    {!! $profiles?->perfil_ingreso !!}
                </div>
            </div>
        </article>
        {{-- card --}}

        {{-- image --}}
        <article class="col-span-3 order-1 md:order-2 md:col-span-1">
            <img src="{{ asset('images/carrera/perfil-ingreso.png') }}" alt="IMAGEN PERFIL DE INGRESO" class="w-full">
        </article>
        {{-- image --}}
    </div>
</section>
{{-- admission profile --}}

{{-- graduation profile --}}
<section class="container mx-auto mt-20">
    <div class="grid grid-cols-3">
        {{-- card --}}
        <article class="col-span-3 order-2 md:col-span-2 pt-16">
            <div class="relative w-fit mx-auto">
                <img src="{{ asset('images/carrera/iconos/perfil-egreso.png') }}" alt="Icono perfil de egreso" class="absolute top-0 end-0 w-28 me-10 -translate-y-1/2">
                <div class="bg-area rounded-3xl p-10 max-w-175 max-h-105 overflow-y-auto eahf-light-scroll mx-auto">
                    <header>
                        <h2 class="text-3xl text-start font-black">
                            Perfil de
                            <br>
                            <span class="color-buap-h">Egreso</span>
                        </h2>
                    </header>

                    {!! $profiles?->perfil_egreso !!}
                </div>
            </div>
        </article>
        {{-- card --}}

        {{-- image --}}
        <article class="col-span-3 order-1 md:col-span-1">
            <img src="{{ asset($profileImages?->egreso) }}" alt="IMAGEN PERFIL DE EGRESO" class="w-full">
        </article>
        {{-- image --}}
    </div>
</section>
{{-- graduation profile --}}

{{-- virtual tours --}}
@if ($virtualTour)
<section class="container mx-auto mt-20">
    <article class="flex justify-center items-center">
        <img src="{{ asset('images/carrera/iconos/recorrido-virtual.png') }}" alt="Ícono tour virtual" class="w-28 me-3">
        <h2 class="text-3xl text-center font-black">
            Recorrido
            <br>
            <span class="text-area">virtual</span>
        </h2>
    </article>

    <article class="mt-10">
        <div class="text-[15px] text-center">
            Información obtenida del Departamento de Planta Física BUAP | <a href="https://plantafisica.buap.mx" target="_blank" rel="noopener noreferrer" class="color-buap-l underline">https://plantafisica.buap.mx</a>
        </div>
        <iframe src="{{ $virtualTour }}" frameborder="0" class="w-full h-96 md:h-100 lg:h-125 rounded-2xl"></iframe>
    </article>
</section>
@endif
{{-- virtual tours --}}

{{-- campus, location, contact --}}
<section x-data="contact" class="container mx-auto mt-20">
    <div class="grid grid-cols-12 gap-2">
        {{-- card --}}
        <article class="col-span-12 md:col-span-4">
            <div class="relative mx-auto">
                <img src="{{ asset('images/carrera/iconos/contacto.png') }}" alt="Ícono contacto" class="absolute top-0 end-0 w-28 me-10 -translate-y-1/2">
                <div class="bg-buap-l rounded-3xl p-3 overflow-y-auto eahf-light-scroll mx-auto">
                    <header>
                        <h2 class="text-3xl text-start font-black text-white">
                            Sedes y
                            <br>
                            <span class="color-buap-h">ubicación</span>
                        </h2>
                    </header>

                    <template x-for="campus in offer" :key="campus.id">
                    <div>
                        <button @click="updateCampus(campus.id)" :class="{'bg-buap-h': active == campus.id, 'bg-buap-h-light': active != campus.id, 'opacity-50 cursor-not-allowed': !campus.coordinates}" type="button" class="w-full my-2 rounded-lg text-white">
                            <span x-html="`${campus.campus?.name}<br>(${campus.academic_unit.name})`"></span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                        <p x-show="active == campus.id" x-html="campus.contact?.contacto ?? 'Sin información'" class="rounded-lg p-2 bg-white"></p>
                    </div>
                    </template>
                </div>
            </div>
        </article>
        {{-- card --}}

        {{-- map --}}
        <article class="col-span-12 md:col-span-8 h-full bg-gray-300 rounded-md p-1">
            <div id="map" class="map min-h-96 h-full rounded-md"></div>
        </article>
        {{-- map --}}
    </div>
</section>
{{-- campus, location, contact --}}

{{-- images --}}
<section x-data="carrousel" class="container mx-auto mt-20">
    <article class="flex justify-center items-center">
        <img src="{{ asset('images/carrera/iconos/galeria-imagenes.png') }}" alt="Ícono galería de imágenes" class="w-28 me-3">
        <h2 class="text-3xl text-center font-black">
            Galería de
            <br>
            <span class="text-area">Imágenes</span>
        </h2>
    </article>

    <article class="eahf-light-scroll mt-10">
        <div class="inline-flex">
            <template x-for="campus in offer" :key="campus.id">
            <button @click="updateCampus(campus.id)" :class="{'bg-buap-h': activeCampus == campus.id, 'area-button': activeCampus != campus.id, 'opacity-50 cursor-not-allowed': campus.images.length == 0}" :disabled="campus.images.length == 0" type="button" class="inline-block w-75 my-2 me-2 px-3 py-1 rounded-lg text-white">
                <span x-html="`${campus.campus?.name}<br>(${campus.academic_unit.name})`"></span>
            </button>
            </template>
        </div>
    </article>

    <article class="mt-10 w-full">
        <section class="relative bg-neutral-900 rounded-2xl overflow-hidden shadow-2xl">
            {{-- main image --}}
            <div class="relative w-full aspect-video">
                <img
                    :src="assetsRoute.replace('__IMG__', activeImage.imagen)"
                    :alt="activeImage.created_at"
                    class="w-full h-full rounded-2xl object-cover transition-all duration-500 ease-in-out"
                >

                {{-- averlay inferor clack - to-transparent --}}
                {{-- <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent"></div> --}}

                {{-- button to left --}}
                <button
                    @click="previousImage"
                    class="absolute top-1/2 -translate-y-1/2 left-4 z-10
                        bg-black/20 hover:bg-black/40
                        text-white rounded-full
                        backdrop-blur-md transition
                        size-10"
                >
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                {{-- button to left --}}

                {{-- button to right --}}
                <button
                    @click="nextImage"
                    class="absolute top-1/2 -translate-y-1/2 right-4 z-10
                        bg-black/20 hover:bg-black/40
                        text-white rounded-full
                        backdrop-blur-md transition
                        size-10"
                >
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
                {{-- button to right --}}
            </div>
            {{-- main image --}}

            {{-- miniaturas --}}
            <div class="flex gap-4 p-4 overflow-x-auto scrollbar-hide bg-neutral-950">
                <template x-for="(image, index) in images" :key="image.id">
                    <img
                        @click="setActive(index)"
                        :src="assetsRoute.replace('__IMG__', image.imagen)"
                        class="w-24 h-16 md:w-28 md:h-20 object-cover rounded-lg cursor-pointer"
                        :class="index === activeImageIndex
                                ? 'ring-2 ring-blue-500 scale-105'
                                : 'opacity-70 hover:opacity-100'"
                    >
                </template>
            </div>
            {{-- miniaturas --}}
        </section>
    </article>
</section>
{{-- images --}}

{{-- spacer --}}
<br><br><br><br><br><br><br><br><br><br>
{{-- spacer --}}
@endsection

@section('footer')
@endsection

@section('js')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('search', () => ({
        searchParam: '',
        open: false,
        results: [],
        educationalPrograms: @json($educationalPrograms),
        educationalProgramRoute: '{{ route("educational-program", ["educationalProgram" => "__KEY__"]) }}',
        search( param ) {
            this.results = this.educationalPrograms.filter( element => element.name.toLowerCase().includes(param.toLowerCase()) )
        },
        to( key ) {
            return this.educationalProgramRoute.replace('__KEY__', key)
        }
    }))

    Alpine.data('subjects', () => ({
        disciplinaryElectives: @json($optativeDisciplinarySubjects),
        terminalDisciplinaryElectives: @json($terminals),
        semesterCount: @json($semesterCount),
        semesters: @json($semestersList),
        activeSemester: "1",
        semestersWithTerminals: [],
        terminalColor: '',
        init() {
            // calc box-shadow
            // const semesters = document.getElementById('semesters')
            // if ( semesters ) {
            //     this.shadowIndicators(semesters)
            // }

            // validate empty structure
            if ( Object.keys(this.disciplinaryElectives).length > 0 ) {


                Object.keys(this.disciplinaryElectives).forEach( semester => {
                    // get html container (semester ul)
                    semesterList = document.getElementById('semester' + semester)
                    if (!semesterList) {
                        return
                    }

                    // iterate areas
                    Object.keys(this.disciplinaryElectives[semester]).forEach( area => {
                        // add area name
                        const title = document.createElement('li')
                        title.textContent = area
                        title.classList.add('dinamic-subject','mt-3','list-none','font-bold','group-hover:text-white','group-hover:text-shadow-sm','text-shadow-black')
                        semesterList.appendChild(title)

                        // iterate subjects - sorted by title
                        const sortedSubjects = Object.keys(this.disciplinaryElectives[semester][area]).sort((a, b) =>
                            this.disciplinaryElectives[semester][area][a].subject.title.localeCompare(this.disciplinaryElectives[semester][area][b].subject.title)
                        )
                        sortedSubjects.forEach( subject => {
                            // add subjects
                            const _subject = document.createElement('li')
                            _subject.textContent = this.disciplinaryElectives[semester][area][subject].subject.title
                            _subject.classList.add('dinamic-subject')
                            semesterList.appendChild(_subject)
                        } )
                    })
                })
            }

            // validate empty structure
            if ( Object.keys(this.terminalDisciplinaryElectives).length > 0 ) {
                // show first terminal
                firstArea = Object.keys(this.terminalDisciplinaryElectives)[0]

                // get area´s subjects
                data = this.terminalDisciplinaryElectives[firstArea]

                // var to redirect view
                index = 0
                firstSemesterWithArea = null

                // iterate semesters
                Object.keys(data).forEach( semester => {
                    // collect semesters with terminal subjects (store as number)
                    this.semestersWithTerminals.push(Number(semester))

                    // get html container (semester ul)
                    semesterList = document.getElementById('semester' + semester)
                    if (!semesterList) {
                        return
                    }

                    // collect first semester
                    if (index == 0) { firstSemesterWithArea = semester }

                    // iterate areas
                    Object.keys(data[semester]).forEach( area => {
                        // add area name
                        const title = document.createElement('li')
                        title.textContent = area
                        title.classList.add('dinamic-subject','mt-3','list-none','font-bold','group-hover:text-white','group-hover:text-shadow-sm','text-shadow-black')
                        semesterList.appendChild(title)

                        // iterate subjects - sorted by title
                        const sortedSubjects = Object.keys(data[semester][area]).sort((a, b) =>
                            data[semester][area][a].subject.title.localeCompare(data[semester][area][b].subject.title)
                        )
                        sortedSubjects.forEach( subject => {
                            // add subjects
                            const _subject = document.createElement('li')
                            _subject.textContent = data[semester][area][subject].subject.title
                            _subject.classList.add('dinamic-subject')
                            semesterList.appendChild(_subject)
                            // collect terminal color
                            if (index == 0) {this.terminalColor = data[semester][area][subject].area.color; index++;}
                        } )
                    })
                } )
                Array.from(document.getElementsByClassName("areaBand")).forEach(area => area.classList.add("hidden"))
                this.semestersWithTerminals.forEach(semester => document.getElementById('areaBand' + semester).classList.remove('hidden'))
            }
        },
        // shadowIndicators(semesters) {
        //     const maxScroll = semesters.scrollWidth - semesters.clientWidth
        //     const current = semesters.scrollLeft
        //     const threshold = 5  // margen de tolerancia

        //     const hasLeft = current > threshold
        //     const hasRight = current < (maxScroll - threshold)

        //     semesters.classList.remove(
        //         'shadow-left',
        //         'shadow-right',
        //         'both-shadows'
        //     )

        //     if (hasLeft && hasRight) {
        //         semesters.classList.add('both-shadows')
        //     } else if (hasLeft) {
        //         semesters.classList.add('shadow-right')
        //     } else if (hasRight) {
        //         semesters.classList.add('shadow-left')
        //     }
        // },
        setTerminalSubjects(area) {
            // remove dinamic semester bands
            this.semestersWithTerminals = []

            /* remove actual dinamic subjects */
            const actualSubjects = document.querySelectorAll('.dinamic-subject')
            actualSubjects.forEach(subject => subject.remove())

            // get area´s subjects
            data = this.terminalDisciplinaryElectives[area]

            // var to redirect view
            index = 0
            firstSemesterWithArea = null

            // iterate semesters
            Object.keys(data).forEach( semester => {
                // collect semesters with terminal subjects (store as number)
                this.semestersWithTerminals.push(Number(semester))

                // get html container (semester ul)
                semesterList = document.getElementById('semester' + semester)
                if (!semesterList) {
                    return
                }

                // collect first semester
                if (index == 0) { firstSemesterWithArea = (semester - 1) }

                // iterate areas
                Object.keys(data[semester]).forEach( area => {
                    // add area name
                    const title = document.createElement('li')
                    title.textContent = area
                    title.classList.add('dinamic-subject','mt-3','list-none','font-bold','group-hover:text-white','group-hover:text-shadow-sm','text-shadow-black')
                    semesterList.appendChild(title)

                    // iterate subjects - sorted by title
                    const sortedSubjects = Object.keys(data[semester][area]).sort((a, b) =>
                        data[semester][area][a].subject.title.localeCompare(data[semester][area][b].subject.title)
                    )
                    sortedSubjects.forEach( subject => {
                        // add subjects
                        const _subject = document.createElement('li')
                        _subject.textContent = data[semester][area][subject].subject.title
                        _subject.classList.add('dinamic-subject')
                        semesterList.appendChild(_subject)
                        // collect terminal color
                        if (index == 0) {this.terminalColor = data[semester][area][subject].area.color; index++;}
                    } )
                })
            } )
            Array.from(document.getElementsByClassName("areaBand")).forEach(area => area.classList.add("hidden"))
            this.semestersWithTerminals.forEach(semester => document.getElementById('areaBand' + semester).classList.remove('hidden'))
            const container = document.getElementById("semesters")
            const element = document.getElementById("semesterContainer" + firstSemesterWithArea)
            container.scrollLeft = element.offsetLeft
        },
        previousSemester() {
            // calc index to translate view
            index = this.semesters.indexOf( this.activeSemester )
            newIndex = ((index - 1) + this.semesterCount) % this.semesterCount
            this.activeSemester = this.semesters[ newIndex ]

            const toView = document.getElementById('semesterContainer' + this.activeSemester)

            const container = document.getElementById("semesters")
            container.scrollLeft = toView.offsetLeft
        },
        nextSemester() {
            // calc index to translate view
            index = this.semesters.indexOf( this.activeSemester )
            newIndex = (index + 1) % this.semesterCount
            this.activeSemester = this.semesters[ newIndex ]

            const toView = document.getElementById('semesterContainer' + this.activeSemester)

            const container = document.getElementById("semesters")
            container.scrollLeft = toView.offsetLeft
        }
    }))

    Alpine.data('contact', () => ({
        offer: @json($offer),
        active:  @json($offerId),
        map: null,
        marker: null,
        init() {
            // default center
            centerPoint = [-98.200647, 19.000530]

            // tryna get selected campus
            const campus = this.offer.find(item => item.id === this.active)
            if (campus && campus.coordinates) {
                centerPoint = [campus.coordinates.longitud, campus.coordinates.latitud]
            }

            // create map instance
            this.map = new maplibregl.Map({
                container: 'map',
                style: '{{ asset('map-styles/bright.json') }}',
                center: centerPoint,
                zoom: 14,
            })

            // add marker
            this.map.on('load', () => {
                this.map.resize()
                this.marker = new maplibregl.Marker()
                    .setLngLat(centerPoint)
                    .addTo(this.map)
            })
        },
        updateCampus(index) {
            const campus = this.offer.find(item => item.id === index)
            if (!campus || !campus.coordinates) return

            this.active = index

            this.marker.setLngLat([
                campus.coordinates.longitud,
                campus.coordinates.latitud
            ])

            this.map.flyTo({
                center: [
                    campus.coordinates.longitud,
                    campus.coordinates.latitud
                ],
                zoom: 14,
                essential: true
            })
        },
    }))

    Alpine.data('carrousel', () => ({
        offer: @js($offer),
        activeCampus: @json($offerId),
        activeImage: {
            'imagen': 'arena-buap.jpg',
            'created_at': 'sin información',
        },
        activeImageIndex: 0,
        images: [],
        imagesCount: 0,
        assetsRoute: '{{ asset("storage/__IMG__") }}',
        init() {
            // validate images existence
            if (!this.offer || this.offer.length === 0) return

            // set active campus
            const campus = this.offer.find(campus => campus.id == this.activeCampus)
            this.images = campus.images

            // set active campus images
            this.imagesCount = this.images.length
            if ( this.imagesCount > 0 ) {
                this.activeImage = this.images[this.activeImageIndex]
            }
        },
        updateCampus(index) {
            // set selected campus active
            this.activeCampus = index
            const campus = this.offer.find(campus => campus.id == this.activeCampus)

            // validate images existence
            if (!campus.images) return

            // set active campus images
            this.images = campus.images
            this.imagesCount = this.images.length

            // set first image as active
            if ( this.imagesCount > 0 ) {
                this.activeImageIndex = 0
                this.activeImage = this.images[this.activeImageIndex]
            } else {
                this.activeImage = {
                    'imagen': 'arena-buap.jpg',
                    'created_at': 'sin información',
                }
            }
        },
        previousImage() {
            this.activeImageIndex = ((this.activeImageIndex - 1) + this.imagesCount) % this.imagesCount
            this.activeImage = this.images[this.activeImageIndex] ?? this.images[0]
        },
        nextImage() {
            this.activeImageIndex = (this.activeImageIndex + 1) % this.imagesCount
            this.activeImage = this.images[this.activeImageIndex] ?? this.images[0]
        },
        setActive(index) {
            if ( this.images[index] ) {
                this.activeImageIndex = index
            } else {
                this.activeImageIndex = 0
            }

            this.activeImage = this.images[this.activeImageIndex]
        },
    }))
})
</script>
@endsection
