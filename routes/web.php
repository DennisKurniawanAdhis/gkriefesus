<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IbadahController;
use App\Http\Controllers\KomisiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KolekteController;
use App\Http\Controllers\PendetaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KeahlianController;
use App\Http\Controllers\SumbanganController;
use App\Http\Controllers\PernikahanController;
use App\Http\Controllers\PerpuluhanController;
use App\Http\Controllers\CalonBaptisController;
use App\Http\Controllers\jenisIbadahController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardKasController;
use App\Http\Controllers\DashboardPendetaController;


Route::get('/', function () {
    return redirect()->route('login'); // Mengarahkan ke route login
});


Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
  
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
  
    Route::get('logout', 'logout')->middleware('auth')->name('logout');

});
  
Route::middleware('auth')->group(function () {

    Route::get('super', function () {
        return view('super');
    })->name('super');

    Route::controller(AdminController::class)->prefix('admin')->group(function () {
        Route::get('', 'index')->name('admin');
        Route::get('create', 'create')->name('admin.create');
        Route::post('store', 'store')->name('admin.store');
        Route::get('show/{id}', 'show')->name('admin.show');
        Route::get('edit/{id}', 'edit')->name('admin.edit');
        Route::put('edit/{id}', 'update')->name('admin.update');
        Route::delete('destroy/{id}', 'destroy')->name('admin.destroy');
    });

    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
});


Route::middleware('auth')->group(function () {
 

    Route::get('keanggotaan', function () {
        return view('keanggotaan');
    })->name('keanggotaan');


    
    Route::controller(AnggotaController::class)->prefix('anggota')->group(function () {
        Route::get('', 'index')->name('anggota');
        Route::get('create', 'create')->name('anggota.create');
        Route::post('store', 'store')->name('anggota.store');
        Route::get('show/{anggotaID}', 'show')->name('anggota.show');
        Route::get('edit/{anggotaID}', 'edit')->name('anggota.edit');
        Route::put('edit/{anggotaID}', 'update')->name('anggota.update');
        Route::delete('destroy/{anggotaID}', 'destroy')->name('anggota.destroy');
    });

    Route::controller(jenisIbadahController::class)->prefix('jenisIbadah')->group(function () {
        Route::get('', 'index')->name('jenisIbadah');
        Route::get('create', 'create')->name('jenisIbadah.create');
        Route::post('store', 'store')->name('jenisIbadah.store');
        Route::get('show/{ibadahID}', 'show')->name('jenisIbadah.show');
        Route::get('edit/{ibadahID}', 'edit')->name('jenisIbadah.edit');
        Route::put('edit/{ibadahID}', 'update')->name('jenisIbadah.update');
        Route::delete('destroy/{ibadahID}', 'destroy')->name('jenisIbadah.destroy');
    });

    

    Route::controller(KeahlianController::class)->prefix('keahlian')->group(function () {
        Route::get('', 'index')->name('keahlian');
        Route::get('create', 'create')->name('keahlian.create');
        Route::post('store', 'store')->name('keahlian.store');
        Route::get('show/{keahlianID}', 'show')->name('keahlian.show');
        Route::get('edit/{keahlianID}', 'edit')->name('keahlian.edit');
        Route::put('edit/{keahlianID}', 'update')->name('keahlian.update');
        Route::delete('destroy/{keahlianID}', 'destroy')->name('keahlian.destroy');
    });

    Route::controller(PendetaController::class)->prefix('pendeta')->group(function () {
        Route::get('', 'index')->name('pendeta');
        Route::get('create', 'create')->name('pendeta.create');
        Route::post('store', 'store')->name('pendeta.store');
        Route::get('show/{pendetaID}', 'show')->name('pendeta.show');
        Route::get('edit/{pendetaID}', 'edit')->name('pendeta.edit');
        Route::put('edit/{pendetaID}', 'update')->name('pendeta.update');
        Route::delete('destroy/{pendetaID}', 'destroy')->name('pendeta.destroy');
    });
    

    Route::controller(PernikahanController::class)->prefix('pernikahan')->group(function () {
        Route::get('', 'index')->name('pernikahan');
        Route::get('create', 'create')->name('pernikahan.create');
        Route::post('store', 'store')->name('pernikahan.store');
        Route::get('show/{pernikahanID}', 'show')->name('pernikahan.show');
        Route::get('edit/{pernikahanID}', 'edit')->name('pernikahan.edit');
        Route::put('edit/{pernikahanID}', 'update')->name('pernikahan.update');
        Route::delete('destroy/{pernikahanID}', 'destroy')->name('pernikahan.destroy');
    });

    Route::controller(CalonBaptisController::class)->prefix('calonBaptis')->group(function () {
        Route::get('', 'index')->name('calonBaptis');
        Route::get('create', 'create')->name('calonBaptis.create');
        Route::post('store', 'store')->name('calonBaptis.store');
        Route::get('show/{baptisID}', 'show')->name('calonBaptis.show');
        Route::get('edit/{baptisID}', 'edit')->name('calonBaptis.edit');
        Route::put('edit/{baptisID}', 'update')->name('calonBaptis.update');
        Route::delete('destroy/{baptisID}', 'destroy')->name('calonBaptis.destroy');
    });

    Route::controller(IbadahController::class)->prefix('ibadah')->group(function () {
        Route::get('', 'index')->name('ibadah');
        Route::get('create', 'create')->name('ibadah.create');
        Route::post('store', 'store')->name('ibadah.store');
        Route::get('show/{dataIbadahID}', 'show')->name('ibadah.show');
        Route::get('edit/{dataIbadahID}', 'edit')->name('ibadah.edit');
        Route::put('edit/{dataIbadahID}', 'update')->name('ibadah.update');
        Route::delete('destroy/{dataIbadahID}', 'destroy')->name('ibadah.destroy');
    });

    Route::controller(KomisiController::class)->prefix('komisi')->group(function () {
        Route::get('', 'index')->name('komisi');
        Route::get('create', 'create')->name('komisi.create');
        Route::post('store', 'store')->name('komisi.store');
        Route::get('show/{komisiID}', 'show')->name('komisi.show');
        Route::get('edit/{komisiID}', 'edit')->name('komisi.edit');
        Route::put('edit/{komisiID}', 'update')->name('komisi.update');
        Route::delete('destroy/{komisiID}', 'destroy')->name('komisi.destroy');
    });

    Route::controller(DashboardPendetaController::class)->prefix('DashboardPendeta')->group(function () {
        Route::get('/', 'index')->name('DashboardPendeta.index');
    });

    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
});


Route::middleware('auth')->group(function () {
 

    Route::get('keuangan', function () {
        return view('keuangan');
    })->name('keuangan');

    Route::controller(PerpuluhanController::class)->prefix('perpuluhan')->group(function () {
        Route::get('', 'index')->name('perpuluhan');
        Route::get('create', 'create')->name('perpuluhan.create');
        Route::post('store', 'store')->name('perpuluhan.store');
        Route::get('show/{kasID}', 'show')->name('perpuluhan.show');
        Route::get('edit/{kasID}', 'edit')->name('perpuluhan.edit');
        Route::put('edit/{kasID}', 'update')->name('perpuluhan.update');
        Route::delete('destroy/{kasID}', 'destroy')->name('perpuluhan.destroy');
    });

    Route::controller(KolekteController::class)->prefix('kolekte')->group(function () {
        Route::get('', 'index')->name('kolekte');
        Route::get('create', 'create')->name('kolekte.create');
        Route::post('store', 'store')->name('kolekte.store');
        Route::get('show/{kasID}', 'show')->name('kolekte.show');
        Route::get('edit/{kasID}', 'edit')->name('kolekte.edit');
        Route::put('edit/{kasID}', 'update')->name('kolekte.update');
        Route::delete('destroy/{kasID}', 'destroy')->name('kolekte.destroy');
    });

    Route::controller(SumbanganController::class)->prefix('sumbangan')->group(function () {
        Route::get('', 'index')->name('sumbangan');
        Route::get('create', 'create')->name('sumbangan.create');
        Route::post('store', 'store')->name('sumbangan.store');
        Route::get('show/{kasID}', 'show')->name('sumbangan.show');
        Route::get('edit/{kasID}', 'edit')->name('sumbangan.edit');
        Route::put('edit/{kasID}', 'update')->name('sumbangan.update');
        Route::delete('destroy/{kasID}', 'destroy')->name('sumbangan.destroy');
    });

    Route::controller(PengeluaranController::class)->prefix('pengeluaran')->group(function () {
        Route::get('', 'index')->name('pengeluaran');
        Route::get('create', 'create')->name('pengeluaran.create');
        Route::post('store', 'store')->name('pengeluaran.store');
        Route::get('show/{pengeluaranID}', 'show')->name('pengeluaran.show');
        Route::get('edit/{pengeluaranID}', 'edit')->name('pengeluaran.edit');
        Route::put('edit/{pengeluaranID}', 'update')->name('pengeluaran.update');
        Route::delete('destroy/{pengeluaranID}', 'destroy')->name('pengeluaran.destroy');
    });

    Route::controller(DashboardKasController::class)->prefix('DashboardKas')->group(function () {
        Route::get('/', 'index')->name('DashboardKas.index');
    });
    

    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
});