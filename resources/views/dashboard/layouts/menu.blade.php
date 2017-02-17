<div class="top-bar">
    <div class="top-bar-title">
            <span data-responsive-toggle="responsive-menu" data-hide-for="medium">
                <button class="menu-icon dark" type="button" data-toggle></button>
            </span>
        <strong style="color: #9d9d9d;">Cover That Dashboard</strong>
    </div>
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li><a href="{{ url('/dashboard/home') }}">Home</a></li>
            <li>
                <a href="#">One</a>
                <ul class="menu vertical">
                    <li><a href="#">One</a></li>
                    <li><a href="#">Two</a></li>
                    <li><a href="#">Three</a></li>
                </ul>
            </li>
            <li><a href="#">Two</a></li>
            <li><a href="{{ url ('/dashboard/logout') }}">Logout</a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <!--<ul class="menu">
            <li><input type="search" placeholder="Search"></li>
            <li><button type="button" class="button">Search</button></li>
        </ul>-->
    </div>
</div>