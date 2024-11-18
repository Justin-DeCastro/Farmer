<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #ffcccc;
            padding: 10px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Critical Weather Alert</h2>
    </div>
    <div class="content">
        <p>Dear Farmer,</p>
        <p>We want to inform you about the upcoming critical weather conditions in <strong>{{ $emailData['city'] }}</strong>.</p>
        <ul>
            <li><strong>Temperature:</strong> {{ $emailData['temperature'] }}°C</li>
            <li><strong>Condition:</strong> {{ $emailData['description'] }}</li>
        </ul>
        <p>Please take necessary precautions to protect your crops and livestock.</p>
        <p>Thank you, <br> AgriTech Team</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} AgriTech. All Rights Reserved.
    </div>
</body>
</html>
