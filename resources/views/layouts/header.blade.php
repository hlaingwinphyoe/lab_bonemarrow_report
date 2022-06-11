<div class="header bg-primary mb-4 p-2 rounded">
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary btn-sm d-block d-lg-none show-sidebar-btn" id="showSidebar">
            <i class="fas fa-bars fa-2x"></i>
        </button>
        <div class="d-flex d-none d-md-flex align-items-center">
            <p class="mb-0 text-white h4 ms-1">{{ env("APP_NAME") }}</p>
        </div>
        <div class="">
            <div class="">
                <button class="btn btn-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ isset(Auth::user()->photo) ? asset('storage/profile_thumbnails/'.Auth::user()->photo) : asset('images/user_default.png') }}" class="user-img rounded" alt="">
                    <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><span class="d-block d-md-none dropdown-item">{{ auth()->user()->name }}</span></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="fa-solid fa-user-cog text-primary"></i>  Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
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
