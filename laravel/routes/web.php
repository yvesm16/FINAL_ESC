<?php
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user/welcome');
});

Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register', function () {
    return view('/user/register');
});

Route::get('/forgotpassword', function () {
    return view('/user/forgotpassword');
}); 
Route::post('/login', [RegisterController::class, 'login']);
Route::get('/login', function () {
    return view('/user/login');
});

Route::get('/verify', [RegisterController::class, 'verifyUser']);

Route::post('/forgotpassword', [RegisterController::class, 'forgotPassword']);
Route::get('/forgotpassword', function () {
    return view('/user/forgotpassword');
});

Route::get('/main', function () {
    return view('/user/mainmenu');
});

Route::get('/student', function () {
    return view('/user/student/mainstudent');
});

Route::get('/prof', function () {
    return view('/user/admin/mainprof');
});

Route::get('/director', function () {
    return view('/user/admin/maindirector');
});

Route::get('/department chair', function () {
    return view('/user/admin/maindc');
});

Route::get('/secretary', function () {
    return view('/user/admin/mainsec');
});

Route::get('/registrar', function () {
    return view('/user/admin/mainregistrar');
});