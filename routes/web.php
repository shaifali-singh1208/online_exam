<?php
use App\Http\Controllers\admin\SpeakController;

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\SuperAdminController;
use App\Http\Controllers\admin\TestController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ParagraphController;

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

// eturn view('welcome');
// });
// Route::get('/', function () {
//     r

Route::get('all_test_panel',[AdminController::class,'alltest']);
Route::post('test1',[AdminController::class,'test1']);
Route::get('test1',[AdminController::class,'test_1']);

Route::post('test2',[AdminController::class,'test2']);
Route::get('test2',[AdminController::class,'test_2']);

Route::post('test3',[AdminController::class,'test3']);
Route::get('test3',[AdminController::class,'test_3']);

Route::post('test4',[AdminController::class,'test4']);
// Route::get('test4',[AdminController::class,'test_4']);


Route::get('home',[AdminController::class,'home']);
Route::get('/',[LoginController::class,'login']);
Route::get('register',[LoginController::class,'register_user']);
Route::post('register',[LoginController::class,'register']);
Route::post('login',[LoginController::class,'loginuser']);
Route::get('/change-profile',[LoginController::class,'change_profile']);
Route::get('/change-profile/update-profile/{id}',[LoginController::class,'changeprofile']);
Route::post('/profile-update',[LoginController::class,'profile_update']);

// Route::get('/reset-password',[LoginController::class,'change_password']);
Route::get('/reset-password/{id}',[LoginController::class,'reset_pass']);
Route::post('/reset-password',[LoginController::class,'update_password']);


Route::get('paragraph',[ParagraphController::class,'paragraph']);
Route::post('paragraph',[ParagraphController::class,'add_para']);
Route::get('test_write',[ParagraphController::class,'test_write']);
Route::post('test_write',[ParagraphController::class,'test_written']);
// Route::get('speaking',[SpeakController::class,'speak']);
Route::get('listening',[SpeakController::class,'listen']);
Route::post('listening',[SpeakController::class,'listens']);


Route::get('speak',[SpeakController::class,'create']);
// Route::get('speaking',[SpeakController::class,'speak']);
Route::post('speak',[SpeakController::class,'store']);
Route::get('users',[UserController::class,'get_user']);
Route::get('users',[UserController::class,'get_user']);
Route::get('edit_users/{id}',[UserController::class,'edit_user']);
Route::post('edit_users',[UserController::class,'user_edit']);
Route::get('delete/{id}',[UserController::class,'delete']);
//
Route::get('transaction',[AdminController::class,'transaction_detail']);


// '''' superadmin---
Route::get('test',[SuperAdminController::class,'expert']);
Route::get('written_ques/{id}',[SuperAdminController::class,'written_ques']);
Route::get('written_ques/written_answer/{test_id}/{ques_id}',[SuperAdminController::class,'written_question']);

 Route::get('written_ques/written_answer/ques_answer/{id}/{test_id}/{question_id}',[SuperAdminController::class,'written_answer']);

 Route::get('written_ques/written_answer/ques_answer/update-result/{celpip}/{test_id}/{write_id}', [SuperAdminController::class, 'update_result']);

Route::post('update_written_ans',[SuperAdminController::class,'update_written_ans']);

Route::get('speaking_answer',[SuperAdminController::class,'speaking_test']);



Route::get('speaking_ques/{id}',[SuperAdminController::class,'speaking_ques']);

Route::get('speaking_ques/speaking_answer/{test_id}/{question_id}',[SuperAdminController::class,'speaking_answer']);

Route::get('speaking_ques/speaking_answer/speaking_ans/{id}/{test_id}/{question_id}',[SuperAdminController::class,'speaking_ans']);

Route::get('speaking_ques/speaking_answer/speaking_ans/update-speaking_result/{celpip}/{test_id}/{speak_id}',[SuperAdminController::class,'update_speaking_result']);

Route::post('update_speaking_ans',[SuperAdminController::class,'update_speaking_ans']);
//---alltest--
Route::get('all_test',[TestController::class,'all_test']);
Route::get('all_para/{id}',[TestController::class,'all_para']);

Route::get('edit_para/{id}',[TestController::class,'edit_para']);
Route::post('edit_para',[TestController::class,'editpara']);
Route::get('edit_para/edit-listening/{test_id}',[TestController::class,'getListeningTest']);
Route::get('edit_para/edit-listening/listening_edit_test/question/edit/{ques_id}',[TestController::class,'editlisteningTest']);
Route::post('edit-listening-ques/',[TestController::class,'edit_listening_Ques']);
Route::get('edit_para/edit-listening/listening_edit_test/question/{ques_id}',[TestController::class,'edit_listen_que']);
Route::post('edit-listen-question/',[TestController::class,'edit_listen_question']);

Route::get('edit_para/edit-reading/{test_id}',[TestController::class,'getReadingTest']);
Route::get('edit_para/edit-paragraph/paragraph_edit_test/{ques_id}',[TestController::class,'editparagraphTest']);
Route::post('edit-paragraph-ques/',[TestController::class,'edit_paragraph_Ques']);
Route::get('edit_para/edit-paragraph/paragraph_edit_test/ques/{ques_id}',[TestController::class,'edit_para_que']);
Route::post('edit-para-question/',[TestController::class,'edit_para_question']);

Route::get('edit_para/edit-listening/listening_edit_test/question/edit/listen_ques/{id}',[TestController::class,'listen_ques']);
Route::get('edit_para/edit-paragraph/paragraph_edit_test/ques/paragraph_ques/{id}',[TestController::class,'paragraph_ques']);
Route::get('edit_para/edit-writting/writting_edit_test/write_ques/{id}',[TestController::class,'write_ques']);
Route::get('edit_para/edit-speaking/speaking_edit_test/speaking_ques/{id}',[TestController::class,'speaking_ques']);

Route::get('listen/{id}',[TestController::class,'listen']);






Route::get('edit_para/edit-writting/{test_id}',[TestController::class,'getWrittingTest']);
Route::get('edit_para/edit-writting/writting_edit_test/{ques_id}',[TestController::class,'editWrittingTest']);
Route::post('edit-writting-ques/',[TestController::class,'editQues']);


Route::get('edit_para/edit-speaking/{test_id}',[TestController::class,'getSpeakingTest']);
Route::get('edit_para/edit-speaking/speaking_edit_test/{ques_id}',[TestController::class,'editspeakingTest']);
Route::post('edit-speaking-ques/',[TestController::class,'edit_speak_Ques']);


Route::get('edit_para_ques/{id}',[TestController::class,'edit_que']);
Route::post('edit_para_ques',[TestController::class,'edit_ques']);



Route::get('logout',[LoginController::class,'logout']);







