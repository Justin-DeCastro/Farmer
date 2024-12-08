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

                    <div class="row">
                        <!-- Last Name -->
                        <div class="col-md-4 form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control"
                                value="{{ old('last_name', auth()->user()->last_name) }}" required>
                            @error('last_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- First Name -->
                        <div class="col-md-4 form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control"
                                value="{{ old('first_name', auth()->user()->first_name) }}" required>
                            @error('first_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Middle Name -->
                        <div class="col-md-4 form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" id="middle_name" name="middle_name" class="form-control"
                                value="{{ old('middle_name', auth()->user()->middle_name) }}">
                            @error('middle_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Suffix -->
                        <div class="col-md-4 form-group">
                            <label for="suffix">Suffix</label>
                            <input type="text" id="suffix" name="suffix" class="form-control"
                                value="{{ old('suffix', auth()->user()->suffix) }}">
                            @error('suffix')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Farmer Address -->
                        <div class="col-md-4 form-group">
                            <label for="farmer_address">Farmer Address</label>
                            <input type="text" id="farmer_address" name="farmer_address" class="form-control"
                                value="{{ old('farmer_address', auth()->user()->farmer_address) }}" required>
                            @error('farmer_address')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Farm Location -->
                        <div class="col-md-4 form-group">
                            <label for="farm_location">Farm Location</label>
                            <input type="text" id="farm_location" name="farm_location" class="form-control"
                                value="{{ old('farm_location', auth()->user()->farm_location) }}" required>
                            @error('farm_location')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Birthdate -->
                        <div class="col-md-4 form-group">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" id="birthdate" name="birthdate" class="form-control"
                                value="{{ old('birthdate', auth()->user()->birthdate) }}" required>
                            @error('birthdate')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sex -->
                        <div class="col-md-4 form-group">
                            <label for="sex">Sex</label>
                            <select id="sex" name="sex" class="form-control" required>
                                <option value="male" {{ old('sex', auth()->user()->sex) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('sex', auth()->user()->sex) == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('sex')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div class="col-md-4 form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" id="contact_number" name="contact_number" class="form-control"
                                value="{{ old('contact_number', auth()->user()->contact_number) }}" required>
                            @error('contact_number')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- 4Ps -->
                        <div class="col-md-4 form-group">
                            <label for="fourps">4Ps</label>
                            <input type="text" id="fourps" name="fourps" class="form-control"
                                value="{{ old('fourps', auth()->user()->fourps) }}">
                            @error('fourps')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- PWD -->
                        <div class="col-md-4 form-group">
                            <label for="pwd">PWD</label>
                            <input type="text" id="pwd" name="pwd" class="form-control"
                                value="{{ old('pwd', auth()->user()->pwd) }}">
                            @error('pwd')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Indigenous -->
                        <div class="col-md-4 form-group">
                            <label for="indigenous">Indigenous</label>
                            <input type="text" id="indigenous" name="indigenous" class="form-control"
                                value="{{ old('indigenous', auth()->user()->indigenous) }}">
                            @error('indigenous')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Farm Area -->
                        <div class="col-md-4 form-group">
                            <label for="farm_area">Farm Area</label>
                            <input type="number" id="farm_area" name="farm_area" class="form-control"
                                value="{{ old('farm_area', auth()->user()->farm_area) }}" required>
                            @error('farm_area')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Area Planted -->
                        <div class="col-md-4 form-group">
                            <label for="area_planted">Area Planted</label>
                            <input type="number" id="area_planted" name="area_planted" class="form-control"
                                value="{{ old('area_planted', auth()->user()->area_planted) }}" required>
                            @error('area_planted')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Commodity -->
                        <div class="col-md-4 form-group">
                            <label for="commodity">Commodity</label>
                            <input type="text" id="commodity" name="commodity" class="form-control"
                                value="{{ old('commodity', auth()->user()->commodity) }}" required>
                            @error('commodity')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
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

    </script>
</body>
</html>
