<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\ExcelExportController;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                                |
|--------------------------------------------------------------------------|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route pour afficher le formulaire d'importation
Route::get('/import', [ExcelImportController::class, 'showForm'])->name('excel.import.form');

// Route pour traiter l'importation
Route::post('/import', [ExcelImportController::class, 'import'])->name('excel.import');

// Route pour afficher la liste des fichiers importés
Route::get('/files', [ExcelImportController::class, 'index'])->name('files.index');

// Route pour voir un fichier spécifique
Route::get('/files/{id}', [ExcelImportController::class, 'viewFile'])->name('view.file');

// Route pour exporter les données
Route::get('/export', [ExcelExportController::class, 'export'])->name('excel.export');

// Route::delete('/files/{id}', [ExcelImportController::class, 'destroy'])->name('delete.file');
Route::get('/files/{id}/edit', [ExcelImportController::class, 'edit'])->name('edit.file');
Route::put('/files/{id}', [ExcelImportController::class, 'update'])->name('update.file');

Route::delete('/files/{id}', [ExcelImportController::class, 'destroy'])->name('delete.file');