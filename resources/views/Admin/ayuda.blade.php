<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                <nav class=""
                    id="layout-navbar">
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
                        <h5 class="card-header">Messages</h5>
                        <!-- Add a container div for positioning -->
                        <div class="button-container" style="display: flex; justify-content: flex-end;">

                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Farmer Name</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Image</th> <!-- Add a column for the image -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calamityReport as $report)
                                        @if ($report->status === 'completed') <!-- Filter only completed reports -->
                                            <tr>
                                                <td>{{ $report->reporter_name }}</td>
                                                <td>{{ $report->email }}</td>
                                                <td>{{ $report->location }}</td>
                                                <td>{{ $report->description }}</td>
                                                <td>
                                                    <span class="badge" style="background-color: #28a745; color: white;">Completed</span>
                                                </td>
                                                <td>
                                                    <!-- Check if an image exists for the report and display it -->
                                                    @if ($report->image_path)
                                                        <img src="{{ asset($report->image_path) }}" alt="Report Image" style="width: 100px; height: auto;">
                                                    @else
                                                        No image uploaded
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
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
    <div class="modal fade" id="farmerAyudaModal" tabindex="-1" aria-labelledby="farmerAyudaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="farmerAyudaModalLabel">Submit Your Farmer Assistance Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('farmer-ayuda.store') }}" method="post" id="farmerAyudaForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Farmer Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name') }}" required>
                            @error('name')
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
                            <label for="location">Farm Location</label>
                            <input type="text" id="location" name="location" class="form-control"
                                value="{{ old('location') }}" required>
                            @error('location')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="assistance">Supply to Give</label>
                            <textarea id="assistance" name="assistance" class="form-control" rows="4" required>{{ old('assistance') }}</textarea>
                            @error('assistance')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-submit">Submit Request</button>
                    </form>
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
</body>

</html>
