<!DOCTYPE html>
<html>
<head>
    <title>Freelance Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 60px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            padding: 32px 24px;
            text-align: center;
        }
        h1 {
            color: #2d3e50;
            margin-bottom: 24px;
        }
        h2 {
            color: #4a90e2;
            margin: 24px 0 16px 0;
            font-size: 1.2em;
        }
        button {
            display: block;
            width: 100%;
            margin: 8px 0;
            padding: 12px 0;
            background: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.2s;
        }
        button:hover {
            background: #357abd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Freelance.com</h1>

    <h2>Log In</h2>
    <button onclick="window.location.href='Customer/login.php'">Log in as Customer</button>
    <button onclick="window.location.href='Customer/seller_login.php'">Log in as Seller</button>

    <h2>Don't have an account? Register</h2>
    <button onclick="window.location.href='Customer/customer_Reg.php'">Register as Customer</button>
    <button onclick="window.location.href='seller/seller.php'">Register as Seller</button>
</body>
</html>
