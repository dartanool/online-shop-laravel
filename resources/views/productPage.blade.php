<!DOCTYPE html>
<html lang="ru">
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Страница продукта</title>-->
<!--</head>-->
<!--<body>-->
<div class="product-container">
    <div class="product-info">
        <img class="product-image" src="{{$product->image_url}}" >
        <h2 class="product-name">{{$product->name}}</h2>
        <h3 class="product-price">Цена: {{$product->price}}руб.</h3>
        <h4 class="description-title">Описание</h4>
        <p class="product-description">{{$product->description}}</p>

    </div>
    <div class="reviews-section">
        <h4 class="reviews-title">Отзывы</h4>
        <h5 class="average-rating">Средняя оценка: </h5>
        <div class="reviews-list">
            @foreach($reviews as $review)

            <div class="review-item">
                <p class="review-author">Автор: {{$review->user->name}} </p>
                <p class="review-author">Время: {{$review->created_at}}</p>
                <p class="review-author">Оценка: {{$review->score}}</p>
                <p class="review-text">{{$review->review_text}}</p>
            </div>
            @endforeach
        </div>

        <form class="leave-review-form" action= "/add-review" method="post">
            @csrf
            <input type="hidden" placeholder="Enter product id" value="{{$product->id}}" name ="productId" required>
            <div class="rating-section">
                <h4 class="rating-title">Оценка</h4>
                <select name="score" id="review-rating-select">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                @error('score')
                {{$message}}}
                @enderror()
            </div>
            <textarea placeholder="Оставьте ваш отзыв" name="reviewText"></textarea>
            @error('reviewText')
            {{$message}}}
            @enderror()
            <button type="submit">Оставить отзыв</button>
        </form>
    </div>
</div>

</body>
</html>


<style>

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #4070f4;
    }

    .product-container {
        max-width: 800px;
        margin: 40px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .product-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .product-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .product-name {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 20px;
        color: #00698f;
        margin-bottom: 20px;
    }

    .description-title {
        font-size: 18px;
        margin-bottom: 10px;
        text-align: center;
    }

    .product-description {
        text-align: justify;
        padding: 0 20px;
    }


    .reviews-section {
        margin-top: 40px;
    }
    .reviews-title {
        font-size: 18px;
        margin-bottom: 20px;
        text-align: center;
    }

    .average-rating {
        font-size: 18px;
        margin-bottom: 20px;
        text-align: left;
    }
    .reviews-list {
        padding: 0 20px;
    }

    .review-item {
        background-color: #f9f9f9;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px; /* Добавляем отступ снизу */
        border: 1px solid #ddd; /* Добавляем границу */
        box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Добавляем тень */
    }

    .review-text {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .review-author {
        font-size: 14px;
        color: #666;
    }






    .leave-review-form {
        padding: 0 20px;
        margin-top: 20px;
    }

    .leave-review-form textarea {
        width: 100%;
        height: 100px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
    }

    .leave-review-form input[type="text"] {
        width: 100%;
        height: 40px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
    }

    .leave-review-form button[type="submit"] {
        width: 100%;
        height: 40px;
        background-color: #4070f4;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .leave-review-form button[type="submit"]:hover {
        background-color: #00698f;
    }



    /* ... */

    .rating-section{
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .rating-title {
        font-size: 18px;
        margin-bottom: 20px;
    }

    #rating-select, #review-rating-select {
        width: 100px;
        height: 30px;
        font-size: 16px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .review-rating {
        font-size: 14px;
        color: #666;
    }

</style>
