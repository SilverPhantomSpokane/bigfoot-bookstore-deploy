<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// --- HOME PAGE ---
Route::get('/', function () {
    return redirect('/departments');
});

// --- DASHBOARD (BREEZE) ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- USER PROFILE (BREEZE) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- SWITCH USER (ADMIN / MANAGER / USER) ---
Route::middleware('auth')->post('/impersonate/{role}', function ($role) {

    $user = User::where('role', $role)->first();

    if (! $user) {
        abort(404, "Role '{$role}' not found");
    }

    Auth::login($user);

    return redirect()->route('departments.index')
        ->with('status', "Logged in as {$role}");
})->name('impersonate');

// --- DEPARTMENTS CRUD ---
Route::resource('departments', DepartmentController::class);

// --- PRODUCTS CRUD ---
Route::resource('products', ProductController::class)->except(['index', 'show']);

Route::prefix('departments/{department}')->group(function () {
    Route::get('products/create', [ProductController::class, 'create'])->name('departments.products.create');
    Route::post('products', [ProductController::class, 'store'])->name('departments.products.store');
});

// fallback
Route::fallback(function () {
    return redirect()->route('departments.index');
});

require __DIR__.'/auth.php';
