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
                <h3 class="salutation" style="color: #AACD72; font-weight: bold; font-size: 1.5rem; text-align: center;">Messages</h3>

                <div class="allPosts" style="margin-top: 20px; width: 100%; display: flex; flex-direction: column; gap: 30px;">
                    
                    <div style="background-color: #DAEDED; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); width: 100%;">
                        <h4 style="color: #01544F; font-family: 'Poppins', sans-serif; margin-bottom: 15px; font-size: 1.2rem;"><i class="fa-solid fa-paper-plane" style="color: #AACD72; margin-right: 8px;"></i> New Message</h4>
                        <form method="POST" action="{{ route('messages.store') }}" style="display: flex; flex-direction: column; gap: 15px;">
                            @csrf
                            <input type="number" name="receiver_id" placeholder="Receiver User ID" required style="padding: 12px; border-radius: 6px; border: 1px solid #ccc; outline: none; font-family: 'Poppins', sans-serif; transition: border-color 0.3s;" onfocus="this.style.borderColor='#01544F'" onblur="this.style.borderColor='#ccc'">
                            <textarea name="content" placeholder="Type your message here..." required style="padding: 12px; border-radius: 6px; border: 1px solid #ccc; outline: none; font-family: 'Poppins', sans-serif; min-height: 80px; resize: vertical; transition: border-color 0.3s;" onfocus="this.style.borderColor='#01544F'" onblur="this.style.borderColor='#ccc'"></textarea>
                            <button type="submit" style="background-color: #01544F; color: #AACD72; border: none; padding: 10px 20px; font-weight: bold; border-radius: 6px; cursor: pointer; align-self: flex-start; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#02423e'" onmouseout="this.style.backgroundColor='#01544F'">Send <i class="fa-solid fa-arrow-right" style="margin-left: 5px;"></i></button>
                        </form>
                    </div>

                    <div style="background-color: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); width: 100%;">
                        <h4 style="color: #01544F; font-family: 'Poppins', sans-serif; margin-bottom: 20px; border-bottom: 2px solid #DAEDED; padding-bottom: 10px;"><i class="fa-solid fa-inbox" style="color: #AACD72; margin-right: 8px;"></i> Inbox History</h4>
                        
                        @if($messages->isEmpty())
                            <div style="text-align: center; color: #666; padding: 30px;">
                                <i class="fa-regular fa-comments" style="font-size: 2rem; color: #DAEDED; margin-bottom: 10px;"></i><br>
                                No messages yet.
                            </div>
                        @else
                            <div style="display: flex; flex-direction: column; gap: 15px; max-height: 500px; overflow-y: auto; padding-right: 10px;">
                                @foreach($messages as $message)
                                    @if($message->sender_id === Auth::id())
                                        <div style="align-self: flex-end; background-color: #AACD72; color: #01544F; padding: 12px 18px; border-radius: 20px 20px 0px 20px; max-width: 75%; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 5px; gap: 15px;">
                                                <strong style="font-size: 0.85rem; opacity: 0.8;">To: User {{ $message->receiver_id }}</strong>
                                                <small style="font-size: 0.7rem; opacity: 0.7;">{{ $message->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p style="margin: 0; font-family: 'Inter', sans-serif;">{{ $message->content }}</p>
                                        </div>
                                    @else
                                        <div style="align-self: flex-start; background-color: #DAEDED; color: #01544F; padding: 12px 18px; border-radius: 20px 20px 20px 0px; max-width: 75%; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 5px; gap: 15px;">
                                                <strong style="font-size: 0.85rem; opacity: 0.8;">From: User {{ $message->sender_id }}</strong>
                                                <small style="font-size: 0.7rem; opacity: 0.7;">{{ $message->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p style="margin: 0; font-family: 'Inter', sans-serif;">{{ $message->content }}</p>
                                        </div>
                                    @endif
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
