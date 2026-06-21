<!DOCTYPE html>
<html>

<head>
    <title>Sembark URL Shortner</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }

        .login-box {
            width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border: 1px solid #ddd;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }

        button {
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Login Here</h2>
        <form action="/login" method="POST">
            @csrf
            <label>Email</label>
            <input
                type="email"
                name="email"
                required>
            <label>Password</label>
            <input
                type="password"
                name="password"
                required>
            <button type="submit">
                Login
            </button>
        </form>
    </div>
</body>

</html>