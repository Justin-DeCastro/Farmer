<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
    <style>
        .background-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .profile-form {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            background-color: rgba(249, 249, 249, 0.3);
            backdrop-filter: blur(5px);
        }
        .profile-form h3 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 4px;
        }
        .btn-submit {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    @include('Components.User.header')
    @include('Components.User.sidebar')

    <div class="main-panel">
        <div class="background-container" style="background: url('images/farner.webp') no-repeat center center; background-size: cover;">
            <div class="profile-form">
                <h3 class="fw-bold mb-3">Update Your Profile</h3>
                <form action="{{ route('profile.update') }}" method="post" id="profileForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="rs">RS</label>
                        <input type="text" id="rs" name="rs" class="form-control"
                            value="{{ old('rs', auth()->user()->rs) }}">
                        @error('rs')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Enter new password (leave blank to keep current)">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
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
    </script>
</body>
</html>
