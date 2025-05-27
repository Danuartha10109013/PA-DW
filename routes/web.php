<?php

use App\Http\Controllers\AbsentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/verify/{token}', [AuthController::class, 'verify']);

// route middleware guest
Route::middleware(['guest'])->group(function () {

    // route auth
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginAction']);
    Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('forgot-password', [AuthController::class, 'forgotPasswordAction']);
    Route::get('reset-password/{token}', [AuthController::class, 'resetPassword']);
    Route::put('reset-password/{token}/action', [AuthController::class, 'resetPasswordAction']);

});

// middleware auth
Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // grup backoffice
    Route::group(['prefix' => 'backoffice'], function () {

        // grup dashboard
        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', [DashboardController::class, 'index']);
        });

        // grup absen
        Route::group(['prefix' => 'absen'], function () {
            Route::get('/', [AbsentController::class, 'create']);
            Route::post('/store', [AbsentController::class, 'store']);
            Route::post('/home-early', [AbsentController::class, 'homeEarly']); 
        });

        // grup wfh
        Route::group(['prefix' => 'wfh'], function () {
            Route::get('/', [AbsentController::class, 'wfhCreate']);
            // Route::get('/wfh-store', [AbsentController::class, 'wfhStore']);

            // revisi
            Route::post('/wfh-store', [AbsentController::class, 'wfhStore']);
        });

        // grup absensi
        Route::group(['prefix' => 'absensi'], function () {
            Route::get('/', [AbsentController::class, 'index']);
            Route::get('/pdf/{bulan}/{tahun}', [AbsentController::class, 'pdfBulanTahun']);
            Route::get('/pdf', [AbsentController::class, 'pdf']);

            // grup absensi_id
            Route::group(['prefix' => '{absensi_id}'], function () {
                Route::put('/update', [AbsentController::class, 'update']);
                Route::get('/delete', [AbsentController::class, 'delete']);
                Route::get('/detail', [AbsentController::class, 'detail']);
            });
        });

        // grup report
        Route::group(['prefix' => 'report'], function () {
            Route::get('/', [AbsentController::class, 'report']);
            Route::get('/pdf/{bulan}/{tahun}', [AbsentController::class, 'reportPdfBulanTahun']);
            Route::get('/pdf', [AbsentController::class, 'reportPdf']);
        });

        // grup cuti
        Route::group(['prefix' => 'cuti'], function () {
            Route::get('/', [SubmissionController::class, 'cuti']);
            Route::post('/store', [SubmissionController::class, 'storeCuti']);

            // grup cuti_id
            Route::group(['prefix' => '{cuti_id}'], function () {
                Route::get('/edit', [SubmissionController::class, 'editCuti']);
                Route::put('/update', [SubmissionController::class, 'updateCuti']);
                Route::get('/delete', [SubmissionController::class, 'deleteCuti']);
                Route::get('/confirm', [SubmissionController::class, 'confirmCuti']);
                Route::put('/reject', [SubmissionController::class, 'rejectCuti']);
                Route::put('/adjust', [SubmissionController::class, 'adjustCuti']);
                Route::put('/update-status-description', [SubmissionController::class, 'updateStatusDescriptionCuti']);
            });
        });

        // grup izin-sakit
        Route::group(['prefix' => 'izin-sakit'], function () {
            Route::get('/', [SubmissionController::class, 'izinSakit']);
            Route::post('/store', [SubmissionController::class, 'storeIzinSakit']);

            // grup izin-sakit_id
            Route::group(['prefix' => '{id}'], function () {
                Route::get('/edit', [SubmissionController::class, 'editIzinSakit']);
                Route::put('/update', [SubmissionController::class, 'updateIzinSakit']);
                Route::get('/delete', [SubmissionController::class, 'deleteIzinSakit']);
                Route::get('/confirm', [SubmissionController::class, 'confirmIzinSakit']); 
                Route::put('/reject', [SubmissionController::class, 'rejectIzinSakit']);
                Route::put('/adjust', [SubmissionController::class, 'adjustIzinSakit']);
                Route::put('/update-status-description', [SubmissionController::class, 'updateStatusDescriptionIzinSakit']);
                Route::get('/skd-preview', [SubmissionController::class, 'skdPreview']);
            });
        });

        // grup wfh
        Route::group(['prefix' => 'data-wfh'], function () {
            Route::get('/', [SubmissionController::class, 'wfh']);
            Route::post('/store', [SubmissionController::class, 'storeWfh']);

            // grup wfh_id
            Route::group(['prefix' => '{wfh_id}'], function () {
                Route::get('/edit', [SubmissionController::class, 'editWfh']);
                Route::put('/update', [SubmissionController::class, 'updateWfh']);
                Route::get('/delete', [SubmissionController::class, 'deleteWfh']);
                Route::get('/confirm', [SubmissionController::class, 'confirmWfh']);
                Route::put('/reject', [SubmissionController::class, 'rejectWfh']);
                Route::put('/adjust', [SubmissionController::class, 'adjustWfh']);
                Route::put('/update-status-description', [SubmissionController::class, 'updateStatusDescriptionWfh']);
            });
        });

        // grup office
        Route::group(['prefix' => 'office'], function () {
            Route::get('/', [OfficeController::class, 'index']);
            Route::post('/add', [OfficeController::class, 'add']);
            Route::post('/create', [OfficeController::class, 'create']);
            Route::get('/generate', [OfficeController::class, 'generate']);
            Route::get('/download', [OfficeController::class, 'download']);

            // grup office_id
            Route::group(['prefix' => '{office_id}'], function () {
                Route::put('/update', [OfficeController::class, 'update']);
                Route::put('/edit', [OfficeController::class, 'edit']);
                Route::get('/detail', [OfficeController::class, 'detail']);
                Route::get('/delete', [OfficeController::class, 'delete']);
            });
        });

        // grup shift
        Route::group(['prefix' => 'shift'], function () {
            Route::get('/', [ShiftController::class, 'index']);
            Route::post('/create', [ShiftController::class, 'create']);

            // grup shift_id
            Route::group(['prefix' => '{shift_id}'], function () {
                Route::put('/update', [ShiftController::class, 'update']);
                Route::get('/delete', [ShiftController::class, 'delete']);
            });
        });

        // grup role
        Route::group(['prefix' => 'role'], function () {
            Route::get('/', [RoleController::class, 'index']);
            Route::post('/create', [RoleController::class, 'create']);

            // grup role_id
            Route::group(['prefix' => '{role_id}'], function () {
                Route::put('/update', [RoleController::class, 'update']);
                Route::get('/delete', [RoleController::class, 'delete']);
            });
        });

        // grup user
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/create', [UserController::class, 'create']);

            // grup user_id
            Route::group(['prefix' => '{user_id}'], function () {
                Route::put('/update', [UserController::class, 'update']);
                Route::put('/update-by-admin', [UserController::class, 'updateByAdmin']);
                Route::get('/profile', [UserController::class, 'profile']);
                Route::get('/edit-data', [UserController::class, 'editData']);
                Route::get('/edit-password', [UserController::class, 'editPassword']);
                Route::post('/update-data', [UserController::class, 'updateData']);
                Route::post('/update-password', [UserController::class, 'updatePassword']);
                Route::get('/delete', [UserController::class, 'delete']);
            });
        });

    });

});