<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            JUNGE SHOP
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggel navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>

            {{-- Right Side Of Navbar --}}
            <ul class="navbar-nav navbar-right">
                {{-- Authentication Links --}}
                <li class="nav-item"><a href="#" class="nav-link">登录</a></li>
                <li class="nav-item"><a href="#" class="nav-link">注册</a></li>
            </ul>
        </div>
    </div>
</nav>