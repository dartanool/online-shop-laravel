<html lang="en" dir="ltr">
<h2>Cart</h2>
<div class="product-grid">
    @foreach($userProducts as $userProduct)
    <div class="product-item">
        <img class="product-image" src="{{ $userProduct->product->image_url }}" data-image-width="720" data-image-height="1080">
        <table>
            <thead>
            <tr>
                <th>name</th>
                <th>amount</th>
                <th>price</th>
                <th>Total cost</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $userProduct->product->name }}</td>
                <td> {{$userProduct->amount}}</td>
                <td>{{ $userProduct->product->price }}</td>
                <td>{{ number_format($userProduct->amount * $userProduct->product->price) }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    @endforeach

</div>
</html>

<style>
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 10px;
        padding: 20px;
    }

    .product-item {
        padding: 50px;
        border: 1px solid #ddd;
        text-align: center;
    }

    .product-image {
        width: 200px; /* 200px / 1.5 = 133.33px */
        height: 200px; /* 200px / 1.5 = 133.33px */
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: 1fr;
        }
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 6px;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #dddddd;


    }
    th {
        background-color: #4070f4   ; /* Цвет фона заголовка */
        color: white; /* Цвет текста заголовка */

    }
</style>
