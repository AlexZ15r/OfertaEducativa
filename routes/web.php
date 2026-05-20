<?php

use Illuminate\Support\Facades\Route;

// welcome page
Route::get('/', App\Http\Controllers\OfertaEducativaController::class)->name('index');
// educational program details
Route::get('/licenciatura/{educationalProgram}', App\Http\Controllers\LicenciaturaController::class)->name('educational-program');
// campus
Route::get('/campus/{campus}', App\Http\Controllers\CampusController::class)->name('campus');
// academic units
Route::get('/unidad-academica/{academicUnit}', App\Http\Controllers\AcademicUnitController::class)->name('academic-unit');
// modalities
Route::get('/modalidad/{modality}', App\Http\Controllers\ModalityController::class)->name('modality');

// group & middleware for crud type forms
Route::prefix('dashboard')->middleware([App\Http\Middleware\ValidateEcosistemaSession::class, App\Http\Middleware\ValidateEditorRole::class])->group(function () {
    // control panel
    Route::get('/', App\Http\Controllers\Dashboard\Index::class)->name('dashboard');

    // only administrators & some curricular / academic manager
    Route::middleware(App\Http\Middleware\ManageCatalogs::class)->group(function () {
        // crud academic units
        Route::get('/academic-units', function () {echo "academic units dashboard";})->name('dashboard.academic-units');
        // crud campus
        Route::get('/campus', function () {echo "campus dashboard";})->name('dashboard.campus');
        // crud educational programs
        Route::get('/educational-programs', App\Http\Controllers\Dashboard\EducationalPrograms::class)->name('dashboard.educational-programs');
        // crud campus, academic unit, educational program
        Route::get('/offer', function () { echo "edita la lista de campus, academic unit, educational program para la oferta educativa y demás procesos"; })->name('dashboard.offer');
        // crud gestores curriculares
        Route::get('/academic-managers', function () { echo "asigna gestores curriculares a cargo de planes de estudio y asignaturas"; })->name('dashboard.academic-managers');
    });

    // current administration
    Route::middleware(App\Http\Middleware\ViewStatistics::class)->group(function () {
        // statistics
        Route::get('/statistics', function () { echo "monitoreo y reportes en tiempo real"; })->name('dashboard.statistics');
    });

    // administrators, academic units & communication
    Route::middleware(App\Http\Middleware\ManagePublicOffer::class)->group(function () {
        // public academic offer
        Route::get('/public-offer', App\Http\Controllers\Dashboard\PublicOffer::class)->name('dashboard.public-offer');

        // details view
        Route::get('/public-offer/{offer}/details', App\Http\Controllers\Dashboard\DetailsIndex::class)->name('dashboard.details');
        // details post
        Route::post('/public-offer/{offer}/details', App\Http\Controllers\Dashboard\DetailsUpdate::class)->name('dashboard.update-details');

        // images view
        Route::get('/public-offer/{offer}/images', App\Http\Controllers\Dashboard\ImagesIndex::class)->name('dashboard.images');
        // images post
        Route::post('/public-offer/{offer}/images', App\Http\Controllers\Dashboard\ImagesUpload::class)->name('dashboard.upload-images');
        // images delete
        Route::post('/public-offer/{offer}/images/delete/{image}', App\Http\Controllers\Dashboard\ImageDelete::class)->name('dashboard.delete-image');
    });
});








// research stpageflip
Route::get('/stpageflip', function () {
    return view('stpageflip');
})->name('stpageflip');

// research turnjs
Route::get('/turnjs', function () {
    return view('turnjs');
})->name('turnjs');

// research demanda
Route::get('/demanda', function () {
    return view('demanda');
})->name('demanda');

// research dompdf
Route::get('/pdf/plan-sociologia/{clavepe}', [App\Http\Controllers\Pdf\PlanSociologiaController::class, 'generar'])->name('generate.pdf');
