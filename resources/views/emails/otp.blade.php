<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OTP Email</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
    }

    .email-container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #ffffff;
      border: 1px solid #dddddd;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .header {
      background-color: #007bff;
      color: #ffffff;
      text-align: center;
      padding: 20px;
    }

    .header h1 {
      margin: 0;
      font-size: 24px;
    }

    .content {
      padding: 20px;
      text-align: center;
    }

    .content p {
      font-size: 16px;
      color: #333333;
      line-height: 1.6;
      margin: 15px 0;
    }

    .otp {
      display: inline-block;
      font-size: 24px;
      font-weight: bold;
      color: #007bff;
      background-color: #f0f8ff;
      padding: 10px 20px;
      border-radius: 4px;
      margin: 20px 0;
    }

    .footer {
      background-color: #f1f1f1;
      text-align: center;
      padding: 10px;
      font-size: 14px;
      color: #777777;
    }

    .footer a {
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="email-container">
    <div class="header">
      <h1>poul3y</h1>
    </div>

    <div class="content">
      <p>Hi [Recipient's Name],</p>
      <p>Your One-Time Password (OTP) for verification is:</p>
      <div class="otp">{{$otp}}</div>
      <p>This OTP is valid for the next 10 minutes. Please do not share it with anyone.</p>
      <p>If you didn’t request this, please ignore this email or contact our support.</p>
    </div>

    <div class="footer">
      <p>Thank you,<br>The poul3y Team</p>
      <p><a href="#">Privacy Policy</a> | <a href="#">Contact Support</a></p>
    </div>
  </div>
</body>

</html>
