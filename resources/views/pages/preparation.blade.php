<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدخال الاسم</title>
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
            text-align: center;
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-container img {
            width: 120px;
            margin-bottom: 20px;
        }
        .form-control {
            font-size: 18px;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        .save-button {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            border: none;
            border-radius: 10px;
            background-color: #28a745;
            color: white;
            transition: background-color 0.3s ease;
        }
        .save-button:hover {
            background-color: #218838;
        }
        .loading {
            display: none;
            font-size: 20px;
            color: #28a745;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <div style="display: flex; justify-content: center; align-items: center; gap: 20px; margin-bottom: 20px;">
            <img src="{{ asset('asset/images/second-logo.png') }}" alt="Side" style="width: 100px;">
            <img src="{{ asset('asset/images/logo.png') }}" alt="Logo" style="width: 200px;">
        </div>
        <form method="POST" action="{{ route('students.attendance') }}" onsubmit="showLoading()">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="ادخل الاسم">
            <button type="submit" class="save-button">حفظ</button>
        </form>

        <!-- Loading indicator -->
        <div id="loading" class="loading">
            جاري التسجيل...
        </div>

        <!-- Success message -->
        @if(session('success'))
            <div style="background-color: #ffffff; border: 2px solid #28a745; color: #28a745; padding: 20px; border-radius: 12px; margin-top: 20px; font-size: 20px; font-weight: bold; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div style="margin-top: 15px;">
            <a href="{{ url('/') }}" style="text-decoration: none; font-size: 16px; color: #007bff;">&larr; العودة إلى الصفحة الرئيسية</a>
        </div>
    </div>

    <script>
        function showLoading() {
            document.getElementById('loading').style.display = 'block';
        }
    </script>

</body>
</html>
