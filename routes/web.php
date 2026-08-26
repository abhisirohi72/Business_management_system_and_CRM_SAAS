<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::withoutMiddleware('web')->get('/debug-scheme', function (Request $request) {
    return response()->json([
        'secure' => $request->isSecure(),
        'scheme' => $request->getScheme(),
        'url' => $request->fullUrl(),
        'forwarded_proto' => $request->header('X-Forwarded-Proto'),
    ]);
});

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
    
Route::get("/register", function(){
    return view("auth.register");
})->name("register");


Route::post("/register", [AuthController::class, 'register'])->name("register.store");

Route::middleware('auth')->group(function () {

    Route::get('/leads', [LeadController::class, 'index'])
        ->name('leads.index');

    Route::get('/leads/create', [LeadController::class, 'create'])
        ->name('leads.create');

    Route::post('/leads', [LeadController::class, 'store'])
        ->name('leads.store');

    Route::get('/leads/{lead}/edit', [LeadController::class, 'edit'])
        ->name('leads.edit');

    Route::put('/leads/{lead}', [LeadController::class, 'update'])
        ->name('leads.update');

    Route::delete('/leads/{lead}', [LeadController::class, 'destroy'])
    ->name('leads.destroy');
    
    //For Clients
    Route::resource('clients', ClientController::class);

    //For Projects
    Route::resource('projects', ProjectController::class);
});

Route::get("/dashboard", function(){
    return view("dashboard");
})->middleware('auth')->name("dashboard");

