<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
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
                <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <!-- SVG Paths -->
                </svg>
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Agtech</span>
            </a> --}}

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
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
          <nav class="" id="layout-navbar">
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
              <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->user ? $feedback->user->name : 'Unknown' }}</td>
                            <td>{{ $feedback->email }}</td>
                            <td>{{ $feedback->message }}</td>
                            <td>
                                <button class="btn btn-link badge-action" data-bs-toggle="modal" data-bs-target="#editModal" onclick="populateEditModal({{ $feedback }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form id="delete-form-{{ $feedback->id }}" action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-link badge-action" onclick="confirmDeletion({{ $feedback->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
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

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Modal for Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Feedback</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="edit-form" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="mb-3">
                <label for="editName" class="form-label">Name</label>
                <input type="text" class="form-control" id="editName" name="name" required>
              </div>
              <div class="mb-3">
                <label for="editEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="editEmail" name="email" required>
              </div>
              <div class="mb-3">
                <label for="editMessage" class="form-label">Message</label>
                <textarea class="form-control" id="editMessage" name="message" required></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('Components.Admin.Script')

    <!-- Include SweetAlert2 CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDeletion(feedbackId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if the user confirms
                    document.getElementById(`delete-form-${feedbackId}`).submit();
                }
            });
        }

        function populateEditModal(feedback) {
            // Populate the modal fields with the feedback data
            document.getElementById('editName').value = feedback.name;
            document.getElementById('editEmail').value = feedback.email;
            document.getElementById('editMessage').value = feedback.message;
            document.getElementById('edit-form').action = `/feedbacks/${feedback.id}`; // Set the form action URL
        }
    </script>

  </body>
</html>
