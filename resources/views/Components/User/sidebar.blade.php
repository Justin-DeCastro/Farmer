<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="home" class="logo">
                        <img src="admin/assets/img/kaiadmin/logo1-removebg-preview.png" alt="navbar brand" class="navbar-brand" height="120" />
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
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item active">
                            <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                                <span class="caret"></span>

                                <!-- Weather Notification Badge (Red) with Bouncing Animation -->
                                <span class="ms-2">
                                    <strong>Tomorrow's Weather: </strong>
                                    @if($tomorrowWeather['temperature'] && $tomorrowWeather['temperature'] > 35)
                                        <span class="badge bg-danger text-white ms-2 bounce-animation" style="font-size: 12px;">
                                            Hot!
                                        </span>
                                    @elseif($tomorrowWeather['temperature'])
                                        <span class="badge bg-success text-white ms-2 bounce-animation" style="font-size: 12px;">
                                            {{ $tomorrowWeather['temperature'] }}°C
                                        </span>
                                    @endif
                                </span>
                            </a>



                            <div class="collapse" id="dashboard">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="feedback">
                                            <span class="sub-item">Feedback</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="farmerdata">
                                            <span class="sub-item">FarmerData</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="calamityReport">
                                            <span class="sub-item">Calamity Report</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="viewcrops">
                                            <span class="sub-item">View all Crops and Live Stocks</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->
<style>
    @keyframes bounce {
    0% {
        transform: translateY(0);
    }
    25% {
        transform: translateY(-5px);
    }
    50% {
        transform: translateY(0);
    }
    75% {
        transform: translateY(-5px);
    }
    100% {
        transform: translateY(0);
    }
}

.bounce-animation {
    animation: bounce 1s infinite;
}

</style>
