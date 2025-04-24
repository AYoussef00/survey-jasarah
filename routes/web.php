<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
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
    return view('home');
});

Route::get('/preparation', action: [ProjectController::class,'showPreprationPage'])->name('preparation.view');
Route::get('/qestions', action: [ProjectController::class,'showQuestionPage'])->name('question.view');

Route::post('/attendance', [ProjectController::class, 'saveAttendance'])->name('attendance.save');
Route::get('/view-questions', [ProjectController::class, 'getQuestions'])->name('questions.view');
Route::post('/responses', [ProjectController::class, 'storeResponses'])->name('responses.store');
