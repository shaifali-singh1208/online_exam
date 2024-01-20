<?php

use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ParaController;
use App\Http\Controllers\api\WriteController;
use App\Http\Controllers\api\SubscriptionController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login_user']);
Route::get('get_read_test',[ParaController::class,'get_para']);
Route::get('get_write_test',[ParaController::class,'get_write_test']);
Route::post('post_write_answer',[ParaController::class,'post_test']);
Route::get('get_speak_test',[WriteController::class,'get_speak']);
Route::get('listening',[ParaController::class,'listening']);
Route::get('get_test_by_id/{user_id}/{test_id}', [TestController::class, 'get_test_by_id']);
Route::get('get_test_by_testtype/{user_id}/{test_type}', [TestController::class, 'get_test_by_testtype']);
Route::get('get_result', [TestController::class, 'get_result']);

Route::get('get_celpip_test', [TestController::class, 'celpip_Test']);
Route::post('add_result', [TestController::class, 'add_result']);

Route::post('add_speaking_result', [TestController::class, 'add_speaking_result']);

Route::post('add_speaking_answer',[WriteController::class,'add_speaking_answer']);

Route::get('/transaction/all/{user_id}', [SubscriptionController::class, 'index']);
Route::get('/transaction/current/{user_id}', [SubscriptionController::class, 'currentTransaction']);

Route::get('/profile/{user_id}', [SubscriptionController::class, 'getUserProfile']);
Route::post('/profile/edit/{user_id}', [SubscriptionController::class, 'editUserProfile']);
Route::post('/forget-password', [SubscriptionController::class, 'sendPasswordResetLink']);
Route::post('/password-reset', [SubscriptionController::class, 'updatePassword']);
Route::post('/payment-intent', [SubscriptionController::class, 'createPaymentIntent']);
Route::post('/payment/update', [SubscriptionController::class, 'updateTransaction']);
// Route::get('/payment/cancel', [SubscriptionController::class, 'createPaymentIntent']);
Route::get('/get_all_subscription', [SubscriptionController::class, 'get_all_subscription']);
Route::get('get_results/{user_id}', [TestController::class, 'get_result_by_userId']);
