<div class="col-12 col-lg-3 col-xl-2 vh-100 sidebar">
    <div class="d-flex justify-content-between align-items-center py-2 mt-3 nav-brand">
        <div class="d-flex align-items-center">
            <span class="p-2 rounded d-flex justify-content-center align-items-center me-2">
<!--                <i class="fas fa-user text-white h4 mb-0"></i>-->
                <img src="{{ asset('images/logo.jpg') }}" style="width: 60px" alt="">
            </span>
            <span class="fw-bolder h4 mb-0  text-primary ms-2">Biopsy Reports</span>
        </div>
        <button class="hide-sidebar-btn btn btn-light d-block d-lg-none">
            <i class="fa fa-times text-primary" style="font-size: 2em;"></i>
        </button>
    </div>
    <div class="nav-menu">
        <ul>
            <li class="text-center fw-bold h5 text-nowrap mb-0">
                <span>ICSH Guidelines</span>
            </li>

            <li class="menu-spacer"></li>

            <x-side-bar-title title="Report Listings" />

            <li class="menu-item">
                <x-side-bar-link name="Listings" link="{{ route('index') }}" />
            </li>

            <li class="menu-spacer"></li>

            <x-side-bar-title title="Report Form" />

            <li class="menu-item">
                <x-side-bar-link name="Aspirate Report" link="{{ route('aspirate.create') }}" />
            </li>
            <li class="menu-item">
                <x-side-bar-link name="Trephine Report" link="{{ route('trephine.create') }}" />
            </li>
            <li class="menu-item">
                <x-side-bar-link name="Histo Report" link="{{ route('histo.create') }}" />
            </li>
            <li class="menu-item">
                <x-side-bar-link name="Cyto Report" link="{{ route('cyto.create') }}" />
            </li>
            <li class="menu-spacer"></li>

            @if(auth()->user()->role == 0)
            <x-side-bar-title title="Manage Setting" />

            <li class="menu-item">
                <x-side-bar-link name="Hospitals" link="{{ route('hospital.create') }}" />
            </li>

            <li class="menu-spacer"></li>
            @endif
            <x-side-bar-title title="User Setting" />

            <li class="menu-item">
                @if(auth()->user()->role == 0)
                <x-side-bar-link name="Users" link="{{ route('users') }}" />
                @endif
                <x-side-bar-link name="Profile" link="{{ route('profile') }}" />

            </li>

            <hr>
            <li class="menu-item">
                <a class="btn btn-danger text-white w-100" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-sign-out"></i>  Log Out
                </a>
            </li>

        </ul>
    </div>
</div>
