@auth
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
    <title>Document</title>
</head>
<body>
    <header>
        <div class="all_navigation_bar">
            <nav class="nav_title">
                <a class="app_name" href="/">Connectly</a>
            </nav>
            <nav class="nav_sections">
                <ul class="list_sections">
                    <li><a id="home_link" href="/">HOME</a></li>
                    <li><a href="/posts">POSTS</a></li>
                    <li><a href="/friends">FRIENDS</a></li>
                    <li><a href="/notifications">NOTIFICATIONS</a></li>
                </ul>
            </nav>
            <form action="/logout" method="POST" class="nav_logout">
                @csrf
                <button type="submit">DÉCONNECTER</button>
            </form>
        </div>
    </header>
    <main class="container_of_home">
        <div class="side_bar">
            <div class="realSideBar">
                <nav class="section_icons">
                    <ul class="icons_for_sections">
                        <li><i class="fa-solid fa-paper-plane"></i></li>
                        <li><i class="fa-solid fa-message"></i></li>
                        <li><i class="fa-solid fa-user"></i></li>
                        <li><i class="fa-solid fa-newspaper"></i></li>
                        <li><i class="fa-regular fa-note-sticky"></i></li>
                    </ul>
                </nav>
                <nav class="parametre_icon">
                    <i class="fa-solid fa-gear"></i>
                </nav>
            </div>
        </div>
        <div class="main_page">
            <div class="page_home">
                <h3 class="salutation">{{ session('name') }}</h3>
                <form class="post_writing_content" action="/makingPost" method="post">
                    @csrf
                    <textarea  type="text" name="content" id="tell_friends" placeholder="Tell your friends something new! ..."></textarea>
                    <button type="submit" id="post_it" name="post_it">Post it</button>
                </form>
                <div class="allPosts">
                    @foreach($usersAndPosts as $userAndPost)
                        <div class="iPost">
                            <div class="firstLine">
                                <h3 class="userName">
                                    <img src="{{ isset($userAndPost->avatar) ? $userAndPost->avatar : asset('media/Untitled (2).png') }}" alt="" >
                                    {{ $userAndPost->name }}
                                </h3>
                                <h3 class="creationDate">
                                    {{ $userAndPost->createdDate}}
                                    <span class="at"> at</span> 
                                    {{ $userAndPost->createdTime }}
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
@endauth