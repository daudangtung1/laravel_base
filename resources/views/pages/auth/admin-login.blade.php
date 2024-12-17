<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ mix('lib/toastr/toastr.css') }}">
    <style>
        * {
            margin: 0;
        }

        .login__banner {
            background: url("{{ asset('images/sisu_bg-min.png') }}");
            height: 100vh;
            position: relative;
        }

        .login__banner form {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <div class="login__banner">
        <form action="{{ route('admin.postLogin') }}" method="POST">
            @csrf
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