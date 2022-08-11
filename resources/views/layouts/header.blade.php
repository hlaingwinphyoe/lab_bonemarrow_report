<div class="header bg-primary mb-3 py-2 px-3">
    <div class="d-flex justify-content-between">
        <button class="btn btn-link btn-sm d-block d-lg-none show-sidebar-btn" id="showSidebar">
            <i class="fas fa-bars fa-2x text-white"></i>
        </button>
        <div class="d-flex d-none d-md-flex align-items-center">
            <a href="{{ route('index') }}" class="mb-0 text-white h4 ms-1">550 MCH Biopsy Reports</a>
        </div>
        <div class="">
            <div class="dropdown">
                <a
                    class="dropdown-toggle d-flex align-items-center hidden-arrow"
                    href="#"
                    id="navbarDropdownMenuAvatar"
                    role="button"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false"
                >
                    <img
                        src="{{ isset(Auth::user()->photo) ? asset('storage/profile_thumbnails/'.Auth::user()->photo) : asset('images/user_default.png') }}"
                        class="rounded shadow user-img me-2"
                        alt="user-image"
                        loading="lazy"
                    />
                    <span class="d-none d-md-inline text-white">{{ auth()->user()->name }}</span>
                </a>
                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdownMenuAvatar"
                >
                    <li><span class="d-block d-md-none dropdown-item">{{ auth()->user()->name }}</span></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="fa-solid fa-user-cog text-primary"></i> My Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-sign-out text-danger"></i>  Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
