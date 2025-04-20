<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: rgba(64, 112, 244, 0.05);
        }

        header {
            background-color: #ffffff;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-nav {
            display: flex;
            gap: 25px;
        }

        .header-link {
            color: #333;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 15px;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 15px;
        }

        .header-link:hover {
            background-color: #f5f5f5;
            color: #4070f4;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .product-item {
            padding: 20px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            margin-bottom: 15px;
            border-radius: 8px;
            background: #f9f9f9;
            padding: 10px;
        }

        .product-info {
            margin-bottom: 15px;
        }

        .product-id {
            font-size: 14px;
            color: #777;
            margin-bottom: 5px;
        }

        .product-name {
            font-size: 18px;
            font-weight: 600;
            margin: 5px 0;
            color: #333;
            line-height: 1.4;
        }

        .product-price {
            font-size: 20px;
            font-weight: 700;
            color: #4070f4;
            margin: 10px 0;
        }

        .product-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .action-button {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .primary-button {
            background-color: #4070f4;
            color: white;
        }

        .primary-button:hover {
            background-color: #3058c7;
        }

        .secondary-button {
            background-color: #f0f0f0;
            color: #333;
        }

        .secondary-button:hover {
            background-color: #e0e0e0;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: 1fr;
                padding: 20px 15px;
            }

            .header-nav {
                gap: 15px;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="logo" style="font-weight: 700; font-size: 18px;">Catalog</div>
    <nav class="header-nav">
        <a href="user-profile" class="header-link">My Profile</a>
        <a href="cart" class="header-link">My Cart</a>
        <a href="create-order" class="header-link">Create Order</a>
        <a href="logout" class="header-link">Logout</a>
    </nav>
</header>

<main>
    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-item">
                <img class="product-image" src="{{$product->image_url}}" alt="{{$product->name}}">

                <div class="product-info">
                    <div class="product-id">ID: {{$product->id}}</div>
                    <h3 class="product-name">{{$product->name}}</h3>
                    <div class="product-price">{{number_format($product->price, 2)}} ₽</div>
                </div>

                <div class="product-actions">
                    <form class="product" action="/product/{{$product->id}}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <button type="submit" class="action-button secondary-button">Details</button>
                    </form>

                    <form class="increase-form" action="/add-product" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <button type="submit" class="action-button primary-button">+ Add</button>
                    </form>
                </div>

                <form class="decrease-product" action="/decrease-product" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <button type="submit" class="action-button secondary-button" style="width: 100%">- Remove</button>
                </form>
            </div>
        @endforeach
    </div>
</main>
</body>
</html>
