<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $questions = [
            'مدى رضاك عن جودة القاعة التدريبية من حيث الموقع، الراحة والتجهيزات؟',
            'ما مدى رضاك عن الضيافة والخدمات المقدمة خلال أيام التدريب؟',
            'تقييمك لأداء المدرب من حيث الشرح والتفاعل؟',
            'هل كان تاريخ تنفيذ البرنامج مناسبًا لك؟',
            'كان فريق البرنامج متعاون وقدم جميع سُبل المساعدة؟',
            'هل لديك أي من الاقتراحات التي تساعد على التحسين؟',
        ];

        foreach ($questions as $q) {
            Question::create([
                'question_text' => $q
            ]);
        }
    }
}
