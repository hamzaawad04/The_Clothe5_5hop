<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Basket - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-playfair text-black antialiased">
        @include('components.mainnavbar')
        
  <style>
    /*importing font from google*/
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap');

    /* container for basket header */
    .basket-header {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
      padding: 0 20px;
      margin-top: 30px;
    }

    /* the title */
    .basket-title {
      font-family: 'Playfair Display', serif;
      font-style: normal;
      font-weight: 500;
      font-size: 48px;
      line-height: 64px;
      color: #000000;
      margin: 0;
    }

    /* item counter */
    .item-count {
      font-family: 'Playfair Display', serif;
      font-weight: 300;
      font-size: 24px;
      line-height: 28px;
      color: #000000;
    }

    /* divider line */
    .basket-divider {
      border: none;
      border-top: 1px solid #000000;
      opacity: 0.2;
      margin: 8px 0;
      margin-left: 42px;
      width: calc(100% - 102px);
    }

    /* basket item container */
    .basket-item {
      position: relative;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      padding: var(--inner-pad);
      box-sizing: border-box;
      width: 355px;
      height: 490px;
      background: rgba(217, 217, 217, 0.55);
      border: 1px solid #000000;
      border-radius: 8px;
    }

    /* basket content area: items and summary */
    .basket-content {
      display: flex;
      align-items: flex-start;
      gap: 2rem;
      padding: 10px 20px;
    }

    /* product image container */
    .item-image {
      position: absolute;
      top: 20px;
      left: 20px;
      width: 317px;
      height: 342px;
      object-fit: cover;
      border-radius: 8px;
      background: #fff;
    }

    /* details */
    .item-details {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
      font-family: 'Playfair Display', serif;
      font-size: 15px;
      line-height: 1.25;
      color: #000;
      margin: 370px 20px 60px 20px;
    }

    .item-details h3 {
      margin: 0;
      font-size: 18px;
      font-weight: 400;
      line-height: 1.2;
      letter-spacing: 0;
    }

    .item-details p {
      margin: 0;
      font-weight: 300;
      font-size: 16px;
      line-height: 1.3;
      color: #000;
    }

    .item-actions { display:flex; justify-content:space-between; align-items:center; gap:1rem; }

    /* item specifications */
    .item-specs {
      font-family: 'Playfair Display', serif;
      font-weight: 300;
      font-size: 18px;
      color: #000;
      margin-top: 4px;
      opacity: 0.5;
    }

    /* heart icon */
    .heart-icon {
      position: absolute;
      top: 375px;
      right: 20px;
      width: 20px;
      height: 20px;
      cursor: pointer;
    }

    /* compact controls */
    .quantity-box { display:flex; gap:.25rem; align-items:center; padding:.25rem .5rem; border:1px solid #000; border-radius:5px; }

    /* trash icon */
    .trash-icon {
      position: absolute;
      bottom: 10px;
      left: 20px;
      width: 25px;
      height: 25px;
      cursor: pointer;
    }

    /* empty basket message */
    .empty-message {
      text-align: center;
      color: #000;
      font-family: 'Playfair Display', serif;
      font-weight: 250;
      font-size: 20px;
      margin: 100px auto;
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .empty-message img{
      position: relative;
      width: 158px;
      height: 158px;
      margin: 0 auto 20px auto;
    }

    /* basket summary section */
    .basket-summary {
      width: 380px;
      background: rgba(217, 217, 217, 0.55);
      border: 1px solid #000000;
      border-radius: 8px;
      padding: 1rem;
      margin-left: auto;
      margin-right: 40px;
      margin-top: 0;
    }

    /* divider in summary */
    .summary-divider {
      border: none;
      border-top: 1px solid #000000;
      opacity: 0.2;
      margin: 8px 0 16px 0;
    }

    /* summary title */
    .summary-title {
      font-family: 'Playfair Display', serif;
      font-weight: 500;
      font-size: 24px;
      line-height: 32px;
      margin-top: 0;
      margin-bottom: 16px;
    }

    /* summary item text */
    .summary-item {
      font-family: 'Playfair Display', serif;
      font-weight: 300;
      font-size: 14px;
      line-height: 24px;
      margin: 4px 0;
    }

    /* total amount text */
    .summary-total {
      font-family: 'Playfair Display', serif;
      font-weight: 630;
      font-size: 16px;
      line-height: 24px;
      margin: 8px 0;
      text-transform: uppercase;
    }

    /* checkout button */
    .checkout-button {
      width: 292px;
      height: 45px;
      background-color: #14213D;
      border-radius: 3px;
      border: none;
      color: #ffffff;
      font-family: 'Playfair Display', serif;
      font-size: 16px;
      font-weight: 570;
      cursor: pointer;
      display: block;
      margin: 1rem auto 0 auto;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .checkout-button:hover {
      background-color: #98a2c5;
    }
  </style>

  <div class="basket-header">
    <h2 class="basket-title">BASKET</h2>
    <span class="item-count">0 items</span>
  </div>
  <hr class="basket-divider"/>

  <main class="basket-content" id="basket-content">
    <div id="basket-items-container"></div>

    <!-- Empty Basket Message -->
    <div class="empty-message" style="display: block;">
      <img src="{{ asset('images/empty-basket.png') }}" alt="Sad basket" />
      <p>Nothing's in your basket ;(</p>
    </div>

    <!-- Basket Summary (hidden by default) -->
    <div class="basket-summary" style="display: none;" id="basket-summary">
      <p class="summary-title">Basket Summary</p>
      <hr class="summary-divider"/>
      <p class="summary-item">Subtotal: <span id="subtotal">£0.00</span></p>
      <p class="summary-item">Delivery Fee: <span id="delivery">£0.00</span></p>
      <p class="summary-total">Total: <span id="total">£0.00</span></p>
      <form action="{{ route('orders.checkout') }}" method="GET">
        <button type="submit" class="checkout-button">PROCESS YOUR ORDER</button>
      </form>
    </div>
  </main>

  <script>
    function setupItemListeners() {
      document.querySelectorAll('.basket-item').forEach(item => {
        const decreaseBtn = item.querySelector('.decrease');
        const increaseBtn = item.querySelector('.increase');

        increaseBtn.addEventListener('click', () => {
          const index = increaseBtn.getAttribute('data-index');
          increaseQuantity(index);
        });

        decreaseBtn.addEventListener('click', () => {
          const index = decreaseBtn.getAttribute('data-index');
          decreaseQuantity(index);
        });
      });
    }

    function updateBasketState() {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      const itemCount = document.querySelector('.item-count');
      const basketSummary = document.getElementById('basket-summary');
      const emptyMessage = document.querySelector('.empty-message');

      let totalQuantity = 0;
      cart.forEach(item => {
        totalQuantity += item.quantity;
      });

      if (cart.length === 0) {
        itemCount.textContent = '0 items';
        basketSummary.style.display = 'none';
        emptyMessage.style.display = 'block';
      } else {
        itemCount.textContent = `${totalQuantity} item${totalQuantity > 1 ? 's' : ''}`;
        basketSummary.style.display = 'block';
        emptyMessage.style.display = 'none';
      }
    }

    function setupTrashListeners() {
      document.querySelectorAll('.trash-icon').forEach(icon => {
        icon.addEventListener('click', () => {
          const index = icon.getAttribute('data-index');
          removeFromCart(index);
        });
      });
    }

    function displayBasket() {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      const container = document.getElementById('basket-items-container');

      container.innerHTML = '';

      cart.forEach((item, index) => {
        const itemHTML = `
          <div class="basket-item">
            <img src="${item.image}" alt="${item.name}" class="item-image" />
            <div class="item-details">
              <h3>${item.name}</h3>
              <p>£${item.price.toFixed(2)}</p>
              <p class="item-specs">${item.size || 'N/A'} | ${item.color || 'N/A'}</p>
            </div>
            <div class="item-actions">
              <img src="/icons/heart.svg" alt="Add to favorites" class="heart-icon" />
              <img src="/icons/bin.svg" alt="Remove item" class="trash-icon" data-index="${index}" />
              <div class="quantity-box">
                <button type="button" class="decrease" data-index="${index}">−</button>
                <span class="quantity-display">${item.quantity}</span>
                <button type="button" class="increase" data-index="${index}">+</button>
              </div>
            </div>
          </div>
        `;
        container.innerHTML += itemHTML;
      });

      updateTotals();
      updateBasketState();
      setupItemListeners();
      setupTrashListeners();
    }

    function updateTotals() {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      let subtotal = 0;

      cart.forEach(item => {
        subtotal += item.price * item.quantity;
      });

      const deliveryFee = subtotal > 0 ? 5.00 : 0;
      const total = subtotal + deliveryFee;

      document.getElementById('subtotal').textContent = '£' + subtotal.toFixed(2);
      document.getElementById('delivery').textContent = '£' + deliveryFee.toFixed(2);
      document.getElementById('total').textContent = '£' + total.toFixed(2);
    }

    function removeFromCart(index) {
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      cart.splice(index, 1);
      localStorage.setItem('cart', JSON.stringify(cart));
      displayBasket();
    }

    function increaseQuantity(index) {
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      if (cart[index]) {
        cart[index].quantity++;
        localStorage.setItem('cart', JSON.stringify(cart));
        displayBasket();
      }
    }

    function decreaseQuantity(index) {
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      if (cart[index] && cart[index].quantity > 1) {
        cart[index].quantity--;
        localStorage.setItem('cart', JSON.stringify(cart));
        displayBasket();
      }
    }

    document.addEventListener('DOMContentLoaded', displayBasket);
  </script>
    </body>
</html>
