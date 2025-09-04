<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});
Route::get('/admin', function () {
    return view('admindashboard');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Models\admin_panel_setting;

Route::get('/check-admin-images/{id}', function ($id) {
    $admin = AdminPanelSetting::find($id);

    if (!$admin) {
        return "❌ AdminPanelSetting with id {$id} not found.";
    }

    $errors = [];

    foreach ($admin->images as $img) {
        $errors[] = "✅ Image {$img->id}: OK ({$img->imageable_type} - {$img->imageable_id})";
    }

    if (empty($errors)) {
        $errors[] = "⚠ No images found for AdminPanelSetting {$id}";
    }

    return response()->json($errors);
});
require __DIR__ . '/auth.php';
