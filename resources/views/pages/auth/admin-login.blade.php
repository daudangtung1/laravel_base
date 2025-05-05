<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ mix('lib/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ mix('css/login.css') }}">
    <style>
        * {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <div class="content">
                <h1>JOIN THE LARGEST ART COMMUNITY IN THE WORLD</h1>
                <p>Explore and discover art, become a better artist, connect with others over mutual hobbies, or buy and
                    sell work – you can do it all here.</p>
                <span class="credit">ART BY <strong>endprocess83</strong></span>
            </div>
        </div>

        <div class="right-section">
            <div class="login-box">
                <form action="{{ route('admin.postLogin') }}" method="POST">
                    <button class="close-btn">&times;</button>
                    <h2>Log In</h2>
                    @csrf
                    <label>Username</label>
                    <input type="text" placeholder="Enter your username" name="email">
                    <label>Password</label>
                    <input type="password" placeholder="Enter your password" name="password">
                    <div class="remember-me">
                        <label class="remember-me__checkbox">
                            <input type="checkbox" id="remember">
                            <div class="custom-checkbox"></div>
                            <span for="remember">Keep me logged in</span>
                        </label>

                        <a href="#">Forgot username or password?</a>
                    </div>
                    <button class="btn-login">Next</button>

                    <p class="join-text">Become a Deviant <a href="#">Join DeviantArt</a></p>

                    <p class="terms">
                        By logging in to DeviantArt, I confirm that I have read and agree to the DeviantArt <a
                            href="#">Terms of Service</a>,
                        <a href="#">Privacy Policy</a>, and to receive emails and updates.
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="{{ mix('lib/jquery/jquery.js') }}" type="text/javascript"></script>
<script src="{{ mix('lib/toastr/toastr.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        let response = "{{ session('error') }}";
        if (response !== '') {
            toastr.error(response);
        }
    });
</script>

</html>