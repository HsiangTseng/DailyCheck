<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>


    <!-- ================Start Sidebar================ -->
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">
                    @if (Session::has('user_account'))
                        Hello, {{Session::get('user_account')}}
                    @endif
                </li>
                <li>
                    <a href="/Home" class="mm-active">
                        <i class="metismenu-icon pe-7s-check"></i>
                        DailyCheck
                    </a>
                </li>
                <li>
                    <a href="/EditStock">
                        <i class="metismenu-icon pe-7s-pen"></i>
                        編輯股票
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ================End Sidebar================ -->


</div>  


