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
                    <ul class="nav nav-secondary flex-column">
                        <li class="nav-item">
                            <a href="home" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
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
                        </li>

                        <li class="nav-item">
                            <a href="feedback" class="nav-link {{ Request::is('feedback') ? 'active' : '' }}">
                                <i class="fas fa-comment-dots"></i>
                                <span class="sub-item">Feedback</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="farmerdata" class="nav-link {{ Request::is('farmerdata') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>
                                <span class="sub-item">Farmer Data</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="calamityReport" class="nav-link {{ Request::is('calamityReport') ? 'active' : '' }}">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span class="sub-item">Calamity Report</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="viewcrops" class="nav-link {{ Request::is('viewcrops') ? 'active' : '' }}">
                                <i class="fas fa-leaf"></i>
                                <span class="sub-item">View all Crops and Live Stocks</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="editAccount" class="nav-link {{ Request::is('editAccount') ? 'active' : '' }}">
                                <i class="fas fa-user-cog"></i>
                                <span class="sub-item">Account</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link logout-btn" id="logoutBtn">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
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
<script>
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();  // Prevent the default link behavior (page navigation)

        // Send an AJAX request to logout
        fetch("{{ route('logout') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'  // CSRF Token for protection
            },
        })
        .then(response => {
            if (response.ok) {
                // Redirect to login page or home after logout
                window.location.href = "{{ url('login') }}";  // Or adjust the redirect as needed
            }
        })
        .catch(error => {
            console.error('Error logging out:', error);
        });
    });
</script>
