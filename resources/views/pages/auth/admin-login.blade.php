<!DOCTYPE html>
<html>

<head>

</head>

<body>
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
</body>

</html>