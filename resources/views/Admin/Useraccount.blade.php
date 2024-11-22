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
                        <h5 class="card-header">Accounts</h5>
                        <!-- Add a container div for positioning -->


                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Farmer Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">RSBA</th>
                                        <th scope="col">Created At</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userAccount as $request)
                                        <tr>

                                            <td>{{ $request->id }}</td>
                                            <td>{{ $request->name }}</td>
                                            <td>{{ $request->email }}</td>
                                            <td>{{ $request->rs }}</td>
                                            <td>{{ $request->created_at->format('Y-m-d H:i:s') }}</td>
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
