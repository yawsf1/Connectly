<div class="side_bar">
    <div class="realSideBar">
        <nav class="section_icons">
            <ul class="icons_for_sections">
                <li class="sideBarActualise">
                    <a href="{{ route('home') }}" class="{{ Request::is('/') ? 'active-side-link' : '' }}">
                        <i class="fa-solid fa-newspaper"></i>
                    </a>
                </li>
                <li class="sideBarMessageBtn">
                    <a href="/MyMessages" class="{{ Request::is('MyMessages') ? 'active-side-link' : '' }}">
                        <i class="fa-solid fa-paper-plane"></i>
                    </a>
                </li>
                <li class="sideBarNotifBtn">
                    <a href="/myNotifications" class="{{ Request::is('myNotifications') ? 'active-side-link' : '' }}">
                        <i class="fa-solid fa-message"></i>
                    </a>
                </li>
                <li class="sideBarFriendBtn">
                    <a href="/myFriends" class="{{ Request::is('myFriends') ? 'active-side-link' : '' }}">
                        <i class="fa-solid fa-user"></i>
                    </a>
                </li>
                <li class="sidebarMyPosts">
                    <a href="/myPosts" class="{{ Request::is('myPosts') ? 'active-side-link' : '' }}">
                        <i class="fa-regular fa-note-sticky"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <nav class="parametre_icon">
            <a href="{{ route('settings') }}" class="{{ Request::is('settings') ? 'active-side-link' : '' }}" style="text-decoration: none;">
                <i class="fa-solid fa-gear"></i>
            </a>
        </nav>
    </div>
</div>
<style>
    .side_bar {
        background-color: #DAEDED;
        width: 60px;
        position: absolute;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
        justify-content: space-between;
    }

    .realSideBar {
        width: 60px;
        position: fixed;
        left: 0;
        top: 55px;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: calc(100vh - 55px);
        justify-content: space-between;
    }

    .icons_for_sections {
        list-style: none;
    }

    .icons_for_sections li {
        margin-top: 20px;
    }

    .icons_for_sections .sideBarNotifBtn,
    .icons_for_sections .SideBarHomeBtn,
    .icons_for_sections .sideBarFriendBtn {
        display: none;
    }

    .icons_for_sections .sidebarMyPosts {
        display: none;
    }



    .parametre_icon i {
        margin-bottom: 25px;
    }
.icons_for_sections li a.active-side-link i,
.parametre_icon a.active-side-link i {
    color: #AACD72;
    background-color: #01544F;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.icons_for_sections li a i, .parametre_icon a i {
    transition: all 0.3s ease;
    color: #01544F; 
}
.icons_for_sections {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: center; 
}

.icons_for_sections li {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    width: 100%; 
}

.icons_for_sections li a, .parametre_icon a {
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    width: 40px; 
    height: 40px;
}

.icons_for_sections li a.active-side-link i,
.parametre_icon a.active-side-link i {
    color: #AACD72 !important;
    background-color: #01544F;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
    position: relative; 
}

    @media (max-width: 991.98px) {
        .icons_for_sections .sideBarNotifBtn {
            display: block;
        }
    }

    @media (max-width: 767.98px) {
        .icons_for_sections .sideBarNotifBtn,
        .icons_for_sections .sideBarFriendBtn,
        .icons_for_sections .sideBarActualise,
        .icons_for_sections .SideBarHomeBtn {
            display: flex;
        }

        .icons_for_sections .sidebarMyPosts {
            display: flex;
        }
    }

    @media (max-width: 575.98px) {

    .side_bar {
        position: fixed;
        bottom: 0;
        left: 0;
        top: auto;
        width: 100%;
        height: 60px;
        z-index: 100;
        background-color: #DAEDED;
    }

    .realSideBar {
        position: relative; /* remove fixed */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        flex-direction: row; /* horizontal */
        justify-content: space-between;
        align-items: center;
        padding: 0 15px;
    }

    .section_icons {
        width: 100%;
    }

    .icons_for_sections {
        display: flex;
        flex-direction: row; 
        align-items: center;
        padding: 0;
        justify-content: center; 
        gap: 20px; 
        width: auto; 
        margin: 0 auto; 
    }

    .icons_for_sections li {
        margin-top: 0;
        width: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .icons_for_sections li a.active-side-link i,
    .parametre_icon a.active-side-link i {
        width: 35px;
        height: 35px;
    }

    .parametre_icon i {
        margin-bottom: 0;
    }
}

</style>