<header style="border-bottom: solid 1px green; background-color: transparent; z-index: 999;">
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Logo -->
                    {{-- <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="menu-main d-flex align-items-center justify-content-end">
                            <a href="mebni.org"><img src="{{ asset('assets/frontend/img/logo/logo_mebni.png') }}" class="img-logo"alt=""></a>
                        </div>
                    </div> --}}
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div style="display: flex; flex-direction: row; justify-content: space-between;">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <a href="mebni.org"><img src="{{ asset('assets/frontend/img/logo/logo_mebni.png') }}" class="img-logo"alt=""></a>
                            </div>
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="/">Home</a></li>
                                            <li><a href="{{ route('public.profile') }}">Profile</a></li>
                                            <li><a href="{{ route('public.organization') }}">Organization</a></li>
                                            <li><a href="#">News & Publication</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('public.news') }}">News</a></li>
                                                    <li><a href="{{ route('public.publication') }}">Publication</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('public.event') }}">Event</a></li>
                                            <li>
                                                <div class="header-right-btn d-lg-block" style="width: 100%;">
                                                    <a href="{{ route('public.membership') }}" class="btn header-btn" style="height: 60px; color: white; display: flex; justify-content: center; align-items: center;">Membership</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
