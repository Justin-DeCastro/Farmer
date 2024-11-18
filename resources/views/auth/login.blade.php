<style>
    /* Centering the container */
    .login-container {
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
    .login-card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        background-color: rgba(255, 255, 255, 0); /* Transparent background */
        max-width: 400px;
        width: 100%;
        padding: 20px;
    }

    /* Header styling */
    .login-header {

        color: #fff;
        text-align: center;
        padding: 15px;
        border-radius: 8px 8px 0 0;
        font-size: 1.5rem;
    }

    /* Body styling */
    .login-body {
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.6); /* Slight transparency for the form body */
        border-radius: 8px;
    }

    /* Button styling */
    .login-btn {
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

    .login-btn:hover {
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
    .register-link {
        text-align: center;
        margin-top: 20px;
    }

    .register-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    .register-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="container login-container">
    <div class="card login-card">
        <div class="card-header login-header">
            {{ __('Login') }}
        </div>
        <div class="card-body login-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

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
                    <button type="submit" class="btn login-btn">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
            <div class="register-link">
                <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
            </div>
        </div>
    </div>
</div>
