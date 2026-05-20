@props([
    'cpp' => 0,
    'modalidad' => 'Modalidad',
    'maxCompetencia' => 10,
    'campus' => ''
])

@php
    $min = 1;
    $max = 181;
    $valor = $cpp;
    $maxCompetencia = 10;
    // Escalar el valor al rango 0-10
    $competencia = (($valor - $min) / ($max - $min)) * $maxCompetencia;
    // Evitar que pase del máximo
    $competencia = max(0, min($competencia, $maxCompetencia));
    $ratio = $competencia / $maxCompetencia;
    $angulo = $ratio * 180;
    $uid = 'taco-' . uniqid();
@endphp

<div class="tacometro text-center mx-3"
     data-angulo="{{ $angulo - 90 }}"
     id="{{ $uid }}"
     style="width:180px">

    <svg viewBox="0 0 300 160">
        <defs>
            <linearGradient id="grad-{{ $uid }}" x1="0%" y1="100%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#22c55e"/>
                <stop offset="50%" stop-color="#facc15"/>
                <stop offset="100%" stop-color="#ef4444"/>
            </linearGradient>
        </defs>

        <path d="M 20 150 A 130 130 0 0 1 280 150"
              stroke="url(#grad-{{ $uid }})"
              stroke-width="30"
              fill="none" />

        <line class="aguja"
              x1="150" y1="150"
              x2="150" y2="40"
              stroke="#222"
              stroke-width="6"
              style="transform-origin:150px 150px; transform:rotate(-90deg);" />

        <circle cx="150" cy="150" r="12" fill="#222"/>
    </svg>

    <h2 class="mt-3 text-lg font-semibold">
        {{ $modalidad }}
        @if ( $modalidad == "Escolarizada" )
            <br>
            {{ $campus }}
        @endif
    </h2>

    <script>
    document.addEventListener('DOMContentLoaded', () => {

        const tacometros = document.querySelectorAll('.tacometro');

        tacometros.forEach(container => {
            const aguja = container.querySelector('.aguja');
            const anguloFinal = parseFloat(container.dataset.angulo);

            // Animación inicial
            aguja.style.transition = "transform 1.8s cubic-bezier(.25,.8,.25,1)";
            aguja.style.transform = `rotate(${anguloFinal}deg)`;

            // Oscilación ligera después
            setTimeout(() => {

                let i = 0;
                const amplitud = 2;
                const velocidad = 0.15;
                const base = anguloFinal;

                function oscilar() {
                    const offset = Math.sin(i) * amplitud;
                    aguja.style.transform = `rotate(${base + offset}deg)`;
                    i += velocidad;
                    requestAnimationFrame(oscilar);
                }

                aguja.style.transition = "none";
                oscilar();
            }, 1900);
        });

    });
    </script>
</div>
