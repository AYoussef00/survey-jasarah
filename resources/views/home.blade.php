<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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
        .menu-container {
            text-align: center;
            width: 100%;
            max-width: 420px;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .menu-container img {
            width: 240px;
            margin-bottom: 20px;
        }
        .menu-button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 16px;
            border: 2px solid #28a745;
            border-radius: 10px;
            background-color: #ffffff;
            color: #28a745;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .menu-button:hover {
            background-color: #28a745;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <div class="menu-container">
        <div style="display: flex; justify-content: center; align-items: center; gap: 20px; margin-bottom: 20px;">
            <img src="{{ asset('asset/images/second-logo.png') }}" alt="Side" style="width: 100px;">
            <img src="{{ asset('asset/images/logo.png') }}" alt="Logo" style="width: 200px;">
        </div>
        <a href="{{ route('preparation.view') }}" class="menu-button">تسجيل الحضور</a>
        {{-- <a href="{{ route('questions.view') }}" class="menu-button">الإستبيان</a> --}}
        <a href="{{ asset('files/Agenda.pdf') }}" class="menu-button" target="_blank">عن البرنامج</a>
        <a href="{{ asset('files/guide.pdf') }}" class="menu-button" target="_blank">دليلك في مدريد</a>
        <a href="https://www.google.com/maps/place/%D9%81%D9%86%D8%AF%D9%82+%D9%85%D8%A7%D9%86%D8%B3%D8%A7%D8%B1%D8%AF+%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%D8%8C+%D8%B1%D8%A7%D8%AF%D9%8A%D8%B3%D9%88%D9%86+%D9%83%D9%88%D9%84%D9%8A%D9%83%D8%B4%D9%86%E2%80%AD/@24.7836736,46.6528016,17z/data=!3m1!4b1!4m9!3m8!1s0x3e2ee322ac19326f:0x22b5b911df192888!5m2!4m1!1i2!8m2!3d24.7836736!4d46.6528016!16s%2Fg%2F11dd_rlqxy?entry=ttu&g_ep=EgoyMDI1MDQxNi4xIKXMDSoASAFQAw%3D%3D" class="menu-button" target="_blank">موقع فندق مانسارد</a>
        <a href="#" class="menu-button" onclick="showContactModal(event)">تواصل معنا</a>

    </div>

    <div id="contactModal" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; padding: 30px; border-radius: 10px; text-align: center; max-width: 400px; width: 90%;">
            <h5 style="margin-bottom: 15px;">📞 للتواصل معنا</h5>
            <p dir="ltr" style="font-size: 18px; text-align: center;">
                <a href="https://wa.me/966530168063" target="_blank" style="text-decoration: none; color: inherit;">
                    <strong>+966 530 168 063</strong>
                </a>
            </p>
            <button onclick="hideContactModal()" style="margin-top: 20px; padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 8px;">إغلاق</button>
        </div>
    </div>

    <script>
        function showContactModal(e) {
            e.preventDefault();
            document.getElementById('contactModal').style.display = 'flex';
        }

        function hideContactModal() {
            document.getElementById('contactModal').style.display = 'none';
        }
    </script>

</body>
</html>
