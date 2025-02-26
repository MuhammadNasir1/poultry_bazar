<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .credentials {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }

        .button {
            display: inline-block;
            background: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .footer {
            font-size: 14px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">Your Login Details</div>
        <div class="content">
            Hello {{$userName}}, <br><br>
            Here are your login details for accessing your account:
            <div class="credentials">
                Email: <strong>{{$email}}</strong><br>
                Password: <strong>{$password}</strong>
            </div>
            Please use the button below to log in to your account:
            <br>

            If you did not request this information, please ignore this email.
        </div>
        <div class="footer">
            &copy;  {{ date('Y') }} Poul3y. All rights reserved.
        </div>
    </div>
</body>

</html>
