<!-- resources/views/emails/announcement.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $content }}</p>

    <!-- Footer -->
    <div class="footer" style="margin-top: 20px; text-align: center; font-size: 12px; color: #888;">
        &copy; {{ date('Y') }} AgriTech. All Rights Reserved.
    </div>
</body>
</html>
