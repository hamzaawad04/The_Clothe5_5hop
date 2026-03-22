<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wishlist</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Playfair Display", serif;
            background: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .wishlist-main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .wishlist-header {
            text-align: center;
            margin: 24px auto 8px;
            max-width: 760px;
            position: relative;
        }
        .wishlist-title-wrapper {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
            position: relative;
        }
        .wishlist-heart {
            width: 24px;
            height: 24px;
            object-fit: contain;
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }
        .wishlist-title {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            padding-top: 12px;
            z-index: 5;
        }
        .navbar-divider {
            border-top: 1px solid rgba(0,0,0,0.15);
            margin: 0;
            width: 100%;
        }
        .item-count {
            font-size: 15px;
            opacity: .7;
            margin-top: 4px;
        }
        .wishlist-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 18px;
            padding: 20px;
            width: 100%;
        }
        .wishlist-items {
            flex: 1;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 20px;
            width: 100%;
            max-width: 1000px;
        }

        /* ---------------- FIXED SECTION ---------------- */
        .wishlist-item {
            position: relative;
            background: #e5e5e5aa;
            border: 1px solid #000;
            border-radius: 8px;
            padding: 16px;
            width: 320px;
            display: flex;
            flex-direction: column;
            min-height: 480px; /* ensures equal height like your mockup */
        }
        /* ------------------------------------------------ */

        .item-image {
            width: 100%;
            height: 280px;
            object-fit: contain;
            border-radius: 8px;
        }
        .item-details {
            margin-top: 10px;
        }
        .item-details h3 {
            margin: 0;
            font-size: 18px;
        }
        .item-details p {
            margin: 4px 0;
            opacity: .8;
        }
        .item-name, .item-price {
            display: none;
        }
        .empty-message {
            width: 100%;
            margin-top: 30px;
            text-align: center;
            opacity: .75;
        }
        .wishlist-actions {
            margin-top: 14px;
            display: flex;
            justify-content: flex-end;
        }
        .wishlist-actions form {
            margin: 0;
        }
        .wishlist-actions .remove {
            background: transparent;
            border: 0;
            padding: 0;
        }
        .wishlist-actions .remove .action-icon {
            width: 22px;
            height: 22px;
        }

        .wishlist-actions button,
        .move-outside {
            background: #14213D;
            color: #fff;
            border: none;
            padding: 10px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ---------------- FIXED SECTION ---------------- */
        .move-form {
            margin-top: auto; /* pushes button to bottom */
        }

        .move-outside {
            width: 100%;
            margin-top: 12px;
        }
        /* ------------------------------------------------ */

        .action-icon {
            width: 18px;
            height: 18px;
            display: inline-block;
        }
        .wishlist-actions .remove {
            background: transparent;
        }
        .wishlist-actions .move {
            background: #14213D;
        }
    </style>
</head>
<body class="font-playfair text-black">

@include('components.mainnavbar')
<hr class="navbar-divider" />

<main class="wishlist-main">
    <div class="wishlist-header">
        <div class="wishlist-title-wrapper">
            <img src="{{ asset('images/heart.png') }}" alt="heart" class="wishlist-heart" />
            <h2 class="wishlist-title">Wishlist</h2>
        </div>
        <div class="item-count">You currently have {{ $count }} products in your wishlist</div>
        <div class="wishlist-divider"></div>
    </div>

    <div class="wishlist-content">
        <div class="wishlist-items">
            @foreach($wishlists as $wishlist)
                <div class="wishlist-item">
    <img
        src="{{ asset($wishlist->product->images->first()->url ?? 'images/no-image.png') }}"
        alt="{{ $wishlist->product->name }}"
        class="item-image"
    >

    <div class="item-details">
        <h3>{{ $wishlist->product->name }}</h3>
        <p>£{{ number_format($wishlist->product->base_price, 2) }}</p>
        <p>{{ $wishlist->variant->size }} | {{ $wishlist->variant->color }}</p>
    </div>

    <div class="wishlist-actions">
        <form action="{{ route('wishlist.remove', $wishlist->variant_id) }}" method="POST" class="remove-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="remove" aria-label="Remove from favorites">
                <img src="{{ asset('images/assets/bin.png') }}" alt="Remove" class="action-icon">
            </button>
        </form>
    </div>

    <form action="{{ route('wishlist.move', $wishlist->variant_id) }}" method="POST" class="move-form">
        @csrf
        <button type="submit" class="move move-outside">Move to basket</button>
    </form>
</div>

            @endforeach
        </div>
    </div>
</main>

@include('components.footer')

</body>
</html>