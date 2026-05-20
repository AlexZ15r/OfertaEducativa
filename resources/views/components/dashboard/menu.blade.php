<aside class="max-h-fit col-span-3 md:col-span-2 p-3 bg-gray-100 shadow-lg">
    @if ( $esAdministrador )
    <a
        href="{{ route('dashboard.academic-units') }}"
        {{-- bg-(--azul-buap-h) hover:bg-(--azul-buap-l) --}}
        class="text-gray-400 block mb-1 pointer-events-none {{ $action == 'academic-units' ? 'underline' : '' }}"
    >
        <i class="fa-regular fa-clock"></i>
        Unidades Académicas
    </a>

    <a
        href="{{ route('dashboard.campus') }}"
        {{-- bg-(--azul-buap-h) hover:bg-(--azul-buap-l) --}}
        class="text-gray-400 block mb-1 pointer-events-none {{ $action == 'campus' ? 'underline' : '' }}"
    >
        <i class="fa-regular fa-clock"></i>
        Campus
    </a>

    <a
        href="{{ route('dashboard.educational-programs') }}"
        {{-- bg-(--azul-buap-h) hover:bg-(--azul-buap-l) --}}
        class="text-gray-400 block mb-1 pointer-events-none {{ $action == 'educational-programs' ? 'underline' : '' }}"
    >
        <i class="fa-regular fa-clock"></i>
        Planes de Estudio
    </a>

    <a
        href="{{ route('dashboard.offer') }}"
        {{-- bg-(--azul-buap-h) hover:bg-(--azul-buap-l) --}}
        class="text-gray-400 block mb-1 pointer-events-none {{ $action == 'offer' ? 'underline' : '' }}"
    >
        <i class="fa-regular fa-clock"></i>
        Oferta Académica
    </a>

    <a
        href="{{ route('dashboard.statistics') }}"
        {{-- bg-(--azul-buap-h) hover:bg-(--azul-buap-l) --}}
        class="text-gray-400 block mb-1 pointer-events-none {{ $action == 'statistics' ? 'underline' : '' }}"
    >
        <i class="fa-regular fa-clock"></i>
        Reportes y Estadística
    </a>

    <a
        href="{{ route('dashboard.academic-managers') }}"
        {{-- bg-(--azul-buap-h) hover:bg-(--azul-buap-l) --}}
        class="text-gray-400 block mb-1 pointer-events-none {{ $action == 'academic-managers' ? 'underline' : '' }}"
    >
        <i class="fa-regular fa-clock"></i>
        Gestores Curriculares
    </a>
    @endif

    {{-- free to play --}}
    <a
        href="{{ route('dashboard.public-offer') }}"
        class="block mb-1 {{ $action == 'public-offer' ? 'underline' : '' }}"
    >
        Oferta Académica Pública
    </a>
    {{-- free to play --}}

    @if ($errors->any())
    <ul class="text-rose-400">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
</aside>
