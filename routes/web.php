<?php

use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\OptionController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
// Banca
use App\Http\Controllers\ImportExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

// -- define idioma --
Route::get('/greeting/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'es', 'fr'])) {
        // abort(400);
        $locale = 'fr';
    }
    App::setLocale($locale);
    session(['locale' => $locale]);
    return redirect('/');
});
// -- fin define idioma --

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    $targetFolder = base_path() . '/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    dump($targetFolder, $linkFolder);
});

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('property', PropertyController::class);
        Route::resource('option', OptionController::class);
    });

// sistema BANCA
Route::group(['prefix' => 'banca'], function () {
    Route::get('/import', [ImportExportController::class, 'index'])->name('banca.index');
    Route::post('/import', [ImportExportController::class, 'import'])->name('banca.import');
    Route::get('/import/nuevo', [ImportExportController::class, 'createTablaTraspasos'])->name('banca.import.nuevo');
    Route::get('/export', [ImportExportController::class, 'export'])->name('banca.export');
    Route::get('/duplicados', [ImportExportController::class, 'export'])->name('banca.eliminar.duplicados');
    //
    // Route::post('/traspasos/duplicados', [ImportExportController::class, 'eliminarRegistrosDuplicados'])->name('banca.eliminar.duplicados');
    // Route::post('/traspasos/movimientos', [ImportExportController::class, 'TraspasoAMovimientos'])->name('banca.crearMovimientos');
    // Route::get('/clientes', [ImportExportController::class, 'clientes'])->name('banca.clientes');
});

// Route::controller(PrincipalController::class)
//     ->prefix('')
//     ->as('')
//     ->group(function () {
//         route::get('/', 'home')->name('home');
//         route::get('/testInput', 'testInput')->name('testInput');
//         route::get('/porDefinir', 'porDefinir')->name('porDefinir');
//         route::get('/acercade', 'acercade')->name('acercade');
//         route::get('/contacto', 'contacto')->name('contacto');
//         route::post('/contacto', 'contacto')->name('contacto.enviar');
//         Route::get('/linkstorage', function () {
//             $targetFolder = base_path() . '/storage/app/public';
//             $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
//             dump($targetFolder, $linkFolder);
//         });
//     });

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('users', 'users')
    ->middleware(['auth', 'verified'])
    ->name('users');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

// probando el App\Helpers.php
Route::get('call-helper', function () {
    $mdY = fncConvertYmdToMdy('2023-02-12');
    var_dump("Converted 2023-02-12 into 'MDY': " . $mdY);

    $ymd = fncConvertMdyToYmd('02-12-2023');
    var_dump("<br>Converted 02-12-2023 into 'YMD': " . $ymd);

    $dmy = fncConvertYmdToDmy('2023-02-12');
    var_dump("<br>Converted 2023-02-12 into 'DMY': " . $dmy);

    $dates = ['2-2-2023', '28-2-2023', '1-1-2023', '30-1-2023', '29-2-2024'];
    var_dump(fncDetectCommonDateFormat($dates)); // Imprime: 'd-m-y'
});
