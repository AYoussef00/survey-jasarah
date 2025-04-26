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
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
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
            text-align: center;
            width: 100%;
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
        .star-rating {
            direction: ltr;
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .star {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s;
        }
        .star.selected,
        .star:hover,
        .star:hover ~ .star {
            color: #f0ad4e;
        }
        .menu-button.small-button {
            font-size: 14px;
            padding: 10px 20px;
            width: auto;
        }
        .bordered-button {
            border: 2px solid #28a745;
            padding: 10px 20px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .bordered-button:hover {
            background-color: #28a745;
            color: #fff;
            transform: scale(1.05);
        }
        .black-text {
            color: black;
            text-decoration: none;
        }
        .black-text:hover {
            color: black;
            background-color: transparent;
        }
        .star.hovered {
            color: #f0ad4e;
        }
    </style>
</head>
<body>

    <div class="form-container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('responses.store') }}">
            @csrf

            <div id="user-info" class="question active">
                <label for="username">من فضلك أدخل اسمك:</label>
                <input type="text" name="name" id="name" class="form-control mb-3" required>
                <button type="button" class="submit-btn" onclick="goToFirstQuestion()">التالي</button>
                <div class="d-flex justify-content-center">
                    <a href="{{ url('/') }}" class="home-link">العودة إلى الصفحة الرئيسية</a>
                </div>
            </div>

            @foreach($questions as $index => $question)
            <input type="hidden" name="question_id[]" value="{{ $question->id }}">

            @if ($index == 3 || $index == 4)
                <div id="question-{{ $index + 1 }}" class="question">
                    <div class="d-flex justify-content-center">
                        <p class="question-progress small text-secondary mb-3">السؤال {{ $index + 1 }} من {{ count($questions) }}</p>
                    </div>
                    <label>{{ $question->question_text }}</label>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="menu-button small-button bordered-button black-text" onclick="event.preventDefault(); document.querySelector('input[name=\'responses[{{ $question->id }}]\'][value=\'نعم\']').checked = true; nextQuestion({{ $index + 1 }});">نعم</a>
                        <a href="#" class="menu-button small-button bordered-button black-text" onclick="event.preventDefault(); document.querySelector('input[name=\'responses[{{ $question->id }}]\'][value=\'لا\']').checked = true; nextQuestion({{ $index + 1 }});">لا</a>
                    </div>
                    <input type="radio" name="responses[{{ $question->id }}]" value="نعم" style="display:none;" required>
                    <input type="radio" name="responses[{{ $question->id }}]" value="لا" style="display:none;">
                    <input type="hidden" name="answers[{{ $question->id }}]" value="نعم">
                    <div class="d-flex justify-content-center">
                        <a href="{{ url('/') }}" class="home-link">العودة إلى الصفحة الرئيسية</a>
                    </div>
                </div>
            @elseif ($index == count($questions) - 1)
                <div id="question-{{ $index + 1 }}" class="question">
                    <div class="d-flex justify-content-center">
                        <p class="question-progress small text-secondary mb-3">السؤال {{ $index + 1 }} من {{ count($questions) }}</p>
                    </div>
                    <label>{{ $question->question_text }}</label>
                    <input type="hidden" name="responses[{{ $question->id }}]" value="0">

                    <!-- حقل الملاحظات الاختياري -->
                    <div class="mt-3">
                        <label for="notes" class="form-label">ملاحظات إضافية (اختياري):</label>
                        <textarea name="responses[{{ $question->id }}][notes]" id="notes" class="form-control" rows="3" placeholder="أضف ملاحظاتك إن وجدت..."></textarea>
                    </div>

                    <button type="submit" class="submit-btn">إرسال إجابتك</button>
                    <div class="d-flex justify-content-center">
                        <a href="{{ url('/') }}" class="home-link">العودة إلى الصفحة الرئيسية</a>
                    </div>
                </div>
            @else
                <div id="question-{{ $index + 1 }}" class="question">
                    <div class="d-flex justify-content-center">
                        <p class="question-progress small text-secondary mb-3">السؤال {{ $index + 1 }} من {{ count($questions) }}</p>
                    </div>
                    <label>{{ $question->question_text }}</label>
                    <div class="options star-rating" data-question="{{ $index + 1 }}">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star" data-value="{{ $i }}">&#9733;</span>
                        @endfor
                        <input type="hidden" name="responses[{{ $question->id }}][rating]" id="q{{ $index + 1 }}" value="0">
                    </div>
                    <button type="button" class="submit-btn mt-3" style="display:none;" id="next-btn-{{ $index + 1 }}" onclick="nextQuestion({{ $index + 1 }})">التالي</button>
                    <div class="d-flex justify-content-center">
                        <a href="{{ url('/') }}" class="home-link">العودة إلى الصفحة الرئيسية</a>
                    </div>
                </div>
            @endif
            @endforeach

            <div id="thank-you-message" class="question">
                <p class="thank-you-message">شكرًا لك على إجابتك!</p>
                <button type="submit" class="submit-btn">إرسال الإجابات</button>
                <div class="d-flex justify-content-center">
                    <a href="{{ url('/') }}" class="home-link">العودة إلى الصفحة الرئيسية</a>
                </div>
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
                const thankYouMessage = document.getElementById('thank-you-message');
                currentQuestion.classList.remove('active');
                setTimeout(() => {
                    thankYouMessage.classList.add('active');
                }, 500);
            }
        }

        function goToFirstQuestion() {
            const nameInput = document.getElementById('name');
            if (nameInput.value.trim() === '') {
                alert('يرجى إدخال الاسم أولاً');
                return;
            }
            document.getElementById('user-info').classList.remove('active');
            document.getElementById('question-1').classList.add('active');
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.star-rating').forEach(rating => {
                // اجعل ترتيب النجوم من اليمين لليسار مع العد من اليمين (1) إلى اليسار (5)
                const stars = Array.from(rating.querySelectorAll('.star'));
                const input = rating.querySelector('input[name^="responses"][name$="[rating]"]');
                stars.forEach((star, index) => {
                    star.addEventListener('mouseenter', () => {
                        stars.forEach((s, i) => {
                            s.classList.toggle('hovered', i >= index);
                        });
                    });

                    star.addEventListener('mouseleave', () => {
                        stars.forEach(s => s.classList.remove('hovered'));
                    });

                    star.addEventListener('click', () => {
                        let count = 0;
                        stars.forEach((s, i) => {
                            if (i >= index) {
                                s.classList.add('selected');
                                count++;
                            } else {
                                s.classList.remove('selected');
                            }
                        });
                        input.value = count;  // عدد النجوم التي أصبحت صفراء فعليًا
                        const qNumber = rating.getAttribute('data-question');
                        document.getElementById('next-btn-' + qNumber).style.display = 'block';
                    });
                });
            });
        });
    </script>

</body>
</html>
