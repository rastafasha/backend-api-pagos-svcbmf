<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ActualizacionController;
use App\Http\Controllers\Admin\AdminPlanController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Admin\AdminCurrencyController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\tiposdepagoController;
use App\Http\Controllers\Admin\AdminDirectoryController;
use App\Http\Controllers\Directories\PublicDirectoryController;
use App\Http\Controllers\Auth\ChangeForgotPasswordControllerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::post('register', [AuthController::class, 'register'])
//     ->name('register');

// Route::post('login', [AuthController::class, 'login'])
//     ->name('login');



Route::group(['middleware' => 'api'], function ($router) {

    // Auth
    require __DIR__ . '/api_routes/auth.php';

    // Contacts
    require __DIR__ . '/api_routes/contact.php';

    // Currency
    require __DIR__ . '/api_routes/currency.php';

    // Directorios
    require __DIR__ . '/api_routes/directory.php';

    // Directorios
    require __DIR__ . '/api_routes/member.php';

    // Pagos
    require __DIR__ . '/api_routes/payment.php';
    
    // Tipos de Pagos
    require __DIR__ . '/api_routes/paymentMethod.php';

    // Productos
    require __DIR__ . '/api_routes/plans.php';

    // Actualizacion
    require __DIR__ . '/api_routes/actualizacion.php';

    // users
    require __DIR__ . '/api_routes/users.php';

    Route::get('/directorios', [PublicDirectoryController::class, 'index'])
        ->name('public.directories.index');


 Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])
        ->name('forgot.password');

    Route::post('/change-forgot-password', [ChangeForgotPasswordControllerController::class, 'changeForgotPassword'])
        ->name('change.forgot.password');


    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
        ->name('reset.password');

    Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])
        ->name('change.password');

    Route::post('/contact/form', [ContactFormController::class, 'contactStore'])
        ->name('contact.store');

    Route::get('/cache', function () {
        Artisan::call('cache:clear');
        return "Limpiar Cache";
    });

    Route::get('/optimize', function () {
        Artisan::call('optimize:clear');
        return "Optimización de Laravel";
    });

    Route::get('/storage-link', function () {
        Artisan::call('storage:link');
        return "Storage Link";
    });


    Route::get('/migrate-seed', function () {
        Artisan::call('migrate:refresh --seed');
        return "Migrate seed";
    });


    Route::post('file', [imageController::class, 'file'])->name('fileUpload');
    Route::post('file/class/uploader', [imageController::class, 'fileClassUploader'])->name('fileUploaderClass');


    Route::get('/currencies', [AdminCurrencyController::class, 'index'])
        ->name('currency.index');

        Route::get('/directory/show/{directory}', [AdminDirectoryController::class, 'directoryShow'])
        ->name('directory.show');

    Route::get('/paymentmethods', [tiposdepagoController::class, 'index'])
        ->name('paymentmethods.index');

    Route::post('/currency/store', [AdminCurrencyController::class, 'currencyStore'])
        ->name('currency.store');

    Route::post('/plan/store', [AdminPlanController::class, 'planStore'])
        ->name('plan.store');

    Route::post('/actualizacion/store', [ActualizacionController::class, 'store'])
        ->name('actualizacion.store');

});
