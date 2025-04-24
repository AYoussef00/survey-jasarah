<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function showPreprationPage(){
        return view(view: "pages.preparation");
    }


    public function showQuestionPage(){
        return view(view: "pages.question");
    }

    public function getQuestions()
    {
        $questions = DB::table('questions')->get();

        return view('pages.question', ['questions' => $questions]);
    }



    public function storeResponses(Request $request)
    {
        // التحقق من صحة المدخلات
        $request->validate([
            'name' => 'required|string|max:255',
            'responses' => 'required|array', // تأكد من أن الإجابات موجودة
        ]);

        // تخزين الإجابات في قاعدة البيانات
        foreach ($request->responses as $question_id => $response) {
            $data = [
                'name' => $request->name,
                'question_id' => $question_id,
                'answers' => is_array($response) ? ($response['answer'] ?? null) : ($response == 'نعم' || $response == 'لا' ? $response : null),
                'notes' => is_array($response) ? $response['notes'] ?? null : null,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // أضف التقييم فقط إذا كان موجودًا
            if (is_array($response) && isset($response['rating'])) {
                $data['rating'] = $response['rating'];
            }

            DB::table('responses')->insert($data);
        }

        return redirect()->back()->with('success', 'تم إرسال الإجابات بنجاح');
    }
}
