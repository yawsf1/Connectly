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
    <link rel="icon" href="{{ asset('media/Untitled design.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Connectly - Home</title>
</head>
<body>
    <header>
        @include('parts.MainNav')
    </header>

    <main class="container_of_home">
        @include('parts.SideNav')
        <div class="main_page">

            <div class="page_home">
                <h3 class="salutation">{{ session('name') }}</h3>
                <form class="post_writing_content" action="{{ route('makingPost') }}" method="POST">
                    @csrf
                    <textarea  type="text" name="content" id="tell_friends" placeholder="Tell your friends something new! ..."></textarea>
                    <button type="submit" id="post_it" name="post_it">Post it</button>
                </form>
                <div class="allPosts">
                    @foreach($usersAndPosts as $userAndPost)
                        <div class="iPost" data-id="{{$userAndPost->post_id}}">
                            <div class="deletePostConfirmation">
                                <i class="fa-solid fa-xmark deleteAttentionQuestion"></i>
                                <h3>
                                    <span class="mainAttentionQuestion"> you sure you want to delete this post? </span>
                                    <br><span class="mainAttentionProblem">This action cannot be undone. </span>
                                </h3>
                                <div class="btnsOfAttentionContainer">
                                    <button class="confirmDeletePost">Delete</button>
                                    <button class="cancelDeletePost">Cancel</button>
                                </div>
                            </div>    
                            @if($userAndPost->user_id === Auth::id())
                                <div class="PostModifications">
                                    <ul>
                                        <li class="changingPost">Modify <i class="fa-solid fa-pen-to-square"></i></li>
                                        <li class="deletingPost">Delete <i class="fa-solid fa-trash"></i></li>
                                    </ul>
                                </div>
                            @endif
                            <div class="firstLine">
                                <h3 class="userName">
                                    <img class="profileImage" src="{{ $userAndPost->avatar ?? asset('media/Untitled (2).png') }}" alt="" >
                                    {{ $userAndPost->name }}
                                </h3>
                                <h3 class="creationDate">
                                    {{ $userAndPost->createdDate}}
                                    <span class="at"> at</span> 
                                    {{ $userAndPost->createdTime }}
                                    @if($userAndPost->user_id === Auth::id())
                                        <i class="fa-solid fa-ellipsis DetailOfThePost"></i>
                                    @endif                                    
                                </h3>
                            </div>
                            <div class="theActualPost">
                                <p class="contentOfPost">{{ $userAndPost->content }}</p>
                            </div>
                        </div>    
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</body>
</html>
