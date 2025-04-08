<html lang="en" dir="ltr">
<body>
<div class="wrapper">
    <h2>Create order</h2>
    <form action="{{ route('post.createOrder') }}"  method="post">
        @csrf
        <label for="name"><b>Name </b></label>
        @error('name')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <div class="input-box">
            <input type="text" placeholder="Enter your name" id="contact_name" name="contact_name" required>
        </div>
        <label for="address"><b>Адрес доставки</b></label>
        @error('address')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <div class="input-box">
            <input type="text" placeholder="Enter your address" id="address" name="address" required>
        </div>
        <label for="phone"><b>Номер телефона</b></label>
        @error('phone')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <div class="input-box">
            <input type="text" placeholder="+7 (___) ___-__-__" id="contact_phone" name="contact_phone" required>
        </div>
        <label for="text"><b>Комментарий</b></label>
        <div class="input-box">
            <input type="text" placeholder="Enter your comment" id="comment" name ="comment" >
        </div>
        <div class="wrapper">
            @foreach($userProducts as $userProduct)
            <h3>{{$userProduct->name}}</h3>
            <label for="amount">Количество:</label>
            <input type="number" id="amount" name="amount" min="1" value="{{$userProduct->amount}}" required>
            <div>
                <label for="amount">Стоимость за 1 шт:</label>
                <label class="price">₽ {{$userProduct->product->price}}</label>
            </div>
            <div>
                <label for="totalProduct">Итого:</label>
                <label class="price">₽ {{($userProduct->product->price)*($userProduct->amount)}}</label>
            </div>
            @endforeach
            <h3><label for="totalOrder">Заказ на сумму:</label></h3>
            <div class="price">₽ {{$total}}</div>
        </div>
        <div class="input-box button">
            <input type="Submit" value="Create order">
        </div>
    </form>
</div>
</body>
</html>

<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    body{
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #4070f4;
    }
    .wrapper{
        position: relative;
        max-width: 1000px;
        width: 100%;
        background: #fff;
        padding: 34px;
        border-radius: 6px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    }
    .wrapper h2{
        position: relative;
        font-size: 22px;
        font-weight: 600;
        color: #333;
    }
    .wrapper h2::before{
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 28px;
        border-radius: 12px;
        background: #4070f4;
    }
    .wrapper form{
        margin-top: 30px;
    }
    .wrapper form .input-box{
        height: 52px;
        margin: 18px ;
    }
    form .input-box input{
        height: 100%;
        width: 100%;
        outline: none;
        padding: 0 15px;
        font-size: 17px;
        font-weight: 400;
        color: #333;
        border: 1.5px solid #C7BEBE;
        border-bottom-width: 2.5px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    .input-box input:focus,
    .input-box input:valid{
        border-color: #4070f4;
    }
    form .policy{
        display: flex;
        align-items: center;
    }
    form h3{
        position: relative;
        font-size: 22px;
        font-weight: 600;
        color: #333;
    }
    .input-box.button input{
        color: #fff;
        letter-spacing: 1px;
        border: none;
        background: #4070f4;
        cursor: pointer;
    }
    .input-box.button input:hover{
        background: #0e4bf1;
    }
</style>
