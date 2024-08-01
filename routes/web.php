<?php

use App\Http\Controllers\UserMgmtController;
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
    return view('dashboard');
});

// User Management -> Mengatur Role & Menu masing masing user 
Route::get('user-mgmt', [UserMgmtController::class, 'index'])->name('usermgmt.index');
// Menu
Route::get('user-mgmt/menu', [UserMgmtController::class, 'menu'])->name('usermgmt.menu');
Route::post('user-mgmt/menu', [UserMgmtController::class, 'tambahMenu'])->name('menu.add');
// Role
Route::get('user-mgmt/role', [UserMgmtController::class, 'role'])->name('usermgmt.role');
Route::post('user-mgmt/role', [UserMgmtController::class, 'tambahRole'])->name('role.add');
Route::put('user-mgmt/role/{id}', [UserMgmtController::class, 'editRole'])->name('role.edit');
Route::delete('user-mgmt/role/{id}', [UserMgmtController::class, 'delRole'])->name('role.del');

Route::get('pengajuan', function () {
    return view('pengajuan.index', ['pesan' => 'Pengajuan']);
})->name('pengajuan');
Route::get('pengajuan/mou', function () {
    return view('pengajuan.index', ['pesan' => 'Pengajuan MoU']);
})->name('pengajuan.mou');
Route::get('pengajuan/moa', function () {
    return view('pengajuan.index', ['pesan' => 'Pengajuan MoA']);
})->name('pengajuan.moa');
Route::get('pengajuan/ia', function () {
    return view('pengajuan.index', ['pesan' => 'Pengajuan IA']);
})->name('pengajuan.ia');
