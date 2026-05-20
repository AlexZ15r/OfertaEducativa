<?php
// Datos de ejemplo (ACTUAL)
$aspirantes = 120;
$admitidos = 60;
$cpp = $aspirantes / $admitidos; // 4.54

// Calcular ángulo de la aguja (0° a 180°)
$angulo_aguja = min($cpp * 18, 180);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tacómetro de Demanda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
        }

        .contenedor-tacometro {
            text-align: center;
            max-width: 400px;
        }

        svg {
            width: 300px;
            height: 160px;
        }

        .aguja {
            transform-origin: 150px 150px;
            transform: rotate(-90deg);
        }

        .punto-central {
            fill: #222;
        }

        h2 {
            margin-top: 12px;
            font-size: 1.4em;
            font-weight: bold;
            color: #000;
            margin: 10px 0;
        }

        .detalles {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 15px;
        }

        .dato {
            background: #f8f8f8;
            padding: 8px;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .valor {
            font-weight: bold;
            font-size: 1.2em;
        }

        body {
            margin: 0;
            padding: 0;
            background: transparent;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Alineado arriba */
            min-height: 100vh;
        }

        .iframe-compact {
            width: 1024px;  /* Ancho horizontal estándar */
            height: 576px;  /* 16:9 ratio */
            border: none;
            border-radius: 12px;
            transform: scale(0.8);
            transform-origin: center top;
        }
    </style>
</head>
<body>
    <div class="contenedor-tacometro">
        <!-- Gauge con SVG -->
        <svg viewBox="0 0 300 160">
            <defs>
                <linearGradient id="gradiente" x1="0%" y1="100%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#44cc44"/>
                    <stop offset="50%" stop-color="#ffcc44"/>
                    <stop offset="100%" stop-color="#ff4444"/>
                </linearGradient>
            </defs>

            <path d="M 20 150 A 130 130 0 0 1 280 150"
                  stroke="url(#gradiente)"
                  stroke-width="30"
                  fill="none" />

            <line id="aguja" x1="150" y1="150" x2="150" y2="40"
                  stroke="#222" stroke-width="6"
                  class="aguja" />

            <circle cx="150" cy="150" r="12" class="punto-central"/>
        </svg>

        <h2>Tacómetro de Demanda</h2>
    </div>

    <script>
        window.addEventListener('load', function() {
            const aguja = document.getElementById('aguja');
            const anguloFinal = <?php echo $angulo_aguja - 90; ?>;

            // Movimiento inicial suave
            aguja.style.transition = "transform 2s ease-in-out";
            aguja.style.transform = `rotate(${anguloFinal}deg)`;

            // Cuando termina, quitar transición y empezar oscilación continua
            setTimeout(() => {
                aguja.style.transition = "none";
                let i = 0;
                const amplitud = 2.5;   // grados de oscilación
                const velocidad = 0.25; // velocidad angular (más rápido)
                const base = anguloFinal;

                function oscilar() {
                    // oscilación suave pero rápida
                    const offset = Math.sin(i) * amplitud;
                    aguja.style.transform = `rotate(${base + offset}deg)`;
                    i += velocidad;
                    requestAnimationFrame(oscilar);
                }

                oscilar();
            }, 2200);
        });
    </script>
</body>
</html>
