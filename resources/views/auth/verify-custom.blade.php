<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>მეილის ვერიფიკაცია</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admincss/css/fonts/fonts.css">
    <style>
        @font-face {
            font-family: 'ITC';
            src: url('/public/ITC Avant Garde Gothic LT Book.ttf') format('truetype');
        }

        body {
            background-color: #000000;
            color: #ffffff;
            font-family: "Noto Sans Georgian", "Noto Sans", sans-serif !important;
        }

        h1 {
            font-family: 'ITC';
            letter-spacing: 1.5px;
        }

        .email-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .email-header {
            background-color: #333333;
            padding: 20px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
            color: #ffffff;
        }

        .email-body {
            padding: 20px;
            text-align: center;
        }

        .email-body p {
            font-size: 16px;
            line-height: 1.5;
            color: #cccccc;
        }

        .verify-btn {
            background-color: #ffffff;
            color: #000000;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 30px;
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            transition: background-color 0.3s ease, color 0.3s ease;
            border: 2px solid #ffffff;
            text-decoration: none;
        }

        .verify-btn:hover {
            background-color: #cccccc;
            color: #000000;
        }

        .email-footer {
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #aaaaaa;
        }

        .email-footer a {
            color: #ffffff;
            text-decoration: none;
        }

        @media screen and (max-width: 600px) {
            .email-container {
                width: 90% !important;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>მეილის ვერიფიკაცია</h1>
        </div>
        <div class="email-body">
            <h1 style="color: white">ABSTRAGE</h1>
            <p>გამარჯობა , {{ $user->name }}</p>
            <p>მადლობა რეგისტრაციის გავლისთვის! გთხოვთ დააჭიროთ ქვედა ღილაკს, რომ გაიაროს თქვენმა მეილმა ვერიფიკაცია და
                იხილოთ ჩვენი პროდუქცია !</p>
            <div class="text-center">
                <a href="{{ $url }}" class="verify-btn">მეილის ვერიფიკაცია</a>
            </div>
            <p>ბედნიერ დღეს გისურვებთ!</p>
        </div>
        <div class="email-footer">
            <p>გესაჭიროებათ დახმარება? <a href="mailto:abstrage@gmail.com">მოგვწერეთ მეილზე</a></p>
            <p>© 2024 Abstrage. ყველა უფლება დაცულია</p>
        </div>
    </div>
</body>
</html>
