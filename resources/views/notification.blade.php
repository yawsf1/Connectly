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
                <h3 class="salutation" style="color: #AACD72; font-weight: bold; font-size: 1.5rem; text-align: center;">Notifications</h3>
            
                <div class="allPosts" style="margin-top: 20px; width: 100%;">
                    @if($notifications->isEmpty())
                        <div style="background-color: #DAEDED; color: #01544F; padding: 30px; border-radius: 8px; text-align: center; font-weight: bold; font-family: 'Poppins', sans-serif;">
                            <i class="fa-regular fa-bell-slash" style="font-size: 2rem; margin-bottom: 10px; color: #AACD72;"></i><br>
                            No new notifications right now.
                        </div>
                    @else
                        <div style="display: flex; flex-direction: column; gap: 15px;">
                            @foreach($notifications as $notification)
                                <div class="iPost" style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background-color: {{ $notification->is_read ? '#DAEDED' : '#ffffff' }}; color: #01544F; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid {{ $notification->is_read ? 'transparent' : '#AACD72' }}; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.01)'" onmouseout="this.style.transform='scale(1)'">
                                    <div style="display: flex; align-items: center; gap: 15px;">
                                        <i class="fa-solid fa-bell" style="color: {{ $notification->is_read ? '#01544F' : '#AACD72' }}; font-size: 1.2rem;"></i>
                                        <div>
                                            <p style="margin: 0; font-weight: bold; font-family: 'Poppins', sans-serif;">{{ $notification->message }}</p>
                                            <small style="color: #666; font-size: 0.8rem;">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    @if(!$notification->is_read)
                                        <form method="POST" action="{{ route('notifications.update', $notification->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" style="background-color: #AACD72; color: #01544F; border: none; padding: 8px 16px; cursor: pointer; border-radius: 20px; font-weight: bold; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#90b55a'" onmouseout="this.style.backgroundColor='#AACD72'">Mark as Read</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</body>
</html>
