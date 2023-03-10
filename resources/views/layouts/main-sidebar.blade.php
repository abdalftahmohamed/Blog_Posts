<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!-- User details -->

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>

            <li>
                <a href="{{route('dashboard')}}" class="waves-effect">
                    <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end"></span>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-calendar-2-line"></i>
                    <span>Posts</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('posts.index')}}">View</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-mail-send-line"></i>
                    <span>Comments</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('comments.index')}}">View</a></li>
                </ul>
            </li>


        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>
