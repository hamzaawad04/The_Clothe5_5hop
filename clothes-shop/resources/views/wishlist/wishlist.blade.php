<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: "Playfair Display", serif; 
            background: #fff;
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }
        .wishlist-main {
            flex:1;
            display:flex;
            flex-direction:column;
        }
        .wishlist-header {
            display:flex; justify-content:space-between; 
            padding-left:20px; margin-top:0px;
            padding-right: 10px;
            padding-top: 5px;
        }
        .wishlist-title { font-size:48px; font-weight:500; }
        .item-count { font-size:22px; opacity:.7; }
        .wishlist-divider { 
            border-top:1px solid #0003;
            width:calc(100% - 60px);
            margin:auto;
        }
        .wishlist-content { display:flex; gap:40px; padding:20px; }
        .wishlist-items { 
            flex:1; 
            display:flex; 
            flex-wrap:wrap; 
            gap:20px; 
            align-content:flex-start;
        }

        .wishlist-item {
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
        .item-name {
            font-size:18px;
            font-weight:500;
            margin-top:10px;
        }
        .item-price {
            font-size:16px;
            opacity:.8;
        }
        