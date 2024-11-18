<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">
@include('Components.Admin.header')

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
                        <h5 class="card-header">Calamity Report</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Reporter Name</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
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
                                                @if ($report->status === 'completed')
                                                    <span class="badge"
                                                        style="background-color: #28a745; color: white;">Completed</span>
                                                @else
                                                    <span class="badge"
                                                        style="background-color: #dc3545; color: white;">Pending</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($report->status !== 'completed')
                                                    <form action="{{ route('calamity-report.complete', $report->id) }}"
                                                        method="post" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success">Mark as
                                                            Completed</button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('calamity-report.delete', $report->id) }}"
                                                    method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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

    <!-- Modal for Edit -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('Components.Admin.Script')

    <!-- Include SweetAlert2 CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Check for success session data and show toast
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    toast: true,
                    position: 'top-end', // Top-right corner
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000, // 3 seconds
                    timerProgressBar: true
                });
            });
        @endif
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>
