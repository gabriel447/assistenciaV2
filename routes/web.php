<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    $clientesCount = \App\Models\Cliente::count();
    $manutencoesCount = \App\Models\Manutencao::count();
    $manutencoesPendentes = \App\Models\Manutencao::whereIn('status', ['aguardando', 'em_andamento', 'aguardando_pecas'])->count();
    
    return view('dashboard', compact('clientesCount', 'manutencoesCount', 'manutencoesPendentes'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rotas para Manutenções e Clientes
    Route::resource('manutencoes', App\Http\Controllers\ManutencaoController::class);
    Route::resource('clientes', App\Http\Controllers\ClienteController::class);
});

require __DIR__.'/auth.php';
