<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Anton&family=Bebas+Neue&family=Boldonse&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lobster&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Flex:opsz,wght@8..144,100..1000&family=Roboto:ital,wght@0,100..900;1,100..900&family=Rubik+Glitch&family=Staatliches&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('media/Untitled design.png') }}">
    <title>Connectly - Login</title></head>
<body>
    <header class="header2">
        <div class="all_navigation_bar2">
            <nav class="nav_title">
                <a class="app_name" href="{{ route('loginPage') }}">Connectly</a>
            </nav>
            <nav class="nav_logout">
                <a href="{{ route('registerPage') }}">INSCRIPTION</a>
            </nav>
        </div>
    </header>
    <main class="container_of_home3">
        <h1 class="title_register">Start Your Journey</h1>

        <form class="register_form" action="{{ route('login') }}" method="post">
            @csrf        
            <input type="email" name="email" class="email1" id="email" value="{{old('email')}}" placeholder="Your email ...">
            
            @error('email')
                <h4 class="error"> {{$message}} </h4>    
            @enderror

            <input type="password" name="password" id="password" class="password1" placeholder="Your password ...">
            
            @error('password')
                <h4 class="error"> {{$message}} </h4>    
            @enderror

            @error('login')
                <h4 class="error"> {{$message}} </h4>    
            @enderror
            

            <div class="submit_container">
                <button type="submit" id="submit1">LOGIN</button>
            </div>
            <h2 class="orOtherAuth">Or</h2>

            <div class="authGoogle">
                <a href="/auth/google" class="authGoogleLink">
                    <img src="{{ asset('media/search.png') }}" alt="" height="40" width="40">
                    <h4>Continue with Google</h4>
                </a>
            </div>
        </form>

    </main>
</body>
</html>