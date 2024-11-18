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
    }

    .notification-card .card {
      border-radius: 10px;
      overflow: hidden;
    }

    .notification-card .btn-close {
      background: none;
      border: none;
      font-size: 18px;
      cursor: pointer;
      float: right;
    }

    .notification-card.d-none {
      display: none;
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
                    <p>
                      @if(strlen($announcement->content) > 50)
                        {{ substr($announcement->content, 0, 50) }}...
                        <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#announcementModal" data-title="{{ $announcement->title }}" data-content="{{ $announcement->content }}">Read More</a>
                      @else
                        {{ $announcement->content }}
                      @endif
                    </p>
                    <small class="text-muted">{{ $announcement->created_at->diffForHumans() }}</small>
                    <hr>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="announcementModalLabel"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>

              </div>

            </div>
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Feedback from Farmers</p>
                            <h4 class="card-title">{{ $feedbackCount }}</h4>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-info bubble-shadow-small"
                        >
                        <i class="fas fa-seedling"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Count of Crops</p>
                            <h4 class="card-title">
                                 {{ $uniqueCropTypesCount }} <br>
                                {{-- Total Livestock: {{ $totalLivestock }} --}}
                            </h4>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-success bubble-shadow-small"
                        >
                          <i class="fas fa-paw"></i>


                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Total Count of Livestock</p>
                          <h4 class="card-title"> {{ $uniqueCropTypesCount }} <br></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>



          </div>
        </div>

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
  </body>
</html>
