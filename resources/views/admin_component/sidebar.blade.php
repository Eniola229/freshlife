<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ url('/') }}">
            <span class="align-middle">FreshLife Water</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('profile') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ url('profile') }}">
                    <i class="align-middle" data-feather="user"></i>
                    <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('pages-blank.html') && !request()->is('pages-profile.html') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ url('pages-blank.html') }}">
                    <i class="align-middle" data-feather="book"></i>
                    <span class="align-middle">Products</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('pages-blank.html') && !request()->is('pages-profile.html') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ url('pages-blank.html') }}">
                    <i class="align-middle" data-feather="book"></i>
                    <span class="align-middle">Orders</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('pages-blank.html') && !request()->is('pages-profile.html') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ url('pages-blank.html') }}">
                    <i class="align-middle" data-feather="book"></i>
                    <span class="align-middle">Payments Records</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('icons-feather.html') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ url('icons-feather.html') }}">
                    <i class="align-middle" data-feather="coffee"></i>
                    <span class="align-middle">Notification</span>
                </a>
            </li>
        </ul>

        <!-- <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div>
                <div class="d-grid">
                    <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
                </div>
            </div>
        </div> -->
    </div>
</nav>
