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
    <main x-data="forms" class="p-2 grid grid-cols-12 gap-2">
        <x-dashboard.menu :action="'public-offer'" :esAdministrador="$esAdministrador"></x-dashboard.menu>
        {{-- menu sidebar --}}

        {{-- dinamic content --}}
        <article class="min-h-150 col-span-9 md:col-span-10 p-3 bg-gray-200 shadow-lg">
            {{-- actions bar --}}
            <nav class="grid grid-cols-12 gap-1 mb-3 pb-1 border-b border-(--azul-buap-l)">
                <article class="col-span-2">
                    <a title="regresar" href="{{ route('dashboard.public-offer') }}" class="px-3 py-2 rounded bg-(--azul-buap-h) text-white cursor-pointer flex justify-center items-center">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </article>
                <article class="col-span-10">
                    <h1 class="h-full text-center font-bold">{{ $offerName }}</h1>
                </article>
            </nav>
            {{-- actions bar --}}

            {{-- tabs --}}
            <x-dashboard.details.tab :offer="$offer" :origin="$canEditWhyStudy" :canEditUas="$canEditUas" :canEditDes="$canEditDes"></x-dashboard.details.tab>
            {{-- tabs --}}

            {{-- details form --}}
            <form action="{{ route('dashboard.details', ['offer' => $offerId]) }}" method="post" class="grid grid-cols-12 gap-3">
                @csrf
                <input x-model="active" type="hidden" name="form">
                {{-- para unidades académicas --}}

                @if ($canEditUas)
                @if ($canEditWhyStudy)
                {{-- porque estudiar ? --}}
                <section x-cloak x-show="active == 'whyStudy'" class="col-span-12">
                    <div class="text-end">
                        <label for="whyStudy">
                            <span class="group text-gray-400">
                                <i class="fa-solid fa-info"></i>
                            </span>
                            {{-- ¿Por qué estudiar? --}}
                        </label>
                    </div>
                    <textarea name="whyStudy" id="whyStudy">{{ old('whyStudy', $offer->educationalProgram?->whyStudy?->porque_estudiar ?? "¿Por qué estudiar este programa?") }}</textarea>
                </section>
                {{-- porque estudiar ? --}}
                @endif

                {{-- informes --}}
                <section x-cloak x-show="active == 'contact'" class="col-span-12">
                    <div class="text-end">
                        <label for="contact">
                            <span class="group text-gray-400">
                                <i class="fa-solid fa-info"></i>
                            </span>
                            {{-- Información de contacto --}}
                        </label>
                    </div>
                    <textarea name="contact" id="contact">{{ old('contact', $offer->contact?->contacto ?? "Dirección, teléfono, extensión, correo electrónico, página institucional, otros...") }}</textarea>
                </section>
                {{-- informes --}}

                {{-- coordenadas --}}
                <section x-cloak x-show="active == 'coordinates'" class="col-span-12">
                    <div class="text-end">
                        <label for="coordinates-x">
                            <span class="group text-gray-400">
                                <i class="fa-solid fa-info"></i>
                            </span>
                            {{-- Coordenadas --}}
                        </label>
                    </div>
                    <article class="grid grid-cols-2 gap-2">
                        <input value="{{ old('coordinates.x', $offer->coordinates?->latitud ?? "") }}" type="text" id="coordinates-x" name="coordinates[x]" class="col-span-2 md:col-span-1 px-2 py-1 bg-white rounded-md border border-gray-400" placeholder="latitud">
                        <input value="{{ old('coordinates.y', $offer->coordinates?->longitud ?? "") }}" type="text" id="coordinates-y" name="coordinates[y]" class="col-span-2 md:col-span-1 px-2 py-1 bg-white rounded-md border border-gray-400" placeholder="longitud">
                    </article>
                </section>
                {{-- coordenadas --}}
                @endif

                {{-- para unidades académicas --}}

                {{-- para des --}}

                @if ($canEditDes)
                {{-- perfil ingreso --}}
                <section x-cloak x-show="active == 'admissionProfile'" class="col-span-12">
                    <div class="text-end">
                        <label for="admissionProfile">
                            <span class="group text-gray-400">
                                <i class="fa-solid fa-info"></i>
                            </span>
                            {{-- Perfil de ingreso --}}
                        </label>
                    </div>
                    <textarea name="admissionProfile" id="admissionProfile">{{ old('admissionProfile', $offer->educationalProgram?->profiles?->perfil_ingreso ?? "Perfil de ingreso") }}</textarea>
                </section>
                {{-- perfil ingreso --}}

                {{-- perfil egreso --}}
                <section x-cloak x-show="active == 'graduationProfile'" class="col-span-12">
                    <div class="text-end">
                        <label for="graduationProfile">
                            <span class="group text-gray-400">
                                <i class="fa-solid fa-info"></i>
                            </span>
                            {{-- Perfil de egreso --}}
                        </label>
                    </div>
                    <textarea name="graduationProfile" id="graduationProfile">{{ old('graduationProfile', $offer->educationalProgram?->profiles?->perfil_egreso ?? "Perfil de egreso") }}</textarea>
                </section>
                {{-- perfil egreso --}}

                {{-- campo laboral --}}
                <section x-cloak x-show="active == 'employmentArea'" class="col-span-12">
                    {{-- descripción textual --}}
                    <article>
                        <div class="text-end">
                            <label for="employmentArea">
                                <span class="group text-gray-400">
                                    <i class="fa-solid fa-info"></i>
                                </span>
                                {{-- Campo Laboral --}}
                            </label>
                        </div>
                        <textarea name="employmentArea" id="employmentArea">{{ old('employmentArea', $offer->educationalProgram?->employmentArea?->campo_laboral ?? "Campo laboral") }}</textarea>
                    </article>
                    {{-- descripción textual --}}

                    {{-- posible listado de campos laborales --}}
                    <article class="mt-10">
                        <div class="text-start">
                            <label for="workplace">
                                Listado específico
                            </label>
                        </div>

                        {{-- form --}}
                        <div id="dinamic-form" class="grid grid-cols-12 gap-1">
                            <div class="col-span-10 md:col-span-11">
                                <input @keydown.enter.prevent="addSpecificArea" x-model="protoArea" type="text" id="workplace" class="w-full p-1 bg-white rounded-md" placeholder="Descripción del área de empleo">
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <button @click="addSpecificArea" type="button" class="w-full h-full px-3 py-1 bg-emerald-300 hover:bg-emerald-400 text-white rounded-md">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-span-12">
                            <template x-for="(area, index) in areas" :key="index">
                                <div class="grid grid-cols-12 gap-1 my-1">
                                    <div class="col-span-10 md:col-span-11">
                                        <input :id="`workplace${index}`" :value="area" type="text" name="workplaces[]" class="w-full p-1 bg-white rounded-md" placeholder="Descripción del área de empleo">
                                    </div>
                                    <div class="col-span-2 md:col-span-1">
                                        <button @keydown.enter.prevent="removeArea(index)" @click="removeArea(index)" type="button" class="w-full h-full px-3 py-1 bg-red-400 hover:bg-red-500 text-white rounded-md">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>
                            </div>
                        </div>
                        {{-- form --}}

                        {{-- list --}}
                        <div class="grid grid-cols-12 gap-3"></div>
                        {{-- list --}}
                    </article>
                    {{-- posible listado de campos laborales --}}
                </section>
                {{-- campo laboral --}}
                @endif

                {{-- para des --}}

                {{-- submit button --}}
                <button type="submit" class="w-fit px-3 py-1 bg-(--azul-buap-h) hover:bg-(--azul-buap-l) text-white rounded-md">
                    Guardar
                </button>
                {{-- submit button --}}
            </form>
            {{-- details form --}}
        </article>
        {{-- dinamic content --}}
    </main>
    {{-- main content --}}
    <br><br><br><br><br><br><br><br><br><br>
</section>
@endsection

@section('footer')
@endsection

@section('js')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('forms', () => ({
            init(){
                @if ($canEditUas)
                @if ($canEditWhyStudy)
                tinymce.init({
                    selector: 'textarea#whyStudy',
                    license_key: 'gpl',
                    language: 'es_MX',
                    height: 600,
                    base_url: '/new-oferta-educativa/tinymce',
                    plugins: 'advlist code emoticons link lists table help',
                    toolbar: 'bold italic | bullist numlist | link emoticons',
                    skin_url: 'default',
                    content_css: 'default',
                });
                @endif
                tinymce.init({
                    selector: 'textarea#contact',
                    license_key: 'gpl',
                    language: 'es_MX',
                    height: 600,
                    base_url: '/new-oferta-educativa/tinymce',
                    plugins: 'advlist code emoticons link lists table help',
                    toolbar: 'bold italic | bullist numlist | link emoticons',
                    skin_url: 'default',
                    content_css: 'default',
                });
                @endif
                @if ($canEditDes)
                tinymce.init({
                    selector: 'textarea#admissionProfile',
                    license_key: 'gpl',
                    language: 'es_MX',
                    height: 600,
                    base_url: '/new-oferta-educativa/tinymce',
                    plugins: 'advlist code emoticons link lists table help',
                    toolbar: 'bold italic | bullist numlist | link emoticons',
                    skin_url: 'default',
                    content_css: 'default',
                });
                tinymce.init({
                    selector: 'textarea#graduationProfile',
                    license_key: 'gpl',
                    language: 'es_MX',
                    height: 600,
                    base_url: '/new-oferta-educativa/tinymce',
                    plugins: 'advlist code emoticons link lists table help',
                    toolbar: 'bold italic | bullist numlist | link emoticons',
                    skin_url: 'default',
                    content_css: 'default',
                });
                tinymce.init({
                    selector: 'textarea#employmentArea',
                    license_key: 'gpl',
                    language: 'es_MX',
                    height: 600,
                    base_url: '/new-oferta-educativa/tinymce',
                    plugins: 'advlist code emoticons link lists table help',
                    toolbar: 'bold italic | bullist numlist | link emoticons',
                    skin_url: 'default',
                    content_css: 'default',
                });
                @endif
            },
            active: @json($active ?? ($canEditWhyStudy ? 'whyStudy' : 'contact')),
            protoArea: '',
            areas: @json( $workPlaces ),
            changeForm(form) {
                this.active = form
            },
            addSpecificArea() {
                area = document.getElementById('workplace').value
                if (!area) {
                    return
                }
                this.areas.push(area.trim())
                this.protoArea = ''
            },
            removeArea(index) {
                this.areas.splice(index, 1)
            },
        }))
    })
</script>
@endsection
