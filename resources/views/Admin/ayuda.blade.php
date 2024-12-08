<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@include('Components.Admin.header')
<style>
    .table {
        border: 3px solid #6c7d47;
        /* Earthy green border */
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(108, 125, 71, 0.3);
        /* Subtle shadow */
        width: 100%;
        overflow: hidden;
        position: relative;
        animation: borderBlink 3s infinite alternate;
        /* Animate the border effect */
    }

    .table th {
        background-color: #a8b67a;
        /* Light green header */
        color: #4d5e26;
        /* Dark green text */
        padding: 10px;
    }

    .table td {
        border-bottom: 1px solid #ddd;
        padding: 10px;
    }

    .table tr:hover {
        background-color: #eaf0d5;
        /* Light green row hover effect */
    }

    .table img {
        border: 2px solid #6c7d47;
        /* Add a border to images */
        border-radius: 5px;
    }

    /* Keyframe animation for the rotating blinking border effect */
    @keyframes borderBlink {
        0% {
            border-color: #6c7d47;
            /* Earthy green border */
            box-shadow: 0 0 15px #6c7d47;
            /* Subtle glowing effect */
        }

        50% {
            border-color: #a8b67a;
            /* Lighter green */
            box-shadow: 0 0 15px #a8b67a;
            /* Glowing effect in lighter green */
        }

        100% {
            border-color: #4d5e26;
            /* Dark green */
            box-shadow: 0 0 15px #4d5e26;
            /* Glowing effect in dark green */
        }
    }
</style>


<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    {{-- <a href="#" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <!-- SVG Logo -->
                            <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <!-- SVG Paths -->
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Agtech</span>
                    </a> --}}

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>
                @include('Components.Admin.sidebar')
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">

                        </div>
                        <!-- /Search -->
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Main Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <!-- Table -->
                    <div class="card">
                        <h5 class="card-header">Farmer Assitance</h5>
                        <div class="button-container" style="display: flex; justify-content: flex-start;">
                            <button onclick="generateReport()" class="btn btn-primary">Generate Report</button>
                        </div>


                        <!-- Add a container div for positioning -->
                        <div class="button-container" style="display: flex; justify-content: flex-end;">

                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table">
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
                                        <th>Assistance Type</th>
                                        <th>Assistance History</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calamityReport as $report)
                                        <tr>
                                            <td>{{ $report->first_name }} {{ $report->middle_name }}
                                                {{ $report->surname }} {{ $report->extension_name }}</td>
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
                                                    <span
                                                        class="badge bg-warning text-dark">{{ $report->status }}</span>
                                                @elseif($report->status == 'Canceled')
                                                    <span
                                                        class="badge bg-danger text-white">{{ $report->status }}</span>
                                                @elseif($report->status == 'Accepted')
                                                    <span
                                                        class="badge bg-success text-white">{{ $report->status }}</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary text-white">{{ $report->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (is_array($report->proof_images) && count($report->proof_images) > 0)
                                                    @foreach ($report->proof_images as $image)
                                                        <img src="{{ asset($image) }}" alt="Proof Image" width="100"
                                                            height="100">
                                                    @endforeach
                                                @elseif(is_string($report->proof_images) && !empty($report->proof_images))
                                                    <img src="{{ asset($report->proof_images) }}" alt="Proof Image"
                                                        width="100" height="100">
                                                @else
                                                    No Image Available
                                                @endif
                                            </td>
                                            <td>{{ $report->assistance_type }}</td>
                                            <td>
                                                @foreach ($report->assistanceHistories as $history)
                                                    <span class="badge bg-info">{{ $history->assistance_type }} -
                                                        {{ \Carbon\Carbon::parse($history->date_provided)->format('F d, Y') }}</span><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($report->status !== 'completed' && $report->status !== 'canceled')
                                                    <form id="completeForm{{ $report->id }}"
                                                        action="{{ route('calamity-report.complete', $report->id) }}"
                                                        method="post" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-primary">Mark as
                                                            Completed</button>
                                                    </form>
                                                @endif

                                                @if ($report->status !== 'canceled')
                                                    <form id="cancelForm{{ $report->id }}"
                                                        action="{{ route('calamity-report.cancel', $report->id) }}"
                                                        method="post" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-warning">Cancel</button>
                                                    </form>
                                                @endif

                                                <!-- Add Buttons for Assistance -->
                                                <form id="cashAssistanceForm{{ $report->id }}"
                                                    action="{{ route('calamity-report.store-assistance', ['id' => $report->id, 'assistanceType' => 'Cash Assistance']) }}"
                                                    method="post" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success">Cash
                                                        Assistance</button>
                                                </form>

                                                <form id="seedAssistanceForm{{ $report->id }}"
                                                    action="{{ route('calamity-report.store-assistance', ['id' => $report->id, 'assistanceType' => 'Seed Assistance']) }}"
                                                    method="post" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success">Seed
                                                        Assistance</button>
                                                </form>

                                                <form id="fertilizerAssistanceForm{{ $report->id }}"
                                                    action="{{ route('calamity-report.store-assistance', ['id' => $report->id, 'assistanceType' => 'Fertilizer Assistance']) }}"
                                                    method="post" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success">Fertilizer
                                                        Assistance</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>

                    <!-- / Table -->
                </div>
                <!-- / Main Content -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Assistance History Modal -->
    <div class="modal fade" id="assistanceHistoryModal" tabindex="-1" aria-labelledby="assistanceHistoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assistanceHistoryModalLabel">Assistance History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="assistanceHistoryContent">
                    <!-- Dynamic Content for Assistance History Will Go Here -->
                </div>
            </div>
        </div>
    </div>



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('Components.Admin.Script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include SweetAlert2 CSS & JS -->



    <script>
        // Check for success session data and show toast
        @if (session('success'))
            $(document).ready(function() {
                $.notify({
                    message: "{{ session('success') }}"
                }, {
                    type: 'success',
                    delay: 5000, // 5 seconds
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
    <script>
        function generateReport() {
            var printContents = document.querySelector('.table').outerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = '<html><head><title>Report</title><style>body { font-family: Arial, sans-serif; margin: 20px;} .table {border: 1px solid #ddd; border-collapse: collapse; width: 100%;} .table th, .table td {padding: 8px 12px; text-align: left;} .table th {background-color: #f2f2f2;} .table tr:nth-child(even) {background-color: #f9f9f9;} .table tr:hover {background-color: #f1f1f1;}</style></head><body>' + printContents + '</body></html>';
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

</body>

</html>
