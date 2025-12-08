<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Checkout</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: "Playfair Display", serif;
                margin: 0;
                padding: 0;
                background: #ffffff;
                color: #000000;
            }

            header {
                background: white;
                font-size: 2rem;
                color: #14213d;
                padding: 2rem;
                text-align: center;
                position: relative;
            }


            .breadcrumb {
                background: #14213d;
                color: white;
                text-align: center;
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            main {
                padding: 1rem;
            }

            section {
                background: #fff;
                padding: 1rem;
                margin-bottom: 1.5rem;
                border-radius: 5px;
            }

            h2 {
                margin-top: 0;
            }

            h3 {
                margin: 0 0 5px;
                font-size: 1.2em;
                color: #333;
            }

            p {
                margin: 0;
                color: #555;
            }

            .shipping-address {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                flex-wrap: wrap;
                border: 1px solid gold;
                padding: 1rem;
                border-radius: 5px;
            }

            .shipping-details {
                flex: 1;
            }

            .shipping-actions {
                text-align: right;
                min-width: 120px;
            }

            .shipping-actions button {
                display: block;
                margin-bottom: 0.5rem;
                background: #000;
                color: #fff;
                border: none;
                padding: 0.4rem 0.8rem;
                cursor: pointer;
                border-radius: 3px;
            }

            .shipping-actions button:hover {
                background: #444;
            }

            .item {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .quantity-controls button {
                margin: 0 0.5rem;
                padding: 0.3rem 0.6rem;
            }

            label {
                display: block;
                margin: 0.5rem 0;
            }

            button {
                background: #000;
                color: #fff;
                border: none;
                padding: 0.6rem 1rem;
                cursor: pointer;
                border-radius: 3px;
            }

            button:hover {
                background: #444;
            }

            .product-card {
                display: flex;
                gap: 1.5rem;
                border: 1px solid #ddd;
                border-radius: 8px;
                overflow: hidden;
                background: #fff;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                margin-bottom: 1.5rem;
                border: 1px solid gold;
                padding: 1rem;
                border-radius: 3px;
            }

            .product-image {
                width: 150px;
                height: 150px;
                overflow: hidden;
                background: #f0f0f0;
                flex-shrink: 0;
            }

            .product-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .product-info {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 1rem 0;
            }

            .product-info h3 {
                margin: 0 0 0.5rem 0;
                font-size: 1.2rem;
            }

            .product-price {
                font-size: 1.5rem;
                font-weight: bold;
                color: #000;
                margin: 0.5rem 0;
            }

            .product-description {
                color: #666;
                margin: 0.5rem 0;
                font-size: 0.95rem;
            }

            .product-details {
                display: flex;
                gap: 1rem;
                margin: 0.5rem 0;
            }

            .detail-item {
                font-size: 0.9rem;
                color: #666;
                background: #f9f9f9;
                padding: 0.3rem 0.6rem;
                border-radius: 3px;
            }

            .quantity-controls {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-top: 0.5rem;
            }

            .quantity-controls button {
                padding: 0.3rem 0.6rem;
                font-size: 0.9rem;
            }

            .quantity-controls span {
                min-width: 30px;
                text-align: center;
                font-weight: bold;
            }

            .info-section {
                max-width: 1000px;
                font-size: 0.75em;
                margin: auto;
                font-family: "Playfair Display", serif;
            }

            .info-block {
                display: flex;
                align-items: flex-start;
                margin-bottom: 20px;
            }

            .icon {
                width: 40px;
                height: 40px;
                margin-right: 15px;
            }

            .order-button {
                background-color: #14213D;
                font-family: "Playfair Display", serif;
                color: #FCA311;
                border: none;
                padding: 16px 18px;
                font-size: 2em;
                cursor: pointer;
                width: 100%;
                margin-top: 30px;
            }

            .order-button:hover {
                background-color: #FCA311;
                color: #14213D;
            }

            .divider {
                border: none;
                height: 1px;
                background: #e0e0e0;
                margin: 1rem 0;
            }

            .divider.dashed { background: none; border-top: 1px dashed #ccc; height: 0; }
            .divider.gold { background: gold; height: 2px; }
        </style>
    </head>

    <body class="font-playfair text-black">

        @include('components.checkoutnavbar')

        <nav class="breadcrumb">
            Basket > Place Order > Pay > Order Complete
        </nav>

        <main>
            <!-- CUSTOMER DETAILS -->
            <section class="shipping-address">
                <div class="shipping-details">
                    <h2>Shipping Address</h2>
                   
                    
                    @auth
                        @php $user = auth()->user(); @endphp
                        <p>{{ $user->first_name }} {{ $user->last_name }}</p>

                        {{-- Add the other deatils of the database for the cutsomer here --}}
                        
                    @else
                        <p>Customer Name</p>
                        <p>Road name</p>
                        <p>City, County</p>
                        <p>Country</p>
                        <p>Post code</p>
                        <p><a href="{{ route('login') }}">Sign in to use saved address</a></p>
                    @endauth
                </div>
                <div class="shipping-actions">
                    <button type="button">Change</button>
                    <button type="button">Edit address</button>
                </div>
            </section>

           
            <hr class="divider" />

            <form method="POST" action="{{ route('checkout.place-order') }}">
                @csrf

                <!-- PRODUCTS IN BASKET -->
                <section class="item-details">
                    <h2>Your Basket</h2>

                    @if(!empty($basket['items']))
                        @foreach($basket['items'] as $item)
                            <div class="product-card" data-id="{{ $item['id'] }}" data-price="{{ $item['price'] ?? 0 }}">
                                <div class="product-image">
                                    <img src="{{ asset($item['image'] ?? 'images/placeholder.jpg') }}" alt="{{ $item['name'] ?? 'Product' }}" />
                                </div>
                                <div class="product-info">
                                    <h3>{{ $item['name'] ?? 'Product Name' }}</h3>
                                    <p class="product-price">£{{ number_format($item['price'] ?? 0, 2) }}</p>
                                    <p class="product-description">{{ $item['description'] ?? '' }}</p>
                                    <div class="product-details">
                                        <span class="detail-item">Size: {{ $item['size'] ?? 'N/A' }}</span>
                                        <span class="detail-item">Color: {{ $item['colour'] ?? 'N/A' }}</span>
                                    </div>

                                    <div class="quantity-controls">
                                        <button type="button" class="qty-btn" data-change="-1" data-id="{{ $item['id'] }}">-</button>

                                        <input type="hidden" name="quantities[{{ $item['id'] }}]" value="{{ $item['quantity'] ?? 1 }}" class="quantity-input" data-id="{{ $item['id'] }}" />

                                        <span class="quantity-display" id="quantity-{{ $item['id'] }}">{{ $item['quantity'] ?? 1 }}</span>

                                        <button type="button" class="qty-btn" data-change="1" data-id="{{ $item['id'] }}">+</button>
                                    </div>

                                    <input type="hidden" name="items[]" value="{{ $item['id'] }}" />
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Your basket is empty.</p>
                    @endif
                </section>

                <hr class="divider" />

                <!-- SHIPING OPTIONS -->
                <section class="shipping-options">
                    <h2>Shipping Options</h2>
                    <label><input type="radio" name="shipping" value="standard" data-cost="3.00" checked /> Standard Shipping (£3.00)</label>
                    <label><input type="radio" name="shipping" value="click_collect" data-cost="3.00" /> Click & Collect (£3.00)</label>
                    <label><input type="radio" name="shipping" value="express" data-cost="6.00" /> Express Shipping (£6.00)</label>
                </section>

                <hr class="divider" />

                <!-- PAYYYMENT METHID SECTION -->
                <section class="payment-method">
                    <h2>Payment Method</h2>
                    <label><input type="radio" name="payment" value="PayPal" /> PayPal</label>
                    <label><input type="radio" name="payment" value="Credit/Debit Card" /> Credit/Debit Card</label>
                    <label><input type="radio" name="payment" value="Apple Pay" /> Apple Pay</label>
                    <label><input type="radio" name="payment" value="Google Pay" /> Google Pay</label>
                </section>

                <hr class="divider" />

                <!-- ORDER SUMMARY -->
                <section class="order-summary">
                    <h2>Order Summary</h2>
                    <p>Retail Price: <span id="retail-price">£0.00</span></p>
                    <p>Shipping Fee: <span id="shipping-fee">£0.00</span></p>
                    <p>On-Time Delivery Guarantee: FREE</p>
                    <p>Promotions: <span id="promotions">-£1.16</span></p>
                    <p><strong>Order Total: <span id="order-total">£0.00</span></strong></p>

                    <!-- ORDER STUFF -->
                    <input type="hidden" name="retail_total" id="retail_total" value="0.00" />
                    <input type="hidden" name="shipping_total" id="shipping_total" value="0.00" />
                    <input type="hidden" name="promotions_total" id="promotions_total" value="0.00" />
                    <input type="hidden" name="order_total" id="order_total_input" value="0.00" />
                </section>

                <hr class="divider" />


                <!-- LEGALITIES -->
                <div class="info-section">
                    <div class="info-block">
                        <div>
                            <h3> 🔒 Payment Security</h3>
                            <p>The Clothes Shop uses the latest industry standards to protect your personal information.</p>
                        </div>
                    </div>
                    <div class="info-block">
                        <div> 
                            <h3> 🛡️ Security & Privacy</h3>
                            <p>We will not store your card details and information.</p>
                        </div>
                    </div>
                    <div class="info-block">
                        <div>
                            <h3> 👨🏻‍💻 Customer Support</h3>
                            <p>Contact our Customer Service Platform or email us with any questions.</p>
                        </div>
                    </div>

                    <hr class="divider" />


                    <!-- ORDER BUTTON -->
                    <button type="submit" class="order-button">Order & Pay</button>
                </div>
            </form>
        </main>


        <script>
        document.addEventListener('DOMContentLoaded', function () {

        function recalcTotals() {
            const productCards = document.querySelectorAll('.product-card[data-price]');
            let retail = 0;

            productCards.forEach(card => {
                const price = parseFloat(card.dataset.price) || 0;
                const id = card.dataset.id;
                const qtyInput = document.querySelector('input.quantity-input[data-id="' + id + '"]');
                const qty = parseInt(qtyInput?.value || '1', 10) || 1;
                retail += price * qty;
            });

            // PROMOTIONNNNNNNN
            const PROMOTIONS = retail * 0.25;

            const shippingRadio = document.querySelector('input[name="shipping"]:checked');
            const shippingCost = parseFloat(shippingRadio?.dataset.cost || '0') || 0;

            const total = Math.max(0, retail - PROMOTIONS + shippingCost);

            document.getElementById('retail-price').textContent = '£' + retail.toFixed(2);
            document.getElementById('shipping-fee').textContent = '£' + shippingCost.toFixed(2);
            document.getElementById('promotions').textContent = '-£' + PROMOTIONS.toFixed(2);
            document.getElementById('order-total').textContent = '£' + total.toFixed(2);

            document.getElementById('retail_total').value = retail.toFixed(2);
            document.getElementById('shipping_total').value = shippingCost.toFixed(2);
            document.getElementById('promotions_total').value = PROMOTIONS.toFixed(2);
            document.getElementById('order_total_input').value = total.toFixed(2);
        }

        function updateQuantity(id, change) {
            const input = document.querySelector('input.quantity-input[data-id="' + id + '"]');
            const display = document.getElementById('quantity-' + id);
            if (!input || !display) return;
            let qty = parseInt(input.value, 10) || 1;
            qty = Math.max(1, qty + change);
            input.value = qty;
            display.textContent = qty;
            recalcTotals();
        }

        document.querySelectorAll('.qty-btn').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const id = this.dataset.id;
                const change = parseInt(this.dataset.change, 10) || 0;
                updateQuantity(id, change);
            });
        });

        document.querySelectorAll('input[name="shipping"]').forEach(r => {
            r.addEventListener('change', recalcTotals);
        });

        recalcTotals();
        });
        </script>
    </body>
</html>