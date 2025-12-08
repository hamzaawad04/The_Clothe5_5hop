<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Confirmed!</title>

    <style>
        body {
            font-family: "Playfair Display", serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f9f9f9;
        }
        .confirmation {
            text-align: center;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .confirmation h1 {
            margin-bottom: 20px;
            color: #0e3e19ff;
        }
        .confirmation a {
            display: inline-block;
            padding: 12px 24px;
            background-color: #14213d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-family: "Playfair Display", serif;
            font-size: 16px;
        }
        .confirmation a:hover {
            background-color: #59708aff;
        }
    </style>
</head>
<body>
    <div class="confirmation">
        <h1>✅ Your order has gone through!</h1>
        <a href="{{ url('/') }}">Back to Home</a>
    </body>
</html>