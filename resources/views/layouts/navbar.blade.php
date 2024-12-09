<nav class="navbar bg-base-100 fixed top-0 z-50 shadow-md">
    <div class="navbar-start">
        <div class="dropdown">
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="#home">Home</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#about">About</a></li>
            </ul>
        </div>
        <a class="btn btn-ghost normal-case text-xl text-error">Vir Sushi</a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="#home">Home</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#about">About</a></li>
        </ul>
    </div>
    <div class="navbar-end">
        <a class="btn btn-ghost text-sm text-gray-500 hover:text-red-500 transition-colors"
            href="{{ route('login') }}">Login</a>
    </div>
</nav>
