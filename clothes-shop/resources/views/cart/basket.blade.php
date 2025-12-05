<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Basket - {{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
</head>

<body class="font-playfair text-black antialiased">

@include('components.mainnavbar')

<style>
    .basket-header {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
      padding: 0 20px;
      margin-top: 30px;
    }
    .basket-title {
      font-family: 'Playfair Display', serif;
      font-size: 48px;
      margin: 0;
    }
    .item-count {
      font-size: 24px;
    }
    .basket-divider {
      border-top: 1px solid #000000;
      opacity: 0.2;
      margin: 8px 0;
      margin-left: 42px;
      width: calc(100% - 102px);
    }
    .basket-content {
      display: flex;
      gap: 2rem;
      padding: 10px 20px;
    }

    /* Item Card */
    .basket-item {
      position: relative;
      padding: 1rem;
      width: 355px;
      height: 490px;
      background: rgba(217, 217, 217, 0.55);
      border: 1px solid #000000;
      border-radius: 8px;
    }
 .item-image {
  width: 100%;
  aspect-ratio: 1 / 1.2;
  object-fit: cover;
  border-radius: 8px;
  background: #fff;
  display: block;
}



    .item-details {
      margin-top: 0.75rem;
      font-size: 16px;
    }
    .item-details h3 {
      margin: 0;
      font-size: 18px;
    }
    .item-specs {
      font-size: 16px;
      opacity: 0.6;
    }

    .item-actions {
      margin-top: 1rem;
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    .basket-summary {
      width: 380px;
      background: rgba(217, 217, 217, 0.55);
      border: 1px solid #000000;
      border-radius: 8px;
      padding: 1rem;
      margin-left: auto;
      margin-right: 40px;
    }
    .summary-title {
      font-size: 24px;
      margin: 0 0 12px 0;
    }
    .summary-item,
    .summary-total {
      margin: 4px 0;
    }

    .checkout-button {
        width: 100%;
        background-color: #14213D;
        color: #fff;
        border: none;
        border-radius: 3px;
        padding: .75rem 1rem;
        font-size: 16px;
        cursor: pointer;
        transition: .3s;
    }
    .checkout-button:hover {
        background-color: #56607f;
    }

    .empty-message{
      margin: 100px auto;
      text-align: center;
      font-size: 20px;
    }
</style>


<div class="basket-header">
    <h2 class="basket-title">BASKET</h2>
    <span class="item-count">{{ $items->sum('qty') }} items</span>
</div>
<hr class="basket-divider"/>


<main class="basket-content">

    @if($items->count())

        <div>
            @foreach($items as $item)

                <div class="basket-item">

                    <img src="/{{ $item->variant->product->images->first()->url ?? 'images/placeholder.png' }}"
                         class="item-image" alt="Product">

                    <div class="item-details">
                        <h3>{{ $item->variant->product->name }}</h3>
                        <p>£{{ number_format($item->variant->price, 2) }}</p>
                        <p class="item-specs">{{ $item->variant->size }} 
                            @if($item->variant->color) | {{ $item->variant->color }} @endif
                        </p>
                    </div>

                    <div class="item-actions">

                        {{-- Update Qty --}}
                        <form method="POST" action="{{ route('cart.update', $item->variant_id) }}">
                            @csrf
                            <input
                                type="number"
                                name="qty"
                                value="{{ $item->qty }}"
                                min="1"
                                class="border rounded px-2 w-16"
                            >
                            <button class="px-2 py-1 border rounded">Update</button>
                        </form>

                        {{-- Remove --}}
                        <form method="POST" action="{{ route('cart.remove', $item->variant_id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="px-2 py-1 border rounded text-red-600">
                                Remove
                            </button>
                        </form>

                    </div>

                </div>

            @endforeach
        </div>


        {{-- Basket Summary --}}
        <div class="basket-summary">
            <p class="summary-title">Basket Summary</p>
            <p class="summary-item">Subtotal:
                £{{ number_format($items->sum(fn($i) => $i->variant->price * $i->qty), 2) }}
            </p>
            <p class="summary-item">Delivery Fee: £0.00</p>

            <p class="summary-total">
                Total: £{{ number_format($items->sum(fn($i) => $i->variant->price * $i->qty), 2) }}
            </p>

            <form action="{{ route('orders.checkout') }}" method="GET">
                <button type="submit" class="checkout-button">
                    PROCESS YOUR ORDER
                </button>
            </form>
        </div>

    @else

        <div class="empty-message">
            <img src="{{ asset('images/empty-basket.png') }}" alt="Empty">
            <p>Nothing's in your basket ;(</p>
        </div>

    @endif

</main>

</body>
</html>
