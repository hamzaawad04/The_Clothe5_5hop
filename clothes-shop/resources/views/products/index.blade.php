<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Products</title>
  
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
      background: #fff;
      min-height: 300px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .card .image {
      background: #f3f4f6;
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
    .card.hover-swap-hoodie .image {
      position: relative;
    }
    .card.hover-swap-hoodie .image-front,
    .card.hover-swap-hoodie .image-back {
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
    .card.hover-swap-hoodie .image-back {
      opacity: 0;
    }
    .card.hover-swap-hoodie:hover .image-front {
      opacity: 0;
    }
    .card.hover-swap-hoodie:hover .image-back {
      opacity: 1;
    }
    .card.hover-swap-tshirt .image {
      position: relative;
    }
    .card.hover-swap-tshirt .image-front,
    .card.hover-swap-tshirt .image-back {
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
    .card.hover-swap-tshirt .image-back {
      opacity: 0;
    }
    .card.hover-swap-tshirt:hover .image-front {
      opacity: 0;
    }
    .card.hover-swap-tshirt:hover .image-back {
      opacity: 1;
    }
    .card.hover-swap-jumper .image {
      position: relative;
    }
    .card.hover-swap-jumper .image-front,
    .card.hover-swap-jumper .image-back {
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
    .card.hover-swap-jumper .image-back {
      opacity: 0;
    }
    .card.hover-swap-jumper:hover .image-front {
      opacity: 0;
    }
    .card.hover-swap-jumper:hover .image-back {
      opacity: 1;
    }
    .card.hover-swap-buttonup .image {
      position: relative;
    }
    .card.hover-swap-buttonup .image-front,
    .card.hover-swap-buttonup .image-back {
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
    .card.hover-swap-buttonup .image-back {
      opacity: 0;
    }
    .card.hover-swap-buttonup:hover .image-front {
      opacity: 0;
    }
    .card.hover-swap-buttonup:hover .image-back {
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
    .footer-columns {
      display: inline-flex;
      justify-content: flex-start;
      gap: 40px;
      margin-bottom: 0;
    }
    .footer-column {
      text-align: left;
    }
    .footer-column ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .footer-column li {
      margin: 8px 0;
    }
    .footer-column a {
      text-decoration: none;
      color: #e5e7eb;
      transition: color 0.3s;
    }
    .footer-column a:hover {
      color: orange;
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
  @include('components.mainnavbar')
  <!-- Filter bar -->
  <div class="filters">
    <div class="filter-group"><label for="sort">Sort</label><select id="sort"><option>Featured</option><option>Polo</option><option>Hoodie</option><option>T-Shirt</option><option>Jumper</option><option>Button-Up Shirt</option></select></div>
    <div class="filter-group"><label for="size">Size</label><select id="size"><option>All</option><option>XS</option><option>S</option><option>M</option><option>L</option><option>XL</option><option>XXL</option></select></div>
    <div class="filter-group"><label for="colour">Colour</label><select id="colour"><option>All</option><option>Black</option><option>White</option><option>Blue</option><option>Red</option><option>Grey</option><option>Navy</option></select></div>
    <div class="filter-group"><label for="price">Price</label><select id="price"><option>All</option><option>Under £15</option><option>£15-£25</option><option>£25-£40</option><option>Over £40</option></select></div>
  </div>

  <!-- Navy section removed -->

  <!-- Product grid -->
  <div class="container">
    <div class="results-heading">{{ $results->count() }} Items found</div>
    <div class="grid">
      @foreach ($results as $result)

        @php
          $primary = $result->images->where('is_primary', 1)->first();
          $secondary = $result->images->where('is_primary', 0)->first();
          $front = $primary ? asset($primary->url): 'images/placeholder.png';
          $back = $secondary ? asset($secondary->url): $front;
        @endphp

        <a href="{{ route('products.show', $result->product_id) }}">
          <div class='card hover-swap'>
                  <div class='image'>

                    <div class='image-front'>
                      <img src="{{ $front }}">
                    </div>

                    <div class='image-back'>
                      <img src="{{ $back }}">
                    </div>

                  </div>
                  <div class='info'>
                    <h3>{{ $result->name }}</h3>
                    <p>£{{ $result->base_price }}</p>
                  </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
  @include('components.footer')
</body>
</html>