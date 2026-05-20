@extends('layouts.app')

@section('css')
@endsection

@section('header')
@endsection

@section('content')
{{-- video --}}
<section>
    <article>
        <video id="miVideo" class="w-full" src="{{ asset('multimedia/index-video-wide.mp4') }}" autoplay muted loop controls playsinline></video>
    </article>
</section>
{{-- video --}}

{{-- title --}}
<section class="container mx-auto mt-10">
    <article class="text-center">
        <h1 class="color-buap-l text-2xl font-black">Oferta Educativa 2026:</h1>
        <h3 class="color-buap-h text-2xl font-bold">Profesional Asociado, Técnico Superior Universitario y Licenciaturas</h3>
    </article>
</section>
{{-- title --}}

<hr>

{{-- browser --}}
<section x-data="search" class="container mx-auto mt-10">
    {{-- button set --}}
    <article class="grid grid-cols-12 gap-3">
        <div class="col-span-6 md:col-span-2">
            <button
                @click="searchCategory('educationalPrograms')"
                :class="(activeCategory == 'educationalPrograms') ? 'active' : ''"
                type="button"
                class="w-full py-1 px-3 color-buap-h hvr-underline-from-left"
            >Programa / Carrera</button>
        </div>
        <div class="col-span-6 md:col-span-2">
            <button
                @click="searchCategory('campus')"
                :class="(activeCategory == 'campus') ? 'active' : ''"
                type="button"
                class="w-full py-1 px-3 color-buap-h hvr-underline-from-left"
            >Sedes</button>
        </div>
        <div class="col-span-6 md:col-span-2">
            <button
                @click="searchCategory('academicUnits')"
                :class="(activeCategory == 'academicUnits') ? 'active' : ''"
                type="button"
                class="w-full py-1 px-3 color-buap-h hvr-underline-from-left"
            >Unidad Académica</button>
        </div>
        <div class="col-span-6 md:col-span-2">
            <button
                @click="searchCategory('modalities')"
                :class="(activeCategory == 'modalities') ? 'active' : ''"
                type="button"
                class="w-full py-1 px-3 color-buap-h hvr-underline-from-left"
            >Modalidad</button>
        </div>
        <div class="col-span-12 md:col-span-2">
            <a @click="$dispatch('view-new')" href="#main" class="w-full py-1 px-3 color-buap-h hvr-underline-from-left">Nueva Oferta Educativa</a>
        </div>
        <div class="col-span-12 md:col-span-2">
            <a target="_blank" href="http://www.miespaciodgems.buap.mx/oferta-educativa-dems/index.php" class="w-full py-1 px-3 text-center color-buap-h hvr-underline-from-left">Oferta Media Superior</a>
        </div>
    </article>
    {{-- button set --}}

    {{-- input --}}
    <article class="mt-10">
        <div class="relative">
            <input x-model="searchParam" @click="open = true" @input="search($el.value); open = true" :placeholder="placeholder" type="text" id="search" class="w-full p-3 rounded-full bg-white border border-gray-100 shadow"
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
            <template x-for="(item, index) in results" :key="activeCategory+'-'+item.key">
            <a x-text="item.name" :href="to(item.key)" class="block p-3 hover:bg-gray-100 border-b last:border-b-0"></a>
            </template>
        </div>
    </article>
    {{-- input --}}
</section>
{{-- browser --}}

{{-- main --}}
<section x-data="dinamicContent" id="main" class="container mx-auto mt-20" @view-new.window="viewNew">
    <h1 class="text-2xl font-black text-center mb-5">Entérate de nuestra Oferta Educativa en la <span class="color-buap-l">BUAP</span></h1>

    <article class="grid grid-cols-12 gap-3">
        {{-- button set --}}
        <section class="col-span-4 flex flex-col justify-start items-center">
            <template x-if="offer.length">
            <template x-for="(category, index) in offer" :key="index">
            <article class="w-full">
                <button @click="viewCategory(category)" :class="activeCategory == category.class ? category.class + ' active' : category.class" class="fancy-button relative">
                    <span x-text="category.nombre"></span>
                    <span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </span>
                    <span class="absolute top-0 end-0">
                        <img :src="category.icon" :alt="category.nombre" class="fancy-icon size-20">
                    </span>
                </button>
            </article>
            </template>
            </template>
        </section>
        {{-- button set --}}

        {{-- dinamic content --}}
        <section class="col-span-8 min-h-137.5">
            <div class="h-full rounded-2xl bg-cover bg-center bg-no-repeat grid grid-cols-2 gap-4" :style="`background-image: url('${img}');`">
                {{-- aus list --}}
                <aside class="rounded-2xl bg-[rgba(255,255,255,0.6)] m-1 p-3 overflow-y-auto eahf-light-scroll">
                    <h3 class="text-sm font-bold mb-3 text-gray-800"
                        x-text="`Unidades Académicas (${auCount})`">
                    </h3>

                    <template x-for="(au, index) in aus" :key="au.id">
                    <article>
                        <button
                            @click="viewAcademicUnit(au)"
                            type="button"
                            class="fancy-button-au w-full font-bold rounded-md p-3 mb-2 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg flex justify-between items-center"
                            :class="(activeAcademicUnit == au.id) ? `active au-${activeCategory}` : `au-${activeCategory}`"
                        >
                            <span x-text="au.name" class="text-start"></span>
                            <span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </span>
                        </button>
                    </article>
                    </template>
                </aside>
                {{-- aus list --}}

                {{-- eps list --}}
                <aside class="rounded-2xl bg-[rgba(217,217,217,0.7)] m-1 p-3 overflow-y-auto eahf-light-scroll">
                    <h3 class="text-sm font-bold mb-3 text-gray-800"
                        x-text="`Planes de estudio (${epCount})`">
                    </h3>

                    <ul class="list-disc ps-5">
                        <template x-for="(ep, index) in eps" :key="index">
                        <li>
                            {{-- quantic jump --}}
                            <a :href="routeEducationalProgram.replace('__PE__', ep.id)" x-html="`${ep.name}<br>(${ep.campus})`" class="hover:underline color-buap-h"></a>
                            {{-- quantic jump --}}
                        </li>
                        </template>
                    </ul>
                </aside>
                {{-- eps list --}}
            </div>
        </section>
        {{-- dinamic content --}}
    </article>
</section>
{{-- main --}}

{{-- interactive maps --}}
<section class="container mx-auto mt-20">
    <h1 class="text-2xl font-black text-center mb-5">
        Mapas <span class="color-buap-l">Interactivos</span>
    </h1>

    <div class="grid grid-cols-2 gap-3 w-fit mx-auto">
        <article class="col-span-2 text-[15px] text-center">
            Información obtenida del Departamento de Planta Física BUAP | <a href="https://plantafisica.buap.mx" target="_blank" rel="noopener noreferrer" class="color-buap-l underline">https://plantafisica.buap.mx</a>
        </article>
        <article class="col-span-2 md:col-span-1 bg-gray-300 p-5 flex justify-center items-center group relative">
            <img src="{{ asset('images/main-page/cu.jpg') }}" class="w-96 h-72" alt="Campus Ciudad Universitaria">
            <a target="_blank" href="https://recorridosvirtuales.buap.mx/mapa-cu/" class="absolute top-1/2 start-1/2 -translate-1/2 flex justify-center items-center size-0 min-w-fit group-hover:size-full p-5 bg-white group-hover:bg-[#74faff8b] group-hover:text-white font-black group-hover:text-2xl rounded-2xl group-hover:rounded-none transition-discrete duration-700">
                Ciudad Universitaria
            </a>
        </article>
        <article class="col-span-2 md:col-span-1 bg-gray-300 p-5 flex justify-center items-center group relative">
            <img src="{{ asset('images/main-page/centro.jpg') }}" class="w-96 h-72" alt="Campus Centro">
            <a target="_blank" href="https://recorridosvirtuales.buap.mx/mapa-centro/" class="absolute top-1/2 start-1/2 -translate-1/2 flex justify-center items-center size-0 min-w-fit group-hover:size-full p-5 bg-white group-hover:bg-[#74faff8b] group-hover:text-white font-black group-hover:text-2xl rounded-2xl group-hover:rounded-none transition-discrete duration-700">
                Centro
            </a>
        </article>
        <article class="col-span-2 md:col-span-1 bg-gray-300 p-5 flex justify-center items-center group relative">
            <img src="{{ asset('images/main-page/salud.jpg') }}" class="w-96 h-72" alt="Campus Salud">
            <a target="_blank" href="https://recorridosvirtuales.buap.mx/mapa-salud/" class="absolute top-1/2 start-1/2 -translate-1/2 flex justify-center items-center size-0 min-w-fit group-hover:size-full p-5 bg-white group-hover:bg-[#74faff8b] group-hover:text-white font-black group-hover:text-2xl rounded-2xl group-hover:rounded-none transition-discrete duration-700">
                Salud
            </a>
        </article>
        <article class="col-span-2 md:col-span-1 bg-gray-300 p-5 flex justify-center items-center group relative">
            <img src="{{ asset('images/main-page/atlixcayotl.jpg') }}" class="w-96 h-72" alt="Campus Atlixcayotl">
            <a target="_blank" href="https://recorridosvirtuales.buap.mx/mapa-atlixcayotl/" class="absolute top-1/2 start-1/2 -translate-1/2 flex justify-center items-center size-0 min-w-fit group-hover:size-full p-5 bg-white group-hover:bg-[#74faff8b] group-hover:text-white font-black group-hover:text-2xl rounded-2xl group-hover:rounded-none transition-discrete duration-700">
                Atlixcayotl
            </a>
        </article>
    </div>
</section>
{{-- interactive maps --}}

{{-- map --}}
<section class="container mx-auto mt-20">
    <h1 class="text-2xl font-black text-center mb-5">
        Zona de Influencia de la <span class="color-buap-l">BUAP</span> en el <span class="color-buap-l">Estado de Puebla</span>
    </h1>

    <article class="relative p-3">
        <div id="map" class="map h-162.5"></div>
    </article>
</section>
{{-- map --}}

<br><br><br><br><br><br><br><br><br><br>
@endsection

@section('footer')
@endsection

@section('js')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('search', () => ({
            activeCategory: '',
            placeholder: '',
            searchParam: '',
            open: false,
            results: [],
            educationalPrograms: @json($educationalPrograms),
            campus: @json($campus),
            academicUnits: @json($academicUnits),
            modalities: @json($modalities),
            educationalProgramRoute: '{{ route("educational-program", ["educationalProgram" => "__KEY__"]) }}',
            campusRoute: '{{ route("campus", ["campus" => "__KEY__"]) }}',
            academicUnitRoute: '{{ route("academic-unit", ["academicUnit" => "__KEY__"]) }}',
            modalityRoute: '{{ route("modality", ["modality" => "__KEY__"]) }}',
            init() {
                this.activeCategory = 'educationalPrograms'
                this.placeholder = 'Encuentra Licenciaturas'
                this.results = this.educationalPrograms
            },
            searchCategory( category ) {
                this.activeCategory = category
                this.searchParam = ''
                switch ( category ) {
                    case 'educationalPrograms':
                        this.results = this.educationalPrograms
                        this.placeholder = 'Encuentra Licenciaturas'
                        break
                    case 'campus':
                        this.results = this.campus
                        this.placeholder = 'Encuentra Sedes BUAP'
                        break
                    case 'academicUnits':
                        this.results = this.academicUnits
                        this.placeholder = 'Encuentra Facultades y Complejos Regionales'
                        break
                    case 'modalities':
                        this.results = this.modalities
                        this.placeholder = 'Encuentra Modalidades'
                        break
                    default:
                        this.results = []
                        this.placeholder = 'Encuentra Licenciaturas'
                        break
                }
            },
            search( param ) {
                switch (this.activeCategory) {
                    case 'educationalPrograms':
                        this.results = this.educationalPrograms.filter( element => element.name.toLowerCase().includes(param.toLowerCase()) )
                        break
                    case 'campus':
                        this.results = this.campus.filter( element => element.name.toLowerCase().includes(param.toLowerCase()) )
                        break
                    case 'academicUnits':
                        this.results = this.academicUnits.filter( element => element.name.toLowerCase().includes(param.toLowerCase()) )
                        break
                    case 'modalities':
                        this.results = this.modalities.filter( element => element.name.toLowerCase().includes(param.toLowerCase()) )
                        break
                    default:
                        this.results = []
                        break
                }
            },
            to( key ) {
                switch (this.activeCategory) {
                    case 'educationalPrograms':
                        return this.educationalProgramRoute.replace('__KEY__', key)
                        break
                    case 'campus':
                        return this.campusRoute.replace('__KEY__', key)
                        break
                    case 'academicUnits':
                        return this.academicUnitRoute.replace('__KEY__', key)
                        break
                    case 'modalities':
                        return this.modalityRoute.replace('__KEY__', key)
                        break
                    default:
                        return this.educationalProgramRoute.replace('__KEY__', key)
                        break
                }
            }
        }))
    })

    document.addEventListener('alpine:init', () => {
        Alpine.data('dinamicContent', () => ({
            offer: @json($main),
            newOffer: @json($newOffer),
            activeCategory: '',
            activeAcademicUnit: '',
            img: @json($img),
            aus: [],
            eps: [],
            auCount: 0,
            epCount: 0,
            ausColor: '',
            ausColorAccent: '',
            routeEducationalProgram: '{{ route("educational-program", ["educationalProgram" => "__PE__"]) }}',

            viewCategory(active) {
                this.activeCategory = active.class
                this.img = active.img
                this.aus = active.aus
                this.auCount = Object.keys(this.aus).length
                this.epCount = 0
                this.eps = []
                this.activeAcademicUnit = ''
                this.ausColor = active.color_fondo_low
                this.ausColorAccent = active.color_fondo_high
            },

            viewAcademicUnit(active) {
                this.activeAcademicUnit = active.id
                this.eps = active.eps
                this.epCount = Object.keys(this.eps).length
            },

            viewNew() {
                this.activeCategory = this.newOffer.class
                this.img = this.newOffer.img
                this.aus = this.newOffer.aus
                this.auCount = Object.keys(this.aus).length
                this.epCount = 0
                this.eps = []
                this.activeAcademicUnit = ''
                this.ausColor = this.newOffer.color_fondo_low
                this.ausColorAccent = this.newOffer.color_fondo_high
            }
        }))
    })

    document.addEventListener('DOMContentLoaded', () => {
        // Inicializar el mapa
        const map = new maplibregl.Map({
            container: 'map',
            style: '{{ asset('map-styles/bright.json') }}',
            // style: '{{ asset('map-styles/liberty.json') }}',
            // style: '{{ asset('map-styles/positron.json') }}',
            center: [-97.828579, 19.207436],
            zoom: 7,
            pitch: 45,
        });

        map.addControl(new maplibregl.NavigationControl(), 'top-right');

        map.on('load', () => {
            // =====================
            // FUENTES
            // =====================
            map.addSource('buap-boundary', {
                type: 'geojson',
                data: '{{ asset('geojson/municipios-buap.min.geojson') }}',
                promoteId: 'CVEGEO'
            });

            map.addSource('puebla-boundary', {
                type: 'geojson',
                data: '{{ asset('geojson/municipios-puebla.min.geojson') }}'
            });

            // =====================
            // CAPA 3D BUAP
            // =====================
            map.addLayer({
            id: 'buap-fill',
            type: 'fill-extrusion',
            source: 'buap-boundary',
            paint: {
                'fill-extrusion-color': '#00C9F0',
                'fill-extrusion-height': [
                    'case',
                    ['boolean', ['feature-state', 'selected'], false],
                    12000, // altura al hacer clic
                    3000   // altura normal
                ],
                'fill-extrusion-base': 0,
                'fill-extrusion-opacity': 0.8,
                'fill-extrusion-vertical-gradient': false
            }
            });

            // =====================
            // CAPA PUEBLA (FONDO)
            // =====================
            map.addLayer({
                id: 'puebla-fill',
                type: 'fill',
                source: 'puebla-boundary',
                paint: {
                    'fill-color': '#002D4C',
                    'fill-opacity': 0.2
                }
            });

            // =====================
            // CONTORNO BUAP
            // =====================
            map.addLayer({
            id: 'buap-outline',
            type: 'line',
            source: 'buap-boundary',
            paint: {
                'line-color': '#002D4A',
                'line-width': 1
            }
            });

            // =====================
            // INTERACCIÓN
            // =====================
            let selectedId = null;

            map.on('click', 'buap-fill', (e) => {
                const feature = e.features[0];

                // bajar el anterior
                if (selectedId !== null) {
                    map.setFeatureState(
                        { source: 'buap-boundary', id: selectedId },
                        { selected: false }
                    );
                }

                // subir el actual
                selectedId = feature.id;
                map.setFeatureState(
                    { source: 'buap-boundary', id: selectedId },
                    { selected: true }
                );

                // popup
                new maplibregl.Popup()
                    .setLngLat(e.lngLat)
                    .setHTML(`<strong>${feature.properties.NOMGEO}</strong>`)
                    .addTo(map);
            });

            // cursor
            map.on('mouseenter', 'buap-fill', () => {
                map.getCanvas().style.cursor = 'pointer';
            });

            map.on('mouseleave', 'buap-fill', () => {
                map.getCanvas().style.cursor = '';
            });

        });
        });

</script>
@endsection
