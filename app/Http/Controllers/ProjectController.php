<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function showPreprationPage(){
        return view(view: "pages.preparation");
    }


    public function showQuestionPage(){
        return view(view: "pages.question");
    }

    public function saveAttendance(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::table('students')->insert([
            'name' => $request->input('name'),
            'attendance_time' => Carbon::now('Asia/Riyadh')->format('H:i:s'),
            'attendance_date' => Carbon::now('Asia/Riyadh')->toDateString(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('preparation.view')->with('status', 'شكراً لتسجيل حضورك');
    }
}
