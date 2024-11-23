<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agtech</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
    <style>
        .background-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 20px;
        }

        .feedback-table {
            max-width: 100%;
            width: 100%;
            padding: 20px;
            background-color: rgba(249, 249, 249, 0.3);
            backdrop-filter: blur(5px);
            color: #333;
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

        /* Make the table responsive */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Media Queries for smaller screens */
        @media (max-width: 767px) {
            .feedback-table {
                padding: 10px;
            }

            .table th, .table td {
                font-size: 12px; /* Adjust font size for smaller screens */
            }

            .btn-submit {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    @include('Components.User.header')
    @include('Components.User.sidebar')

    <div class="main-panel">
        <div class="background-container" style="background: url('images/farner.webp') no-repeat center center; background-size: cover;">
            <div class="feedback-table">
                <h3 class="fw-bold mb-3">All Data</h3>

                <div class="table-responsive"> <!-- Add table responsive class -->
                    <table id="calamityReportsTable" class="table table-striped table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Crop Types</th>
                                <th>Livestock Types</th>
                                <th>Location</th>
                                <th>Crop Images</th>
                                <th>Livestock Images</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($farmers as $farmer)
                                <tr>
                                    <td>{{ $farmer->name }}</td>
                                    <td>{{ $farmer->email }}</td>
                                    <td>{{ $farmer->phone }}</td>
                                    <td>{{ $farmer->crop_types }}</td>
                                    <td>{{ $farmer->livestock_types }}</td>
                                    <td>{{ $farmer->location }}</td>
                                    <td>
                                        @if ($farmer->crop_images)
                                            @foreach (json_decode($farmer->crop_images) as $image)
                                                <a href="{{ asset($image) }}" data-lightbox="crop-images" data-title="Crop Image">
                                                    <img src="{{ asset($image) }}" alt="Crop Image"
                                                        style="width: 100px; height: auto; cursor: pointer;" />
                                                </a>
                                            @endforeach
                                        @else
                                            <p>No crop images available</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($farmer->livestock_images)
                                            @foreach (json_decode($farmer->livestock_images) as $image)
                                                <a href="{{ asset($image) }}" data-lightbox="livestock-images"
                                                    data-title="Livestock Image">
                                                    <img src="{{ asset($image) }}" alt="Livestock Image"
                                                        style="width: 100px; height: auto; cursor: pointer;" />
                                                </a>
                                            @endforeach
                                        @else
                                            <p>No livestock images available</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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

    <script>
        // Initialize DataTable for calamity reports
        $(document).ready(function() {
            $('#calamityReportsTable').DataTable();
        });
    </script>
</body>
</html>
