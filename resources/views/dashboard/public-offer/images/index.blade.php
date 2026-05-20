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
    <main x-data="imagesModal" class="p-2 grid grid-cols-12 gap-2">
        {{-- images form modal --}}
        <x-modals.images-modal :offer="$offerId" :offerName="$offerName"></x-modals.images-modal>
        {{-- images form modal --}}

        {{-- images viewer modal --}}
        <x-modals.images-viewer-modal></x-modals.images-viewer-modal>
        {{-- images viewer modal --}}

        {{-- menu sidebar --}}
        <x-dashboard.menu :action="'public-offer'" :esAdministrador="$esAdministrador"></x-dashboard.menu>
        {{-- menu sidebar --}}

        {{-- dinamic content --}}
        <article class="min-h-150 col-span-9 md:col-span-10 p-3 bg-gray-200 shadow-lg">
            {{-- actions bar --}}
            <nav class="grid grid-cols-12 gap-1 mb-3 pb-1 border-b border-(--azul-buap-l)">
                <article class="col-span-2 grid grid-cols-2 gap-1">
                    <a title="regresar" href="{{ route('dashboard.public-offer') }}" class="col-span-1 md:px-3 md:py-1 rounded bg-(--azul-buap-h) text-white cursor-pointer flex justify-center items-center">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                    <button title="subir fotos" @click="toggleOpen" type="button" class="col-span-1 md:px-3 md:py-1 rounded bg-emerald-500 text-white cursor-pointer">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </article>
                <article class="col-span-10">
                    <h1 class="h-full text-center font-bold">{{ $offerName }}</h1>
                </article>
            </nav>
            {{-- actions bar --}}

            {{-- image list --}}
            <section class="columns-1 md:columns-2 lg:columns-3 gap-3">
                @foreach ($offerImages as $img)
                <article class="relative mb-3 break-inside-avoid">
                    <div class="m-1 flex justify-center items-center absolute top-0 end-0">
                        @if ($esAdministrador)
                        {{-- classification main --}}
                        <button @click="classify($event.currentTarget, '{{ $img->id  }}', 'main')"
                                type="button"
                                title="marcar como main page"
                                class="size-8 me-1 p-1 rounded-md border-2 border-violet-400 text-white {{ $img->catalogo_principal ? 'bg-violet-400' : 'bg-[#00000078]' }}">
                            <i class="fa-regular fa-house"></i>
                        </button>
                        {{-- classification main --}}

                        {{-- classification banner --}}
                        <button @click="classify($event.currentTarget, '{{ $img->id  }}', 'banner')"
                                type="button"
                                title="marcar como banner"
                                class="size-8 me-1 p-1 rounded-md border-2 border-violet-400 text-white {{ $img->catalogo_licenciatura ? 'bg-violet-400' : 'bg-[#00000078]' }}">
                            <i class="fa-solid fa-pager"></i>
                        </button>
                        {{-- classification banner --}}
                        @endif

                        {{-- expand button --}}
                        <button @click="toggleOpenViewer('{{ $img->imagen }}', '{{ $img->created_at }}')"
                                type="button"
                                title="expandir"
                                class="size-8 me-1 p-1 rounded-md bg-blue-400 text-white">
                            <i class="fa-solid fa-maximize"></i>
                        </button>
                        {{-- expand button --}}

                        {{-- delete button --}}
                        <form action="{{ route('dashboard.delete-image', ['offer' => $offerId, 'image' => $img->id]) }}"
                            method="post">
                            @csrf
                            <button type="submit"
                                    title="eliminar"
                                    class="size-8 p-1 rounded-md bg-rose-400 text-white">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                        {{-- delete button --}}
                    </div>

                    {{-- actual image --}}
                    <img src="{{ asset("storage/$img->imagen") }}"
                        alt="Subida el {{ $img->created_at }}"
                        class="w-full rounded-md">
                    {{-- actual image --}}
                </article>
                @endforeach
            </section>
            {{-- image list --}}
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
        Alpine.data('imagesModal', () => ({
            open: false,
            openViewer: false,
            assetsRoute: '{{ asset('storage') }}',
            classifyRoute: '{{ route("dashboard.classify-image", ["offer" => "$offerId", "image" => "__IMAGE__"]) }}',
            src: null,
            alt: null,
            async init() {
                await axios.get('{{ route("sanctum.csrf-cookie") }}')
            },
            toggleOpen() {
                this.open = !this.open
            },
            toggleOpenViewer(img, creation) {
                this.openViewer = !this.openViewer
                if ( this.openViewer ) {
                    this.src = this.assetsRoute + '/' + img
                    this.alt = `Subida el ${creation}`
                }
            },
            async classify(button, img, type) {
                route = this.classifyRoute.replace('__IMAGE__', img)

                try {
                    const response = await axios.post(
                        route,
                        { type: type },
                        { withCredentials: true }
                    )

                    if (!(response.data.status == 'ok')) {
                        alert('Error al clasificar, recarga y reintenta')
                        return
                    }

                    if ( response.data.currentStatus ) {
                        button.classList.remove('bg-[#00000078]')
                        // button.classList.remove('bg-violet-400')
                        button.classList.add('bg-violet-400')
                    } else {
                        // button.classList.remove('bg-[#00000078]')
                        button.classList.remove('bg-violet-400')
                        button.classList.add('bg-[#00000078]')
                    }
                } catch (error) {
                    alert('Error al clasificar, recarga y reintenta')
                }
            },
        }))
    })
</script>
@endsection
