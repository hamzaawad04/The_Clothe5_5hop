<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>THE CLOTHE5 5HOP – Footwear</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
      height: 220px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #6b7280;
      font-size: 14px;
      border-bottom: 1px solid #e5e7eb;
    }
    .card .image img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
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

  <!-- Filter bar -->
  <div class="filters">
    <div class="filter-group"><label for="sort">Sort</label><select id="sort"><option>Featured</option></select></div>
    <div class="filter-group"><label for="size">Size</label><select id="size"><option>All</option></select></div>
    <div class="filter-group"><label for="colour">Colour</label><select id="colour"><option>All</option></select></div>
    <div class="filter-group"><label for="brand">Brand</label><select id="brand"><option>All</option></select></div>
  </div>

  <!-- Navy section removed -->

  <!-- Product grid -->
  <div class="container">
    <div class="results-heading">5 Items found</div>
    <div class="grid">
      <div class="card"><div class="image">Running Shoe</div><div class="info"><h3>Premium Running Shoe</h3><p>£45</p></div></div>
      <div class="card"><div class="image">Casual Sneaker</div><div class="info"><h3>Unisex Casual Sneaker</h3><p>£35</p></div></div>
      <div class="card"><div class="image">Leather Boot</div><div class="info"><h3>Classic Leather Boot</h3><p>£60</p></div></div>
      <div class="card"><div class="image">Sports Shoe</div><div class="info"><h3>Professional Sports Shoe</h3><p>£55</p></div></div>
      <div class="card"><div class="image">Formal Loafer</div><div class="info"><h3>Unisex Formal Loafer</h3><p>£50</p></div></div>
    </div>
  </div>
  @include('components.footer')
</body>
</html>
