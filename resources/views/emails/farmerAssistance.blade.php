<html>
<body>
    <h1>Hello, {{ $name }}!</h1>
    <p>We are reaching out to offer you the following assistance:</p>
    <p><strong>Location:</strong> {{ $location }}</p>
    <p><strong>Assistance Details:</strong> {{ $assistanceDetails }}</p>
    <p>We hope this helps, and please feel free to contact us for further support.</p>
    <p>Thank you, <br> AgriTech Team</p>

    <div class="footer">
        &copy; {{ date('Y') }} AgriTech. All Rights Reserved.
    </div>
</body>
</html>
