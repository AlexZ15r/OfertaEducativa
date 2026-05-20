<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">

<style>
body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 10.5px;
    color: #333;
}

.header {
    text-align: center;
    margin-bottom: 10px;
}

.header h1 {
    color: #6a1b9a;
    font-size: 18px;
    margin: 0;
}

.header h2 {
    font-size: 12px;
    margin: 0;
}

.semestre {
    background-color: #6a1b9a;
    color: white;
    padding: 6px;
    font-weight: bold;
    margin-top: 12px;
}

.area {
    font-weight: bold;
    margin-top: 6px;
}

ul {
    margin: 3px 0 8px 15px;
    padding: 0;
}

.page-break {
    page-break-before: always;
}
@page
{
    margin: 0;
}
</style>
</head>

<body>

<section class="header">

    {{-- logo buap --}}
    <article class="flex justify-center items-center">
        <img src="{{ asset('images/logos-buap/logo_b_t.png') }}" alt="" class="w-40">
    </article>
    {{-- logo buap --}}

    {{-- etiqueta y área --}}
    <article class="flex justify-between items-center">
        <h1 class="inline-block">Plan de Estudios</h1>
        <span class="bg-amber-200 rounded-pill text-white p-2">
            {{ $creditos_min_max ?? 'créditos min-max' }}
        </span>
    </article>
    {{-- etiqueta y área --}}
</section>

<div class="semestre">Primer Semestre</div>

<div class="area">Área de Formación General Universitaria</div>
<ul>
    <li>Inglés I</li>
    <li>Introducción a la Formación General</li>
</ul>

<div class="area">Área de Teoría Sociológica</div>
<ul>
    <li>Introducción a la perspectiva sociológica</li>
</ul>

<div class="area">Área de Estadística y Computación</div>
<ul>
    <li>Estadística Descriptiva</li>
</ul>

<div class="semestre">Segundo Semestre</div>

<div class="area">Área de Formación General Universitaria</div>
<ul>
    <li>Inglés II</li>
</ul>

<div class="area">Área de Historia</div>
<ul>
    <li>Historia de la Modernidad</li>
</ul>

<div class="page-break"></div>

<div class="semestre">Tercer Semestre</div>

<div class="area">Área de Metodología</div>
<ul>
    <li>Métodos Cualitativos</li>
</ul>

<div class="area">Área de Teoría Política</div>
<ul>
    <li>Derechos Humanos</li>
    <li>Modelos Políticos, Electorales y de Gobierno</li>
</ul>

</body>
</html>
