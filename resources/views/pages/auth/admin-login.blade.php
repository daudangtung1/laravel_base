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
    <div class="login__banner">
        <div class="login__banner--wrapper">
            <div class="login__banner--wrapper--description">
                <div>
                    <h1>Join the largest art community in the world</h1>
                    <p>
                        Explore and discover art, become a better artist, connect with others over mutual hobbies, or buy and sell work – you can do it all here.
                    </p>
                </div>
            </div>
            <div class="login__banner--wrapper--form">
                <form action="{{ route('admin.postLogin') }}" method="POST">
                    @csrf
                    <h2>Login</h2>
                    <div>
                        <label for="email">Email</label><br>
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <div>
                        <label for="password">Password</label><br>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    <div>
                        <button type="submit">Submit</button>
                    </div>
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