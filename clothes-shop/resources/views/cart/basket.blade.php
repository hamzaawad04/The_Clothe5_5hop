<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Basket</title>

    {{-- Include your Tailwind or app.css --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: "Playfair Display", serif;
            background: #f5f5f5;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }
        .item-box {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }
        .item-box:last-child {
            border-bottom: none;
        }
        .item-img {
            width: 90px;
            height: 90px;
            border-radius: 8px;
            overflow: hidden;
            background: #eee;
            flex-shrink: 0;
        }
        .item-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .item-info {
            margin-left: 20px;
            flex-grow: 1;
        }
        .quantity-form button {
            padding: 4px 10px;
            background: #ddd;
            border-radius: 4px;
        }
        .remove-btn {
            color: red;
            font-size: 14px;
        }
        .checkout-btn {
            background: black;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            font-size: 18px;
            margin-top: 25px;
            display: inline-block;
        }
        .checkout-btn:hover {
            background: #333;
        }
    </style>
</head>
<body>

    <div class="container">

        <h1 class="text-3xl font-bold mb-6">Your Basket</h1>

        {{-- 🛒 If basket is empty --}}
        @if(empty($basket['items']) || count($basket['items']) === 0)
            <p>Your basket is empty.</p>

            <a href="{{ route('products.tops') }}" class="text-blue-600 underline">
                Continue Shopping
            </a>
        @else

            {{-- 🛍 Basket Items --}}
            @foreach($basket['items'] as $item)
                <div class="item-box">

                    {{-- Product Image --}}
                    <div class="item-img">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                    </div>

                    {{-- Product Info --}}
                    <div class="item-info">
                        <h2 class="font-semibold text-lg">{{ $item['name'] }}</h2>
                        <p class="text-gray-700">
                            Size: {{ $item['size'] }} &nbsp; | &nbsp;
                            Color: {{ $item['color'] }}
                        </p>
                        <p class="font-bold mt-1">£{{ number_format($item['price'], 2) }}</p>
                    </div>

                    {{-- Quantity Buttons --}}
                    <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="quantity-form mx-4">
                        @csrf
                        <button name="change" value="-1">−</button>
                        <span class="px-3">{{ $item['quantity'] }}</span>
                        <button name="change" value="1">+</button>
                    </form>

                    {{-- Remove Item --}}
                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="remove-btn">Remove</button>
                    </form>

                </div>
            @endforeach

            {{-- Checkout --}}
            <div class="text-right mt-8">
                <a href="{{ route('orders.checkout') }}" class="checkout-btn">
                    Proceed to Checkout
                </a>
            </div>

        @endif

    </div>

</body>
</html>
