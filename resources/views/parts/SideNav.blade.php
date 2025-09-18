<div class="side_bar">
        <div class="realSideBar">
            <nav class="section_icons">
                <ul class="icons_for_sections">
                    <li class="sideBarActualise"><a href="{{ route('home') }}"><i class="fa-solid fa-newspaper"></i></a></li>
                    <li class="sideBarMessageBtn"><a href="/MyMessages"><i class="fa-solid fa-paper-plane"></i></a></li>
                    <li class="sideBarNotifBtn"><a href="/myNotifications"><i class="fa-solid fa-message"></i></a></li>
                    <li class="sideBarFriendBtn"><a href="/myFriends"><i class="fa-solid fa-user"></i></a></li>
                    <li class="sidebarMyPosts"><a href="/myPosts"><i class="fa-regular fa-note-sticky"></i></a></li>
                </ul>
            </nav>
            <nav class="parametre_icon">
                <i class="fa-solid fa-gear"></i>
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
            width: 100%;
            position: fixed;
            left: 0;
            bottom: 0;
            top: auto;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            height: auto;
            z-index: 40;
            background-color: none;
        }

        .side_bar .section_icons {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
            width: 55%;
            flex-grow: 1;
            height: auto;
            gap: 10px;
        }
    }

</style>