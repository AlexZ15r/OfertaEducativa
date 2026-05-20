<nav class="p-2 grid grid-cols-12 gap-1">
    {{-- search --}}
    <article class="col-span-9 relative">
        <label for="search" class="sr-only">Buscar</label>
        <input type="text" placeholder="Encontrar recursos" id="search" class="w-full p-2 pe-14 border border-gray-400">
        <span class="absolute me-3 ps-3 top-1/2 end-0 -translate-y-1/2 border-s-2 border-gray-300 pointer-events-none">
            <i class="fa-solid fa-magnifying-glass"></i>
        </span>
    </article>
    {{-- search --}}

    {{-- academic manager filter --}}
    <article class="col-span-3 relative">
        <label for="academicManagerInput" class="sr-only">Seleccionar gestor curricular</label>
        <select name="academicManager" id="academicManagerInput" class="clean-select w-full p-2 pe-14 border border-gray-400">
            <option value="" disabled selected>Filtrar por gestora</option>
            @foreach ( $academicManagers as $manager )
            <option value="{{ $manager->id }}">{{ $manager->name }}</option>
            @endforeach
        </select>
        <span class="absolute me-3 ps-3 top-1/2 end-0 -translate-y-1/2 border-s-2 border-gray-300 pointer-events-none">
            <i class="fa-solid fa-filter"></i>
        </span>
    </article>
    {{-- academic manager filter --}}
</nav>
