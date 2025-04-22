<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الإستبيان</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            width: 100%;
            max-width: 500px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 30px;
            text-align: right;
        }
        .question {
            margin-bottom: 20px;
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .question.active {
            display: block;
            opacity: 1;
        }
        .question label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }
        .options label {
            display: block;
            background-color: #6c757d;
            color: #fff;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .options input[type="radio"] {
            display: none;
        }
        .options input[type="radio"]:checked + label {
            background-color: #495057;
        }
        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: #6c757d;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            margin-top: 20px;
        }
        .thank-you-message {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .home-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
            color: #007bff;
            text-decoration: none;
        }
        .home-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <form method="POST" action="#">
            @csrf

            <div id="question-1" class="question active">
                <label>ما رأيك في جودة التدريب؟</label>
                <div class="options">
                    <input type="radio" name="q1" id="q1_1" value="ضعيف جدا" onclick="nextQuestion(1)"><label for="q1_1">ضعيف جدا</label>
                    <input type="radio" name="q1" id="q1_2" value="ضعيف" onclick="nextQuestion(1)"><label for="q1_2">ضعيف</label>
                    <input type="radio" name="q1" id="q1_3" value="جيد" onclick="nextQuestion(1)"><label for="q1_3">جيد</label>
                    <input type="radio" name="q1" id="q1_4" value="جيد جدا" onclick="nextQuestion(1)"><label for="q1_4">جيد جدا</label>
                    <input type="radio" name="q1" id="q1_5" value="رائع" onclick="nextQuestion(1)"><label for="q1_5">رائع</label>
                </div>
            </div>

            <div id="question-2" class="question">
                <label>ما رأيك في المدرب؟</label>
                <div class="options">
                    <input type="radio" name="q2" id="q2_1" value="ضعيف جدا" onclick="nextQuestion(2)"><label for="q2_1">ضعيف جدا</label>
                    <input type="radio" name="q2" id="q2_2" value="ضعيف" onclick="nextQuestion(2)"><label for="q2_2">ضعيف</label>
                    <input type="radio" name="q2" id="q2_3" value="جيد" onclick="nextQuestion(2)"><label for="q2_3">جيد</label>
                    <input type="radio" name="q2" id="q2_4" value="جيد جدا" onclick="nextQuestion(2)"><label for="q2_4">جيد جدا</label>
                    <input type="radio" name="q2" id="q2_5" value="رائع" onclick="nextQuestion(2)"><label for="q2_5">رائع</label>
                </div>
            </div>

            <!-- Add more questions similarly -->

            <div id="thank-you-message" class="question">
                <p class="thank-you-message">شكرًا لك على إجابتك!</p>
                <a href="{{ url('/') }}" class="home-link">العودة إلى الصفحة الرئيسية</a>
            </div>

        </form>
    </div>

    <script>
        function nextQuestion(questionNumber) {
            const currentQuestion = document.getElementById(`question-${questionNumber}`);
            const nextQuestionEl = document.getElementById(`question-${questionNumber + 1}`);
            if (nextQuestionEl) {
                currentQuestion.classList.remove('active');
                setTimeout(() => {
                    nextQuestionEl.classList.add('active');
                }, 500);
            } else {
                // Show the thank you message after the last question
                const thankYouMessage = document.getElementById('thank-you-message');
                currentQuestion.classList.remove('active');
                setTimeout(() => {
                    thankYouMessage.classList.add('active');
                }, 500);
            }
        }
    </script>

</body>
</html>
