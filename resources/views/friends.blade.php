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
    <title>Connectly - Notifications</title>
</head>
<body>
    <header>
        <?php 
           $usersAndPosts = []; 
        ?>
        @include('parts.MainNav', ['usersAndPosts' => \Illuminate\Support\Facades\DB::table('users')->select('avatar')->where('id', Auth::id())->get()->map(function($user) { return (object)['user_id' => Auth::id(), 'avatar' => $user->avatar]; })])
    </header>

    <main class="container_of_home">
        @include('parts.SideNav')
        <div class="main_page">

            <div class="page_home">
                <h3 class="salutation" style="color: #AACD72; margin-bottom: 20px; font-weight: bold; font-size: 1.5rem; text-align: center;">Friends</h3>
                <div class="allPosts">
                    @if($errors->any())
                        <div style="background-color: #ff6b6b; color: white; padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center; font-weight: bold;">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div style="background-color: #AACD72; color: #01544F; padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center; font-weight: bold;">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="iPost" style="margin-bottom: 30px; padding: 20px; text-align: center;">
                        <h4 style="color: #01544F; margin-bottom: 10px;">Your Unique ID</h4>
                        <div style="background-color: #DAEDED; padding: 10px; border-radius: 6px; font-family: monospace; font-size: 1.5rem; color: #01544F; font-weight: bold; letter-spacing: 2px;">
                            {{ Auth::user()->unique_code }}
                        </div>
                        <p style="color: #666; font-size: 0.9rem; margin-top: 5px;">Share this code with your friends to connect!</p>
                    </div>

                    <div class="iPost" style="margin-bottom: 30px; padding: 20px;">
                        <h4 style="color: #01544F;">Add Friend</h4>

                        <form method="POST" action="{{ route('friends.store') }}" style="display: flex; gap: 10px; margin-top: 10px;">
                            @csrf
                            <input type="text" name="unique_code" placeholder="Unique ID (9 chars)" maxlength="9" required style="padding: 10px; border-radius: 6px; border: 1px solid #ccc; flex-grow: 1; outline: none;" onfocus="this.style.borderColor='#01544F'" onblur="this.style.borderColor='#ccc'">
                            <button type="submit" style="background-color: #AACD72; color: #01544F; font-weight: bold; border: none; padding: 10px 20px; cursor: pointer; border-radius: 6px;">Send Request</button>
                        </form>
                                                <p style="color: #666; font-size: 0.9rem; margin-top: 5px;">                                                Enter your friend's unique ID (e.g. IZFELSHA5)</p>

                    </div>

                    <div class="iPost" style="margin-bottom: 30px; padding: 20px;">
                        <h4 style="color: #01544F; margin-bottom: 15px;">Pending Requests</h4>
                        @if($pendingRequests->isEmpty())
                            <p style="text-align: center; color: #666;">No pending requests.</p>
                        @else
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                @foreach($pendingRequests as $request)
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #DAEDED; color: #01544F; border-radius: 6px;">
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <img src="{{ $request->user->avatar ?? asset('media/Untitled (2).png') }}" style="width: 40px; height: 40px; border-radius: 50%;">
                                            <p style="margin: 0; font-weight: bold;">{{ $request->user->name }}</p>
                                        </div>
                                        <div style="display: flex; gap: 10px;">
                                            <form method="POST" action="{{ route('friends.update', $request->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" style="background-color: #AACD72; color: #01544F; font-weight: bold; border: none; padding: 8px 15px; cursor: pointer; border-radius: 6px;">Accept</button>
                                            </form>
                                            <form method="POST" action="{{ route('friends.destroy', $request->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background-color: #ff6b6b; color: white; font-weight: bold; border: none; padding: 8px 15px; cursor: pointer; border-radius: 6px;">Decline</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="iPost" style="margin-bottom: 30px; padding: 20px;">
                        <h4 style="color: #01544F; margin-bottom: 15px;">My Friends</h4>
                        @if($friends->isEmpty())
                            <p style="text-align: center; color: #666;">You have no friends yet.</p>
                        @else
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                @foreach($friends as $friend)
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #DAEDED; color: #01544F; border-radius: 6px;">
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <img src="{{ $friend->avatar ?? asset('media/Untitled (2).png') }}" style="width: 40px; height: 40px; border-radius: 50%;">
                                            <div>
                                                <p style="margin: 0; font-weight: bold;">{{ $friend->name }}</p>
                                                <small style="color: #666;">ID: {{ $friend->unique_code }}</small>
                                            </div>
                                        </div>
                                        <form method="POST" action="{{ route('friends.destroy', $friend->friendship_id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background-color: #ff6b6b; color: white; font-weight: bold; border: none; padding: 8px 15px; cursor: pointer; border-radius: 6px;">Remove</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
