<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Exports\QuestionsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

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

Route::post('/attendance', [ProjectController::class, 'storeStudentAttendance'])->name('students.attendance');
Route::get('/view-questions', [ProjectController::class, 'getQuestions'])->name('questions.view');
Route::post('/responses', [ProjectController::class, 'storeResponses'])->name('responses.store');


Route::get('/download-questions', function () {
    return Excel::download(new QuestionsExport, 'questions.xlsx');
});


Route::get('/export-responses', function () {

    // تعريف كلاس التصدير داخل الراوت مباشرة
    new class implements FromCollection {
        public function collection()
        {
            return DB::table('responses')->get();
        }
    };

    return Excel::download(new class implements FromCollection {
        public function collection()
        {
            return DB::table('responses')->get();
        }
    }, 'responses.xlsx');
});
