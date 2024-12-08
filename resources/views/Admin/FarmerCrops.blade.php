<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">
@include('Components.Admin.header')

<style>
    .table {
        border: 3px solid #6c7d47; /* Earthy green border */
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(108, 125, 71, 0.3); /* Subtle shadow */
        width: 100%;
        overflow: hidden;
        position: relative;
        animation: borderBlink 3s infinite alternate; /* Animate the border effect */
    }

    .table th {
        background-color: #a8b67a; /* Light green header */
        color: #4d5e26; /* Dark green text */
        padding: 10px;
    }

    .table td {
        border-bottom: 1px solid #ddd;
        padding: 10px;
    }

    .table tr:hover {
        background-color: #eaf0d5; /* Light green row hover effect */
    }

    .table img {
        border: 2px solid #6c7d47; /* Add a border to images */
        border-radius: 5px;
    }

    /* Keyframe animation for the rotating blinking border effect */
    @keyframes borderBlink {
        0% {
            border-color: #6c7d47; /* Earthy green border */
            box-shadow: 0 0 15px #6c7d47; /* Subtle glowing effect */
        }
        50% {
            border-color: #a8b67a; /* Lighter green */
            box-shadow: 0 0 15px #a8b67a; /* Glowing effect in lighter green */
        }
        100% {
            border-color: #4d5e26; /* Dark green */
            box-shadow: 0 0 15px #4d5e26; /* Glowing effect in dark green */
        }
    }
</style>



<head>
    <link rel="icon" href="images/agtech.jfif" type="image/x-icon">
    <link rel="shortcut icon" href="images/agtech.jfif" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .map-container {
            display: none;
            width: 300px;
            height: 200px;
        }
    </style>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUlV2s9XbLAsllvpPnFoxkznXbdFqUXK4&callback=initMap"></script>
    <!-- Include Lightbox2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet">
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    {{-- <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <!-- SVG Logo -->
                            <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <!-- SVG Paths -->
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">AgTech</span>
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
                <nav id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->

                        <!-- /Search -->
                    </div>
                </nav>
                <!-- / Navbar -->
                <div class="card-footer">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewAllCropsModal">
                        View All Crop Locations
                    </button>
                </div>

                <!-- Main Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <!-- Table -->
                    <div class="card">
                        <h5 class="card-header">Farmer Information</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="strong-black">Name</th>
                                        <th class="strong-black">Email</th>
                                        <th class="strong-black">Phone</th>
                                        <th class="strong-black">Crop Types</th>
                                        <th class="strong-black">Livestock Types</th>
                                        <th class="strong-black">Location</th>
                                        <th class="strong-black">Crop Images</th>
                                        <th class="strong-black">Livestock Images</th>
                                        <th class="strong-black">Map</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($farmers as $farmer)
                                        <tr>
                                            <td class="strong-black">{{ $farmer->name }}</td>
                                            <td class="strong-black">{{ $farmer->email }}</td>
                                            <td class="strong-black">{{ $farmer->phone }}</td>
                                            <td class="strong-black">{{ $farmer->crop_types }}</td>
                                            <td class="strong-black">{{ $farmer->livestock_types }}</td>
                                            <td class="strong-black">{{ $farmer->location }}</td>
                                            <td class="strong-black">
                                                @if ($farmer->crop_images)
                                                    @foreach (json_decode($farmer->crop_images) as $image)
                                                        <a href="{{ asset($image) }}" data-lightbox="crop-images"
                                                            data-title="Crop Image">
                                                            <img src="{{ asset($image) }}" alt="Crop Image"
                                                                style="width: 100px; height: auto; cursor: pointer;" />
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <p>No crop images available</p>
                                                @endif
                                            </td>
                                            <td class="strong-black">
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
                                              <td class="strong-black">
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#mapModal" data-location="{{ $farmer->location }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
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
        <!-- Modal for displaying the map -->
        <!-- Modal for viewing all crop locations -->
        <div class="modal fade" id="viewAllCropsModal" tabindex="-1" aria-labelledby="viewAllCropsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewAllCropsModalLabel">All Crop Locations</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="allCropsMap" style="height: 500px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for displaying the map -->
        <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mapModalLabel">Weather Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modalMap" style="height: 500px; width: 100%;"></div>
                        <div id="weatherInfo" style="margin-top: 20px; display: none;">
                            <!-- Weather information will be dynamically inserted here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('Components.Admin.Script')

</body>

</html>