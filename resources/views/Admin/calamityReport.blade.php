<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
    @include('Components.Admin.header')

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    <div class="app-brand demo">
                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                            <i class="bx bx-chevron-left bx-sm align-middle"></i>
                        </a>
                    </div>
                    <div class="menu-inner-shadow"></div>
                    @include('Components.Admin.sidebar')
                </aside>

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
                            <div class="navbar-nav align-items-center"></div>
                        </div>
                    </nav>

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
                                            <th>Image</th> <!-- Add a column for the image -->
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
                                                        <span class="badge" style="background-color: #28a745; color: white;">Completed</span>
                                                    @elseif ($report->status === 'canceled')
                                                        <span class="badge" style="background-color: #6c757d; color: white;">Canceled</span>
                                                    @else
                                                        <span class="badge" style="background-color: #dc3545; color: white;">For Review</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- Check if an image exists for the report and display it -->
                                                    @if ($report->image_path)
                                                        <img src="{{ asset($report->image_path) }}" alt="Report Image" style="width: 100px; height: auto;">
                                                    @else
                                                        No image uploaded
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- Dropdown Menu -->
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $report->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $report->id }}">
                                                            @if ($report->status !== 'completed')
                                                                <!-- Upload Image Action -->
                                                                <li>
                                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#uploadImageModal{{ $report->id }}">Upload Image</a>
                                                                </li>
                                                            @endif
                                                            @if ($report->status !== 'completed' && $report->status !== 'canceled')
                                                                <!-- Mark as Completed Action -->
                                                                <li>
                                                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('completeForm{{ $report->id }}').submit();">
                                                                        Mark as Completed
                                                                    </a>
                                                                    <form id="completeForm{{ $report->id }}" action="{{ route('calamity-report.complete', $report->id) }}" method="post" style="display: none;">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                    </form>
                                                                </li>
                                                            @endif
                                                            @if ($report->status !== 'canceled')
                                                                <!-- Cancel Action -->
                                                                <li>
                                                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('cancelForm{{ $report->id }}').submit();">
                                                                        Cancel
                                                                    </a>
                                                                    <form id="cancelForm{{ $report->id }}" action="{{ route('calamity-report.cancel', $report->id) }}" method="post" style="display: none;">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                    </form>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>

                                            </tr>

                                            <!-- Modal for Image Upload -->
                                            <div class="modal fade" id="uploadImageModal{{ $report->id }}" tabindex="-1" aria-labelledby="uploadImageModalLabel{{ $report->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="uploadImageModalLabel{{ $report->id }}">Upload Image for Report</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('calamity-report.upload-image', $report->id) }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="image">Select Image</label>
                                                                    <input type="file" name="image" accept="image/*" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Upload Image</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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

        <!-- Core JS -->
        <!-- make sure Bootstrap 5 JS and jQuery are included -->
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
    </body>
</html>
