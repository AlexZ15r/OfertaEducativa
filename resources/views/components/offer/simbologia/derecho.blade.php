<section class="text-center mt-10">
    <article class="border border-(--azul-buap-h) rounded-2xl p-3">
        <h3 class="font-bold text-2xl mb-5">Simbología</h3>

        {{-- terminal list --}}
        <div class="grid grid-cols-12 gap-3">
            @foreach ($terminals as $terminal => $_semesters)
            @php
                $firstSemester = array_keys($_semesters)[0];
                $areas = $terminals[$terminal][$firstSemester];
                $firstArea = array_keys($areas)[0];
                $subjects = $areas[$firstArea];
                $firstSubject = $subjects[0];
                $color = $firstSubject['area']['color'];
            @endphp
            <div class="col-span-12 sm:col-span-6 md:col-span-4 text-start">
                <span style="color: {{ $color }};">
                    <i class="fa-solid fa-play text-[25px]"></i>
                </span>
                {{ $terminal }}
            </div>
            @endforeach
        </div>
        {{-- terminal list --}}
    </article>
</section>
