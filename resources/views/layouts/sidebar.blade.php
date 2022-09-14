<div class="col-12 col-lg-3 col-xl-2 vh-100 sidebar">
    <div class="d-flex justify-content-between align-items-center py-2 mt-3 nav-brand">
        <a href="" class="d-flex align-items-center">
            <span class="p-2 rounded d-flex justify-content-center align-items-center me-2">
<!--                <i class="fas fa-user text-white h4 mb-0"></i>-->
                <img src="{{ asset('images/logo.png') }}" style="width: 40px" alt="">
            </span>
            <span class="fw-bolder h4 mb-0  text-primary ms-2">Biopsy Reports</span>
        </a>
        <button class="hide-sidebar-btn btn btn-link d-block d-lg-none">
            <i class="fa fa-times text-danger" style="font-size: 2em;"></i>
        </button>
    </div>
    <div class="nav-menu">
        <ul>
            <li class="text-center fw-bold h5 text-nowrap mb-0 mt-3">
                <span>ICSH Guidelines</span>
            </li>

            <li class="menu-spacer"></li>

            <x-side-bar-title title="Index" />

            <li class="menu-item">
                <x-side-bar-link name="Dashboard" link="{{ route('index') }}" />
            </li>
            <li class="menu-item">
                <x-side-bar-link name="Sales" link="{{ route('sales') }}" />
            </li>

            <li class="menu-spacer"></li>

            @can('access approve report')
            <x-side-bar-title title="Authorize" />

            <div class="item">
                <a href="#" class="menu-item-link sub-btn mb-1">
                    Authorized Reports
                    <i class="fa-solid fa-chevron-down float-end custom-dropdown"></i>
                </a>
                <div class="sub-menu ms-4">
                    <a href="{{ route('aspirate.index') }}" class="dropdown-item {{ route('aspirate.index') == request()->url() ? 'active':'' }}">
                        <i class="fa-solid fa-chevron-right me-3" style="font-size: 10px"></i>
                        Aspirate List
                    </a>
                    <a href="{{ route('trephine.index') }}" class="dropdown-item {{ route('trephine.index') == request()->url() ? 'active':'' }}">
                        <i class="fa-solid fa-chevron-right me-3" style="font-size: 10px"></i>
                        Trephine List
                    </a>
                    <a href="{{ route('histo') }}" class="dropdown-item {{ route('histo') == request()->url() ? 'active':'' }}">
                        <i class="fa-solid fa-chevron-right me-3" style="font-size: 10px"></i>
                        Histo List
                    </a>
                    <a href="{{ route('cyto') }}" class="dropdown-item {{ route('cyto') == request()->url() ? 'active':'' }}">
                        <i class="fa-solid fa-chevron-right me-3" style="font-size: 10px"></i>
                        Cyto List
                    </a>
                </div>
            </div>

            <li class="menu-spacer"></li>
            @endcan

            @can('access approve')
                <x-side-bar-title title="Approve" />
                <div class="item">
                    <a href="#" class="menu-item-link sub-btn mb-1">
                        Approve Reports
                        <i class="fa-solid fa-chevron-down float-end custom-dropdown"></i>
                    </a>

                    <div class="sub-menu ms-4">
                        <a href="{{ route('report.toApproveHisto') }}" class="dropdown-item {{ route('report.toApproveHisto') == request()->url() ? 'active':'' }}">
                            <i class="fa-solid fa-chevron-right me-3" style="font-size: 10px"></i>
                            Histo Approve
                        </a>
                        <a href="{{ route('report.toApproveCyto') }}" class="dropdown-item {{ route('report.toApproveCyto') == request()->url() ? 'active':'' }}">
                            <i class="fa-solid fa-chevron-right me-3" style="font-size: 10px"></i>
                            Cyto Approve
                        </a>

                    </div>
                </div>
                <li class="menu-spacer"></li>
            @endcan

            @can('access histo')
            <x-side-bar-title title="Register" />
            <div class="item">
                <a href="#" class="menu-item-link sub-btn mb-1">
                    Registered Reports
                    <i class="fa-solid fa-chevron-down float-end custom-dropdown"></i>
                </a>

                <div class="sub-menu ms-4">
                    <a href="{{ route('histo.index') }}" class="dropdown-item {{ route('histo.index') == request()->url() ? 'active':'' }}">
                        <i class="fa-solid fa-chevron-right me-3" style="font-size: 10px"></i>
                        Histo Registered
                    </a>
                    <a href="{{ route('cyto.index') }}" class="dropdown-item {{ route('cyto.index') == request()->url() ? 'active':'' }}">
                        <i class="fa-solid fa-chevron-right me-3" style="font-size: 10px"></i>
                        Cyto Registered
                    </a>

                </div>
            </div>

            <li class="menu-spacer"></li>
            @endcan

            @role('Admin')
                <x-side-bar-title title="Manage Setting" />

                <li class="menu-item">
                    <x-side-bar-link name="Specimen Type" link="{{ route('specimen_type.create') }}" />
                </li>

                <li class="menu-item">
                    <x-side-bar-link name="Hospitals" link="{{ route('hospital.create') }}" />
                </li>


                <li class="menu-item">
                    <x-side-bar-link name="Roles" link="{{ route('roles.index') }}" />
                </li>

                <li class="menu-item">
                    <x-side-bar-link name="Users" link="{{ route('users') }}" />
                </li>

                <li class="menu-spacer"></li>
            @endrole

            <x-side-bar-title title="User Setting" />

            <li class="menu-item">
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
