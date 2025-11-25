<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="header">
      <img src="{{ asset('images/logo gold.jpg') }}" alt="Logo" class="logo" style="height: 100px; width: auto; float: left;" onclick="location.href='home.html'">
      <form id="search-form" class="search-form" role="search" style="display:inline-block; margin-left:20px; vertical-align:middle;"></form>
        <label for="site-search" style="position:absolute; left:-9999px;">Search site</label>
        <input type="search" id="site-search" name="q" placeholder="Search products..." aria-label="Search" style="padding:8px 10px; font-size:16px; border-radius:4px; border:1px solid #ccc;">
        <button type="submit" style="padding:8px 12px; font-size:16px; margin-left:6px; border-radius:4px; border:1px solid #888; background:#fff; cursor:pointer;">Search</button>
      </form>
     <a href="login.html" class="login-btn">Login</a>
    </div>
  <div class="menu"> 
    <nav class="menu">
      <a>Tops</a>
      <a>Bottoms</a>
      <a>Footwear</a>
      <a>Outerwear</a>
      <a>Accessories</a>
    </nav>

  </div>
  <div class="content">
    <img src="{{ asset('images/Model logo.png') }}" alt="Model Logo" class="logo" style="width: 100%; height: auto;">
  </div>
  <div class="footer">
    <a href="contact-us.html">Contact us here</a>
  </div>

</body>
</html>