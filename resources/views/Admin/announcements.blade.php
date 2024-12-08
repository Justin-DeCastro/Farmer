<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@include('Components.Admin.header')
<style>
    /* Add the blinking animation to the edges */
    @keyframes blink {
        0% {
            border-color: #6E7C4D;
        }
        50% {
            border-color: #FF5733; /* Change to your desired blinking color */
        }
        100% {
            border-color: #6E7C4D;
        }
    }

    .card {
        animation: blink 1s infinite; /* Apply the blink animation */
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
                        <!-- Placeholder for additional navbar content -->
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Main Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Announcements</h5>
                            <!-- Button to Trigger Add Announcement Modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
                                Add Announcement
                            </button>
                        </div>
                        <div class="newsfeed-container" style="display: flex; flex-wrap: wrap; gap: 16px; padding: 16px; background-color: #F3EFE0;">
                            @foreach ($announcements as $announcement)
                                <div class="card" style="width: 18rem; background-color: #A8B67A; border: 1px solid #6E7C4D; border-radius: 8px; box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);">
                                    <div class="card-body" style="padding: 16px; color: #FFFFFF;">
                                        <h5 class="card-title" style="font-family: 'Georgia', serif; color: #FDFDFD;">{{ $announcement->title }}</h5>
                                        <p class="card-text" style="font-family: 'Arial', sans-serif; font-size: 14px; line-height: 1.5;">{{ $announcement->content }}</p>
                                        <small class="" style="font-style: italic; color: #FFFFFF;">Posted on: {{ $announcement->created_at->format('Y-m-d') }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>




                    </div>

                </div>
                <!-- / Main Content -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Modal for Adding Announcements -->
        <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAnnouncementModalLabel">Add Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('announcements.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">Announcement Title</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="content">Announcement Content</label>
                                <textarea id="content" name="content" class="form-control" rows="4" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Announcement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    @include('Components.Admin.Script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
