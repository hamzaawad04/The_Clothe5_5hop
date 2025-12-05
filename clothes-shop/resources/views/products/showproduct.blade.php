<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>THE CLOTHE5 5HOP – {{ $product->name }}</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Playfair Display', serif;
      background: #fff;
      color: #111;
    }

    .heading {
      text-align: center;
      font-size: 32px;
      font-weight: bold;
      margin: 20px 0;
      background: #fff;
    }

    .filters {
      background: #0a2540;
      padding: 16px 24px;
      display: flex;
      justify-content: space-around;
      gap: 24px;
    }
    .filters .filter-group {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .filters label {
      margin-bottom: 6px;
      font-weight: 500;
      color: #fff;
    }
    .filters select {
      width: 100%;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .container {
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 24px;
      display: flex;
      gap: 40px;
    }
    .product-image {
      flex: 1;
      background: #f3f4f6;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #e5e7eb;
      border-radius: 10px;
      height: 500px;
    }
    .product-image img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
    .product-details {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .product-details h1 {
      font-size: 28px;
      margin-bottom: 10px;
    }
    .price {
      font-size: 22px;
      font-weight: bold;
      margin: 10px 0;
    }
    .color {
      font-size: 16px;
      margin: 10px 0;
    }
    .quantity {
      margin: 20px 0;
    }
    .quantity input {
      width: 60px;
      padding: 6px;
      font-size: 16px;
      text-align: center;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    .buttons {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }
    .btn {
      flex: 1;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .btn-basket {
      background: #0a2540;
      color: #fff;
    }
    .btn-wishlist {
      background: #e5e7eb;
      color: #333;
    }
    .btn-wishlist.hearted {
      background: #ff4d4d;
      color: #fff;
    }
  </style>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-playfair text-black">
  <!-- Top bar -->
  @include('components.mainnavbar')

  <!-- Product detail -->
  <div class="container">
    <div class="product-image">
      <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}">
    </div>

    <div class="product-details">
      <h1>{{ $product->name }}</h1>
      <div class="price">£{{ $product->price }}</div>
      <div class="color">Colour: {{ $product->color }}</div>

      <form method="POST" action="{{ route('basket.add', $product->id) }}">
        @csrf
        <div class="quantity">
          <label for="qty">Quantity:</label>
          <input type="number" name="quantity" id="qty" value="1" min="1">
        </div>

        <div class="buttons">
          <button type="submit" class="btn btn-basket">Add to Basket</button>
          <button type="button" class="btn btn-wishlist {{ in_array($product->id, session('wishlist', [])) ? 'hearted' : '' }}"
                  onclick="toggleWishlist({{ $product->id }})">
            {{ in_array($product->id, session('wishlist', [])) ? '♥ Wishlisted' : '♡ Wishlist' }}
          </button>
        </div>
      </form>
    </div>
  </div>

  @include('components.footer')

  <script>
    function toggleWishlist(productId) {
      fetch(`/wishlist/toggle/${productId}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        }
      }).then(() => location.reload());
    }
  </script>
</body>
</html>