<nav class="navbar">
    <div class="inner">
        <a href="{{ route('dashboard') }}" class="brand">AndroPeduliLumajang</a>
        <div class="menu">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">DASHBOARD</a>
            <a href="{{ route('pengelolaan') }}" class="{{ request()->routeIs('pengelolaan') ? 'active' : '' }}">PENGELOLAAN</a>
            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">PROFIL</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="link-btn">Keluar</button>
            </form>
        </div>
    </div>
</nav>
