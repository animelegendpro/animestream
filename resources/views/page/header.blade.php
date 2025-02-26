<header class="header">
<style>
    .header__right {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding-right: 15px;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #0b0c2a;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1000;
        right: 0;
        margin-top: 10px;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .dropdown {
        position: relative;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
        opacity: 1;
        visibility: visible;
    }

    /* Add padding to create a hoverable area between trigger and menu */
    .dropdown::after {
        content: '';
        position: absolute;
        height: 20px;
        width: 100%;
        bottom: -20px;
        left: 0;
    }

    .dropdown-item {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-item:hover {
        background-color: #1c1c3a;
        color: #e53637;
    }

    .header__right .me-4 {
        margin-right: 1.5rem !important;
    }

    .dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .dropdown-divider {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin: 0.5rem 0;
    }

    /* Remove the click event script since we're using hover */
    .dropdown-toggle:hover {
        color: #e53637;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="/">
                        <img src="img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="/">Homepage</a></li>
                            @guest
                            <li><a href="{{ route('signup') }}">Sign Up <span class="arrow_carrot-down"></span></a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('signup') }}">Sign Up</a></li>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                </ul>
                            </li>
                            @endguest
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-2">
            <div class="header__right">
    <a href="#" class="search-switch me-4"><span class="icon_search"></span></a>
    @auth
        <div class="dropdown d-inline-block">
            <a href="#" class="dropdown-toggle text-white">
                <span class="icon_profile"></span>
                <span class="ml-2">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('profile') }}" class="dropdown-item">
                    <i class="fa fa-user"></i> My Profile
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fa fa-sign-out"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    @else
        <a href="{{ route('login') }}"><span class="icon_profile"></span></a>
    @endauth
</div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    var dropdownToggle = document.querySelector('.dropdown-toggle');
    var dropdownMenu = document.querySelector('.dropdown-menu');
    
    dropdownToggle.addEventListener('click', function(e) {
        e.preventDefault();
        dropdownMenu.classList.toggle('show');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.matches('.dropdown-toggle') && !e.target.closest('.dropdown-menu')) {
            dropdownMenu.classList.remove('show');
        }
    });
});
</script>

</header>