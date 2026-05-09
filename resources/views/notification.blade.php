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

    <style>
        .notification-card {
            width: 100%;
            background-color: #daeded;
            border-radius: 6px;
            padding: 15px 20px;
            border-left: 5px solid transparent;
            transition: transform 0.2s;
            box-sizing: border-box;
        }
        .notification-card.unread {
            background-color: #ffffff;
            border-left-color: #aacd72;
        }
        .notification-card:hover {
            transform: scale(1.01);
        }
        .notification-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
        }
        .notification-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }
        .notification-left .bell-icon {
            font-size: 1.1rem;
            cursor: default;
        }
        .notification-left .bell-icon.unread {
            color: #aacd72;
        }
        .notification-left .bell-icon.read {
            color: #01544f;
        }
        .notification-message {
            color: #01544f;
            font-weight: 600;
            font-size: 0.95rem;
            margin: 0;
        }
        .notification-time {
            color: #666;
            font-size: 0.78rem;
            margin-top: 3px;
            display: block;
        }
        .notification-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }
        .btn-mark-read {
            background-color: #aacd72;
            color: #01544f;
            border: none;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.8rem;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: background-color 0.3s;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .btn-mark-read:hover {
            background-color: #90b55a;
        }
        .btn-delete {
            background-color: transparent;
            color: #e53935;
            border: 2px solid #e53935;
            padding: 6px 10px;
            border-radius: 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        .btn-delete i {
            color: #e53935;
            font-size: 0.85rem;
            cursor: pointer;
        }
        .btn-delete:hover {
            background-color: #e53935;
        }
        .btn-delete:hover i {
            color: #fff;
        }
        .btn-clear-all {
            background-color: transparent;
            color: #e53935;
            border: 2px solid #e53935;
            padding: 7px 18px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.83rem;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .btn-clear-all i {
            color: #e53935;
            font-size: 0.85rem;
            cursor: pointer;
            transition: color 0.3s;
        }
        .btn-clear-all:hover {
            background-color: #e53935;
            color: #fff;
        }
        .btn-clear-all:hover i {
            color: #fff;
        }
        .empty-notifications {
            background-color: #daeded;
            color: #01544f;
            padding: 35px 20px;
            border-radius: 6px;
            text-align: center;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            box-sizing: border-box;
        }
        .empty-notifications i {
            font-size: 2rem;
            color: #aacd72;
            margin-bottom: 12px;
            display: block;
            cursor: default;
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

                <h3 class="salutation" style="color: #aacd72; font-weight: bold; font-size: 1.5rem; text-align: center; margin-bottom: 5px;">Notifications</h3>

                <div class="allPosts">

                    @if($notifications->isEmpty())
                        <div class="empty-notifications">
                            <i class="fa-regular fa-bell-slash"></i>
                            No new notifications right now.
                        </div>
                    @else
                        {{-- Clear All --}}
                        <div style="width: 100%; display: flex; justify-content: flex-end; margin-bottom: 12px;">
                            <form method="POST" action="{{ route('notifications.destroyAll') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-clear-all">
                                    <i class="fa-solid fa-trash"></i> Clear All
                                </button>
                            </form>
                        </div>

                        {{-- Notification list --}}
                        @foreach($notifications as $notification)
                            <div class="notification-card {{ $notification->is_read ? 'read' : 'unread' }}">
                                <div class="notification-top">

                                    {{-- Left: bell + text --}}
                                    <div class="notification-left">
                                        <i class="fa-solid fa-bell bell-icon {{ $notification->is_read ? 'read' : 'unread' }}"></i>
                                        <div>
                                            <p class="notification-message">{{ $notification->message }}</p>
                                            <small class="notification-time">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>

                                    {{-- Right: actions --}}
                                    <div class="notification-actions">
                                        @if(!$notification->is_read)
                                            <form method="POST" action="{{ route('notifications.update', $notification->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn-mark-read">
                                                    <i class="fa-solid fa-check" style="color: #01544f; font-size: 0.8rem;"></i> Mark as Read
                                                </button>
                                            </form>
                                        @endif

                                        <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </main>
</body>
</html>