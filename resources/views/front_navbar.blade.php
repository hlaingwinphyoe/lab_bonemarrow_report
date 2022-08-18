<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Toggle button -->
        <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('index') }}">
                550MCH Biopsy Reports
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <x-nav-link link="{{ route('index') }}" name="Aspirate" />
                <x-nav-link link="{{ route('trephine') }}" name="Trephine" />
                <x-nav-link link="{{ route('histo') }}" name="Histo" />
                <x-nav-link link="{{ route('cyto') }}" name="Cyto" />
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
            @guest
                <!-- Icon -->
                <a class="btn btn-primary" href="{{ route('login') }}">
                    <i class="fas fa-sign-in"></i> Login
                </a>
            @endguest
            @auth
                <a href="{{ route('aspirate.index') }}" class="btn btn-primary">
                    <svg width="15px" height="15px" viewBox="0 0 28 28" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <!-- Uploaded to SVGRepo https://www.svgrepo.com -->
                        <title>ic_fluent_grid_28_filled</title>
                        <desc>Created with Sketch.</desc>
                        <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="ic_fluent_grid_28_filled" fill="#fff" fill-rule="nonzero">
                                <path d="M10.75,15 C11.9926407,15 13,16.0073593 13,17.25 L13,22.75 C13,23.9926407 11.9926407,25 10.75,25 L5.25,25 C4.00735931,25 3,23.9926407 3,22.75 L3,17.25 C3,16.0073593 4.00735931,15 5.25,15 L10.75,15 Z M22.75,15 C23.9926407,15 25,16.0073593 25,17.25 L25,22.75 C25,23.9926407 23.9926407,25 22.75,25 L17.25,25 C16.0073593,25 15,23.9926407 15,22.75 L15,17.25 C15,16.0073593 16.0073593,15 17.25,15 L22.75,15 Z M10.75,3 C11.9926407,3 13,4.00735931 13,5.25 L13,10.75 C13,11.9926407 11.9926407,13 10.75,13 L5.25,13 C4.00735931,13 3,11.9926407 3,10.75 L3,5.25 C3,4.00735931 4.00735931,3 5.25,3 L10.75,3 Z M22.75,3 C23.9926407,3 25,4.00735931 25,5.25 L25,10.75 C25,11.9926407 23.9926407,13 22.75,13 L17.25,13 C16.0073593,13 15,11.9926407 15,10.75 L15,5.25 C15,4.00735931 16.0073593,3 17.25,3 L22.75,3 Z" id="🎨-Color"></path>
                            </g>
                        </g>
                    </svg>
                    Dashboard
                </a>
                <!-- Avatar -->
                <div class="dropdown ms-3">
                    <form id="logout" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="{{ isset(Auth::user()->photo) ? asset('storage/profile_thumbnails/'.Auth::user()->photo) : asset('images/user_default.png') }}" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy"/>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout').submit();">
                                <i class="fa-solid fa-sign-out me-1"></i>Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
