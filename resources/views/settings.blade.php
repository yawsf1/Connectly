<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Anton&family=Bebas+Neue&family=Boldonse&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lobster&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Flex:opsz,wght@8..144,100..1000&family=Roboto:ital,wght@0,100..900;1,100..900&family=Rubik+Glitch&family=Staatliches&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('media/Untitled design.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Connectly - My Posts</title>
</head>
<body>
    <header>
        @include('parts.MainNav')
    </header>

    <main class="container_of_home">
        @include('parts.SideNav')
        <div class="main_page">

            <div class="page_home">
                <h3 class="salutation">Profile Settings</h3>
                
                <div class="allPosts" style="margin-top: 20px; width: 100%;">
                    
                    <div style="background-color: #DAEDED; padding: 25px; border-radius: 8px; width: 80%; max-width: 600px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        @if(session('success'))
                            <div style="background-color: #AACD72; color: #01544F; padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center; font-weight: bold;">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('settings.update') }}" style="display: flex; flex-direction: column; gap: 20px;">
                            @csrf
                            @method('PUT')
                            
                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                <label for="name" style="color: #01544F; font-weight: bold; font-family: 'Poppins', sans-serif;">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required style="padding: 12px; border-radius: 6px; border: 1px solid #ccc; font-size: 1rem; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderColor='#01544F'" onblur="this.style.borderColor='#ccc'">
                                @error('name')
                                    <span style="color: #ff6b6b; font-size: 0.85rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                <label for="email" style="color: #01544F; font-weight: bold; font-family: 'Poppins', sans-serif;">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required style="padding: 12px; border-radius: 6px; border: 1px solid #ccc; font-size: 1rem; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderColor='#01544F'" onblur="this.style.borderColor='#ccc'">
                                @error('email')
                                    <span style="color: #ff6b6b; font-size: 0.85rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                <label for="password" style="color: #01544F; font-weight: bold; font-family: 'Poppins', sans-serif;">New Password <span style="font-size: 0.8rem; font-weight: normal;">(Leave blank to keep current)</span></label>
                                <input type="password" id="password" name="password" style="padding: 12px; border-radius: 6px; border: 1px solid #ccc; font-size: 1rem; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderColor='#01544F'" onblur="this.style.borderColor='#ccc'">
                                @error('password')
                                    <span style="color: #ff6b6b; font-size: 0.85rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" style="background-color: #01544F; color: #AACD72; border: none; padding: 12px 20px; font-size: 1rem; font-weight: bold; border-radius: 6px; cursor: pointer; transition: background-color 0.3s; margin-top: 10px;" onmouseover="this.style.backgroundColor='#02423e'" onmouseout="this.style.backgroundColor='#01544F'">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
