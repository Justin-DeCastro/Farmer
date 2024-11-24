@include('Components.User.header')
@include('Components.User.sidebar')
<style>
    .notification-card {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1050;
      width: 300px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      background-color: #d0c4a1; /* Earthy beige background */
      border-radius: 10px;
      padding: 15px;
      font-family: 'Arial', sans-serif; /* Simple, rustic font */
      color: #4d4d33; /* Dark green-brown color */
      border: 2px solid #8c7c4f; /* Rustic border */
    }

    .notification-card .card {
      border-radius: 10px;
      overflow: hidden;
      background-color: #fff;
    }

    .notification-card .btn-close {
      background: none;
      border: none;
      font-size: 22px; /* Larger size for better visibility */
      color: #fff; /* White color for contrast */
      cursor: pointer;
      position: absolute;
      top: 10px;
      right: 10px;
      padding: 5px;
    }

    .notification-card .btn-close:hover {
      color: #ffcc00; /* Yellow color when hovering for a farmer-like effect */
    }

    .notification-card .card-header {
      background-color: #7a6239; /* Muted wood brown */
      color: #fff;
      padding: 10px;
      font-size: 16px;
      font-weight: bold;
    }

    .notification-card .card-body {
      padding: 10px;
      background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png'); /* Burlap texture */
      background-size: cover;
    }

    .notification-card.d-none {
      display: none;
    }

    /* Optional - Hover effect for the whole card */
    .notification-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }
  </style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      const announcementModal = document.getElementById('announcementModal');
      const modalTitle = document.getElementById('announcementModalLabel');
      const modalContent = document.getElementById('modalContent');

      announcementModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const title = button.getAttribute('data-title'); // Extract title from data-* attributes
        const content = button.getAttribute('data-content'); // Extract content from data-* attributes

        // Update the modal's content
        modalTitle.textContent = title;
        modalContent.textContent = content;
      });
    });

    function closeNotification() {
      document.getElementById('notification-card').classList.add('d-none');
    }

    document.addEventListener("DOMContentLoaded", function () {
      setTimeout(() => {
        document.getElementById("notification-card").classList.remove("d-none");
      }, 2000);
    });
  </script>


      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="#" class="logo">
                <img
                  src="admin/assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
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
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
                <div class="input-group">


              </nav>


            </div>
          </nav>
          <!-- End Navbar -->
        </div>
        <div id="notification-card" class="notification-card d-none">
            <div class="card">
              <div class="card-header">
                <h5>Latest Announcements</h5>
                <button class="btn-close" onclick="closeNotification()">&times;</button>
              </div>
              <div class="card-body">
                @foreach($announcements as $announcement)
                  <div class="announcement">
                    <h6>{{ $announcement->title }}</h6>

                    <p class="announcement-content">
                      <span class="content-preview">
                        {!! nl2br(e(Str::limit($announcement->content, 50))) !!}
                      </span>
                      <span class="content-full" style="display:none;">
                        {!! nl2br(e($announcement->content)) !!}
                      </span>
                      <a href="javascript:void(0);" class="read-more">Read More</a>
                    </p>

                    <small class="text-muted">{{ $announcement->created_at->diffForHumans() }}</small>
                    <hr>
                  </div>
                @endforeach
              </div>



            </div>
          </div>



          <div class="container">
            <div class="page-inner">
              <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                  <h3 class="fw-bold mb-3">Dashboard</h3>
                </div>
              </div>
              <div class="row gy-4">
                <!-- Feedback from Farmers -->
                <div class="col-sm-6 col-md-3">
                  <div class="card card-stats shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-icon">
                          <div class="icon-big text-center text-primary">
                            <i class="fas fa-users fa-3x"></i>
                          </div>
                        </div>
                        <div class="col col-stats ms-3">
                          <div class="numbers">
                            <p class="card-category text-uppercase text-muted mb-1">Feedback Count</p>
                            <h4 class="card-title fw-bold text-primary">{{ $feedbackCount }}</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Total Count of Crops -->
                <div class="col-sm-6 col-md-3">
                  <div class="card card-stats shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-icon">
                          <div class="icon-big text-center text-success">
                            <i class="fas fa-seedling fa-3x"></i>
                          </div>
                        </div>
                        <div class="col col-stats ms-3">
                          <div class="numbers">
                            <p class="card-category text-uppercase text-muted mb-1">Total Count of Crops</p>
                            <h4 class="card-title fw-bold text-success">{{ $uniqueCropTypesCount }}</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Total Count of Livestock -->
                <div class="col-sm-6 col-md-3">
                  <div class="card card-stats shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-icon">
                          <div class="icon-big text-center text-danger">
                            <i class="fas fa-paw fa-3x"></i>
                          </div>
                        </div>
                        <div class="col col-stats ms-3">
                          <div class="numbers">
                            <p class="card-category text-uppercase text-muted mb-1">Total Count of Livestock</p>
                            <h4 class="card-title fw-bold text-danger">{{ $uniqueLivestockCount }}</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Total Submitted Reports -->
                <div class="col-sm-6 col-md-3">
                  <div class="card card-stats shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-icon">
                          <div class="icon-big text-center text-warning">
                            <i class="fas fa-file-alt fa-3x"></i>
                          </div>
                        </div>
                        <div class="col col-stats ms-3">
                          <div class="numbers">
                            <p class="card-category text-uppercase text-muted mb-1">Total Calamity Reports</p>
                            <h4 class="card-title fw-bold text-warning">{{ $totalReportsCount }}</h4> <!-- Dynamically load count -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Chart Section: Overview of Data -->
                <div class="col-sm-12 col-md-6">
                  <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                      <h5 class="card-title text-center">Overview of Data</h5>
                      <canvas id="overviewChart" style="max-height: 300px;"></canvas>
                    </div>
                  </div>
                </div>

                <!-- Weather Prediction Section -->
                <div class="col-sm-12 col-md-6">
                  <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body">
                      <h5 class="card-title text-center">Tomorrow's Weather</h5>
                      <canvas id="weatherChart" style="max-height: 300px;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Chart.js Script -->
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <script>
            // Overview Chart
            const ctxOverview = document.getElementById('overviewChart').getContext('2d');
            const overviewChart = new Chart(ctxOverview, {
              type: 'pie',
              data: {
                labels: ['Feedback', 'Crops', 'Livestock'],
                datasets: [{
                  data: [{{ $feedbackCount }}, {{ $uniqueCropTypesCount }}, {{ $uniqueLivestockCount }}],
                  backgroundColor: ['#007bff', '#28a745', '#dc3545'],
                }],
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  legend: { position: 'bottom' },
                },
              },
            });

            // Custom Weather Chart with Cloud-Like Visualization
            const ctxWeather = document.getElementById('weatherChart').getContext('2d');
            const weatherChart = new Chart(ctxWeather, {
              type: 'bar', // Using bar chart to serve as base for cloud
              data: {
                labels: ['Tomorrow'],
                datasets: [{
                  label: 'Temperature (°C)',
                  data: [{{ $tomorrowWeather['temperature'] ?? 0 }}],
                  backgroundColor: 'rgba(135, 206, 250, 0.7)', // Soft blue base for cloud
                }],
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  legend: { display: false },
                  tooltip: {
                    callbacks: {
                      label: function(tooltipItem) {
                        return `Temperature: ${tooltipItem.raw}°C`;
                      },
                    },
                  },
                },
                scales: {
                  y: {
                    beginAtZero: true,
                    title: {
                      display: true,
                      text: 'Temperature (°C)',
                    },
                  },
                },
              },
              plugins: [{
                id: 'cloudShape',
                beforeDraw: function(chart) {
                  const ctx = chart.ctx;

                  // Drawing a custom cloud shape
                  ctx.save();
                  ctx.fillStyle = 'rgba(135, 206, 250, 0.7)';
                  ctx.beginPath();
                  ctx.arc(100, 50, 30, 0, Math.PI * 2); // Left puff
                  ctx.arc(130, 50, 40, 0, Math.PI * 2); // Center puff
                  ctx.arc(170, 50, 30, 0, Math.PI * 2); // Right puff
                  ctx.closePath();
                  ctx.fill();

                  // Add cloud shadow
                  ctx.fillStyle = 'rgba(70, 130, 180, 0.4)';
                  ctx.beginPath();
                  ctx.arc(130, 70, 50, 0, Math.PI * 2); // Shadow below the cloud
                  ctx.closePath();
                  ctx.fill();

                  ctx.restore();
                },
              }],
            });
          </script>




        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">

                <li class="nav-item">
                  <a class="nav-link" href="#">  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">  </a>
                </li>
              </ul>
            </nav>
            <div class="copyright">
              2024, made with <i class="fa fa-heart heart text-danger"></i> by
              <a href="#">Agtech</a>
            </div>

          </div>
        </footer>
      </div>

      <!-- Custom template | don't include it in your project! -->

      <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="admin/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="admin/assets/js/core/popper.min.js"></script>
    <script src="admin/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="admin/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="admin/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="admin/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="admin/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="admin/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="admin/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="admin/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="admin/assets/js/setting-demo.js"></script>
    <script src="admin/assets/js/demo.js"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>

              <script>
                // JavaScript to toggle 'Read More' content
                document.querySelectorAll('.read-more').forEach(function(link) {
                  link.addEventListener('click', function() {
                    var contentPreview = link.previousElementSibling;
                    var contentFull = contentPreview.nextElementSibling;
                    var isFull = contentFull.style.display === 'block';

                    contentPreview.style.display = isFull ? 'inline' : 'none';
                    contentFull.style.display = isFull ? 'none' : 'block';
                    link.textContent = isFull ? 'Read More' : 'Read Less';
                  });
                });
              </script>
  </body>
</html>
