@include('Components.User.header')
@include('Components.User.sidebar')
<div class="main-panel">
    <div class="main-header">
        <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="#" class="logo">
                    <img src="admin/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                        height="20" />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
                <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                    <div class="input-group">
                    </div>
                </nav>
            </div>
        </nav>

        <!-- Data Table -->
        <table class="table" id="farmerTable">
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
                        {{-- <td>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mapModal"
                                data-location="{{ $farmer->location }}">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Scripts -->
<script src="admin/assets/js/core/jquery-3.7.1.min.js"></script>
<script src="admin/assets/js/core/popper.min.js"></script>
<script src="admin/assets/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- DataTables -->
<script src="admin/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Initialize DataTable -->
<script>
    $(document).ready(function() {
        $('#farmerTable').DataTable(); // Initializes the DataTable
    });
</script>

<!-- Kaiadmin JS -->
<script src="admin/assets/js/kaiadmin.min.js"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="admin/assets/js/setting-demo.js"></script>
<script src="admin/assets/js/demo.js"></script>
