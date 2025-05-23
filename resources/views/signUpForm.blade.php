<html lang="en" dir="ltr">
<body>
<div class="wrapper">
    <h2>Registration</h2>
    <form action= "" method="post">
        @csrf
        <label for="name"><b>Name</b></label>
        @error('name')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <div class="input-box">
            <input type="text" placeholder="Enter your name" name ="name" required>
        </div>
        <label for="email"><b>Email</b></label>
        @error('email')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <div class="input-box">
            <input type="text" placeholder="Enter your email" name ="email" required>
        </div>
        <label for="password"><b>Password</b></label>
        @error('password')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <div class="input-box">
            <input type="password" placeholder="Create password" name="password" required>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Confirm password" name ="password_confirmation" required>
        </div>
        <div class="input-box button">
            <input type="Submit" value="Register Now">
        </div>
        <div class="text">
            <h3>Already have an account? <a href="/login">Login now</a></h3>
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
        color: #707070;
        font-size: 14px;
        font-weight: 500;
        margin-left: 10px;
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
    form .text h3{
        color: #333;
        width: 100%;
        text-align: center;
    }
    form .text h3 a{
        color: #4070f4;
    }
</style>
