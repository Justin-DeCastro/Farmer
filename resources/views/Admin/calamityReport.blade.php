<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">
@include('Components.Admin.header')

<style>
    .table {
        border: 3px solid #6c7d47;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(108, 125, 71, 0.3);
        width: 100%;
        overflow: hidden;
        position: relative;
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

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                @include('Components.Admin.sidebar')
            </aside>

            <div class="layout-page">
                <nav class="" id="layout-navbar">
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <div class="navbar-nav align-items-center">
                            <!-- Generate Report and Print Button -->

                            <button class="btn btn-success" id="printBtn" onclick="window.print();">Generate Report</button>
                        </div>
                    </div>
                </nav>

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="card">
                        <h5 class="card-header">Calamity Report</h5>
                        <div class="table-responsive text-nowrap">
                           <!-- Date Range Filters -->
                           <div class="mb-3 row">
                            <div class="col">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" id="startDate" class="form-control">
                            </div>
                            <div class="col">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" id="endDate" class="form-control">
                            </div>
                        </div>


                        <table class="table" id="calamityReportTable">
                            <thead>
                                <tr>
                                    <th>Farmer Name</th>
                                    <th>Birthdate</th>
                                    <th>Region</th>
                                    <th>Province</th>
                                    <th>Municipality</th>
                                    <th>Barangay</th>
                                    <th>Calamity</th>
                                    <th>Farmer Type</th>
                                    <th>RSBSA Ref Number</th>
                                    <th>Crops or Livestocks</th>
                                    <th>Farm Type</th>
                                    <th>Animal Type</th>
                                    <th>Age Classification</th>
                                    <th>No. of Heads</th>
                                    <th>Damage Area</th>
                                    <th>Total Area</th>
                                    <th>Sex</th>
                                    <th>Tribe Name</th>
                                    <th>PWD</th>
                                    <th>ARB</th>
                                    <th>4Ps</th>
                                    <th>Male Count</th>
                                    <th>Female Count</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($calamityReport as $report)
                                    @if ($report->report_status !== 'completed') <!-- Exclude completed status -->
                                        <tr data-date="{{ \Carbon\Carbon::parse($report->created_at)->format('Y-m-d') }}">
                                            <td>{{ $report->first_name }} {{ $report->middle_name }} {{ $report->surname }} {{ $report->extension_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($report->birthdate)->format('F d, Y') }}</td>
                                            <td>{{ $report->region }}</td>
                                            <td>{{ $report->province }}</td>
                                            <td>{{ $report->municipality }}</td>
                                            <td>{{ $report->barangay }}</td>
                                            <td>{{ $report->calamity }}</td>
                                            <td>{{ $report->farmer_type }}</td>
                                            <td>{{ $report->rsbsa_ref_number }}</td>
                                            <td>{{ $report->crops_or_livestocks }}</td>
                                            <td>{{ $report->farm_type }}</td>
                                            <td>{{ $report->animal_type }}</td>
                                            <td>{{ $report->age_classification }}</td>
                                            <td>{{ $report->no_of_heads }}</td>
                                            <td>
                                                Partial: {{ $report->partial_damage_area }}<br>
                                                Total: {{ $report->totally_damage_area }}
                                            </td>
                                            <td>{{ $report->total_area }}</td>
                                            <td>{{ $report->sex }}</td>
                                            <td>{{ $report->tribe_name }}</td>
                                            <td>{{ $report->pwd ? 'Yes' : 'No' }}</td>
                                            <td>{{ $report->arb ? 'Yes' : 'No' }}</td>
                                            <td>{{ $report->four_ps ? 'Yes' : 'No' }}</td>
                                            <td>{{ $report->male_count }}</td>
                                            <td>{{ $report->female_count }}</td>
                                            <td>
                                                @if ($report->status == 'Pending')
                                                    <span class="badge bg-warning text-dark">{{ $report->status }}</span>
                                                @elseif($report->status == 'Canceled')
                                                    <span class="badge bg-danger text-white">{{ $report->status }}</span>
                                                @elseif($report->status == 'Accepted')
                                                    <span class="badge bg-success text-white">{{ $report->status }}</span>
                                                @else
                                                    <span class="badge bg-secondary text-white">{{ $report->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (is_array($report->proof_images) && count($report->proof_images) > 0)
                                                    @foreach ($report->proof_images as $image)
                                                        <img src="{{ asset($image) }}" alt="Proof Image" width="100" height="100">
                                                    @endforeach
                                                @elseif(is_string($report->proof_images) && !empty($report->proof_images))
                                                    <img src="{{ asset($report->proof_images) }}" alt="Proof Image" width="100" height="100">
                                                @else
                                                    No Image Available
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($report->created_at)->format('F d, Y') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $report->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $report->id }}">
                                                        @if ($report->status !== 'Canceled') <!-- Only show if not canceled -->
                                                            <li>
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="event.preventDefault(); document.getElementById('cancelForm{{ $report->id }}').submit();">
                                                                    Cancel
                                                                </a>
                                                                <form id="cancelForm{{ $report->id }}" action="{{ route('calamity-report.cancel', $report->id) }}" method="post" style="display: none;">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                </form>
                                                            </li>
                                                        @endif
                                                        @if ($report->status !== 'completed') <!-- Ensure 'completed' reports are excluded here as well -->
                                                            <li>
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="event.preventDefault(); document.getElementById('completeForm{{ $report->id }}').submit();">
                                                                    Mark as Completed
                                                                </a>
                                                                <form id="completeForm{{ $report->id }}" action="{{ route('calamity-report.complete', $report->id) }}" method="post" style="display: none;">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                </form>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>

                        </table>


<!-- JavaScript to Filter by Date Range -->
<script>
    document.getElementById('startDate').addEventListener('change', filterByDateRange);
    document.getElementById('endDate').addEventListener('change', filterByDateRange);

    function filterByDateRange() {
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        var rows = document.querySelectorAll('#calamityReportTable tbody tr');
        rows.forEach(function(row) {
            var rowDate = row.getAttribute('data-date');
            if ((startDate === '' || rowDate >= startDate) && (endDate === '' || rowDate <= endDate)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    @include('Components.Admin.Script')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        });
        @endif
    </script>

</body>
</html>
