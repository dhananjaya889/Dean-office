<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dean Office Management System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: url('{{asset("img/fot6.jpg")}}') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }
        .login-link {
            position: absolute;
            top: 20px;
            right: 30px;
            background: #ff5722;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        .login-link:hover {
            background: #e64a19;
        }
    </style>
</head>
<body>
    <a href="{{ route('login') }}" class="login-link">Login</a>
    <div class="container">
        <h1>Management Information System</h1>
        <h2>Dean Office</h2>
        <h2>Faculty of Technology</h2>
        <p>Universoty of Ruhuna</p>
    </div>
</body>
</html>
