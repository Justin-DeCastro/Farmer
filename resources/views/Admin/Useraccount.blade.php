<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@include('Components.Admin.header')
<style>
    .table {
        border: 3px solid #6c7d47;
        /* Earthy green border */
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(108, 125, 71, 0.3);
        /* Subtle shadow */
        width: 100%;
        overflow: hidden;
        position: relative;
        animation: borderBlink 3s infinite alternate;
        /* Animate the border effect */
    }

    .table th {
        background-color: #a8b67a;
        /* Light green header */
        color: #4d5e26;
        /* Dark green text */
        padding: 10px;
    }

    .table td {
        border-bottom: 1px solid #ddd;
        padding: 10px;
    }

    .table tr:hover {
        background-color: #eaf0d5;
        /* Light green row hover effect */
    }

    .table img {
        border: 2px solid #6c7d47;
        /* Add a border to images */
        border-radius: 5px;
    }

    /* Keyframe animation for the rotating blinking border effect */
    @keyframes borderBlink {
        0% {
            border-color: #6c7d47;
            /* Earthy green border */
            box-shadow: 0 0 15px #6c7d47;
            /* Subtle glowing effect */
        }

        50% {
            border-color: #a8b67a;
            /* Lighter green */
            box-shadow: 0 0 15px #a8b67a;
            /* Glowing effect in lighter green */
        }

        100% {
            border-color: #4d5e26;
            /* Dark green */
            box-shadow: 0 0 15px #4d5e26;
            /* Glowing effect in dark green */
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
                <nav class="" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Add Farmer Button -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFarmerModal">
                            Add Farmer
                        </button>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Main Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <!-- Table -->
                    <div class="card">
                        <h5 class="card-header">Farmer Accounts</h5>

                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Middle Name</th>
                                        <th scope="col">Suffix</th>
                                        <th scope="col">Farmer Address</th>
                                        <th scope="col">Farm Location</th>
                                        <th scope="col">Birthdate</th>
                                        <th scope="col">Sex</th>
                                        <th scope="col">Contact Number</th>
                                        <th scope="col">4Ps</th>
                                        <th scope="col">PWD</th>
                                        <th scope="col">Indigenous</th>
                                        <th scope="col">Farm Area</th>
                                        <th scope="col">Area Planted</th>
                                        <th scope="col">Commodity</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userAccount as $request)
                                        <tr>
                                            <td>{{ $request->id }}</td>
                                            <td>{{ $request->last_name }}</td>
                                            <td>{{ $request->first_name }}</td>
                                            <td>{{ $request->middle_name }}</td>
                                            <td>{{ $request->suffix }}</td>
                                            <td>{{ $request->farmer_address }}</td>
                                            <td>{{ $request->farm_location }}</td>
                                            <td>{{ $request->birthdate ? \Carbon\Carbon::parse($request->birthdate)->format('Y-m-d') : '' }}</td>
                                            <td>{{ $request->sex }}</td>
                                            <td>{{ $request->contact_number }}</td>
                                            <td>{{ $request->fourps }}</td>
                                            <td>{{ $request->pwd }}</td>
                                            <td>{{ $request->indigenous }}</td>
                                            <td>{{ $request->farm_area }}</td>
                                            <td>{{ $request->area_planted }}</td>
                                            <td>{{ $request->commodity }}</td>
                                            <td>{{ $request->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td>
                                                <!-- Button to trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal{{ $request->id }}">
                                                    Update
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach ($userAccount as $request)
                            <!-- Update Modal -->
                            <div class="modal fade" id="updateModal{{ $request->id }}" tabindex="-1" aria-labelledby="updateModalLabel{{ $request->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('profile.update', $request->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateModalLabel{{ $request->id }}">Update Profile</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Last Name -->
                                                <div class="form-group">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $request->last_name }}" required>
                                                </div>

                                                <!-- First Name -->
                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $request->first_name }}" required>
                                                </div>

                                                <!-- Middle Name -->
                                                <div class="form-group">
                                                    <label for="middle_name">Middle Name</label>
                                                    <input type="text" id="middle_name" name="middle_name" class="form-control" value="{{ $request->middle_name }}">
                                                </div>

                                                <!-- Suffix -->
                                                <div class="form-group">
                                                    <label for="suffix">Suffix</label>
                                                    <input type="text" id="suffix" name="suffix" class="form-control" value="{{ $request->suffix }}">
                                                </div>

                                                <!-- Farmer Address -->
                                                <div class="form-group">
                                                    <label for="farmer_address">Farmer Address</label>
                                                    <input type="text" id="farmer_address" name="farmer_address" class="form-control" value="{{ $request->farmer_address }}" required>
                                                </div>

                                                <!-- Farm Location -->
                                                <div class="form-group">
                                                    <label for="farm_location">Farm Location</label>
                                                    <input type="text" id="farm_location" name="farm_location" class="form-control" value="{{ $request->farm_location }}" required>
                                                </div>

                                                <!-- Birthdate -->
                                                <div class="form-group">
                                                    <label for="birthdate">Birthdate</label>
                                                    <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ $request->birthdate ? \Carbon\Carbon::parse($request->birthdate)->format('Y-m-d') : '' }}" required>
                                                </div>

                                                <!-- Sex -->
                                                <div class="form-group">
                                                    <label for="sex">Sex</label>
                                                    <select id="sex" name="sex" class="form-control" required>
                                                        <option value="male" {{ $request->sex == 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female" {{ $request->sex == 'female' ? 'selected' : '' }}>Female</option>
                                                    </select>
                                                </div>

                                                <!-- Contact Number -->
                                                <div class="form-group">
                                                    <label for="contact_number">Contact Number</label>
                                                    <input type="text" id="contact_number" name="contact_number" class="form-control" value="{{ $request->contact_number }}" required>
                                                </div>

                                                <!-- 4Ps -->
                                                <div class="form-group">
                                                    <label for="fourps">4Ps</label>
                                                    <input type="text" id="fourps" name="fourps" class="form-control" value="{{ $request->fourps }}">
                                                </div>

                                                <!-- PWD -->
                                                <div class="form-group">
                                                    <label for="pwd">PWD</label>
                                                    <input type="text" id="pwd" name="pwd" class="form-control" value="{{ $request->pwd }}">
                                                </div>

                                                <!-- Indigenous -->
                                                <div class="form-group">
                                                    <label for="indigenous">Indigenous</label>
                                                    <input type="text" id="indigenous" name="indigenous" class="form-control" value="{{ $request->indigenous }}">
                                                </div>

                                                <!-- Farm Area -->
                                                <div class="form-group">
                                                    <label for="farm_area">Farm Area</label>
                                                    <input type="number" id="farm_area" name="farm_area" class="form-control" value="{{ $request->farm_area }}" required>
                                                </div>

                                                <!-- Area Planted -->
                                                <div class="form-group">
                                                    <label for="area_planted">Area Planted</label>
                                                    <input type="number" id="area_planted" name="area_planted" class="form-control" value="{{ $request->area_planted }}" required>
                                                </div>

                                                <!-- Commodity -->
                                                <div class="form-group">
                                                    <label for="commodity">Commodity</label>
                                                    <input type="text" id="commodity" name="commodity" class="form-control" value="{{ $request->commodity }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach


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

    <!-- Add Farmer Modal -->
    <div class="modal fade" id="addFarmerModal" tabindex="-1" aria-labelledby="addFarmerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFarmerModalLabel">Add Farmer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('register.submits') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rs">RSBA No.</label>
                            <input id="rs" type="text" class="form-control @error('rs') is-invalid @enderror" name="rs" value="{{ old('rs') }}" required>
                            @error('rs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn register-btn">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    @include('Components.Admin.Script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Function to confirm before form submission
        function confirmUpdate(requestId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to update this profile.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('updateForm' + requestId).submit();
                }
            });
        }

        // Success message after form is successfully submitted (optional)
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Profile updated successfully!',
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
