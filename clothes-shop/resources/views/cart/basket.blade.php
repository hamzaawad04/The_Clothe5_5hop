<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Basket</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: "Playfair Display", serif; 
            background: #fff;
        }
        .basket-header {
            display:flex; justify-content:space-between; 
            padding-left:20px; margin-top:0px;
            padding-right: 10px;
            padding-top: 5px;
        }
        .basket-title { font-size:48px; font-weight:500; }
        .item-count { font-size:22px; opacity:.7; }
        .basket-divider { 
            border-top:1px solid #0003;
            width:calc(100% - 60px);
            margin:auto;
        }
        .basket-content { display:flex; gap:40px; padding:20px; }
        .basket-items { 
            flex:1; 
            display:flex; 
            flex-wrap:wrap; 
            gap:20px; 
            align-content:flex-start;
        }

        .basket-item {
            position:relative;
            background:#e5e5e5aa;
            border:1px solid #000;
            border-radius:8px;
            padding:20px;
            width:320px;
        }

        .item-image {
            width:100%;
            height:330px;
            object-fit:contain;
            border-radius:8px;
        }

        .item-details { margin-top:10px; }
        .item-details h3 { margin:0; font-size:20px; }
        .item-details p { margin:3px 0; opacity:.8; }

        .quantity-box {
            border:1px solid #000;
            border-radius:6px;
            padding:4px 8px;
            display:flex;
            gap:6px;
            width:max-content;
        }

        .basket-summary {
            width:360px;
            background:#e5e5e5aa;
            border:1px solid #000;
            border-radius:8px;
            padding:20px;
            height:max-content;
        }

        .checkout-button {
            width:100%;
            background:#14213D;
            color:white;
            padding:12px;
            border-radius:6px;
            margin-top:20px;
        }

        .empty-message {
            text-align:center;
            width:100%;
            margin-top:10px;
            opacity:.7;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

@include('components.mainnavbar')

<div class="basket-header">
    <h2 class="basket-title">BASKET</h2>
    <span class="item-count">{{ $cartItems->count() }} items</span>
</div>

<hr class="basket-divider"/>

<div class="basket-content">

    <!-- LEFT SIDE (ITEMS) -->
    <div class="basket-items">

        @if($cartItems->isEmpty())
            <div class="empty-message">
                <img src="{{ asset('images/empty-basket.png') }}" width="150">
                <p>Your basket is empty…</p>
            </div>
        @else

            @foreach($cartItems as $item)
                <div class="basket-item">

                    <img 
                        src="{{ asset($item->variant->product->images->first()->url) }}"
                        class="item-image"
                    >

                    <div class="item-details">
                        <h3>{{ $item->variant->product->name }}</h3>
                        <p>£{{ number_format($item->variant->product->base_price, 2) }}</p>
                        <p>{{ $item->variant->size }} | {{ $item->variant->color }}</p>
                    </div>

                    <!-- QUANTITY FORM -->
                    <form action="{{ route('cart.update', $item->variant_id) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="quantity-box">
                            <button name="qty" value="{{ max(1, $item->qty - 1) }}">−</button>
                            <span>{{ $item->qty }}</span>
                            <button name="qty" value="{{ $item->qty + 1 }}">+</button>
                        </div>
                    </form>

                    <!-- REMOVE ITEM -->
                    <form action="{{ route('cart.remove', $item->variant_id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="text-sm text-red-600">Remove</button>
                    </form>

                </div>
            @endforeach

        @endif

    </div>

    <!-- RIGHT SIDE (SUMMARY) -->
    @if(!$cartItems->isEmpty())
        <div class="basket-summary">
            
            <h3 class="text-xl font-semibold">Basket Summary</h3>

            <hr class="my-3"/>

            <p>Subtotal: £{{ number_format($subtotal, 2) }}</p>
            <p>Delivery: £{{ number_format($deliveryFee, 2) }}</p>

            <p class="mt-3 font-bold text-lg">
                TOTAL: £{{ number_format($total, 2) }}
            </p>

            <form action="{{ route('orders.checkout') }}" method="GET">
                <button type="submit" class="checkout-button">
                    PROCESS YOUR ORDER
                </button>
            </form>

        </div>
    @endif

    </div>

@include('components.footer')

</body>
</html>
