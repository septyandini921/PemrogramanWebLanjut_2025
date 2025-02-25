<!DOCTYPE html>
<html>
<head>
    <title>Product Index</title>
</head>
<body>
    <h1>Product Index Page</h1>
    
    <h2>Kategori Produk:</h2>
    <ul>
        <li><a href="{{ route('product.food-beverage') }}">Makanan & Minuman</a></li>
        <li><a href="{{ route('product.beauty-health') }}">Kecantikan & Kesehatan</a></li>
        <li><a href="{{ route('product.home-care') }}">Perawatan Rumah</a></li>
        <li><a href="{{ route('product.baby-kid') }}">Bayi & Anak-anak</a></li>
    </ul>
</body>
</html>