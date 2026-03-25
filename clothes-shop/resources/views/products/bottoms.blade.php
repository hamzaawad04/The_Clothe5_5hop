<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bottoms</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #fff;
      color: #111;
    }
    /* Heading */
    .heading {
      text-align: center;
      font-size: 32px;
      font-weight: bold;
      margin: 20px 0;
      background: #fff;
    }
    /* Filter bar */
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

    /* Navy section removed */

    /* Container */
    .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    }

    /* Product grid */
    .results-heading {
      font-size: 20px;
      font-weight: 600;
      margin: 24px 0;
      text-align: center;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      padding: 24px 0;
      background: #fff;
    }
    .card {
      border: 1px solid #e5e7eb;
      border-radius: 10px;
      box-shadow: 0 1px 2px rgba(0,0,0,.06), 0 2px 8px rgba(0,0,0,.06);
      overflow: hidden;
      background: #e6e9ed;
      min-height: 300px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .card .image {
      background: white;
      height: 300px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #6b7280;
      font-size: 14px;
      border-bottom: 1px solid #e5e7eb;
    }
    .card .image img {
      width: auto;
      height: 90%;
      object-fit: contain;
      display: block;
    }
    .card.hover-swap .image {
      position: relative;
    }
    .card.hover-swap .image-front,
    .card.hover-swap .image-back {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.3s ease;
    }
    .card.hover-swap .image-back {
      opacity: 0;
    }
    .card.hover-swap:hover .image-front {
      opacity: 0;
    }
    .card.hover-swap:hover .image-back {
      opacity: 1;
    }
    .card .info {
      padding: 16px;
    }
    .card .info h3 {
      font-size: 16px;
      margin: 0 0 8px;
    }
    .card .info p {
      font-size: 18px;
      font-weight: bold;
      margin: 0;
    }
    .no-results {
      text-align: center;
      padding: 60px 0;
      color: #6b7280;
      font-size: 16px;
      grid-column: 1 / -1;
    }
    /* About It section (full-bleed) */
    .about-it {
      background: #0a2540;
      padding: 8px 0;
      border-top: 1px solid #e5e7eb;
      text-align: left;
      color: #fff;
      position: relative;
      left: 50%;
      right: 50%;
      margin-left: -50vw;
      margin-right: -50vw;
      width: 100vw;
    }
    .about-it .about-inner {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 24px;
    }
    .about-it h2 {
      font-size: 18px;
      margin: 0 0 12px;
      color: #fff;
    }
    .about-it h3 {
      font-size: 16px;
      font-weight: 600;
      margin: 0 0 12px;
      color: #fff;
    }
    .about-it p {
      margin: 0;
      color: #e5e7eb;
      line-height: 1.6;
    }
    .about-it .note {
      display: none;
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class = "font-playfair text-black">
  <!-- Top bar -->
  @include('components.mainnavbar')

  {{-- Filter bar --}}
  <div class="filters">
    <div class="filter-group">
      <label for="filter-size">Size</label>
      <select id="filter-size">
        <option value="all">All</option>
        <option value="XS">XS</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="One Size">One Size</option>
      </select>
    </div>
    <div class="filter-group">
      <label for="filter-colour">Colour</label>
      <select id="filter-colour">
        <option value="all">All</option>
        <option value="Black">Black</option>
        <option value="White">White</option>
        <option value="Gold">Gold</option>
        <option value="Silver">Silver</option>
        <option value="Brown">Brown</option>
        <option value="Navy">Navy</option>
        <option value="Beige">Beige</option>
      </select>
    </div>
    <div class="filter-group">
      <label for="filter-price">Price</label>
      <select id="filter-price">
        <option value="all">All</option>
        <option value="0-25">Under &pound;25</option>
        <option value="25-50">&pound;25 &ndash; &pound;50</option>
        <option value="50-100">&pound;50 &ndash; &pound;100</option>
        <option value="100-999">Over &pound;100</option>
      </select>
    </div>
  </div>

  <!-- Product grid -->
  <div class="container">
    <div class="results-heading" id="results-count">{{ $products->count() }} Items found</div>
      <div class="grid" id="product-grid">
        @foreach ($products as $product)

          @php
            $primary = $product->images->where('is_primary', 1)->first();
            $secondary = $product->images->where('is_primary', 0)->first();
            $front = $primary ? asset($primary->url): 'images/placeholder.png';
            $back = $secondary ? asset($secondary->url): $front;
            $sizes = $product->variants->pluck('size')->unique()->filter()->values();
            $colours = $product->variants->pluck('colour')->unique()->filter()->values();
            $price = (float) $product->base_price;
          @endphp

          <a href="{{ route('products.show', $product->product_id) }}"
             class="product-card-link"
             data-sizes="{{ $sizes->join(',') }}"
             data-colours="{{ $colours->join(',') }}"
             data-price="{{ $price }}"
             style="text-decoration:none;">
          <div class='card hover-swap'>
                  <div class='image'>

                    <div class='image-front'>
                      <img src="{{ $front }}" alt="{{ $product->name }}">
                    </div>

                    <div class='image-back'>
                      <img src="{{ $back }}" alt="{{ $product->name }}">
                    </div>

                  </div>
                  <div class='info'>
                    <h3>{{ $product->name }}</h3>
                    <p>£{{ $product->base_price }}</p>
                  </div>
          </div>
        </a>
        @endforeach
      <div class="no-results" id="no-results" style="display:none;">
        No products match your selected filters.
      </div>
      {{--<div class="card hover-swap"><div class="image"><div class="image-front"><img src="/images/bottoms/jeansfront.png" alt="Jeans"></div><div class="image-back"><img src="/images/bottoms/jeansback.png" alt="Jeans Back"></div></div><div class="info"><h3>Jeans</h3><p>£67</p></div></div>
      <div class="card hover-swap"><div class="image"><div class="image-front"><img src="/images/bottoms/shortsfront.png" alt="Shorts"></div><div class="image-back"><img src="/images/bottoms/shortsback.png" alt="Shorts Back"></div></div><div class="info"><h3>Shorts</h3><p>£50</p></div></div>
      <div class="card hover-swap"><div class="image"><div class="image-front"><img src="/images/bottoms/joggersfront.png" alt="Joggers"></div><div class="image-back"><img src="/images/bottoms/joggersback.png" alt="Joggers Back"></div></div><div class="info"><h3>Joggers</h3><p>£50</p></div></div>
      <div class="card hover-swap"><div class="image"><div class="image-front"><img src="/images/bottoms/cargosfront.png" alt="Cargos"></div><div class="image-back"><img src="/images/bottoms/cargosback.png" alt="Cargos Back"></div></div><div class="info"><h3>Cargos</h3><p>£60</p></div></div>
      <div class="card hover-swap"><div class="image"><div class="image-front"><img src="/images/bottoms/chinosfront.png" alt="Chinos"></div><div class="image-back"><img src="/images/bottoms/chinosback.png" alt="Chinos Back"></div></div><div class="info"><h3>Chinos</h3><p>£55</p></div></div>
    </div>--}}
  </div>
</div>
@include('components.footer')

  <script>
    const sizeFilter = document.getElementById('filter-size');
    const colourFilter = document.getElementById('filter-colour');
    const priceFilter = document.getElementById('filter-price');
    const countEl = document.getElementById('results-count');
    const noResults = document.getElementById('no-results');

    function applyFilters() {
      const size = sizeFilter.value;
      const colour = colourFilter.value;
      const price = priceFilter.value;

      const cards = document.querySelectorAll('.product-card-link');
      let visible = 0;

      cards.forEach(card => {
        const cardSizes = card.dataset.sizes.split(',').map(s => s.trim());
        const cardColours = card.dataset.colours.split(',').map(c => c.trim());
        const cardPrice = parseFloat(card.dataset.price);

        const sizeMatch = size === 'all' || cardSizes.includes(size);
        const colourMatch = colour === 'all' || cardColours.includes(colour);

        let priceMatch = true;
        if (price !== 'all') {
          const [min, max] = price.split('-').map(Number);
          priceMatch = cardPrice >= min && cardPrice <= max;
        }

        if (sizeMatch && colourMatch && priceMatch) {
          card.style.display = '';
          visible++;
        } else {
          card.style.display = 'none';
        }
      });

      countEl.textContent = visible + ' Items found';
      noResults.style.display = visible === 0 ? 'block' : 'none';
    }

    sizeFilter.addEventListener('change', applyFilters);
    colourFilter.addEventListener('change', applyFilters);
    priceFilter.addEventListener('change', applyFilters);
  </script>
</body>
</html>
