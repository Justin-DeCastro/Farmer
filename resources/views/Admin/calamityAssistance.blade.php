<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Assistance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @include('Components.Admin.header')
    <style>
        .table {
            border: 3px solid #6c7d47;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(108, 125, 71, 0.3);
            width: 100%;
            overflow: hidden;
            animation: borderBlink 3s infinite alternate;
        }

        .table th {
            background-color: #a8b67a;
            color: #4d5e26;
            padding: 10px;
        }

        .table td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }

        .table tr:hover {
            background-color: #eaf0d5;
        }

        .table img {
            border: 2px solid #6c7d47;
            border-radius: 5px;
        }

        @keyframes borderBlink {
            0% {
                border-color: #6c7d47;
                box-shadow: 0 0 15px #6c7d47;
            }

            50% {
                border-color: #a8b67a;
                box-shadow: 0 0 15px #a8b67a;
            }

            100% {
                border-color: #4d5e26;
                box-shadow: 0 0 15px #4d5e26;
            }
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('Components.Admin.sidebar')
            </aside>
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Main Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="card">
                        <h5 class="card-header">Farmer Assistance</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <button onclick="generateReport()" class="btn btn-primary">Generate Report</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addAssistanceModal">
                                Add Assistance
                            </button>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <!-- Date Range Filter -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" id="startDate" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" id="endDate" class="form-control">
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <!-- Table -->
                                <table class="table table-bordered" id="assistanceTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Assistance Title</th>
                                            <th>Date</th>
                                            <th>Farmer</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assistances as $assistance)
                                            <tr data-date="{{ \Carbon\Carbon::parse($assistance->assistance_date)->format('Y-m-d') }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $assistance->assistance_title }}</td>
                                                <td>{{ \Carbon\Carbon::parse($assistance->assistance_date)->format('F d, Y') }}</td>
                                                <td>
                                                    @if ($assistance->users->isNotEmpty())
                                                        @foreach ($assistance->users as $user)
                                                            {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
                                                            @if (!$loop->last)
                                                                <br> <!-- Add a line break if multiple users -->
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        No User Assigned
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('assistances.destroy', $assistance->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
                                                            Delete
                                                        </button>
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
                <!-- Modal -->
                <div class="modal fade" id="addAssistanceModal" tabindex="-1" aria-labelledby="addAssistanceModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('assistances.store') }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Assistance</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Assistance Title -->
                                    <div class="mb-3">
                                        <label for="assistance_title" class="form-label">Assistance Title</label>
                                        <input type="text" id="assistance_title" class="form-control" name="assistance_title">
                                    </div>

                                    <!-- Date Picker -->
                                    <div class="mb-3">
                                        <label for="assistance_date" class="form-label">Date</label>
                                        <input type="date" id="assistance_date" class="form-control" name="assistance_date" required>
                                    </div>

                                    <!-- User Checkboxes -->
                                    <div class="mb-3">
                                        <label class="form-label">Select Users</label>
                                        <div>
                                            @foreach ($users as $user)
                                                <div class="form-check">
                                                    <input
                                                        type="checkbox"
                                                        class="form-check-input"
                                                        id="user_{{ $user->id }}"
                                                        name="user_ids[]"
                                                        value="{{ $user->id }}">
                                                    <label class="form-check-label" for="user_{{ $user->id }}">
                                                        {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
<script>
    document.getElementById('startDate').addEventListener('change', filterByDateRange);
    document.getElementById('endDate').addEventListener('change', filterByDateRange);

    function filterByDateRange() {
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        var rows = document.querySelectorAll('#assistanceTable tbody tr');
        rows.forEach(function(row) {
            var rowDate = row.getAttribute('data-date');
            if ((startDate === '' || rowDate >= startDate) && (endDate === '' || rowDate <= endDate)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Generate Report function
    function generateReport() {
        window.print(); // This will trigger the browser's print dialog
    }
</script>
</html>
