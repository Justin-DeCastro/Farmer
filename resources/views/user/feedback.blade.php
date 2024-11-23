<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agtech</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        .background-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px 10px;
            background: url('images/farner.webp') no-repeat center center;
            background-size: cover;
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

        @media (max-width: 768px) {
            .btn-submit {
                width: 100%;
                margin-bottom: 10px;
            }
            .feedback-table h3 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .modal-content {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    @include('Components.User.header')
    @include('Components.User.sidebar')

    <div class="main-panel">
        <div class="background-container">
            <div class="feedback-table">
                <h3 class="fw-bold mb-3">Feedback Reports</h3>
                <button class="btn-submit" data-bs-toggle="modal" data-bs-target="#calamityReportModal">Submit Feedback</button>
                <div class="table-responsive mt-3">
                    <table id="calamityReportsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Farmer Name</th>
                                <th>Email</th>
                                <th>Message</th>

                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $report)
                                <tr>
                                    <td>{{ $report->name }}</td>
                                    <td>{{ $report->email }}</td>
                                    <td>{{ $report->message }}</td>
                                    <td>{{ $report->status }}</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for submitting calamity report -->
    <div class="modal fade" id="calamityReportModal" tabindex="-1" aria-labelledby="calamityReportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calamityReportModalLabel">Submit Your Feedback Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('feedback.store') }}" method="post" id="feedbackForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required readonly>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required readonly>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Feedback</label>
                        <textarea id="message" name="message" class="form-control" rows="4" required>{{ old('message') }}</textarea>
                        @error('message')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn-submit">Submit Feedback</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <script>
        // Check for success session data and show toast
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

        // Initialize DataTable for calamity reports
        $(document).ready(function() {
            $('#calamityReportsTable').DataTable();
        });
    </script>
</body>
</html>
