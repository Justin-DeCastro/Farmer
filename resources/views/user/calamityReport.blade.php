<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agtech</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
    <style>
        .background-container {
            min-height: 100vh; /* Ensures it covers the entire viewport */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .feedback-form {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            border: none; /* Removed border for seamless look */
            border-radius: 8px;
            background-color: rgba(249, 249, 249, 0.3); /* Increased transparency */
            backdrop-filter: blur(5px); /* Optional blur effect */
        }
        .feedback-form h3 {
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
            <div class="feedback-form">
                <h3 class="fw-bold mb-3">Submit Your Calamity Report</h3>
                <form action="{{ route('calamity-report.store') }}" method="post" id="calamityReportForm">
                    @csrf
                    <div class="form-group">
                        <label for="reporterName">Farmer Name</label>
                        <input type="text" id="reporterName" name="reporterName" class="form-control"
                            value="{{ old('reporterName') }}" required>
                        @error('reporterName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location">Calamity Location</label>
                        <input type="text" id="location" name="location" class="form-control"
                            value="{{ old('location') }}" required>
                        @error('location')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Calamity Description</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn-submit">Submit Report</button>
                </form>

            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="admin/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="admin/assets/js/core/popper.min.js"></script>
    <script src="admin/assets/js/core/bootstrap.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <script>
        // Check for success session data and show toast
        @if(session('success'))
            $(document).ready(function() {
                $.notify({
                    message: "{{ session('success') }}"
                }, {
                    type: 'success',
                    delay: 5000, // 5 seconds
                    placement: {
                        from: "top",
                        align: "right" // Align toast to the right
                    },
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    }
                });
            });
        @endif
    </script>

    <!-- Other JS Files -->
    <script src="admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="admin/assets/js/plugin/chart.js/chart.min.js"></script>
    <script src="admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <script src="admin/assets/js/plugin/chart-circle/circles.min.js"></script>
    <script src="admin/assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="admin/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="admin/assets/js/plugin/jsvectormap/world.js"></script>
    <script src="admin/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="admin/assets/js/kaiadmin.min.js"></script>
    <script src="admin/assets/js/setting-demo.js"></script>
    {{-- <script src="admin/assets/js/demo.js"></script> --}}
</body>
</html>
