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
                <h3 class="fw-bold mb-3">Calamity Reports</h3>
                <button class="btn-submit" data-bs-toggle="modal" data-bs-target="#calamityReportModal">Submit Report</button>
                <div class="table-responsive mt-3">
                    <table id="calamityReportsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Farmer Name</th>
                                <th>Email</th>
                                <th>Calamity Location</th>
                                <th>Calamity Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calamityReport as $report)
                                <tr>
                                    <td>{{ $report->reporter_name }}</td>
                                    <td>{{ $report->email }}</td>
                                    <td>{{ $report->location }}</td>
                                    <td>{{ $report->description }}</td>
                                    <td>
                                        @if($report->status == 'Completed')
                                            <span class="badge badge-success">Completed</span>
                                        @elseif($report->status == 'For Review')
                                            <span class="badge badge-warning">For Review</span>
                                        @elseif($report->status == 'Canceled')
                                            <span class="badge badge-danger">Canceled</span>
                                        @else
                                            <span class="badge badge-secondary">Unknown</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('calamity-report.delete', $report->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
                                        </form>
                                        <form action="{{ route('calamity-report.cancel', $report->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to cancel this report?')">Cancel</button>
                                        </form>
                                    </td>
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
                    <h5 class="modal-title" id="calamityReportModalLabel">Submit Your Calamity Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('calamity-report.store') }}" method="post" id="calamityReportForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="reporterName">Farmer Name</label>
                                <input type="text" id="reporterName" name="reporterName" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                @error('reporterName')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="location">Calamity Location</label>
                            <input type="text" id="location" name="location" class="form-control" value="{{ old('location') }}" required>
                            @error('location')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Calamity Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn-submit">Submit Report</button>
                    </div>
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
