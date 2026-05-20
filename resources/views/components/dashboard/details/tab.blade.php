<nav class="col-span-12">
    @if ($canEditUas)
    @if ($canEditWhyStudy)
    <button
        @click="changeForm('whyStudy')"
        type="button"
        class="w-full md:w-fit m-1 px-3 py-1 bg-gray-300"
        :class="active == 'whyStudy' ? 'bg-sky-300' : ''"
    >
        @if ($indicators->whyStudy)
        <span class="text-emerald-900">
            <i class="fa-solid fa-circle-check"></i>
        </span>
        @endif
        ¿Por qué estudiar?
    </button>
    @endif
    <button
        @click="changeForm('contact')"
        type="button"
        class="w-full md:w-fit m-1 px-3 py-1 bg-gray-300"
        :class="active == 'contact' ? 'bg-sky-300' : ''"
    >
        @if ($indicators->contact)
        <span class="text-emerald-900">
            <i class="fa-solid fa-circle-check"></i>
        </span>
        @endif
        Información de contacto
    </button>
    <button
        @click="changeForm('coordinates')"
        type="button"
        class="w-full md:w-fit m-1 px-3 py-1 bg-gray-300"
        :class="active == 'coordinates' ? 'bg-sky-300' : ''"
    >
        @if ($indicators->coordinates)
        <span class="text-emerald-900">
            <i class="fa-solid fa-circle-check"></i>
        </span>
        @endif
        Coordenadas
    </button>
    @endif
    @if ($canEditDes)
    <button
        @click="changeForm('admissionProfile')"
        type="button"
        class="w-full md:w-fit m-1 px-3 py-1 bg-gray-300"
        :class="active == 'admissionProfile' ? 'bg-sky-300' : ''"
    >
        @if ($indicators->admissionProfile)
        <span class="text-emerald-900">
            <i class="fa-solid fa-circle-check"></i>
        </span>
        @endif
        Perfil de Ingreso
    </button>
    <button
        @click="changeForm('graduationProfile')"
        type="button"
        class="w-full md:w-fit m-1 px-3 py-1 bg-gray-300"
        :class="active == 'graduationProfile' ? 'bg-sky-300' : ''"
    >
        @if ($indicators->graduationProfile)
        <span class="text-emerald-900">
            <i class="fa-solid fa-circle-check"></i>
        </span>
        @endif
        Perfil de Egreso
    </button>
    <button
        @click="changeForm('employmentArea')"
        type="button"
        class="w-full md:w-fit m-1 px-3 py-1 bg-gray-300"
        :class="active == 'employmentArea' ? 'bg-sky-300' : ''"
    >
        @if ($indicators->employmentArea)
        <span class="text-emerald-900">
            <i class="fa-solid fa-circle-check"></i>
        </span>
        @endif
        Campo Laboral
    </button>
    @endif
</nav>
