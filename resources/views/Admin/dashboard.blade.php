<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">
@include('Components.Admin.header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="menu-inner-shadow"></div>
                @include('Components.Admin.sidebar')
            </aside>
            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                </nav>

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <!-- Combined Section for Good Day, Affected Location, and Total Crops/Stocks -->
                            <div class="col-lg-12 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <!-- Good Day Section -->
                                        <div class="col-sm-12 col-md-6">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">
                                                    <i class="fas fa-smile"></i> Good Day, {{ Auth::user()->name }} 🎉
                                                </h5>
                                                <p class="mb-4">
                                                    <!-- Weather Prediction Section -->
                                                <div class="weather-prediction">
                                                    <h3><i class="fas fa-sun"></i> Weather Prediction for Tomorrow - Oriental Mindoro</h3>
                                                    @if (isset($tomorrowWeather['temperature']) && isset($tomorrowWeather['description']))
                                                        <p><i class="fas fa-thermometer-half"></i> Temperature: {{ $tomorrowWeather['temperature'] }} °C</p>
                                                        <p><i class="fas fa-cloud-sun"></i> Condition: {{ ucfirst($tomorrowWeather['description']) }}
                                                            @if (isset($tomorrowWeather['icon']))
                                                                <img src="https://openweathermap.org/img/wn/{{ $tomorrowWeather['icon'] }}@2x.png"
                                                                    alt="{{ $tomorrowWeather['description'] }}" />
                                                            @endif
                                                        </p>
                                                    @else
                                                        <p><i class="fas fa-times-circle"></i> Weather data is currently unavailable. Please try again later.</p>
                                                    @endif
                                                </div>
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Most Affected Location and Stats -->
                                        <div class="col-sm-12 col-md-6">
                                            <div class="card-body">
                                                <h2 class="h5"><i class="fas fa-map-marker-alt"></i> Most Affected Location by Weather</h2>
                                                @if ($mostAffectedLocation)
                                                    <p><i class="fas fa-location-arrow"></i> <strong>Location:</strong> Bambanin, Victoria, Oriental Mindoro</p>
                                                    <p><i class="fas fa-exclamation-triangle" style="color: red;"></i> <strong>Affected Farmer Count:</strong> 2</p>
                                                @else
                                                    <p><i class="fas fa-exclamation-circle"></i> No affected locations found.</p>
                                                @endif

                                                <hr>

                                                <div class="d-flex justify-content-between">
                                                    <!-- Total Number of Crops Box -->
                                                    <div class="border p-2 rounded d-flex flex-column align-items-center justify-content-center" style="height: 150px;">
                                                        <span class="fw-semibold d-block mb-1">
                                                            <i class="fas fa-seedling fa-3x"></i> Total Number of Crops
                                                        </span>
                                                        <h3 class="card-title mb-0">
                                                            {{ $uniqueCropTypesCount }}
                                                        </h3>
                                                    </div>

                                                    <!-- Total Number of Live Stocks Box -->
                                                    <div class="border p-2 rounded d-flex flex-column align-items-center justify-content-center" style="height: 150px;">
                                                        <span class="fw-semibold d-block mb-1">
                                                            <i class="fas fa-piggy-bank fa-3x"></i> Total Number of Live Stocks
                                                        </span>
                                                        <h3 class="card-title mb-0">
                                                            <i class="fas fa-pig fa-3x"></i> {{ $uniqueCropTypesCount }}
                                                        </h3>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Image Section -->
                        </div>

                        <!-- Charts Section (Side by Side) -->
                        <div class="row">
                            <!-- Farmers by Location Chart -->
                            <div class="col-md-6 mb-3"> <!-- Reduced margin-bottom here -->
                                <canvas id="locationChart" height="200"></canvas>
                            </div>

                            <!-- Crop Type Distribution Chart -->
                            <div class="col-md-6 mb-3"> <!-- Reduced margin-bottom here -->
                                <div style="height: 450px;">
                                    <canvas id="cropAndLivestockChart" style="width: 100%; height: 100%;"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Most Affected Location Chart -->
                            <div class="col-md-12">
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="affectedChart" style="width: 100%; height: 100%;"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
</body>
@include('Components.Admin.Script')

</html>
