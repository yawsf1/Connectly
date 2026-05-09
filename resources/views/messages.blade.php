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
    <title>Connectly - Messages</title>
    <style>
        .container_of_home {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .main_page {
            flex-grow: 1;
            padding: 20px;
            box-sizing: border-box;
            margin-left: 60px; 
            display: flex;
            justify-content: start;
        }

        .page_home {
            width: 100%;
            max-width: 700px; /* Limits width on desktop but stays fluid on mobile */
        }

        .message-bubble {
            max-width: 80%;
            word-wrap: break-word;
        }

        @media (max-width: 767.98px) {
            .main_page {
                margin-left: 60px;
                padding: 15px;
            }
        }

        @media (max-width: 575.98px) {
            .main_page {
                margin-left: 0;
                margin-bottom: 70px; /* Space for the bottom navigation bar */
                padding: 10px;
            }
            .message-bubble {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <header>
        <?php $usersAndPosts = []; ?>
        @include('parts.MainNav', ['usersAndPosts' => \Illuminate\Support\Facades\DB::table('users')->select('avatar')->where('id', Auth::id())->get()->map(function($user) { return (object)['user_id' => Auth::id(), 'avatar' => $user->avatar]; })])
    </header>

    <main class="container_of_home">
        @include('parts.SideNav')
        <div class="main_page">
            <div class="page_home">
                <h3 class="salutation" style="color: #AACD72; font-weight: bold; font-size: 1.5rem; text-align: center; margin-top: 10px;">Messages</h3>

                <div class="allPosts" style="margin-top: 20px; width: 100%; display: flex; flex-direction: column; gap: 20px;">

                    <div style="background-color: #DAEDED; padding: 20px; border-radius: 8px; width: 100%; box-sizing: border-box;">
                        <h4 style="color: #01544F; font-family: 'Poppins', sans-serif; margin-bottom: 15px; font-size: 1.1rem;">
                            <i class="fa-solid fa-paper-plane" style="color: #AACD72; margin-right: 8px;"></i> New Message
                        </h4>

                        @if($friends->isEmpty())
                            <div style="text-align: center; color: #666; padding: 20px; background-color: #fff; border-radius: 8px;">
                                <p style="font-family: 'Poppins', sans-serif; margin: 0;">No friends yet.</p>
                            </div>
                        @else
                            <form method="POST" action="{{ route('messages.store') }}" style="display: flex; flex-direction: column; gap: 15px;">
                                @csrf
                                <div style="width: 100%;">
                                    <div style="position: relative; width: 100%;">
                                        <select name="receiver_id" required style="width: 100%; padding: 12px 12px 12px 40px; border-radius: 6px; border: 1px solid #ccc; font-family: 'Poppins', sans-serif; box-sizing: border-box; background: white;">
                                            <option value="" disabled selected>Choose a friend...</option>
                                            @foreach($friends as $friend)
                                                <option value="{{ $friend->id }}">{{ $friend->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fa-solid fa-user" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #AACD72;"></i>
                                    </div>
                                </div>

                                <textarea name="content" placeholder="Type your message..." required style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid #ccc; min-height: 80px; box-sizing: border-box; font-family: 'Poppins', sans-serif;"></textarea>

                                <button type="submit" style="background-color: #01544F; color: #AACD72; border: none; padding: 10px 20px; font-weight: bold; border-radius: 6px; cursor: pointer; align-self: flex-start;">
                                    Send
                                </button>
                            </form>
                        @endif
                    </div>

                    <div style="background-color: #ffffff; padding: 20px; border-radius: 8px; width: 100%; box-sizing: border-box; border: 1px solid #DAEDED;">
                        <h4 style="color: #01544F; font-family: 'Poppins', sans-serif; margin-bottom: 15px; border-bottom: 2px solid #DAEDED; padding-bottom: 5px;">
                            <i class="fa-solid fa-inbox" style="color: #AACD72; margin-right: 8px;"></i> History
                        </h4>

                        @if($messages->isEmpty())
                            <div style="text-align: center; color: #999; padding: 20px;">No messages.</div>
                        @else
                            <div style="display: flex; flex-direction: column; gap: 15px; max-height: 400px; overflow-y: auto;">
                                @foreach($messages as $message)
                                    @if($message->sender_id === Auth::id())
                                        <div class="message-bubble" style="align-self: flex-end; background-color: #AACD72; color: #01544F; padding: 10px 15px; border-radius: 15px 15px 0 15px;">
                                            <p style="margin: 0; font-size: 0.9rem;">{{ $message->content }}</p>
                                        </div>
                                    @else
                                        <div class="message-bubble" style="align-self: flex-start; background-color: #DAEDED; color: #01544F; padding: 10px 15px; border-radius: 15px 15px 15px 0;">
                                            <p style="margin: 0; font-size: 0.9rem;">{{ $message->content }}</p>
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