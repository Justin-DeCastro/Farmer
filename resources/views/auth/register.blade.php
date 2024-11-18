<link rel="icon" href="{{ asset('images/farner.webp') }}" type="image/x-icon">
<style>
    /* Centering the container */
    .register-container {
        margin-top: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh; /* Full viewport height */
        background-image: url('images/farner.webp'); /* Background image */
        background-size: cover; /* Cover the entire container */
        background-position: center; /* Center the image */
    }

    /* Card styling */
    .register-card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        background-color: rgba(255, 255, 255, 0); /* Transparent background */
        max-width: 400px;
        width: 100%;
        padding: 20px;
    }

    /* Header styling */
    .register-header {

        color: #fff;
        text-align: center;
        padding: 15px;
        border-radius: 8px 8px 0 0;
        font-size: 1.5rem;
    }

    /* Body styling */
    .register-body {
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.6); /* Slight transparency for the form body */
        border-radius: 8px;
    }

    /* Button styling */
    .register-btn {
        background-color: rgba(0, 123, 255, 0.8); /* Slight transparency for button */
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-size: 1rem;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .register-btn:hover {
        background-color: rgba(0, 86, 179, 0.8);
        transform: scale(1.02);
    }

    /* Form group styling */
    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px;
        font-size: 1rem;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.8); /* Slight transparency for input fields */
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Label styling */
    .form-group label {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
    }

    /* Register link styling */
    .login-link {
        text-align: center;
        margin-top: 20px;
    }

    .login-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    .login-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="container register-container">
    <div class="card register-card">
        <div class="card-header register-header">
            {{ __('Register') }}
        </div>
        <div class="card-body register-body">
            <form method="POST" action="{{ route('register') }}">
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

            <div class="login-link">
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </div>
    </div>
</div>
<script>
    @if (session('success'))
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            toast: true, // Makes it a toast-style notification
            didOpen: () => {
                Swal.showLoading();
            }
        });
    @endif

    @if (session('error'))
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 3000,
            toast: true, // Makes it a toast-style notification
            didOpen: () => {
                Swal.showLoading();
            }
        });
    @endif
</script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
