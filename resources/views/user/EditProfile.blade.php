<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
        }

        .background-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #e9eff1;
            background-image: url('images/farner.webp');
            background-position: center;
            background-size: cover;
            background-blur: 5px;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            width: 100%;
            max-width: 750px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile-card .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .profile-card h3 {
            font-size: 24px;
            font-weight: 600;
            color: #3b5998;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #3b5998;
            box-shadow: 0 0 5px rgba(59, 89, 152, 0.5);
        }

        .btn-submit {
            background-color: #3b5998;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #365899;
        }

        .profile-picture {
            width: 150px;  /* Increased size */
            height: 150px; /* Increased size */
            border-radius: 50%; /* Keep the container round */
            background-color: #e9eff1;
            border: 2px solid #ddd;
            margin-bottom: 20px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            overflow: hidden; /* Ensure the image doesn't overflow */
        }

        .profile-picture img {
            width: 100%; /* Ensure the image covers the container */
            height: 100%; /* Ensure the image covers the container */
            object-fit: cover; /* Crop the image to maintain aspect ratio */
            border-radius: 50%; /* Keep the image itself round */
        }

        .profile-info {
            display: flex;
            align-items: center;
        }

        .profile-info h4 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .profile-info p {
            font-size: 14px;
            color: #777;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }

        /* Hide the file input field */
        #imageInput {
            display: none;
        }
    </style>
</head>
<body>
    @include('Components.User.header')
    @include('Components.User.sidebar')

    <div class="main-panel">
        <div class="background-container">
            <div class="profile-card">
                <h3 class="fw-bold mb-3 text-center">Update Your Profile</h3>
                <form action="{{ route('profile.update') }}" method="post" id="profileForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Profile Picture Preview and File Input Inside the Form -->
                    <label for="imageInput" class="profile-picture">
                        <!-- Current profile picture preview -->
                        <img src="{{ asset(auth()->user()->profile_picture) }}" alt="Profile Picture" class="img-fluid">
                    </label>
                    <!-- Hidden file input -->
                    <input type="file" id="imageInput" name="profile_picture" accept="image/*" onchange="updateImagePreview(this)">

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rs">RS</label>
                        <input type="text" id="rs" name="rs" class="form-control"
                            value="{{ old('rs', auth()->user()->rs) }}">
                        @error('rs')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Leave blank to keep current password">
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    <script src="admin/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="admin/assets/js/core/popper.min.js"></script>
    <script src="admin/assets/js/core/bootstrap.min.js"></script>
    <script src="admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script>
        @if(session('success'))
            $(document).ready(function() {
                $.notify({
                    message: "{{ session('success') }}"
                }, {
                    type: 'success',
                    delay: 5000,
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    }
                });
            });
        @endif

        // Update the profile picture preview when a new file is selected
        function updateImagePreview(input) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.profile-picture img').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
</body>
</html>
