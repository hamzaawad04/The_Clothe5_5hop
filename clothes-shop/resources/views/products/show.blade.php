<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} – THE CLOTHE5 5HOP</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body {
            font-family: "Playfair Display", serif;
            background: #fff;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 40px 20px;
            display: flex;
            gap: 50px;
        }
        .image-box {
            width: 450px;
        }
        .main-image {
            width: 100%;
            height: 450px;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,.15);
        }
        .thumbs {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .thumbs img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            background: white;
            padding: 4px;   
        }
        .thumbs img:hover {
            border-color: #14213D;
        }
        .info-box {
            flex: 1;
        }
        .add-btn {
            background: #14213D;
            color: gold;
            padding: 12px 20px;
            border-radius: 6px;
            margin-top: 20px;
        }
        .popup {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 260px;
            background: #fff;
            border: 1px solid #ddd;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,.2);
            z-index: 999;
        }

        /* REVIEWS SECTION */
        .reviews-section{
            max-width:1200px;
            margin:60px auto;
            padding:0 40px;
        }
        .reviews-header-grid{
            display:flex;
            justify-content:space-between;
            align-items:flex-end;
            border-bottom:1px solid #e0e0e0;
            padding-bottom:25px;
            margin-bottom:30px;
        }
        .reviews-title-area h2{
            font-size:2rem;
            margin-bottom:10px;
            color:#14213D;
        }
        .overall-rating{
            color:#666;
            font-size:.9rem;
        }
        .stars-gold{
            color:#14213D;
            font-size:1.2rem;
            margin-right:8px;
        }
        .reviews-actions{
            text-align:right;
        }
        .reviews-actions p{
            font-size:.8rem;
            color:#888;
            margin-bottom:10px;
            text-transform:uppercase;
            letter-spacing:1px;
        }
        .button-group{
            display:flex;
            gap:12px;
        }
        .btn-login,.btn-register{
            text-decoration:none;
            padding:10px 25px;
            font-size:.9rem;
            border:1px solid #14213D;
            transition:.25s;
        }
        .btn-login{
            background:transparent;
            color:#14213D;
        }
        .btn-register{
            background:#14213D;
            color:gold;
        }
        .btn-login:hover{
            background:#f3f3f3;
        }
        .empty-state{
            padding:50px 0;
            text-align:center;
            color:#999;
            background:#fdfdfd;
            border:1px dashed #eee;
        }

        /* STAR RATING SYSTEM */
        .star-rating{
            display:flex;
            flex-direction:row-reverse;
            justify-content:flex-end;
            gap:6px;
        }

        .star-rating input{
            display:none;
        }

        .star-rating label{
            font-size:32px;
            color:#d1d5db;
            cursor:pointer;
            transition:color .2s;
        }

        /* hover effect */
        .star-rating label:hover,
        .star-rating label:hover ~ label{
            color:#14213D;
        }

        /* selected stars */
        .star-rating input:checked ~ label{
            color:#14213D;
        }

        /* REVIEW DISPLAY STARS (PREMIUM LOOK) */
        .stars-display{
            display:inline-flex;
            gap:3px;
            font-size:1.2rem;
        }

        .star-icon{
            color:#D4AF37;
            font-weight:900;
        }

        .star-icon.empty{
            color:#e5e5e5;
        }
    </style>
</head>

<body>

@include('components.mainnavbar')

<div class="container">

    <!-- IMAGE SECTION -->
    <div class="image-box"
        x-data="{
            index: 0,
            images: {{ $images->pluck('url')->toJson() }}
        }"
    >
        <img :src="'/' + images[index]" class="main-image">

        @if($images->count() > 1)
            <div class="thumbs">
                @foreach($images as $i => $img)
                    <img 
                        src="/{{ $img->url }}" 
                        @click="index = {{ $i }}"
                    >
                @endforeach
            </div>
        @endif
    </div>

    <!-- PRODUCT INFO -->
    <div class="info-box">

        <h1 class="text-4xl font-bold">{{ $product->name }}</h1>

        <p class="text-2xl mt-3 font-semibold">£{{ number_format($product->base_price, 2) }}</p>

        <div class="mt-6 text-lg">
            {!! $product->description !!}
        </div>

        <!-- ADD TO BASKET FORM -->
        <form 
            x-data="{
    variants: {{ $product->variants->toJson() }},
    variant_id: '{{ $product->variants->first()->variant_id ?? '' }}',
    qty: 1,
    showPopup: false,

    get selectedVariant() {
        return this.variants.find(v => v.variant_id == this.variant_id);
    },

    isOutOfStock() {
        return this.selectedVariant && this.selectedVariant.stock_qty <= 0;
    },

    isLowStock() {
        return this.selectedVariant 
            && this.selectedVariant.stock_qty > 0 
            && this.selectedVariant.stock_qty <= this.selectedVariant.low_stock_threshold;
    },

    async submitForm() {
        let formData = new FormData();
        formData.append('variant_id', this.variant_id);
        formData.append('qty', this.qty);

        const response = await fetch('{{ route('cart.add') }}', {
            method: 'POST',
            headers: { 
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData,
        });

        let result = await response.json();

        if (result.success) {
            this.showPopup = true;
            setTimeout(() => this.showPopup = false, 3000);
        }
    }
}"
            @submit.prevent="submitForm"
            method="POST"
            action="{{ route('cart.add') }}"
        >
            @csrf

            <!-- VARIANT SELECT -->
            @if($product->variants->count() > 1)
                <label class="block mb-2 font-medium">Select Size:</label>
                <select 
                    name="variant_id"
                    x-model="variant_id"
                    class="border rounded px-3 py-2 w-48"
                >
                    @foreach($product->variants as $variant)
                        <option value="{{ $variant->variant_id }}">
                            {{ $variant->size }}
                            @if($variant->color) - {{ $variant->color }} @endif
                        </option>
                    @endforeach
                </select>
            @else
                <input 
                    type="hidden" 
                    name="variant_id"
                    value="{{ $product->variants->first()->variant_id }}"
                    x-model="variant_id"
                >
            @endif

            <!-- QUANTITY -->
            <div class="mt-4 flex items-center gap-4">
                <input 
                    type="number" 
                    name="qty" 
                    x-model="qty"
                    value="1"
                    min="1"
                    class="border rounded px-3 py-2 w-20"
                >

                <div class="stock-status-box ml-4">

                    <div 
                        class="stock-indicator is-low flex"
                        x-show="isLowStock()"
                    >
                        <span class="status-dot dot-gold"></span>
                        <span>
                            Low Stock: Only 
                            <span x-text="selectedVariant.stock_qty"></span> left
                        </span>
                    </div>

                    <div 
                        class="stock-indicator is-out flex"
                        x-show="isOutOfStock()"
                    >
                        <span class="status-dot dot-gray"></span>
                        <span>Currently Out of Stock</span>
                    </div>

                </div>

                <button 
                    type="submit" 
                    class="add-btn hover:bg-[#0f1829]"
                    :disabled="isOutOfStock()"
                    :class="{ 'opacity-50 cursor-not-allowed': isOutOfStock() }"
                >
                    Add to Basket
                </button>

                <!-- POPUP -->
                <div 
                    x-show="showPopup"
                    x-transition
                    class="popup"
                    style="display:none;"
                >
                    <h3 class="font-bold text-lg">Added to Basket!</h3>
                    <p class="text-gray-700 mt-1">{{ $product->name }}</p>
                    <p class="text-gray-500 text-sm">Qty: <span x-text="qty"></span></p>

                    <div class="flex justify-end gap-2 mt-4">
                        <a href="{{ route('cart.basket') }}" class="text-blue-600 underline text-sm">View Basket</a>
                    </div>
                </div>
            </div>
        </form>
                <!-- ADD TO WISHLIST FORM -->
                <form 
                    method="POST"
                    action="{{ route('wishlist.add') }}"
                    class="inline"
                >
                    @csrf
                    <input 
                        type="hidden" 
                        name="variant_id"
                        x-bind:value="variant_id"
                    >
                    <button 
                        type="submit" 
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 ml-2"
                    >
                        ❤️ Add to Wishlist
                    </button>
                </form>
            </div>
    </div>
</div>

<!-- REVIEWS SECTION -->
<section class="reviews-section">

    <div class="reviews-header-grid">

        <div class="reviews-title-area">
            <h2>Customer Reviews</h2>

            <div class="overall-rating">
                <span class="stars-gold">☆☆☆☆☆</span>

                @if($product->reviews->count() > 0)
                    <span class="review-count">
                        {{ $product->reviews->count() }} reviews
                    </span>
                @else
                    <span class="review-count">No reviews yet</span>
                @endif
            </div>
        </div>

        <div class="reviews-actions">

            @auth
                <div class="button-group">
                    <button onclick="openReviewModal()" class="btn-register">
                        Write a Review
                    </button>
                </div>
            @else
                <p>Log in to share your thoughts</p>

                <div class="button-group">
                    <a href="{{ route('login') }}" class="btn-login">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="btn-register">
                        Register
                    </a>
                </div>
            @endauth

        </div>

    </div>

    <div class="reviews-body">

        @if($product->reviews->count() > 0)

            <div class="space-y-6">

                @foreach($product->reviews as $review)

                    <div class="border-b pb-4">

                        <div class="flex justify-between items-center">
                            <strong>
                                {{ $review->user?->first_name ?? 'User' }} {{ $review->user?->last_name ?? '' }}
                            </strong>
                            <div class="stars-display">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="star-icon {{ $i <= $review->rating ? '' : 'empty' }}">★</span>
                                @endfor
                            </div>
                        </div>

                        @if($review->review_text)
                            <p class="mt-2 text-gray-700">
                                {{ $review->review_text }}
                            </p>
                        @endif

                        <p class="text-sm text-gray-400 mt-1">
                            {{ $review->created_at->format('F j, Y') }}
                        </p>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-state">
                <p>
                    Be the first to review <strong>{{ $product->name }}</strong>
                </p>
            </div>

        @endif

    </div>

</section>

<!-- REVIEW MODAL -->
<div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white p-8 rounded-lg w-full max-w-md relative">

        <button onclick="closeReviewModal()" class="absolute top-3 right-4 text-2xl">&times;</button>

        <h2 class="text-2xl font-bold mb-6">Write a Review</h2>

        <form method="POST" action="{{ route('reviews.store', $product->product_id) }}">
            @csrf

            <div class="mb-6">
                <label class="block mb-2 font-medium">Rating</label>

                <div class="star-rating">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}">
                        <label for="star{{ $i }}">★</label>
                    @endfor
                </div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Your Review (Optional)</label>

                <textarea
                    name="review_text"
                    rows="4"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Share your thoughts about this product..."
                ></textarea>
            </div>

            <button type="submit" class="add-btn w-full hover:bg-[#0f1829]">
                Submit Review
            </button>

        </form>

    </div>

</div>

@include('components.footer')



</body>
</html>
