<div class="all_navigation_bar">
    <nav class="nav_title">
        <a class="app_name" href="/">Connectly</a>
    </nav>
    <nav class="nav_sections">
        <ul class="list_sections">
            <li class="HomeMainNav"><a id="home_link" href="/">HOME</a></li>
            <li class="PostsMainNav"><a href="/myPosts">POSTS</a></li>
            <li class="FriendsMainNav"><a href="/myFriends">FRIENDS</a></li>
            <li class="NotificationMainNav"><a href="/myNotifications">NOTIFICATIONS</a></li>
        </ul>
    </nav>
    <div style="display: flex; align-items: center;">
        <form action="{{ route('logout')}}" method="POST" class="nav_logout">
            @csrf
            <button type="submit">LOGOUT</button>
        </form>
        
        <a href="{{ route('settings') }}" class="nav_profile_link">
            <img class="profileImage" 
                 src="{{ Auth::user()->avatar ? (Str::startsWith(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset(Auth::user()->avatar)) : asset('media/Untitled (2).png') }}" 
                 alt="Settings" >
        </a>
    </div>
</div>
<style>
    
.all_navigation_bar {
    display: flex;
    justify-content: space-between;
    width: 90%;
    position: relative;
}

.all_navigation_bar nav {
    display: flex;
    align-items: center;
}

.all_navigation_bar .nav_sections .list_sections {
    display: flex;
    list-style: none;
    gap: 30px;
    align-items: center;
}

.all_navigation_bar img {
    border-radius: 50%;
    height: 40px;
    position: absolute;
    right: 0px;
    cursor: pointer;
}

.all_navigation_bar .nav_sections a,
.all_navigation_bar .nav_title a {
    color: #01544F;
    text-decoration: none;
    font-weight: 800;
}

.all_navigation_bar .nav_title a {
    font-family: "Lobster", sans-serif;
    font-weight: 800;
    font-style: normal;
    font-size: 1.4rem;
}

.all_navigation_bar .nav_logout button {
    text-decoration: none;
    color: #AACD72;
    background-color: #01544F;
    height: 35px;
    width: 110px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    border: none;
    font-family: "Poppins", sans-serif;
    font-weight: 750;
    cursor: pointer;
    margin-right: 60px;
}

.list_sections li a,
.nav_title a {
    font-size: 1rem;
}

.list_sections #home_link {
    text-decoration: none;
    color: #01544F;
    background-color: #AACD72;
    height: 40px;
    width: 80px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.all_navigation_bar .nav_profile_link {
    display: flex;
    align-items: center;
}

.all_navigation_bar img.profileImage {
    border-radius: 50%;
    height: 40px;
    width: 40px; 
    object-fit: cover;
    border: 2px solid #AACD72; 
    cursor: pointer;
    position: static; 
}
@media (max-width: 991.98px) {
    .all_navigation_bar .NotificationMainNav {
        display: none;
    }
}

@media (max-width: 767.98px) {
    .all_navigation_bar .nav_sections .list_sections .HomeMainNav {
        display: none;
    }
    .all_navigation_bar .nav_logout button {
        text-decoration: none;
        color: #AACD72;
        background-color: #01544F;
        height: 35px;
        width: 100px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        border: none;
        font-family: "Poppins", sans-serif;
        font-weight: 650;
        cursor: pointer;
        margin-right: 60px;
    }
    .all_navigation_bar .NotificationMainNav,
    .all_navigation_bar .FriendsMainNav,
    .all_navigation_bar .PostsMainNav {
        display: none;
    }
}

@media (max-width: 575.98px) {
    .all_navigation_bar .nav_logout button {
        text-decoration: none;
        color: #AACD72;
        background-color: #01544F;
        height: 35px;
        width: 100px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        border: none;
        font-family: "Poppins", sans-serif;
        font-weight: 650;
        cursor: pointer;
        margin-right: 60px;
    }
}


</style>